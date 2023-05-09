<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTextRequest;
use App\Http\Requests\UpdateTextRequest;
use App\Models\Text;

class TextController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTextRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Text $text)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Text $text)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTextRequest $request, Text $text)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Text $text)
    {
        //
    }
}
