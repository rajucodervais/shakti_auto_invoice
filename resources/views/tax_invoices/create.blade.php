@extends('layouts.adminLayout')
@section('content')
<style type="text/css">
    .error{
        font-size: 10px;
        color: red;
    }
</style>
    <div id="invoice">
        <div class="card card-default">
            <div class="card-header">
                <strong>Create Invoice</strong>
                <a href="{{route('invoice.index')}}" class="btn btn-secondary pull-right">Back</a>
            </div>
            <form method="POST" action="{{route('invoice.store')}}">
            @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Vendor Code <span class="error">*</span></label>
                                </div>
                                <div class="col-md-8">
                                    <input type="number" name="vendorcode" id="vendorcode" class="vendorcode form-control" value="{{old('vendorcode')}}">
                                    @if($errors->has('vendorcode'))
                                        <div class="error">{{ $errors->first('vendorcode') }}</div>
                                    @endif    
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-4">
                                <label>Address <span class="error">*</span></label>
                                </div>
                                <div class="col-md-8">
                                    <textarea name="address" id="address" class="address form-control">{{old('address')}}</textarea>
                                    @if($errors->has('address'))
                                        <div class="error">{{ $errors->first('address') }}</div>
                                    @endif 
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-4">
                                <label>Name <span class="error">*</span></label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="name" id="name" class="name form-control" value="{{old('name')}}">
                                    @if($errors->has('name'))
                                        <div class="error">{{ $errors->first('name') }}</div>
                                    @endif 
                                </div>
                            </div>   
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-4">
                                <label>Customer GSTIN <span class="error">*</span></label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="customergstin" id="customergstin" class="customergstin form-control" value="{{old('customergstin')}}">
                                    @if($errors->has('customergstin'))
                                        <div class="error">{{ $errors->first('customergstin') }}</div>
                                    @endif 
                                </div>
                            </div>   
                        </div>   
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-4">
                                <label>City <span class="error">*</span></label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="city" id="city" class="city form-control" value="{{old('city')}}">
                                    @if($errors->has('city'))
                                        <div class="error">{{ $errors->first('city') }}</div>
                                    @endif   
                                </div>
                            </div> 
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-4">
                                <label>State Name <span class="error">*</span></label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="state_name" id="state_name" class="state_name form-control" value="{{old('state_name')}}">
                                    @if($errors->has('state_name'))
                                        <div class="error">{{ $errors->first('state_name') }}</div>
                                    @endif 
                                </div>
                            </div>   
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-4">
                                <label>Zip Code <span class="error">*</span></label>
                                </div>
                                <div class="col-md-8">
                                    <input type="number" name="zip_code" id="zip_code" class="zip_code form-control" value="{{old('zip_code')}}">
                                    @if($errors->has('zip_code'))
                                        <div class="error">{{ $errors->first('zip_code') }}</div>
                                    @endif   
                                </div>
                            </div> 
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-4">
                                <label>State code <span class="error">*</span></label>
                                </div>
                                <div class="col-md-8">
                                    <input type="number" name="state_code" id="state_code" class="state_code form-control" value="{{old('state_code')}}">
                                    @if($errors->has('state_code'))
                                        <div class="error">{{ $errors->first('state_code') }}</div>
                                    @endif 
                                </div>
                            </div>   
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-4">
                                <label>Date <span class="error">*</span></label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="date" id="date" class="date form-control" value="{{old('date')}}">
                                    @if($errors->has('date'))
                                        <div class="error">{{ $errors->first('date') }}</div>
                                    @endif    
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-4">
                                <label>P.O. Date <span class="error">*</span></label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="podate" id="podate" class="podate form-control" value="{{old('podate')}}">
                                    @if($errors->has('podate'))
                                        <div class="error">{{ $errors->first('podate') }}</div>
                                    @endif 
                                </div>
                            </div>   
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-4">
                                <label>Purchage Order No <span class="error">*</span></label>
                                </div>
                                <div class="col-md-8">
                                    <input type="number" name="purchage_order_no" id="purchage_order_no" class="purchage_order_no form-control" value="{{old('purchage_order_no')}}">
                                    @if($errors->has('purchage_order_no'))
                                        <div class="error">{{ $errors->first('purchage_order_no') }}</div>
                                    @endif    
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-4">
                                <label>Delivery Challan No</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="delivery_challan_no" id="delivery_challan_no" class="delivery_challan_no form-control" value="{{old('delivery_challan_no')}}">
                                    @if($errors->has('delivery_challan_no'))
                                        <div class="error">{{ $errors->first('delivery_challan_no') }}</div>
                                    @endif    
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row clearfix" style="width:100%;overflow-y: auto;">
                        <div class="col-md-12">
                            <table class="table table-bordered" style="" id="tab_invoice">
                                <thead>
                                    <tr>
                                        <td rowspan="2">Sr No</td>
                                        <td rowspan="2">Description of Goods <span class="error">*</span></td>
                                        <td rowspan="2">HSN/SAC Code <span class="error">*</span></td>
                                        <td rowspan="2">Unit <span class="error">*</span></td>
                                        <td rowspan="2">Qty <span class="error">*</span></td>
                                        <td rowspan="2">Rate <span class="error">*</span></td>
                                        <td rowspan="2">Taxable Value</td>
                                        <td colspan="2">CGST%</td>
                                        <td colspan="2">SGST%</td>
                                        <td>IGST%</td>
                                        <td rowspan="2">Total GST Amount</td>
                                    </tr>
                                    <tr>
                                        <td>Rate</td>
                                        <td>Amt</td>
                                        <td>Rate</td>
                                        <td>Amt</td>
                                        <td>%</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                      <td><span id="sr_no">1</span></td>
                                      <td><textarea class="desc form-control" name="desc[]" id="desc1"></textarea></td>
                                      <td><input type="text" name="hsn_code[]" id="hsn_code1" class="form-control hsn_code"></td>
                                      <td><input type="text" name="unit[]" class="form-control unit" id="unit1"></td>
                                      <td><input type="text" name="order_item_quantity[]" id="order_item_quantity1" data-srno="1" class="form-control input-sm order_item_quantity" /></td>
                                      <td><input type="text" name="order_item_price[]" id="order_item_price1" data-srno="1" class="form-control input-sm number_only order_item_price" /></td>
                                      <td><input type="text" name="order_item_actual_amount[]" id="order_item_actual_amount1" data-srno="1" class="form-control input-sm order_item_actual_amount" readonly /></td>
                                      <td><input type="text" name="cgst_rate[]" id="cgst_rate1" data-srno="1" class="form-control input-sm number_only cgst_rate" /></td>
                                      <td><input type="text" name="cgst_amt[]" id="cgst_amt1" data-srno="1" readonly class="form-control input-sm cgst_amt" /></td>
                                      <td><input type="text" name="sgst_rate[]" id="sgst_rate1" data-srno="1" class="form-control input-sm number_only sgst_rate" /></td>
                                      <td><input type="text" name="sgst_amt[]" id="sgst_amt1" data-srno="1" readonly class="form-control input-sm sgst_amt" /></td>
                                      <td><input type="text" name="igst_rate[]" id="igst_rate1" data-srno="1" class="form-control input-sm number_only igst_rate" /></td>
                                      <td><input type="text" name="total_gst_amt[]" id="total_gst_amt1" data-srno="1" readonly class="form-control input-sm total_gst_amt" /></td>
                                      <td></td>
                                    </tr>
                                </tbody>    
                            </table>
                            <div align="right">
                                <input type="hidden" name="total_item" id="total_item" value="1" />
                                <button type="button" name="add_row" id="add_row" class="btn btn-success btn-xs">+</button>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix justify-content-end" style="margin-top:20px">
                    <div class="pull-right col-md-6">
                      <table class="table table-bordered table-hover" id="tab_invoice_total">
                        <tbody>
                          <tr>
                            <th class="text-center">Total Invoice Value</th>
                            <td class="text-center"><input type="text" name='total_invoice_value' placeholder='0.00' class="form-control" id="total_invoice_value" readonly/></td>
                          </tr>
                          <tr>
                            <th class="text-center">Total Taxable Value</th>
                            <td class="text-center"><input type="text" name='total_taxable_value' placeholder='0.00' class="form-control" id="total_taxable_value" readonly/></td>
                          </tr>
                          <tr>
                            <th class="text-center"><strong>Add</strong> - Total CGST</th>
                            <td class="text-center"><input type="text" name='total_cgst' placeholder='0.00' class="form-control" id="total_cgst" readonly/></td>
                          </tr>
                          <tr>
                            <th class="text-center"><strong>Add</strong> - Total SGST</th>
                            <td class="text-center"><input type="text" name='total_sgst' placeholder='0.00' class="form-control" id="total_sgst" readonly/></td>
                          </tr>
                          <tr>
                            <th class="text-center"><strong>Add</strong> - Total IGST</th>
                            <td class="text-center"><input type="text" name='total_igst' placeholder='0.00' class="form-control" id="total_igst" readonly/></td>
                          </tr>
                          <tr>
                            <th class="text-center"><strong>Grand Total</strong></th>
                            <td class="text-center"><input type="text" name='grand_total' placeholder='0.00' class="form-control" id="grand_total" readonly/></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                    <a href="{{route('invoice.index')}}" class="btn btn-danger">CANCEL</a>
                    <button class="btn btn-success">CREATE</button>
                </div>
            </form>
        </div>
    </div>
    <script src="{{asset('js/tax_invoice_create.js')}}"></script>
@endsection
