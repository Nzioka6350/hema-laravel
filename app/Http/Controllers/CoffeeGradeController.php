<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCoffeeGradeRequest;
use App\Http\Requests\UpdateCoffeeGradeRequest;
use App\Models\CoffeeGrade;
use Illuminate\Http\Request;

class CoffeeGradeController extends Controller
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
                $size = CoffeeGrade::all()->count();
            } else {
                $size = $request->size;
            }
        }
        return CoffeeGrade::cursorPaginate($size);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCoffeeGradeRequest $request)
    {
        //
        $coffeeGrade = CoffeeGrade::create($request->validated());
        return response(status: 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(CoffeeGrade $coffeeGrade)
    {
        //
        return $coffeeGrade;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCoffeeGradeRequest $request, CoffeeGrade $coffeeGrade)
    {
        //
        $coffeeGrade->update($request->validated());
        return response(status: 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CoffeeGrade $coffeeGrade)
    {
        //
        $coffeeGrade->delete();
        return response(status: 204);
    }
}
