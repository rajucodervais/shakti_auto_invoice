<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Challan;
use App\ChallanProduct;
use App\State;
use PDF;
class ChallanController extends Controller
{
    public function index()
    {
        $challan = Challan::orderBy('created_at', 'desc')
            ->paginate(10);

        return view('challans.index', compact('challan'));
    }

    public function create()
    {
        $state = State::all();
        return view('challans.create', compact('state'));
    }

    public function store(Request $request)
    {
        // dd($request);
        $this->validate($request, [
            'name' => 'required|max:255',
            'city' => 'required|max:255', 
            'state_name' => 'required|max:255',
            'zip_code' => 'required|digits:6',
            'state_code' => 'required|numeric',
            'address' => 'required',
            'date' => 'required|date',
            // 'podate' => 'after_or_equal:date',
            'tax_invoice_products.*.desc' => 'required|min:3',
            'tax_invoice_products.*.unit' => 'required|min:1',
            'tax_invoice_products.*.order_item_quantity' => 'required|numeric',
        ]);
        $challan = new Challan();
        $challan->fill([
            'vendorcode'          => $request->vendorcode,
            'name'                => $request->name,
            'customergstin'       => $request->customergstin,
            'city'                => $request->city, 
            'state_name'          => $request->state_name,
            'zip_code'            => $request->zip_code,
            'state_code'          => $request->state_code,
            'address'             => $request->address,
            'date'                => $request->date,
            'podate'              => $request->podate,
            'purchage_order_no'   => $request->purchage_order_no,
            'delivery_challan_no' => $request->delivery_challan_no,
            'vehicle_no'          => $request->vehicle_no,
        ])->save();
        $challan_id = $challan->id;    
        for ($i = 0; $i < $request->total_item; $i++)
        {
            $item = new ChallanProduct();
            $item->fill([
                'challan_id'               => $challan_id,
                'desc'                     => $request->desc[$i],
                'unit'                     => $request->unit[$i],
                'order_item_quantity'      => $request->order_item_quantity[$i],
            ])->save();
        }
        
        return redirect()->route('challan.index')->with('success','Invoice Created Successfully');
    }

    public function show($id)
    {
        $challan = Challan::with('challan_products')->findOrFail($id);
        $state = State::findOrFail($challan->state_name);
        return view('challans.show', compact('challan','state'));
    }

    public function edit($id)
    {
        $state = State::all();
        $challan = Challan::with('challan_products')->findOrFail($id);
        return view('challans.edit', compact('challan','state'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'city' => 'required|max:255', 
            'state_name' => 'required|max:255',
            'zip_code' => 'required|digits:6',
            'state_code' => 'required|numeric',
            'address' => 'required',
            'date' => 'required|date',
            // 'podate' => 'after_or_equal:date',
            'tax_invoice_products.*.desc' => 'required|min:3',
            'tax_invoice_products.*.unit' => 'required|min:1',
            'tax_invoice_products.*.order_item_quantity' => 'required|numeric',
        ]);
        $challan = Challan::findOrFail($id);
        $challan->fill([
            'vendorcode'          => $request->vendorcode,
            'name'                => $request->name,
            'customergstin'       => $request->customergstin,
            'city'                => $request->city, 
            'state_name'          => $request->state_name,
            'zip_code'            => $request->zip_code,
            'state_code'          => $request->state_code,
            'address'             => $request->address,
            'date'                => $request->date,
            'podate'              => $request->podate,
            'purchage_order_no'   => $request->purchage_order_no,
            'delivery_challan_no' => $request->delivery_challan_no,
            'vehicle_no'          => $request->vehicle_no,
        ])->save();

        ChallanProduct::where('challan_id', $id)->delete();    
        for ($i = 0; $i < $request->total_item; $i++)
        {
            $item = new ChallanProduct();
            $item->fill([
                'challan_id'               => $id,
                'desc'                     => $request->desc[$i],
                'unit'                     => $request->unit[$i],
                'order_item_quantity'      => $request->order_item_quantity[$i],
            ])->save();
        }

        return redirect()->route('challan.index')->with('success','Challan Updated Successfully');
    }

    public function destroy($id)
    {
        $challan = Challan::findOrFail($id);
        ChallanProduct::where('challan_id', $challan->id)
            ->delete();
        $challan->delete();
        return redirect()->route('challan.index')->with('success','Challan Deleted Successfully');
    }

    public function create_pdf($id){
        $challan = Challan::with('challan_products')->findOrFail($id);
        $state = State::findOrFail($challan->state_name);
        // return view('challans.pdf',compact('challan','state'));
        $pdf = PDF::loadView('challans.pdf', compact('challan','state'));
        return $pdf->download(time().'_challan.pdf');
    }

}
