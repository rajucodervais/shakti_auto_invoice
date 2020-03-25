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
                <strong>Create Quotation</strong>
                <a href="{{route('quotation.index')}}" class="btn btn-secondary pull-right">Back</a>
            </div>
            <form method="POST" action="{{route('quotation.store')}}">
            @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
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
                                    <select name="state_name" id="state_name" class="state_name form-control">
                                        <option value="">Select State</option>
                                        @foreach($state as $st)
                                            <option value="{{$st->id}}" {{old('state_name') == $st->id ? 'selected':''}}>{{$st->state_name}}</option>
                                        @endforeach
                                    </select>
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
                                    <input type="text" name="state_code" id="state_code" class="state_code form-control" value="{{old('state_code')}}" readonly>
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
                                    <input type="text" name="date" id="date" class="date form-control" value="{{old('date')}}" readonly>
                                    @if($errors->has('date'))
                                        <div class="error">{{ $errors->first('date') }}</div>
                                    @endif    
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row clearfix" style="width:100%;overflow-y: auto;">
                        <div class="col-md-12">
                            <table class="table table-bordered" style="" id="tab_quotation">
                                <thead>
                                    <tr>
                                        <td>Sr No</td>
                                        <td>Description of Goods <span class="error">*</span></td>
                                        <td>Unit <span class="error">*</span></td>
                                        <td>Qty. <span class="error">*</span></td>
                                        <td>Rate<span class="error">*</span></td>
                                        <td>Amount</td>
                                        <td>Discount @ 7%</td>
                                        <td>Taxable Amount</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                      <td><span id="sr_no">1</span></td>
                                      <td><textarea class="desc form-control" name="desc[]" id="desc1"></textarea></td>
                                      <td><input type="text" name="unit[]" class="form-control unit" id="unit1"></td>
                                      <td><input type="text" name="order_item_quantity[]" id="order_item_quantity1" data-srno="1" class="form-control input-sm order_item_quantity" /></td>
                                      <td><input type="text" name="order_item_price[]" id="order_item_price1" data-srno="1" class="form-control input-sm number_only order_item_price" /></td>
                                      <td><input type="text" name="order_item_actual_amount[]" id="order_item_actual_amount1" data-srno="1" class="form-control input-sm order_item_actual_amount" readonly /></td>
                                      
                                      <td><input type="text" name="discount[]" id="discount1" data-srno="1" class="form-control input-sm number_only discount" readonly /></td>
                                      <td><input type="text" name="taxable_amount[]" id="taxable_amount1" data-srno="1" readonly class="form-control input-sm taxable_amount" /></td>
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
                            <th class="text-center">Sub Total</th>
                            <td class="text-center"><input type="text" name='sub_total' placeholder='0.00' class="form-control" id="sub_total" readonly/></td>
                          </tr>
                          <tr>
                            <th class="text-center">Total Taxable Amount</th>
                            <td class="text-center"><input type="text" name='total_taxable_value' placeholder='0.00' class="form-control" id="total_taxable_value" readonly/></td>
                          </tr>
                          <tr>
                            <th class="text-center">CGST @ 9%</th>
                            <td class="text-center"><input type="text" name='cgst' placeholder='0.00' class="form-control" id="cgst" readonly/></td>
                          </tr>
                          <tr>
                            <th class="text-center">SGST @ 9%</th>
                            <td class="text-center"><input type="text" name='sgst' placeholder='0.00' class="form-control" id="sgst" readonly/></td>
                          </tr>
                          <tr>
                            <th class="text-center">IGST @ 18%</th>
                            <td class="text-center"><input type="text" name='igst' placeholder='0.00' class="form-control" id="igst" readonly/></td>
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
                    <a href="{{route('quotation.index')}}" class="btn btn-danger">CANCEL</a>
                    <button class="btn btn-success">CREATE</button>
                </div>
            </form>
        </div>
    </div>
    <script src="{{asset('js/quotation_create.js')}}"></script>
@endsection
