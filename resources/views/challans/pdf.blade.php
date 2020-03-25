<!DOCTYPE html>
<html>
<head>
    <title>shakti auto mobile pdf</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style type="text/css">
        body{
            font-size: 13px;
        }
        .error{
            font-size: 10px;
            color: red;
        }
        .border-div{
            border-top: 1px solid;
            border-right: 1px solid;
            border-left: 1px solid;
        }
        .page-break {
            page-break-after: always;
        }
        #invoice{
            width: 100%;
        }
    </style>
</head>
<body>
     <div id="invoice">
        <div class="row border-div">
            <div class="col-md-12">
                <table style="width: 100%">
                    <tr><td><h4 align="center" style="margin: 0px">CHALLAN</h4></td></tr>
                    <tr>
                        <td>
                            <div style="float: left;">
                                <h5>GSTIN - 23DVPPS8059J1ZQ</h5>    
                            </div>
                            <div align="right">
                                <h6 style="margin-bottom: 3px;">Mobile No. 8435406506</h6>    
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row border-div" style="background: #e6ffff;">
            <div class="col-md-12">
                <table style="width: 100%">
                    <tr>
                        <td style="font-family: 'Times New Roman', Times, serif;font-size: 40px;text-align: center;font-weight: bold;">SHAKTI AUTO MOBILE</td></tr>
                    <tr style="margin-right: 10px">
                        <td>
                            <div style="float: left;">
                                <span>Waidhan, Dist.- Singrauli(M.P.) 486886</span><br>
                                <span>E-mail:- shaktiauto1984@gmail.com</span>
                            </div>
                            <div align="right">
                                <span>Moter, Parts, Engine Oil, Moter Vehicle,</span><br>
                                <span>Repairing Works & Material Supply</span>
                            </div>
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
                        <td>
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
        <div class="row border-div">
        <div class="col-md-12">
                <table class="table table-bordered" id="tab_invoice" style="width: 100%">
                    <thead style="background: yellow">
                        <tr>
                            <td>Sr No</td>
                            <td>Description of Goods</td>
                            <td>Unit</td>
                            <td>Quantity</td>
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
                        <td align="right"><h4 style="margin: 0px;"><b>For:- Shakti Auto Mobile</b></h4></td>
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
    <div class="page-break"></div>
</body>
</html>