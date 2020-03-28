@extends('layouts.adminLayout')
@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tax invoice</h1>
        <a href="{{route('invoice.create')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Create Inovice</a>
    </div>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <input type="text" class="keyword input-sm" id="keyword" name="keyword" placeholder="serach Here">
        <input type="text" class="from_date" id="from_date" name="from_date" placeholder="From Date">
        <input type="text" class="to_date" id="to_date" name="to_date" placeholder="To Date">
        <button type="button" class="search_btn d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Submit</button>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm generate_report"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>

  <!-- Content Row -->
    <div class="row">
            @if(session()->has('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if($invoices->count())
            <table class="table table-bordered tax_invoices_table" style="">
                <thead>
                    <tr>
                        <th>Invoice No</th>
                        <th>Name</th>
                        <th>Invoice Date</th>
                        <th>P.O. Date</th>
                        <th>Grand Total</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($invoices as $invoice)
                        <tr>
                            <?php
                            $id = $invoice->id;
                            $string1 = 'SAM/';
                            $string2 = str_pad($id, 6, "0", STR_PAD_LEFT);
                            $date = date('Y',strtotime($invoice->created_at));
                            $invoice_no = $string1.$string2.'/'.$date;
                            ?>
                            <td><a href="{{route('invoice.show', $invoice->id)}}" class="">{{$invoice_no}}</a></td>
                            <td>{{$invoice->name}}</td>
                            <td>{{$invoice->date}}</td>
                            <td>{{$invoice->podate}}</td>
                            <td>{{$invoice->grand_total}}</td>
                            <td>{{$invoice->created_at->diffForHumans()}}</td>
                            <td class="">
                                <a href="{{route('createpdf', $invoice->id)}}" class="text-primary btn-sm">PDF<i class="fa fa-edit"></i></a>
                                <a href="{{route('invoice.edit', $invoice->id)}}" class="text-primary btn-sm">Edit<i class="fa fa-edit"></i></a>
                                <!-- <a class="text-danger" href="{{route('invoice.destroy', $invoice->id)}}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    Delete
                                </a> -->

                                <form id="logout-form" action="{{route('invoice.destroy', $invoice->id)}}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {!! $invoices->render() !!}
            @else
                <div class="invoice-empty">
                    <p class="invoice-empty-title">
                        No Invoices were created.
                        <a href="{{route('invoice.create')}}">Create Now!</a>
                    </p>
                </div>
            @endif
     </div>   
</div>
<script type="text/javascript">
$(document).ready(function(){
    $("#from_date").datepicker();
    $("#to_date").datepicker();
    $('.search_btn').on('click', function(){
        var from_date = $('.from_date').val();
        var to_date = $('.to_date').val();
        $.ajax({
            type : "GET",
            url : "{{route('invoice_search_btn')}}",
            data:{from_date:from_date,to_date:to_date},
            success:function(data){
                console.log(data);
                $('.tax_invoices_table tbody').html(data);
            }
         });
    })

    $('.keyword').on('keyup', function(){
        var value = $(this).val();
        $.ajax({
            type : "GET",
            url : "{{route('invoice_keyword')}}",
            data:{search:value},
            success:function(data){
                console.log(data);
                $('.tax_invoices_table tbody').html(data);
            }
         });
    });
    $('.generate_report').on('click', function(){
        var from_date = $('.from_date').val();
        var to_date = $('.to_date').val();
        $.ajax({
            type : "GET",
            url : "{{route('invoice_generate_report')}}",
            data:{from_date:from_date,to_date:to_date},
            success:function(data){
                console.log(data);
                // $('.tax_invoices_table tbody').html(data);
            }
         });
    })
})
</script>
<!-- <script src="{{asset('js/main.js')}}"></script> -->
@endsection
