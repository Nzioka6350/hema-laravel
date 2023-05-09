<?php

namespace App\Jobs;

use App\Models\Employee;
use App\Models\EmployeeOnboarding;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class OnboardEmployee implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
        foreach (EmployeeOnboarding::where([
            ['aborted', false],
            ['employee_id', null],
        ])->get() as $onboarding) {

            if (today()->isSameDay($onboarding->date_of_joining) || today()->isPast($onboarding->date_of_joining)) {
                // create employee
                $employee = Employee::create(
                    [
                        'name' => $onboarding->name,
                        'date_of_joining' => $onboarding->date_of_joining,
                        'user_id' => $onboarding->user_id
                    ]
                );
                // update employee_id
                $onboarding->employee_id = $employee->id;
                $onboarding->save();
                // notify employee->user
            }
        }
    }
}
