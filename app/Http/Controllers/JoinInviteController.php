<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreJoinInviteRequest;
use App\Http\Requests\UpdateJoinInviteRequest;
use App\Mail\JoinInvite as MailJoinInvite;
use App\Models\JoinInvite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class JoinInviteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $request->validate([
            'size' => ['integer', 'nullable'],
        ]);
        $size = $request->input('size', 5);
        return JoinInvite::cursorPaginate($size);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreJoinInviteRequest $request)
    {
        //
        $joinInvite = JoinInvite::create($request->validated());
        $action_url = env('APP_URL') . '/api/joininvites/' . $joinInvite->id;
        Mail::to($joinInvite->email)->send(new MailJoinInvite(auth()->user(), $action_url));
        return response(status: 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(JoinInvite $joinInvite)
    {
        //
        return $joinInvite;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJoinInviteRequest $request, JoinInvite $joinInvite)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JoinInvite $joinInvite)
    {
        //
    }
}
