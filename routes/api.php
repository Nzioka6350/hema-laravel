<?php

use App\Http\Controllers\CoffeeBeanController;
use App\Http\Controllers\CoffeeGradeController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeeOnboardingController;
use App\Http\Controllers\GrowerController;
use App\Http\Controllers\JoinInviteController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PurchaseReceiptController;
use App\Http\Controllers\UserController;
use App\Jobs\Waba;
use App\Models\JoinInvite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Notifications\NewLogin;
use Carbon\Carbon;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('waba', function (Request $request) {
    Waba::dispatch($request);
    // Log::alert($messageNtification);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('/user/logout', function (Request $request) {
        Auth::guard('web')->logout();
        return response(status: 200);
    });
    Route::prefix('users')->name('users')->controller(UserController::class)->group(function () {
        Route::get('', 'index');
        Route::post('', 'store');
        Route::get('{user}', 'show');
        Route::post('{user}', 'update');
        Route::delete('{user}', 'destroy');
    });

    Route::prefix('notifications')->name('notifications')->controller(NotificationController::class)->group(function () {
        Route::get('', 'notifications');
        Route::get('unread', 'unreadNotifications');
        Route::get('{id}', 'show');
        Route::post('mark-as-read', 'markAsRead');
        Route::post('delete-read', 'deleteRead');
        Route::post('{id}/mark-as-read', 'markNotificationAsRead');
        Route::delete('{id}', 'deleteNotification');
    });

    Route::prefix('invites')->name('invites')->controller(JoinInviteController::class)->group(function () {
        Route::get('', 'index');
        Route::get('{joinInvite}', 'show');
        Route::post('', 'store');
    });

    Route::prefix('manufacturing')->group(function () {
        Route::resource('coffee-grades', CoffeeGradeController::class);
        Route::resource('coffee-types', CoffeeBeanController::class);
        Route::prefix('purchase-receipts')->name('purchase-receipts')->controller(PurchaseReceiptController::class)->group(function () {
            Route::get('', 'index');
            Route::post('', 'store');
            Route::get('{purchase-receipt}', 'show');
            Route::post('{purchase-receipt}', 'update');
            Route::delete('{purchase-receipt}', 'destroy');
            Route::get('pdf', 'reciept')->withoutMiddleware('auth:sanctum');
        });
    });

    Route::prefix('crm')->group(function () {
        Route::prefix('growers')->name('growers')->controller(GrowerController::class)->group(function () {
            Route::get('', 'index');
            Route::post('', 'store');
            Route::get('{grower}', 'show');
            Route::post('{grower}', 'update');
            Route::delete('{grower}', 'destroy');
        });
    });

    Route::prefix('hr')->group(function () {
        Route::prefix('employee-onboarding')->name('employee-onboarding')->controller(EmployeeOnboardingController::class)->group(function () {
            Route::get('', 'index');
            Route::post('', 'store');
            Route::get('{employeeOnboarding}', 'show');
            Route::post('{employeeOnboarding}', 'update');
            Route::delete('{employeeOnboarding}', 'destroy');
        });
        Route::prefix('employees')->name('employees')->controller(EmployeeController::class)->group(function () {
            Route::get('', 'index');
            Route::post('', 'store');
            Route::get('{employee}', 'show');
            Route::post('{employee}', 'update');
            Route::delete('{employee}', 'destroy');
        });
    });
});

Route::get(
    'auth/redirect',
    function () {
        # redirect to auth server
        $query = http_build_query([
            'client_id' => env('OAUTH_CLIENT_ID'),
            'redirect_uri' => env('APP_URL') . '/api/token',
            'response_type' => 'code',
            'scope' => '*',
        ]);
        return response(['url' => env('OAUTH_SERVER_BASE_URL') . '/oauth/authorize?' . $query], 200);
    }
);

Route::middleware(['web'])->get('token', function (Request $request) {
    $response = Http::asForm()->post(env('OAUTH_SERVER_BASE_URL') . '/oauth/token', [
        'grant_type' => 'authorization_code',
        'client_id' => env('OAUTH_CLIENT_ID'),
        'client_secret' => env('OAUTH_CLIENT_SECRET'),
        'redirect_uri' => env('APP_URL') . '/api/token',
        'code' => $request->code,
    ]);

    if ($response->successful()) {
        $access_token = $response->json()['access_token'];
        // fetch user from provider
        $response = Http::withHeaders(
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $access_token,
            ]
        )->get(env('OAUTH_SERVER_BASE_URL') . '/api/oauth/user');
        $remote_user =  $response->json();
        if ($response->successful()) {
            if (User::where('provider_user_id', $remote_user['id'])->exists()) {
                // login and redirect
                $user = User::where('provider_user_id', $remote_user['id'])->first();
                Auth::login($user, remember: true);
                $request->session()->regenerate();
                $user->notify((new NewLogin($request))->delay(now()->addMinute()));
                return redirect(env('FRONTEND_URL'));
            } else {
                // check against invites
                if (JoinInvite::where('email', $remote_user['email'])->exists()) {
                    // invite exists
                    $joinInvite = JoinInvite::where('email', $remote_user['email'])->first();
                    if ($joinInvite->revokes_in !== null) {
                        if (now() < ($joinInvite->created_at->addDays($joinInvite->revokes_in))) {
                            // create account
                            $user = User::create([
                                'provider_user_id' => $remote_user['id'],
                                'email' => $remote_user['email'],
                                'name' => $remote_user['name'],
                            ]);
                            // and revoke invite
                            $joinInvite->rovoked = true;
                            $joinInvite->save();
                            // login and redirect
                            Auth::login($user, remember: true);
                            $request->session()->regenerate();
                            $user->notify((new NewLogin($request))->delay(now()->addMinute()));
                            return redirect(env('FRONTEND_URL'));
                        } else {
                            // invite invalid
                            return redirect(env('FRONTEND_URL') . '/auth-invalid');
                        }
                    } else {
                        // create account
                        $user = User::create([
                            'provider_user_id' => $remote_user['id'],
                            'email' => $remote_user['email'],
                            'name' => $remote_user['name'],
                        ]);
                        // and revoke invite
                        $joinInvite->rovoked = true;
                        $joinInvite->save();
                        // login and redirect
                        Auth::login($user, remember: true);
                        $request->session()->regenerate();
                        $user->notify((new NewLogin($request))->delay(now()->addMinute()));
                        return redirect(env('FRONTEND_URL'));
                    }
                } else {
                    // check whether client owner
                    $response = Http::withHeaders(
                        [
                            'Accept' => 'application/json',
                            'Authorization' => 'Bearer ' . $access_token,
                        ]
                    )->get(env('OAUTH_SERVER_BASE_URL') . '/api/oauth/user/is-owner');

                    if ($response->successful()) {
                        if ($response->json()['is_owner']) {
                            // create account
                            $user = User::create([
                                'provider_user_id' => $remote_user['id'],
                                'email' => $remote_user['email'],
                                'name' => $remote_user['name'],
                            ]);
                            // login and redirect
                            Auth::login($user, remember: true);
                            $request->session()->regenerate();
                            $user->notify((new NewLogin($request))->delay(now()->addMinute()));
                            return redirect(env('FRONTEND_URL'));
                        }
                    }
                    // no invite
                    // notify not part of allowed user to access system
                    return redirect(env('FRONTEND_URL') . '/auth-invalid');
                }
            }
        }
    } else {
        // error while logging in
        // retry
        return redirect(env('FRONTEND_URL') . '/auth-invalid');
    }
    return redirect(env('FRONTEND_URL') . '/auth-invalid');
});
Route::get('joininvites/{joinInvite}', function (JoinInvite $joinInvite) {
    if (!$joinInvite->revoked) {
        if ($joinInvite->revokes_in !== null) {
            if (now() < ($joinInvite->created_at->addDays($joinInvite->revokes_in))) {
                $query = http_build_query([
                    'client_id' => env('OAUTH_CLIENT_ID'),
                    'redirect_uri' => env('APP_URL') . '/api/token',
                    'response_type' => 'code',
                    'scope' => '*',
                ]);
                return redirect(env('OAUTH_SERVER_BASE_URL') . '/oauth/authorize?' . $query);
            } else {
                // revoke token
                $joinInvite->rovoked = true;
                $joinInvite->save();
                // invalid
                return redirect(env('FRONTEND_URL') . '/auth-invalid');
            }
        } else {
            $query = http_build_query([
                'client_id' => env('OAUTH_CLIENT_ID'),
                'redirect_uri' => env('APP_URL') . '/api/token',
                'response_type' => 'code',
                'scope' => '*',
            ]);
            return redirect(env('OAUTH_SERVER_BASE_URL') . '/oauth/authorize?' . $query);
        }
    } else {
        // revoked
        return redirect(env('FRONTEND_URL') . '/auth-invalid');
    }
});
