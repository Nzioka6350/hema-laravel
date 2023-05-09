<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQualityAnalysisRequest;
use App\Http\Requests\UpdateQualityAnalysisRequest;
use App\Models\QualityAnalysis;
use Illuminate\Http\Request;

class QualityAnalysisController extends Controller
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
                $size = QualityAnalysis::all()->count();
            } else {
                $size = $request->size;
            }
        }
        return QualityAnalysis::paginate($size);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreQualityAnalysisRequest $request)
    {
        //
        QualityAnalysis::create($request->validated());
        return response(status: 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(QualityAnalysis $qualityAnalysis)
    {
        //
        return $qualityAnalysis;
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateQualityAnalysisRequest $request, QualityAnalysis $qualityAnalysis)
    {
        //
        $qualityAnalysis->update($request->validated());
        return response(status:200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(QualityAnalysis $qualityAnalysis)
    {
        //
        $qualityAnalysis->delete();
        return response(status:204);
    }
}
