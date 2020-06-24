<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vendor;

class VendorController extends Controller
{
    public function createVendor(Request $request)
    {
        $vendor = new Vendor();
        $input = $request->all();
        $vendor->fill($input);
        $vendor->save();
        $vendor = Vendor::find($vendor->id);
        return response()->json($vendor);
    }

    public function fetchallVendor(Request $request)
    {
        $vendor = Vendor::all();
        return response()->json($vendor);
    }

    public function deleteVendor($id)
    {
        $vendor = Vendor::find($id);
        $vendor->delete();
    }

    public function updateVendor(rEQUEST $request,$id)
    {
        $vendor = Vendor::find($id);
        $vendor->fill($request->all());
        $vendor->save();
        $vendor = Vendor::find($vendor->id);
        return response()->json($vendor);
    }
}
