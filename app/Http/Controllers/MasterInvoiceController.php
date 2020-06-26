<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MasterInvoice;
use App\MasterInvoiceLine;
use App\Vendor;
use App\Invoice;
use App\InvoiceLine;
use Illuminate\Support\Facades\View;
use DB;

class MasterInvoiceController extends Controller
{
    public function getInvoice()
    {
        session('max', '5000');
        $category = DB::table('categories')->get();

        return view('create_master')->with('category', $category);
    }

    public function createInvoice(Request $request)
    {
        $invoiceLine = DB::table('invoice_lines')->get();
        $masterInvoice = MasterInvoice::find(1);
        //return response()->json($masterInvoice);

        return view('invoice')->with('invoiceLine', $invoiceLine)->with('masterInvoice', $masterInvoice);
    }


    public function createmasterInvoice(Request $request)
    {
       // $value = session('max');
       // return response()->json($request->all());
        $maxTotal = 50000;
        $masterInvoice = new MasterInvoice();
        $input = $request->all();
        $vendor = Vendor::WHERE('id','=',8)->get();
        $invoice = Invoice::get();
        return view('invoice_view')->with('invoice',$invoice)->with('vendor',$vendor);
        $lines = $input['line_items'];
        $masterInvoice->fill($request->all());
        $masterInvoice->save();
        $lines_array = array();
        foreach($lines as $line)
        {
            $ml = new MasterInvoiceLine();
            $ml->quantity = $line['qty'];
            $ml->unit_price = $line['unit_price'];
            $ml->item =    $line['item'];
            $ml->sub_total = $line['qty'] * $line['unit_price'];
            $ml->master_id = $masterInvoice->id;
            $ml->save();
            array_push($lines_array,$ml);
        }
        $masterInvoice->total = array_reduce($lines_array, function($val1,$val2){
            return $val1 + $val2->sub_total;
        }, 0);
        $masterInvoice->save();
        foreach($lines_array as $ml){
            $maxQty = $maxTotal / $ml->unit_price;
            $remaining = $ml->quantity;
            while($remaining > 0){
                if ($remaining>$maxQty){
                    $qty = $maxQty;
                }else{
                    $qty = $remaining;
                }
                $remaining = $remaining - $qty;
                $vendor = Vendor::orderBy('last_usage_timestamp','asc')->first();
                //return response()->json($response);
                $inv = new Invoice();
                $inv->master_id = $masterInvoice->id;
                $inv->vendor_id = $vendor->id;
                $inv->total = $qty * $ml->unit_price;
                $inv->save();
//Update lastusage timestamp of vendor
                //$vendor->last_usage_timestamp = now();
                //$vendor->save()

                $invLine  = new InvoiceLine();
                $invLine->quantity = $qty;
                $invLine->unit_price = $ml->unit_price;
                $invLine->item = $ml->item;
                $invLine->sub_total = $qty * $ml->unit_price;
                $invLine->invoice_id = $inv->id;
                $invLine->save();
            }
        }
        //$invoicetesting = Invoice::find($inv->id);
        //session(['id'=>$invoicetesting->master_id]);
        //$this->id = $invoicetesting->master_id;
        //return response()->json($invoicetesting);
       $id = $this->prepareInvoice($vendor->id);
       return $id;
        //return $test;
        //$masterInvoice = MasterInvoice::find($masterInvoice->id);
        //return response()->json($masterInvoice);
    }

    public function fetchallmasterInvoice()
    {
        $masterInvoice = new MasterInvoice();
        $masterinvoiceResponse = $masterInvoice::all();
        return response()->json($masterinvoiceResponse);
    }

    public function updatemasterInvoice(Request $request,$id)
    {
        $masterInvoice = MasterInvoice::find($id);
        $masterInvoice->fill($request->all());
        $masterInvoice->save();
        $masterinvoiceResponse = $masterInvoice = MasterInvoice::find($masterInvoice->id);
        return response()->json($masterinvoiceResponse);
    }

    public function deletemasterInvoice($id)
    {
        $masterInvoice = MasterInvoice::find($id);
        $masterInvoice->delete();
    }

    public function prepareInvoice($id=0){
        //$vendor = Vendor::find($id);
        //$name = $vendor->name;
        //$invoice = Invoice::WHERE('vendor_id','=',$id)->get();
        //$data=array('invoice'=>$invoice, 'name'=>$name);

        //return response()->json($data);
        //$name = $masterInvoice->name;

        //return view('create_master',compact('invoice','name'));
        return view('create_master');
        //return $master->lines();
    }




}
