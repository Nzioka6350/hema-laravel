<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyLogoRequest;
use App\Http\Requests\UpdateCompanyLogoRequest;
use App\Models\CompanyLogo;

class CompanyLogoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
       return CompanyLogo::all();
    }


    public function serve(CompanyLogo $companyLogo)
    {
        return response()->file('storage/'.$companyLogo->url, );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCompanyLogoRequest $request)
    {
        //
         CompanyLogo::create($request->validated());
         return response(status:201);
    }
    /**
     * Display the specified resource.
     */
    public function show(CompanyLogo $companyLogo)
    {
        //
        return $companyLogo;
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCompanyLogoRequest $request, CompanyLogo $companyLogo)
    {
        //
        $companyLogo->update($request->validated());
        return response(status:200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CompanyLogo $companyLogo)
    {
        //
        $companyLogo->delete();
        return response(status:204);
    }
}
