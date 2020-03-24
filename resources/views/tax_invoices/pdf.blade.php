<!DOCTYPE html>
<html>
<head>
    <title>shakti auto mobile pdf</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
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
</head>
<body>
    <div id="invoice">
        <div class="row border-div">
            <div class="col-md-12">
                <table style="width: 100%">
                    <tr><td colspan="10"><h4 align="center">Tax Invoice</h4></td></tr>
                    <tr>
                        <td><h5>GSTIN - 23DVPPS8059J1ZQ</h5></td>
                        <td align="right">
                            <h5 style="color:red">ORIGINAL COPY</h5>
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
                        <td align="center"></td>
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
                    $id = $tax_invoice->id;
                    $string1 = 'SAM/';
                    $string2 = str_pad($id, 6, "0", STR_PAD_LEFT);
                    $date = date('Y',strtotime($tax_invoice->created_at));
                    $invoice_no = $string1.$string2.'/'.$date;
                ?>
                <table style="width: 100%">
                    <tr>
                        <td>
                            <span><strong>BILL NO:- {{$invoice_no}} </strong></span>
                        </td>
                        <td align="right">
                            <span><strong>DATE:- {{date('d/m/Y',strtotime($tax_invoice->date))}}</strong></span>
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
                            <span><strong>Vendor Code :- {{$tax_invoice->vendorcode}}</strong></span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <span><strong>Name :- {{$tax_invoice->name}}</strong></span>
                        </td>
                        <td align="right">
                            <span><strong>Customer GSTIN :- {{$tax_invoice->customergstin}}</strong></span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <span><strong>Address :- {{$tax_invoice->address}}</strong></span>
                        </td>
                        <td align="right">
                            <span><strong>State Name :- {{$tax_invoice->state_name}}</strong></span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <span><strong>City :- {{$tax_invoice->city}}</strong></span>
                        </td>
                        <td align="right">
                            <span><strong>State Code :- {{$tax_invoice->state_code}}</strong></span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <span><strong>Zip Code :- {{$tax_invoice->zip_code}}</strong></span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span><strong>Purchage Order No :- {{$tax_invoice->purchage_order_no}}</strong></span>
                        </td>
                        <td align="center">
                            <span><strong>P.O. Date :- {{$tax_invoice->podate}}</strong></span>
                        </td>
                        <td align="right">
                            <span><strong>Delivery Challan No :- {{$tax_invoice->delivery_challan_no}}</strong></span>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row border-div">
        <div class="col-md-12">
                <table class="table table-bordered" id="tab_invoice" style="width: 100%" border="1">
                    <thead style="background: yellow">
                        <tr>
                            <td rowspan="2">Sr No</td>
                            <td rowspan="2">Description of Goods</td>
                            <td rowspan="2">HSN/SAC Code</td>
                            <td rowspan="2">Unit</td>
                            <td rowspan="2">Qty</td>
                            <td rowspan="2">Rate</td>
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
                        <?php $count = 1; ?>
                        @foreach($tax_invoice->tax_invoice_products as $product)
                        <tr>
                          <td><span id="sr_no">{{$count}}</span></td>
                          <td>{{$product->desc}}</td>
                          <td>{{$product->hsn_code}}</td>
                          <td>{{$product->unit}}</td>
                          <td>{{$product->order_item_quantity}}</td>
                          <td>{{$product->order_item_price}}</td>
                          <td>{{$product->order_item_actual_amount}}</td>
                          <td>{{$product->cgst_rate}}</td>
                          <td>{{$product->cgst_amt}}</td>
                          <td>{{$product->sgst_rate}}</td>
                          <td>{{$product->sgst_amt}}</td>
                          <td>{{$product->igst_rate}}</td>
                          <td>{{$product->total_gst_amt}}</td>
                        </tr>
                        <?php $count++ ?>
                        @endforeach
                        <tr style="background: yellow">
                            <td colspan="7"></td>
                            <td colspan="4" align="center"><h4><b>Summary</b></h4></td>
                            <td colspan="2" align="center"><h4><b>Amount</b></h4></td>
                        </tr>
                        <tr>
                            <td colspan="7" rowspan="6">
                                <h4><strong>Total Invoice Value (In Words):-</strong></h4>              
                                <h5 style="margin-left: 50px"><b>{{numberTowords($tax_invoice->grand_total)}}</b></h5>
                            </td>
                            <td colspan="4" align="right"><strong>Total Invoice Value</strong></td>
                            <td colspan="2" align="center">{{$tax_invoice->total_invoice_value}}</td>
                        </tr>
                        <tr>
                            <td colspan="4" align="right"><strong>Total Taxable Value</strong></td>
                            <td colspan="2" align="center"><strong>{{$tax_invoice->total_taxable_value}}</strong></td>
                        </tr>
                        <tr>
                            <td colspan="4" align="right"><strong>Add</strong> - Total CGST</td>
                            <td colspan="2" align="center"><strong>{{$tax_invoice->total_cgst}}</strong></td>
                        </tr>
                        <tr>
                            <td colspan="4" align="right"><strong>Add</strong> - Total SGST</td>
                            <td colspan="2" align="center"><strong>{{$tax_invoice->total_sgst}}</strong></td>
                        </tr>
                        <tr>
                            <td colspan="4" align="right"><strong>Add</strong> - Total IGST</td>
                            <td colspan="2" align="center"><strong>{{$tax_invoice->total_igst}}</strong></td>
                        </tr>
                        <tr style="background: yellow">
                            <td colspan="4" align="center"><h4><strong>Grand Total</strong></h4></td>
                            <td colspan="2" align="center"><h4><strong>{{$tax_invoice->grand_total}}</strong></h4></td>
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
</body>
</html>