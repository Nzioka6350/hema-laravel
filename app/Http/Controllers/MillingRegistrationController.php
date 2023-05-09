<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMillingRegistrationRequest;
use App\Http\Requests\UpdateMillingRegistrationRequest;
use App\Models\MillingRegistration;
use Illuminate\Http\Request;

class MillingRegistrationController extends Controller
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
                $size = MillingRegistration::all()->count();
            } else {
                $size = $request->size;
            }
        }
        return MillingRegistration::paginate($size);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMillingRegistrationRequest $request)
    {
        //
        MillingRegistration::create($request->validated());
        return response(status:201);
    }

    /**
     * Display the specified resource.
     */
    public function show(MillingRegistration $millingRegistration)
    {
        //
        return $millingRegistration;
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMillingRegistrationRequest $request, MillingRegistration $millingRegistration)
    {
        //
        $millingRegistration->update($request->validated());
        return response(status:200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MillingRegistration $millingRegistration)
    {
        //
        $millingRegistration->delete();
        return response(status:204);
    }
}
