<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGeneralWeighingRequest;
use App\Http\Requests\UpdateGeneralWeighingRequest;
use App\Models\GeneralWeighing;
use Illuminate\Http\Request;

class GeneralWeighingController extends Controller
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
                $size = GeneralWeighing::all()->count();
            } else {
                $size = $request->size;
            }
        }
        return GeneralWeighing::paginate($size);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGeneralWeighingRequest $request)
    {
        //
        GeneralWeighing::create($request->validated());
        return response(status:201);
    }

    /**
     * Display the specified resource.
     */
    public function show(GeneralWeighing $generalWeighing)
    {
        //
       return $generalWeighing;
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGeneralWeighingRequest $request, GeneralWeighing $generalWeighing)
    {
        //
        $generalWeighing->update($request->validated());
        return response(status:200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GeneralWeighing $generalWeighing)
    {
        //
        $generalWeighing->delete();
        return response(status:204);
    }
}
