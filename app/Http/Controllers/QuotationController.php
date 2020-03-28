<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Quotation;
use App\QuotationProduct;
use App\State;
use PDF;
class QuotationController extends Controller
{
   public function index()
    {
        $quotations = Quotation::orderBy('created_at', 'desc')
            ->paginate(10);

        return view('quotations.index', compact('quotations'));
    }

    public function create()
    {
        $state = State::all();
        return view('quotations.create', compact('state'));
    }

    public function store(Request $request)
    {
        // dd($request);
        $this->validate($request, [
            'name' => 'required|max:255',
            'city' => 'required|max:255', 
            'state_name' => 'required|max:255',
            'zip_code' => 'required|digits:6',
            'state_code' => 'required',
            'address' => 'required',
            'date' => 'required|date',
            'sub_total' => 'required',
            'total_taxable_value' => 'required',
            'grand_total' => 'required',
            'quotation_products.*.desc' => 'required|min:3',
            'quotation_products.*.unit' => 'required|min:1',
            'quotation_products.*.order_item_quantity' => 'required|numeric',
            'quotation_products.*.order_item_price' => 'required|integer',
            'quotation_products.*.order_item_actual_amount' => 'required',
            'quotation_products.*.discount' => 'required|numeric',
            'quotation_products.*.taxable_amount' => 'required',
        ]);
        $quotation = new Quotation();
        $quotation->fill([
            'name'                => $request->name,
            'city'                => $request->city, 
            'state_name'          => $request->state_name,
            'zip_code'            => $request->zip_code,
            'state_code'          => $request->state_code,
            'address'             => $request->address,
            'date'                => $request->date,
            'sub_total'           => $request->sub_total,
            'total_taxable_value' => $request->total_taxable_value,
            'cgst'          => $request->cgst,
            'sgst'          => $request->sgst,
            'igst'          => $request->igst,
            'grand_total'         => $request->grand_total,
        ])->save();
        $quotation_id = $quotation->id;
            
        for ($i = 0; $i < $request->total_item; $i++)
        {
            $item = new QuotationProduct();
            $item->fill([
                'quotation_id'           => $quotation_id,
                'desc'                     => $request->desc[$i],
                'unit'                     => $request->unit[$i],
                'order_item_quantity'      => $request->order_item_quantity[$i],
                'order_item_price'         => $request->order_item_price[$i],
                'order_item_actual_amount' => $request->order_item_actual_amount[$i],
                'discount'                => $request->discount[$i],
                'taxable_amount'            => $request->taxable_amount[$i],
            ])->save();
        }
        
        return redirect()->route('quotation.index')->with('success','Quotation Created Successfully');
    }

    public function show($id)
    {
        $quotation = Quotation::with('quotation_products')->findOrFail($id);
        $state = State::findOrFail($quotation->state_name);
        // dd($quotation);
        return view('quotations.show', compact('quotation','state'));
    }

    public function edit($id)
    {
        $state = State::all();
        $quotation = Quotation::with('quotation_products')->findOrFail($id);
        return view('quotations.edit', compact('quotation','state'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'city' => 'required|max:255', 
            'state_name' => 'required|max:255',
            'zip_code' => 'required|digits:6',
            'state_code' => 'required',
            'address' => 'required',
            'date' => 'required|date',
            'sub_total' => 'required',
            'total_taxable_value' => 'required',
            'grand_total' => 'required',
            'quotation_products.*.desc' => 'required|min:3',
            'quotation_products.*.unit' => 'required|min:1',
            'quotation_products.*.order_item_quantity' => 'required|numeric',
            'quotation_products.*.order_item_price' => 'required|integer',
            'quotation_products.*.order_item_actual_amount' => 'required',
            'quotation_products.*.discount' => 'required|numeric',
            'quotation_products.*.taxable_amount' => 'required',
        ]);
        $quotation = Quotation::findOrFail($id);
        $quotation->fill([
            'name'                => $request->name,
            'city'                => $request->city, 
            'state_name'          => $request->state_name,
            'zip_code'            => $request->zip_code,
            'state_code'          => $request->state_code,
            'address'             => $request->address,
            'date'                => $request->date,
            'sub_total'           => $request->sub_total,
            'total_taxable_value' => $request->total_taxable_value,
            'cgst'                => $request->cgst,
            'sgst'                => $request->sgst,
            'igst'                => $request->igst,
            'grand_total'         => $request->grand_total,
        ])->save();
        QuotationProduct::where('quotation_id', $id)->delete();    
        for ($i = 0; $i < $request->total_item; $i++)
        {
            $item = new QuotationProduct();
            $item->fill([
                'quotation_id'             => $id,
                'desc'                     => $request->desc[$i],
                'unit'                     => $request->unit[$i],
                'order_item_quantity'      => $request->order_item_quantity[$i],
                'order_item_price'         => $request->order_item_price[$i],
                'order_item_actual_amount' => $request->order_item_actual_amount[$i],
                'discount'                => $request->discount[$i],
                'taxable_amount'            => $request->taxable_amount[$i],
            ])->save();
        }

        return redirect()->route('quotation.index')->with('success','Invoice Updated Successfully');
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

    public function create_pdf($id){
        $quotation = Quotation::with('quotation_products')->findOrFail($id);
        $state = State::findOrFail($quotation->state_name);
        $pdf = PDF::loadView('quotations.pdf', compact('quotation','state'));
        return $pdf->download(time().'_quotation.pdf');
    }

    public function search_keyword(Request $request){
        if($request->search != null){
            $quotations = Quotation::where('name','LIKE','%'.$request->search."%")->orderBy('created_at', 'desc')->paginate(10);
        }
        return view('quotations.ajax', compact('quotations'));    
    }

    public function search_between_invoice(Request $request){
        // dd($request);
        if ($request->input('from_date')<>'' && $request->input('to_date')<>'')
        {    
            $start = date("Y-m-d",strtotime($request->input('from_date')));
            $end = date("Y-m-d",strtotime($request->input('to_date')."+1 day"));
            $quotations = Quotation::whereBetween('created_at',[$start,$end])->orderBy('created_at', 'desc')->paginate(10);
        }
        return view('quotations.ajax', compact('quotations'));
    }
    public function generate_report(Request $request){
        dd('quotaiton report');
    }
}
