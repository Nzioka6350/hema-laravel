<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGrowerRequest;
use App\Http\Requests\UpdateGrowerRequest;
use App\Models\Grower;
use Illuminate\Http\Request;

class GrowerController extends Controller
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
                $size = Grower::all()->count();
            } else {
                $size = $request->size;
            }
        }
        return Grower::paginate($size);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGrowerRequest $request)
    {
        //
        Grower::create($request->validated());
        return response(status: 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Grower $grower)
    {
        //
        return $grower;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGrowerRequest $request, Grower $grower)
    {
        //
        $grower->update($request->validated());
        return response(status: 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Grower $grower)
    {
        //
        $grower->delete();
        return response(status: 204);
    }
}
