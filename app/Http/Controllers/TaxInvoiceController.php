<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TaxInvoice;
use App\TaxInvoiceProduct;
use App\State;
use PDF;
use Response;
// use Maatwebsite\Excel\Facades\Excel;
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
        $state = State::all();
        return view('tax_invoices.create', compact('state'));
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
        $state = State::findOrFail($tax_invoice->state_name);
        return view('tax_invoices.show', compact('tax_invoice','state'));
    }

    public function edit($id)
    {
        $state = State::all();
        $tax_invoice = TaxInvoice::with('tax_invoice_products')->findOrFail($id);
        return view('tax_invoices.edit', compact('tax_invoice','state'));
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

    public function create_pdf($id){
        $tax_invoice = TaxInvoice::with('tax_invoice_products')->findOrFail($id);
        $state = State::findOrFail($tax_invoice->state_name);
        $pdf = PDF::loadView('tax_invoices.pdf', compact('tax_invoice','state'));
        return $pdf->download(time().'_invoice.pdf');
    }

    public function search_keyword(Request $request){
        if($request->search != null){
            $invoices = TaxInvoice::where('name','LIKE','%'.$request->search."%")->get();
        }
        return view('tax_invoices.ajax', compact('invoices'));    
    }

    public function search_between_invoice(Request $request){
        // dd($request);
        if ($request->input('from_date')<>'' && $request->input('to_date')<>'')
        {    
            $start = date("Y-m-d",strtotime($request->input('from_date')));
            $end = date("Y-m-d",strtotime($request->input('to_date')."+1 day"));
            $invoices = TaxInvoice::whereBetween('created_at',[$start,$end])->get();
        }
        return view('tax_invoices.ajax', compact('invoices'));
    }

    public function generate_report(Request $request){
        if ($request->input('from_date')<>'' && $request->input('to_date')<>'')
        {    
            $filename = "report.csv";
            $start = date("Y-m-d",strtotime($request->input('from_date')));
            $end = date("Y-m-d",strtotime($request->input('to_date')."+1 day"));
            $invoices = TaxInvoice::with('tax_invoice_products')->whereBetween('created_at',[$start,$end])->get();
            header('Content-Type: applicaton/csv');
            header('Content-Disposition: attachment; filename="'.$filename.'"');   
            $FH = fopen('report.csv', 'w');
                foreach ($invoices as $key => $value) {
                    $id = $value->id;
                    $string1 = 'SAM/';
                    $string2 = str_pad($id, 6, "0", STR_PAD_LEFT);
                    $date = date('Y',strtotime($value->created_at));
                    $invoice_no = $string1.$string2.'/'.$date;
                    foreach ($value->tax_invoice_products as $key => $products) {
                    $output = array($invoice_no,$value->name,$value->city,$value->state_name,$value->state_code,$value->zip_code,$value->address,$value->date,$value->podate,$products->desc,$products->hsn_code,$products->unit,$products->order_item_price,$products->order_item_quantity,$products->order_item_actual_amount,$products->cgst_rate,$products->cgst_amt,$products->sgst_rate,$products->sgst_amt,$products->igst_rate,$products->total_gst_amt);
                    fputcsv($FH, $output);    
                    }            
                }
            fclose($FH);
            // $headers = array(
            //     'Content-Type' => 'applicaton/csv',
            // );

            // return Response::download($filename,'download.csv', $headers);
            // return Excel::download(new UsersExport, $filename);
            // return Response::download($callback, 200, $headers); 
            // $output = '';
            // $output .=  '<table>';
            // foreach ($invoices as $key => $value) {
            //     $id = $value->id;
            //     $string1 = 'SAM/';
            //     $string2 = str_pad($id, 6, "0", STR_PAD_LEFT);
            //     $date = date('Y',strtotime($value->created_at));
            //     $invoice_no = $string1.$string2.'/'.$date;
            //     foreach ($value->tax_invoice_products as $key => $products) {
            //     $output .='<tr>
            //                     <td>'.$invoice_no.'</td>
            //                     <td>'.$value->name.'</td>
            //                     <td>'.$value->city.'</td>
            //                     <td>'.$value->state_name.'</td>
            //                     <td>'.$value->state_code.'</td>
            //                     <td>'.$value->zip_code.'</td>
            //                     <td>'.$value->address.'</td>
            //                     <td>'.$value->date.'</td>
            //                     <td>'.$value->podate.'</td>
            //                     <td>'.$products->desc.'</td>
            //                     <td>'.$products->hsn_code.'</td>
            //                     <td>'.$products->unit.'</td>
            //                     <td>'.$products->order_item_price.'</td>
            //                     <td>'.$products->order_item_quantity.'</td>
            //                     <td>'.$products->order_item_actual_amount.'</td>
            //                     <td>'.$products->cgst_rate.'</td>
            //                     <td>'.$products->cgst_amt.'</td>
            //                     <td>'.$products->sgst_rate.'</td>
            //                     <td>'.$products->sgst_amt.'</td>
            //                     <td>'.$products->igst_rate.'</td>
            //                     <td>'.$products->total_gst_amt.'</td>
            //                 </tr>';
            //     }            
            // }
            // $output .= '</table>';
            // echo $output;
        }
    }
   public function state_list(Request $request){
        $id = $request->id;
        $state = State::findOrFail($id);
        return $state->state_code;
    }

}
