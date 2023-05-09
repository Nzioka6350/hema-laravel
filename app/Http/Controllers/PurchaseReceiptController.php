<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePurchaseReceiptRequest;
use App\Http\Requests\UpdatePurchaseReceiptRequest;
use App\Models\PurchaseReceipt;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PurchaseReceiptController extends Controller
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
                $size = PurchaseReceipt::all()->count();
            } else {
                $size = $request->size;
            }
        }
        $relationships = $request->query('with');
        return PurchaseReceipt::withAllowedRelationships($relationships)->cursorPaginate($size);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePurchaseReceiptRequest $request)
    {
        //
        $purchase =  PurchaseReceipt::create($request->validated());
        if ($request->has('coffee_beans')) {
            $purchase->cofee_beans()->attach($request->coffee_beans);
        }
        return response(status: 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(PurchaseReceipt $purchaseReceipt)
    {
        //
        return $purchaseReceipt;
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePurchaseReceiptRequest $request, PurchaseReceipt $purchaseReceipt)
    {
        // 
        $purchaseReceipt->coffee_beans()->detach(null, true);
        $purchaseReceipt->grower()->detach(null, true);
        if ($request->has('coffee_beans')) {
            $purchaseReceipt->coffee_beans()->attach($request->coffee_beans, [], true);
        }
        $purchaseReceipt->update($request->validated());
        return response(status: 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PurchaseReceipt $purchaseReceipt)
    {
        //
        $purchaseReceipt->delete();
        return response(status: 204);
    }

    public function reciept(PurchaseReceipt $purchaseReceipt)
    {

        // Load the HTML from the Blade template and pass the data
        $html = view('pr', compact('purchaseReceipt'))->render();

        // Generate the PDF using Dompdf
        $pdf = PDF::loadHtml($html);

        // Set the paper size and orientation
        $pdf->setPaper('A4', 'landscape');

        // Download the PDF file
        // return $pdf->download('my-document.pdf');

        // Output the generated PDF to the browser
        return $pdf->stream();
    }
}
