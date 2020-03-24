<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TaxInvoice;
use App\TaxInvoiceProduct;
class TaxInvoiceController extends Controller
{
   	public function index()
    {
        $invoices = TaxInvoice::orderBy('created_at', 'desc')
            ->paginate(10);

        return view('tax_invoices.index', compact('invoices'));
    }

    public function create()
    {
        return view('tax_invoices.create');
    }

    public function store(Request $request)
    {
        // dd($request);
        $this->validate($request, [
            'vendorcode' => 'required|numeric|max:255',
            'name' => 'required|max:255',
            'customergstin' => 'required|string|max:255',
            'city' => 'required|max:255', 
            'state_name' => 'required|max:255',
            'zip_code' => 'required|digits:6',
            'state_code' => 'required|digits:2',
            'address' => 'required',
            'date' => 'required|date',
            'podate' => 'required|date|after_or_equal:date',
            'purchage_order_no' => 'required|numeric',
            'total_invoice_value' => 'required',
            'total_taxable_value' => 'required',
            'total_cgst' => 'required',
            'total_sgst' => 'required',
            'total_igst' => 'required',
            'grand_total' => 'required',
            'tax_invoice_products.*.desc' => 'required|min:3',
            'tax_invoice_products.*.hsn_code' => 'required|min:4',
            'tax_invoice_products.*.unit' => 'required|min:1',
            'tax_invoice_products.*.order_item_quantity' => 'required|numeric',
            'tax_invoice_products.*.order_item_price' => 'required|integer',
            'tax_invoice_products.*.order_item_actual_amount' => 'required',
            'tax_invoice_products.*.cgst_rate' => 'required|numeric',
            'tax_invoice_products.*.cgst_amt' => 'required',
            'tax_invoice_products.*.sgst_rate' => 'required|numeric',
            'tax_invoice_products.*.sgst_amt' => 'required',
            'tax_invoice_products.*.igst_rate' => 'required|numeric',
            'tax_invoice_products.*.total_gst_amt' => 'required',
        ]);
        $tax_invoice = new TaxInvoice();
        $tax_invoice->fill([
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
            'total_invoice_value' => $request->total_invoice_value,
            'total_taxable_value' => $request->total_taxable_value,
            'total_cgst'          => $request->total_cgst,
            'total_sgst'          => $request->total_sgst,
            'total_igst'          => $request->total_igst,
            'grand_total'         => $request->grand_total,
        ])->save();
        $invoice_id = $tax_invoice->id;
            
        for ($i = 0; $i < $request->total_item; $i++)
        {
            $item = new TaxInvoiceProduct();
            $item->fill([
                'tax_invoice_id'           => $invoice_id,
                'desc'                     => $request->desc[$i],
                'hsn_code'                 => $request->hsn_code[$i],
                'unit'                     => $request->unit[$i],
                'order_item_quantity'      => $request->order_item_quantity[$i],
                'order_item_price'         => $request->order_item_price[$i],
                'order_item_actual_amount' => $request->order_item_actual_amount[$i],
                'cgst_rate'                => $request->cgst_rate[$i],
                'cgst_amt'                 => $request->cgst_amt[$i],
                'sgst_rate'                => $request->sgst_rate[$i],
                'sgst_amt'                 => $request->sgst_amt[$i],
                'igst_rate'                => $request->igst_rate[$i],
                'total_gst_amt'            => $request->total_gst_amt[$i],
            ])->save();
        }
        
        return redirect()->route('invoice.index')->with('success','Invoice Created Successfully');
    }

    public function show($id)
    {
        $tax_invoice = TaxInvoice::with('tax_invoice_products')->findOrFail($id);
        return view('tax_invoices.show', compact('tax_invoice'));
    }

    public function edit($id)
    {
        $tax_invoice = TaxInvoice::with('tax_invoice_products')->findOrFail($id);
        return view('tax_invoices.edit', compact('tax_invoice'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'vendorcode' => 'required|numeric|max:255',
            'name' => 'required|max:255',
            'customergstin' => 'required|string|max:255',
            'city' => 'required|max:255', 
            'state_name' => 'required|max:255',
            'zip_code' => 'required|digits:6',
            'state_code' => 'required|digits:2',
            'address' => 'required',
            'date' => 'required|date',
            'podate' => 'required|date|after_or_equal:date',
            'purchage_order_no' => 'required|numeric',
            'total_invoice_value' => 'required',
            'total_taxable_value' => 'required',
            'total_cgst' => 'required',
            'total_sgst' => 'required',
            'total_igst' => 'required',
            'grand_total' => 'required',
            'tax_invoice_products.*.desc' => 'required|min:3',
            'tax_invoice_products.*.hsn_code' => 'required|min:4',
            'tax_invoice_products.*.unit' => 'required|min:1',
            'tax_invoice_products.*.order_item_quantity' => 'required|numeric',
            'tax_invoice_products.*.order_item_price' => 'required|integer',
            'tax_invoice_products.*.order_item_actual_amount' => 'required',
            'tax_invoice_products.*.cgst_rate' => 'required|numeric',
            'tax_invoice_products.*.cgst_amt' => 'required',
            'tax_invoice_products.*.sgst_rate' => 'required|numeric',
            'tax_invoice_products.*.sgst_amt' => 'required',
            'tax_invoice_products.*.igst_rate' => 'required|numeric',
            'tax_invoice_products.*.total_gst_amt' => 'required',
        ]);
        $tax_invoice = TaxInvoice::findOrFail($id);
        $tax_invoice->fill([
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
            'total_invoice_value' => $request->total_invoice_value,
            'total_taxable_value' => $request->total_taxable_value,
            'total_cgst'          => $request->total_cgst,
            'total_sgst'          => $request->total_sgst,
            'total_igst'          => $request->total_igst,
            'grand_total'         => $request->grand_total,
        ])->save();

        TaxInvoiceProduct::where('tax_invoice_id', $id)->delete();    
        for ($i = 0; $i < $request->total_item; $i++)
        {
            $item = new TaxInvoiceProduct();
            $item->fill([
                'tax_invoice_id'           => $id,
                'desc'                     => $request->desc[$i],
                'hsn_code'                 => $request->hsn_code[$i],
                'unit'                     => $request->unit[$i],
                'order_item_quantity'      => $request->order_item_quantity[$i],
                'order_item_price'         => $request->order_item_price[$i],
                'order_item_actual_amount' => $request->order_item_actual_amount[$i],
                'cgst_rate'                => $request->cgst_rate[$i],
                'cgst_amt'                 => $request->cgst_amt[$i],
                'sgst_rate'                => $request->sgst_rate[$i],
                'sgst_amt'                 => $request->sgst_amt[$i],
                'igst_rate'                => $request->igst_rate[$i],
                'total_gst_amt'            => $request->total_gst_amt[$i],
            ])->save();
        }

        return redirect()->route('invoice.index')->with('success','Invoice Updated Successfully');
    }

    public function destroy($id)
    {
        $invoice = Invoice::findOrFail($id);

        InvoiceProduct::where('invoice_id', $invoice->id)
            ->delete();

        $invoice->delete();

        return redirect()
            ->route('invoices.index');
    }

}
