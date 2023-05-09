<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMillingChargesRequest;
use App\Http\Requests\UpdateMillingChargesRequest;
use App\Models\MillingCharges;
use Illuminate\Http\Request;

class MillingChargesController extends Controller
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
                $size = MillingCharges::all()->count();
            } else {
                $size = $request->size;
            }
        }
        return MillingCharges::paginate($size);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMillingChargesRequest $request)
    {
        //
        MillingCharges::create($request->validated());
        return response(status:201);
    }

    /**
     * Display the specified resource.
     */
    public function show(MillingCharges $millingCharges)
    {
        //
        return $millingCharges;
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMillingChargesRequest $request, MillingCharges $millingCharges)
    {
        //
        $millingCharges->update($request->validated());
        return response(status:200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MillingCharges $millingCharges)
    {
        //
        $millingCharges->delete();
        return response(status:204);
    }
}
