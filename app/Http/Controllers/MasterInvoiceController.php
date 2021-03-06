<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MasterInvoice;
use App\MasterInvoiceLine;
use App\Vendor;
use App\Invoice;
use App\InvoiceLine;
use App\Category;
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
        //return response()->json($request->all());
        $current_time = \Carbon\Carbon::now()->toDateTimeString();
       // $value = session('max');
       // return response()->json($request->all());
        $maxTotal = 50000;

        //get invoice keys
       /*$invoice = Invoice::WHERE('master_id','=',1)->get();
        $vendorKey = Vendor::find(1);
        $getinvoiceKeys = $invoice->first();
        $attributeInvoice = array_keys($getinvoiceKeys->toArray());

        $getvendorKeys = $vendorKey->first();
        $attributesVendor = array_keys($getvendorKeys->toArray());

        foreach($invoice as $invoices)
        {
            $arr[] = $invoices->vendor_id;
        }

        $vendor = DB::table('vendors')
                            ->WhereIn('id',$arr)->get();
            $vendors = $vendor->toArray();
            $results = array();
            foreach($invoice as $key=>$data)
            {
                $newarr =array();
                $newarr['id'] = $data->id;
                $newarr['total'] = $data->total;
                $newarr['name'] = $vendors[$key]->name;
                $results[] = $newarr;

            }

            return view('invoice_view')->with('results',$results);*/


        $masterInvoice = new MasterInvoice();
        $input = $request->all();

        $lines = $input['line_items'];
        $masterInvoice->name = $input['name'];
        $masterInvoice->date = $input['date'];
        $masterInvoice->category_id = $input['category'];

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
        //It add sub_total of line items
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
                $vendor = Vendor::orderBy('last_usage_timestamp','asc')->Where('category_id','=',$input['category'])->first();
                //return response()->json($response);
                $inv = new Invoice();
                $inv->master_id = $masterInvoice->id;
                //Vendor::Where('category_id','=',$input['category'])->get();
                $inv->vendor_id = $vendor->id;
                $inv->total = $qty * $ml->unit_price;
                $inv->save();
                //Update lastusage timestamp of vendor
                $vendor->last_usage_timestamp = $current_time;
                $vendor->save();

                $invLine  = new InvoiceLine();
                $invLine->quantity = $qty;
                $invLine->unit_price = $ml->unit_price;
                $invLine->item = $ml->item;
                $invLine->sub_total = $qty * $ml->unit_price;
                $invLine->invoice_id = $inv->id;
                $invLine->save();
            }
        }

        $invoice = Invoice::WHERE('master_id','=',$masterInvoice->id)->get();
        //$category = Category::all();
        //return response()->json($category);

        //return response()->json($vendorCategory);
        foreach($invoice as $invoices)
        {
            $arr[] = $invoices->vendor_id;
        }

        /*foreach($category as $categories)
        {
            $cat[] = $categories->id;
        }
        $catIds = join("','",$cat);*/
        $ids = join("','",$arr);
        $test = join(",",$arr);
        //return response()->json($test);
        //$vendor = Vendor::WHERE('category_id','=',$masterInvoice->category_id)->WhereIn('id',$arr)->get();
        //return response()->json($vendorCategory);
        /*$vendor = DB::table('vendors')
                            ->WhereIn('id',$arr)
                            ->WHERE('category_id','=',$masterInvoice->category_id)
                            ->get();*/
        //return response()->json($ids.'='.$masterInvoice->category_id);
        $vendorData = DB::select( DB::raw("SELECT * FROM vendors WHERE id IN ('$ids') AND category_id = '$masterInvoice->category_id'  ORDER BY FIND_IN_SET (id,'$test') ") );
        //return response()->json($vendorData);
        $results = array();
        foreach($invoice as $key=>$data)
        {
          // return response()->json($vendorData[$key]->name);
            $newarr =array();
            $newarr['id'] = $data->id;
            $newarr['total'] = $data->total;
            $newarr['name'] = $vendorData[$key]->name;
            $results[] = $newarr;

        }

        return view('invoice_view')->with('results',$results);


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

    public function fetchStatement($id)
    {
        $invoiceLine = InvoiceLine::find($id);
        $invoice = Invoice::find($id);
        $masterInvoice = MasterInvoice::WHERE('id','=',$invoice->master_id)->first();
        //return response()->json($invoice->vendor_id);
        $vendor = Vendor::WHERE('id',$invoice->vendor_id)->first();
        //return response()->json($invoice);
        return view('invoice', compact(['invoiceLine', 'invoice', 'vendor' ,'masterInvoice']));

    }




}
