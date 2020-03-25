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
                <strong>View Quotation</strong>&nbsp;&nbsp;&nbsp;&nbsp;
                <a href="{{route('quotation.index')}}" class="btn btn-secondary pull-right">Back</a>
                <a href="{{route('quotation.edit',$quotation->id)}}" class="btn btn-primary pull-right">Edit</a>
            </div>
            <div class="card-body">
                <div class="row border-div">
                    <div class="col-md-12">
                        <table style="width: 100%">
                            <tr><td colspan="10"><h4 align="center">QUOTATION</h4></td></tr>
                            <tr>
                                <td><h6><b>GSTIN - 23DVPPS8059J1ZQ</b></h6></td>
                                <td align="right">
                                    <h6><b>Mobile No. 8435406506</b></h6>
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
                            $id = $quotation->id;
                            $string1 = 'SAM/';
                            $string2 = str_pad($id, 6, "0", STR_PAD_LEFT);
                            $date = date('Y',strtotime($quotation->created_at));
                            $quotation_no = $string1.$string2.'/'.$date;
                        ?>
                        <table style="width: 100%">
                            <tr>
                                <td>
                                    <span><strong>Quotation NO:- <span style="color: red">{{$quotation_no}}</span> </strong></span>
                                </td>
                                <td align="right">
                                    <span><strong>DATE:- <span style="color: red">{{date('d/m/Y',strtotime($quotation->date))}}</span></strong></span>
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
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <span><strong>Name :- {{$quotation->name}}</strong></span>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <span><strong>Address :- {{$quotation->address}}</strong></span>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <span><strong>City :- {{$quotation->city}}</strong></span>
                                </td>
                                <td align="center">
                                    <span><strong>State Name :- {{$state->state_name}}</strong></span>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <span><strong>Zip Code :- {{$quotation->zip_code}}</strong></span>
                                </td>
                                <td align="center">
                                    <span><strong>State Code :- {{$quotation->state_code}}</strong></span>
                                </td>
                                <td></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="row border-div" style="overflow-y: auto;">
                <div class="col-md-12">
                        <table class="table table-bordered" id="tab_quotation">
                            <thead style="background: yellow">
                                <tr>
                                    <td>Sr No</td>
                                    <td>Description of Goods</td>
                                    <td>Unit</td>
                                    <td>Qty</td>
                                    <td>Rate</td>
                                    <td>Taxable Value</td>
                                    <td>Discount @ 9%</td>
                                    <td>Taxable Amount</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $count = 1; ?>
                                @foreach($quotation->quotation_products as $product)
                                <tr>
                                  <td><span id="sr_no">{{$count}}</span></td>
                                  <td>{{$product->desc}}</td>
                                  <td>{{$product->unit}}</td>
                                  <td>{{$product->order_item_quantity}}</td>
                                  <td>{{$product->order_item_price}}</td>
                                  <td>{{$product->order_item_actual_amount}}</td>
                                  <td>{{$product->discount}}</td>
                                  <td>{{$product->taxable_amount}}</td>
                                </tr>
                                <?php $count++ ?>
                                @endforeach
                                <tr>
                                    <td colspan="7" align="right"><strong>Sub Total >>>>>>></strong></td>
                                    <td colspan="1" align="center">{{$quotation->sub_total}}</td>
                                </tr>
                                <tr>
                                    <td colspan="5" rowspan="5">
                                        <h4><strong>Total Invoice Value (In Words):-</strong></h4>              
                                        <h5 style="margin-left: 50px"><b>{{numberTowords($quotation->grand_total)}}</b></h5>
                                    </td>
                                    <td colspan="2" align="right"><strong>Total Taxable Value</strong></td>
                                    <td align="center"><strong>{{$quotation->total_taxable_value}}</strong></td>
                                </tr>
                                <tr>
                                    <td colspan="2" align="right">CGST @ 9 %</td>
                                    <td align="center"><strong>{{$quotation->cgst}}</strong></td>
                                </tr>
                                <tr>
                                    <td colspan="2" align="right">SGST @ 9%</td>
                                    <td align="center"><strong>{{$quotation->sgst}}</strong></td>
                                </tr>
                                <tr>
                                    <td colspan="2" align="right">IGST @ 18%</td>
                                    <td align="center"><strong>{{$quotation->igst}}</strong></td>
                                </tr>
                                <tr style="background: yellow">
                                    <td colspan="2" align="center"><h4><strong>Grand Total Rs.</strong></h4></td>
                                    <td align="center"><h4><strong>{{$quotation->grand_total}}</strong></h4></td>
                                </tr>
                            </tbody>    
                        </table>
                    </div>
                </div>
                <div class="row border-div" style="border-bottom:1px solid">
                    <div class="col-md-12">
                        <table style="width: 100%">
                            <tr>
                                <td align="right" colspan="2"><h4><b>For:- Shakti Auto Mobile</b></h4></td>
                            </tr>
                            <tr>
                                <td>
                                    <p>Certified that the particulars given above are true and correct</p>
                                </td>
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
  echo $result." Only" ;
}
 ?> 
@endsection
