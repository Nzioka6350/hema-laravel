<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyProfileRequest;
use App\Http\Requests\UpdateCompanyProfileRequest;
use App\Models\CompanyProfile;
use Illuminate\Http\Request;

class CompanyProfileController extends Controller
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
                $size = CompanyProfile::all()->count();
            } else {
                $size = $request->size;
            }
        }
        return CompanyProfile::paginate($size);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCompanyProfileRequest $request)
    {
        //
        CompanyProfile::create($request->validated());
        return response(status:201);
    }

    /**
     * Display the specified resource.
     */
    public function show(CompanyProfile $companyProfile)
    {
        //
       return $companyProfile;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCompanyProfileRequest $request, CompanyProfile $companyProfile)
    {
        //
        $companyProfile->update($request->validated());
        return response(status:200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CompanyProfile $companyProfile)
    {
        //
        $companyProfile->delete();
        return response(status:204);
    }
}
