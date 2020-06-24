<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Invoice;

class InvoiceController extends Controller
{
    public function createInvoice(Request $request)
    {
        $invoice = new Invoice();
        $invoice->fill($request->all());
        $invoice->save();
        $invoiceResponse = $invoice->find($invoice->id);
        return response()->json($invoiceResponse);
    }

    public function fetchallInvoice()
    {
        $invoice = Invoice::all();
        return response()->json($invoice);
    }

    public function updateInvoice(Request $request,$id)
    {
        $invoice = Invoice::find($id);
        $invoice->fill($request->all());
        $invoice->save();
        $invoiceResponse = $invoice->find($invoice->id);
        return response()->json($invoiceResponse);

    }

    public function deleteInvoice(Request $request,$id)
    {
        $invoice = Invoice::find($id);
        $invoice->delete();

    }


}
