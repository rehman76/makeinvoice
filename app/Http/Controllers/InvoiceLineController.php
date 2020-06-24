<?php

namespace App\Http\Controllers;
use App\InvoiceLine;

use Illuminate\Http\Request;

class InvoiceLineController extends Controller
{
    public function createinvoiceLine(Request $request)
    {
        $invoiceLine = new InvoiceLine();
        $invoiceLine->fill($request->all());
        $invoiceLine->save();
        $invoiceResponse = $invoiceLine->find($invoiceLine->id);
        return response()->json($invoiceResponse);
    }

    public function fetchallinvoiceLine()
    {
        $invoiceLine = InvoiceLine::all();
        return response()->json($invoiceLine);
    }

    public function updateinvoiceLine(Request $request,$id)
    {
        $invoiceLine = InvoiceLine::find($id);
        $invoiceLine->fill($request->all());
        $invoiceLine->save();
        $invoiceResponse = $invoiceLine->find($invoiceLine->id);
        return response()->json($invoiceResponse);

    }

    public function deleteinvoiceLine(Request $request,$id)
    {
        $invoiceLine = InvoiceLine::find($id);
        $invoiceLine->delete();

    }
}
