<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MasterInvoiceLine;

class MasterInvoiceLineController extends Controller
{
    public function createmasterinvoiceLine(Request $request)
    {
        $masterinvoiceLine = new MasterInvoiceLine();
        $masterinvoiceLine->fill($request->all());
        $masterinvoiceLine->save();
        $masterinvoiceResponse = MasterInvoiceLine::find($masterinvoiceLine->id);
        return response()->json($masterinvoiceResponse);
    }

    public function fetchallmasterinvoiceLine()
    {
        $masterinvoiceLine = MasterInvoiceLine::all();
        return response()->json($masterinvoiceLine);
    }

    public function updatemasterinvoiceLine(Request $request,$id)
    {
        $masterinvoiceLine = MasterInvoiceLine::find($id);
        $masterinvoiceLine->fill($request->all());
        $masterinvoiceLine->save();
        $masterinvoicelineResponse = MasterInvoiceLine::find($masterinvoiceLine->id);
        return response()->json($masterinvoicelineResponse);
    }

    public function deletemasterinvoiceLine(Request $request,$id)
    {
        $masterinvoiceLine = MasterInvoiceLine::find($id);
        $masterinvoiceLine->delete();

    }
}
