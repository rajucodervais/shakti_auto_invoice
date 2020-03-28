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
                <strong>LETTER HEAD</strong>
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
                <br>
                <div class="row border-div">
                    <div class="col-md-12">
                        <a href="{{ url('/prnpriview') }}" class="btnprn btn">Print Preview</a></center>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
<script type="text/javascript">
    $(document).ready(function(){
        $('.btnprn').printPage();
    });
</script>
@endsection
