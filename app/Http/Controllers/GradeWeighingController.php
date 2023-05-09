<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGradeWeighingRequest;
use App\Http\Requests\UpdateGradeWeighingRequest;
use App\Models\GradeWeighing;
use Illuminate\Http\Request;

class GradeWeighingController extends Controller
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
                $size = GradeWeighing::all()->count();
            } else {
                $size = $request->size;
            }
        }
        return GradeWeighing::paginate($size);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGradeWeighingRequest $request)
    {
        //
        GradeWeighing::create($request->validated());
        return response(status:201);
    }

    /**
     * Display the specified resource.
     */
    public function show(GradeWeighing $gradeWeighing)
    {
        //
        return $gradeWeighing;
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGradeWeighingRequest $request, GradeWeighing $gradeWeighing)
    {
        //
        $gradeWeighing->update($request->validated());
        return response(status:200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GradeWeighing $gradeWeighing)
    {
        $gradeWeighing->delete();
        return response(status:204);
    }
}
