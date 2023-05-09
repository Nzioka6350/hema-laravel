<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUomRequest;
use App\Http\Requests\UpdateUomRequest;
use App\Models\Uom;
use Illuminate\Http\Request;

class UomController extends Controller
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
                $size = Uom::all()->count();
            } else {
                $size = $request->size;
            }
        }
        return Uom::paginate($size);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUomRequest $request)
    {
        //
        Uom::create($request->validated());
        return response(status:201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Uom $uom)
    {
        //
        return $uom;
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUomRequest $request, Uom $uom)
    {
        //
        $uom->update($request->validated());
        return response(status:200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Uom $uom)
    {
        //
        $uom->delete();
        return response(status:204);
    }
}
