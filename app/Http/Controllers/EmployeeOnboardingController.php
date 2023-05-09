<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployeeOnboardingRequest;
use App\Http\Requests\UpdateEmployeeOnboardingRequest;
use App\Models\EmployeeOnboarding;
use Illuminate\Http\Request;

class EmployeeOnboardingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $size = 5;
        $request->validate([
            'size' => ['integer'],
        ]);
        if ($request->has('size')) {
            if ($request->integer('size') === -1) {
                $size = EmployeeOnboarding::all()->count();
            } else {
                $size = $request->size;
            }
        }
        return EmployeeOnboarding::cursorPaginate($size);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmployeeOnboardingRequest $request)
    {
        //
        EmployeeOnboarding::create($request->validated());
        return response(status: 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(EmployeeOnboarding $employeeOnboarding)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EmployeeOnboarding $employeeOnboarding)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmployeeOnboardingRequest $request, EmployeeOnboarding $employeeOnboarding)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EmployeeOnboarding $employeeOnboarding)
    {
        //
    }
}
