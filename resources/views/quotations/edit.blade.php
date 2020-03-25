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
                <strong>Edit Quotation</strong>
                <a href="{{route('quotation.index')}}" class="btn btn-secondary pull-right">Back</a>
            </div>
            <form method="POST" action="{{route('quotation.update',$quotation->id)}}">
            @csrf
            @method('PATCH')
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-4">
                                <label>Address <span class="error">*</span></label>
                                </div>
                                <div class="col-md-8">
                                    <textarea name="address" id="address" class="address form-control">{{$quotation->address}}</textarea>
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
                                    <input type="text" name="name" id="name" class="name form-control" value="{{$quotation->name}}">
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
                                    <input type="text" name="city" id="city" class="city form-control" value="{{$quotation->city}}">
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
                                            <option value="{{$st->id}}" {{($quotation->state_name == $st->id)?'selected':''}}>{{$st->state_name}}</option>
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
                                    <input type="number" name="zip_code" id="zip_code" class="zip_code form-control" value="{{$quotation->zip_code}}">
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
                                    <input type="number" name="state_code" id="state_code" class="state_code form-control" value="{{$quotation->state_code}}">
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
                                    <input type="text" name="date" id="date" class="date form-control" value="{{$quotation->date}}">
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
                                        <td>Qty <span class="error">*</span></td>
                                        <td>Rate <span class="error">*</span></td>
                                        <td>Amount</td>
                                        <td>Discount</td>
                                        <td>Taxable Amount</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $count = 1; ?>
                                    @foreach($quotation->quotation_products as $product)
                                    <tr id="row_id_{{$count}}">
                                      <td><span id="sr_no">{{$count}}</span></td>
                                      <td><textarea class="desc form-control" name="desc[]" id="desc{{$count}}">{{$product->desc}}</textarea></td>
                                      <td><input type="text" name="unit[]" class="form-control unit" id="unit{{$count}}" value="{{$product->unit}}"></td>
                                      <td><input type="text" name="order_item_quantity[]" id="order_item_quantity{{$count}}" data-srno="{{$count}}" class="form-control input-sm order_item_quantity" value="{{$product->order_item_quantity}}" /></td>
                                      <td><input type="text" name="order_item_price[]" id="order_item_price{{$count}}" data-srno="{{$count}}" class="form-control input-sm number_only order_item_price" value="{{$product->order_item_price}}"/></td>
                                      <td><input type="text" name="order_item_actual_amount[]" id="order_item_actual_amount{{$count}}" data-srno="{{$count}}" class="form-control input-sm order_item_actual_amount" readonly value="{{$product->order_item_actual_amount}}"/></td>
                                      <td><input type="text" name="discount[]" id="discount{{$count}}" data-srno="{{$count}}" class="form-control input-sm number_only discount" value="{{$product->discount}}"/></td>
                                      <td><input type="text" name="taxable_amount[]" id="taxable_amount{{$count}}" data-srno="{{$count}}" readonly class="form-control input-sm taxable_amount" value="{{$product->taxable_amount}}"/></td>
                                      <td>
                                        @if($count > 1)
                                        <button type="button" name="remove_row" id="{{$count}}" class="btn btn-danger btn-xs remove_row">X</button>
                                        @endif
                                    </td>
                                    </tr>
                                    <?php $count++ ?>
                                    @endforeach
                                </tbody>    
                            </table>
                            <div align="right">
                                <input type="hidden" name="total_item" id="total_item" value="{{count($quotation->quotation_products)}}" />
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
                            <td class="text-center"><input type="text" name='sub_total' placeholder='0.00' class="form-control" id="sub_total" readonly value="{{$quotation->sub_total}}" /></td>
                          </tr>
                          <tr>
                            <th class="text-center">Total Taxable Value</th>
                            <td class="text-center"><input type="text" name='total_taxable_value' placeholder='0.00' class="form-control" id="total_taxable_value" readonly value="{{$quotation->total_taxable_value}}"/></td>
                          </tr>
                          <tr>
                            <th class="text-center"> CGST @ 9%</th>
                            <td class="text-center"><input type="text" name='cgst' placeholder='0.00' class="form-control" value="{{$quotation->cgst}}" id="cgst" readonly/></td>
                          </tr>
                          <tr>
                            <th class="text-center">SGST @ 9%</th>
                            <td class="text-center"><input type="text" name='sgst' placeholder='0.00' value="{{$quotation->sgst}}" class="form-control" id="sgst" readonly/></td>
                          </tr>
                          <tr>
                            <th class="text-center"> IGST @ 18%</th>
                            <td class="text-center"><input type="text" name='igst' placeholder='0.00' class="form-control" value="{{$quotation->igst}}" id="igst" readonly/></td>
                          </tr>
                          <tr>
                            <th class="text-center"><strong>Grand Total</strong></th>
                            <td class="text-center"><input type="text" name='grand_total' placeholder='0.00' value="{{$quotation->grand_total}}" class="form-control" id="grand_total" readonly/></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                    <a href="{{route('quotation.index')}}" class="btn btn-danger">CANCEL</a>
                    <button class="btn btn-success">Update</button>
                </div>
            </form>
        </div>
    </div>
    <script src="{{asset('js/quotation_edit.js')}}"></script>
@endsection
