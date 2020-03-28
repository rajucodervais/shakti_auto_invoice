@extends('layouts.adminLayout')
@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Quotation</h1>
        <a href="{{route('quotation.create')}}" class="btn btn-success pull-right">Create Quotations</a>
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
            @if($quotations->count())
            <table class="table table-bordered quotation_table" style="">
                <thead>
                    <tr>
                        <th>Invoice No</th>
                        <th>Name</th>
                        <th>Invoice Date</th>
                        <th>Grand Total</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($quotations as $quotation)
                        <tr>
                            <?php
                            $id = $quotation->id;
                            $string1 = 'SAM/';
                            $string2 = str_pad($id, 6, "0", STR_PAD_LEFT);
                            $date = date('Y',strtotime($quotation->created_at));
                            $quotation_no = $string1.$string2.'/'.$date;
                            ?>
                            <td><a href="{{route('quotation.show', $quotation->id)}}" class="">{{$quotation_no}}</a></td>
                            <td>{{$quotation->name}}</td>
                            <td>{{$quotation->date}}</td>
                            <td>{{$quotation->grand_total}}</td>
                            <td>{{$quotation->created_at->diffForHumans()}}</td>
                            <td class="">
                                <a href="{{route('createquotationpdf', $quotation->id)}}" class="text-primary btn-sm">PDF<i class="fa fa-edit"></i></a>
                                <a href="{{route('quotation.edit', $quotation->id)}}" class="text-primary btn-sm">Edit<i class="fa fa-edit"></i></a>
                                <!-- <a class="text-danger" href="{{route('quotation.destroy', $quotation->id)}}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    Delete
                                </a> -->

                                <form id="logout-form" action="{{route('quotation.destroy', $quotation->id)}}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {!! $quotations->render() !!}
            @else
                <div class="quotation-empty">
                    <p class="quotation-empty-title">
                        No quotations were created.
                        <a href="{{route('quotation.create')}}">Create Now!</a>
                    </p>
                </div>
            @endif
     </div>   
</div>
<script type="text/javascript">
$(document).ready(function(){
    console.log('hii')
    $("#from_date").datepicker();
    $("#to_date").datepicker();
    $('.search_btn').on('click', function(){
        var from_date = $('.from_date').val();
        var to_date = $('.to_date').val();
        $.ajax({
            type : "GET",
            url : "{{route('quotation_search_btn')}}",
            data:{from_date:from_date,to_date:to_date},
            success:function(data){
                console.log(data);
                $('.quotation_table tbody').html(data);
            }
         });
    })

    $('.keyword').on('keyup', function(){
        var value = $(this).val();
        $.ajax({
            type : "GET",
            url : "{{route('quotation_keyword')}}",
            data:{search:value},
            success:function(data){
                console.log(data);
                $('.quotation_table tbody').html(data);
            }
         });
    });
    $('.generate_report').on('click', function(){
        var from_date = $('.from_date').val();
        var to_date = $('.to_date').val();
        $.ajax({
            type : "GET",
            url : "{{route('quotation_generate_report')}}",
            data:{from_date:from_date,to_date:to_date},
            success:function(data){
                console.log(data);
                // $('.quotation_table tbody').html(data);
            }
         });
    })
})
</script>
@endsection
