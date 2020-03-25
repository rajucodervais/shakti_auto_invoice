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
                <strong>Edit Challan</strong>
                <a href="{{route('challan.index')}}" class="btn btn-secondary pull-right">Back</a>
            </div>
            <form method="POST" action="{{route('challan.update',$challan->id)}}">
            @csrf
            @method('PATCH')
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Vendor Code <span class="error">*</span></label>
                                </div>
                                <div class="col-md-8">
                                    <input type="number" name="vendorcode" id="vendorcode" class="vendorcode form-control" value="{{$challan->vendorcode}}">
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
                                    <textarea name="address" id="address" class="address form-control">{{$challan->address}}</textarea>
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
                                    <input type="text" name="name" id="name" class="name form-control" value="{{$challan->name}}">
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
                                    <input type="text" name="customergstin" id="customergstin" class="customergstin form-control" value="{{$challan->customergstin}}">
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
                                    <input type="text" name="city" id="city" class="city form-control" value="{{$challan->city}}">
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
                                            <option value="{{$st->id}}" {{($challan->state_name == $st->id)?'selected':''}}>{{$st->state_name}}</option>
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
                                    <input type="number" name="zip_code" id="zip_code" class="zip_code form-control" value="{{$challan->zip_code}}">
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
                                    <input type="number" name="state_code" id="state_code" class="state_code form-control" value="{{$challan->state_code}}">
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
                                    <input type="text" name="date" id="date" class="date form-control" value="{{$challan->date}}">
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
                                    <input type="text" name="podate" id="podate" class="podate form-control" value="{{$challan->podate}}">
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
                                    <input type="number" name="purchage_order_no" id="purchage_order_no" class="purchage_order_no form-control" value="{{$challan->purchage_order_no}}">
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
                                    <input type="text" name="delivery_challan_no" id="delivery_challan_no" class="delivery_challan_no form-control" value="{{$challan->delivery_challan_no}}">
                                    @if($errors->has('delivery_challan_no'))
                                        <div class="error">{{ $errors->first('delivery_challan_no') }}</div>
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
                                <label>Vehicle No</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="vehicle_no" id="vehicle_no" class="vehicle_no form-control" value="{{$challan->vehicle_no}}">
                                    @if($errors->has('vehicle_no'))
                                        <div class="error">{{ $errors->first('vehicle_no') }}</div>
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
                                        <td rowspan="2">Unit <span class="error">*</span></td>
                                        <td rowspan="2">Quantity <span class="error">*</span></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $count = 1; ?>
                                    @foreach($challan->challan_products as $product)
                                    <tr id="row_id_{{$count}}">
                                      <td><span id="sr_no">{{$count}}</span></td>
                                      <td><textarea class="desc form-control" name="desc[]" id="desc{{$count}}">{{$product->desc}}</textarea></td>
                                      <td><input type="text" name="unit[]" class="form-control unit" id="unit{{$count}}" value="{{$product->unit}}"></td>
                                      <td><input type="text" name="order_item_quantity[]" id="order_item_quantity{{$count}}" data-srno="{{$count}}" class="form-control input-sm order_item_quantity" value="{{$product->order_item_quantity}}" /></td>
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
                                <input type="hidden" name="total_item" id="total_item" value="{{count($challan->challan_products)}}" />
                                <button type="button" name="add_row" id="add_row" class="btn btn-success btn-xs">+</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{route('invoice.index')}}" class="btn btn-danger">CANCEL</a>
                    <button class="btn btn-success">Update</button>
                </div>
            </form>
        </div>
    </div>
    <script src="{{asset('js/challan_edit.js')}}"></script>
@endsection
