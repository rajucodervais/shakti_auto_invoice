@extends('layouts.adminLayout')
@section('content')
<style type="text/css">
    .error{
        font-size: 10px;
        color: red;
    }
    .border-div{
        border-top: 1px solid;
        border-right: 1px solid;
        border-left: 1px solid;
    }
</style>
    <div id="invoice">
        <div class="card card-default">
            <div class="card-header">
                <strong>View Challan</strong>&nbsp;&nbsp;&nbsp;&nbsp;
                <a href="{{route('challan.index')}}" class="btn btn-secondary pull-right">Back</a>
                <a href="{{route('challan.edit',$challan->id)}}" class="btn btn-primary pull-right">Edit</a>
            </div>
            <div class="card-body">
                <div class="row border-div">
                    <div class="col-md-12">
                        <table style="width: 100%">
                            <tr><td colspan="10"><h4 align="center">CHALLAN</h4></td></tr>
                            <tr>
                                <td><h5>GSTIN - 23DVPPS8059J1ZQ</h5></td>
                                <td align="right">
                                    <h6>Mobile No. 8435406506</h6>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="row border-div" style="background: #e6ffff;">
                    <div class="col-md-12">
                        <table style="width: 100%">
                            <tr><td colspan="10" style="font-family: 'Times New Roman', Times, serif;font-size: 80px;text-align: center;font-weight: bold;">SHAKTI AUTO MOBILE</td></tr>
                            <tr>
                                <td>
                                    <span>Waidhan, Dist.- Singrauli(M.P.) 486886</span><br>
                                    <span>E-mail:- shaktiauto1984@gmail.com</span>
                                </td>
                                <td align="right">
                                    <span>Moter, Parts, Engine Oil, Moter Vehicle,</span><br>
                                    <span>Repairing Works & Material Supply</span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="row border-div">
                    <div class="col-md-12">
                        <?php
                            $id = $challan->id;
                            $string1 = 'CH/';
                            $string2 = str_pad($id, 6, "0", STR_PAD_LEFT);
                            $date = date('Y',strtotime($challan->created_at));
                            $invoice_no = $string1.$string2.'/'.$date;
                        ?>
                        <table style="width: 100%">
                            <tr>
                                <td>
                                    <span><strong>BILL NO:- {{$invoice_no}} </strong></span>
                                </td>
                                <td align="right">
                                    <span><strong>DATE:- {{date('m/d/Y',strtotime($challan->date))}}</strong></span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="row border-div" style="background: #e6ffff;">
                    <div class="col-md-12">
                        <table style="width: 100%">
                            <tr>
                                <td colspan="2">
                                    <span><strong>TO,</strong></span>
                                </td>
                                <td align="right">
                                    <span><strong>Vendor Code :- {{$challan->vendorcode}}</strong></span>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <span><strong>Name :- {{$challan->name}}</strong></span>
                                </td>
                                <td align="right">
                                    <span><strong>Customer GSTIN :- {{$challan->customergstin}}</strong></span>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <span><strong>Address :- {{$challan->address}}</strong></span>
                                </td>
                                <td align="right">
                                    <span><strong>State Name :- {{$state->state_name}}</strong></span>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <span><strong>City :- {{$challan->city}}</strong></span>
                                </td>
                                <td align="right">
                                    <span><strong>State Code :- {{$challan->state_code}}</strong></span>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <span><strong>Zip Code :- {{$challan->zip_code}}</strong></span>
                                </td>
                                <td align="right">
                                    <span><strong>Vehicle No :- {{$challan->vehicle_no}}</strong></span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span><strong>Purchage Order No :- {{$challan->purchage_order_no}}</strong></span>
                                </td>
                                <td align="center">
                                    <span><strong>P.O. Date :- {{$challan->podate}}</strong></span>
                                </td>
                                <td align="right">
                                    <span><strong>Delivery Challan No :- {{$challan->delivery_challan_no}}</strong></span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="row border-div" style="overflow-y: auto;">
                <div class="col-md-12">
                        <table class="table table-bordered" id="tab_invoice">
                            <thead style="background: yellow">
                                <tr>
                                    <td rowspan="2">Sr No</td>
                                    <td rowspan="2">Description of Goods</td>
                                    <td rowspan="2">Unit</td>
                                    <td rowspan="2">Quantity</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $count = 1; ?>
                                @foreach($challan->challan_products as $product)
                                <tr>
                                  <td><span id="sr_no">{{$count}}</span></td>
                                  <td>{{$product->desc}}</td>
                                  <td>{{$product->unit}}</td>
                                  <td>{{$product->order_item_quantity}}</td>
                                </tr>
                                <?php $count++ ?>
                                @endforeach
                            </tbody>    
                        </table>
                    </div>
                </div>
                <div class="row border-div" style="border-bottom:1px solid">
                    <div class="col-md-12">
                        <table style="width: 100%">
                            <tr>
                                <td align="right"><h4><b>For:- Shakti Auto Mobile</b></h4></td>
                            </tr>
                            <tr>
                                <td align="right">
                                    <span style="font-family: cursive;">Authorized Signatory</span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
<?php
function numberTowords($number){
   $no = floor($number);
   $point = round($number - $no, 2) * 100;
   $hundred = null;
   $digits_1 = strlen($no);
   $i = 0;
   $str = array();
   $words = array('0' => '', '1' => 'one', '2' => 'two',
    '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
    '7' => 'seven', '8' => 'eight', '9' => 'nine',
    '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
    '13' => 'thirteen', '14' => 'fourteen',
    '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
    '18' => 'eighteen', '19' =>'nineteen', '20' => 'twenty',
    '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
    '60' => 'sixty', '70' => 'seventy',
    '80' => 'eighty', '90' => 'ninety');
   $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
   while ($i < $digits_1) {
     $divider = ($i == 2) ? 10 : 100;
     $number = floor($no % $divider);
     $no = floor($no / $divider);
     $i += ($divider == 10) ? 1 : 2;
     if ($number) {
        $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
        $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
        $str [] = ($number < 21) ? $words[$number] .
            " " . $digits[$counter] . $plural . " " . $hundred
            :
            $words[floor($number / 10) * 10]
            . " " . $words[$number % 10] . " "
            . $digits[$counter] . $plural . " " . $hundred;
     } else $str[] = null;
  }
  $str = array_reverse($str);
  $result = implode('', $str);
  $points = ($point) ?
    "." . $words[$point / 10] . " " . 
          $words[$point = $point % 10] : '';
  echo "Rupees ".$result ;
}
 ?> 
@endsection
