<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCoffeeBeanRequest;
use App\Http\Requests\UpdateCoffeeBeanRequest;
use App\Models\CoffeeBean;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CoffeeBeanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $size = 5;
        $request->validate([
            'size' => ['integer'],
        ]);
        if ($request->has('size')) {
            if ($request->integer('size') === -1) {
                $size = CoffeeBean::all()->count();
            } else {
                $size = $request->size;
            }
        }
        $relationships = $request->query('with');
        return CoffeeBean::withAllowedRelationships($relationships)->cursorPaginate($size);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCoffeeBeanRequest $request)
    {
        //
        $coffeeType = CoffeeBean::create($request->validated());
        Log::alert($request);
        if ($request->has('coffee_grades')) {
            $coffeeType->grades()->attach($request->coffee_grades);
        }
        return response(status: 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(CoffeeBean $coffeeType)
    {
        //
        return $coffeeType;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCoffeeBeanRequest $request, CoffeeBean $coffeeType)
    {
        //
        $coffeeType->grades()->detach(null, true);
        if ($request->has('coffee_grades')) {
            $coffeeType->grades()->attach($request->coffee_grades, [], true);
        }
        # code...
        $coffeeType->update($request->validated());
        return response(status: 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CoffeeBean $coffeeType)
    {
        //
        $coffeeType->delete();
        return response()->noContent();
    }
}
