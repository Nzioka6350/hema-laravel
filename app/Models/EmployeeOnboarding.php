<?php

namespace App\Models;

use App\Jobs\OnboardEmployee;
use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeOnboarding extends Model
{
    use HasFactory, Uuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'date_of_joining',
        'notify',
        'aborted',
        'user_id',
        'employee_id',
        'company_id',
        'department_id',
        'designation_id',
        'holiday_list_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'notify' => 'boolean',
        'aborted' => 'boolean',
        'date_of_joining' => 'date',
    ];

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::created(function (EmployeeOnboarding $employeeOnboarding) {
            // ...
            OnboardEmployee::dispatch();
        });
        static::updated(function (EmployeeOnboarding $employeeOnboarding) {
            // ...
            OnboardEmployee::dispatch();
        });
    }
}
