@extends('layouts.adminLayout')
@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Challan</h1>
        <a href="{{route('challan.create')}}" class="btn btn-success pull-right">Create Challan</a>
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
            @if($challan->count())
            <table class="table table-bordered table_challan" style="">
                <thead>
                    <tr>
                        <th>challan No</th>
                        <th>Name</th>
                        <th>challan Date</th>
                        <th>P.O. Date</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($challan as $challan)
                        <tr>
                            <?php
                            $id = $challan->id;
                            $string1 = 'CH/';
                            $string2 = str_pad($id, 6, "0", STR_PAD_LEFT);
                            $date = date('Y',strtotime($challan->created_at));
                            $challan_no = $string1.$string2.'/'.$date;
                            ?>
                            <td><a href="{{route('challan.show', $challan->id)}}" class="">{{$challan_no}}</a></td>
                            <td>{{$challan->name}}</td>
                            <td>{{$challan->date}}</td>
                            <td>{{$challan->podate}}</td>
                            <td>{{$challan->created_at->diffForHumans()}}</td>
                            <td class="">
                                <a href="{{route('createchallanpdf', $challan->id)}}" class="text-primary btn-sm">PDF<i class="fa fa-edit"></i></a>
                                <a href="{{route('challan.edit', $challan->id)}}" class="text-primary btn-sm">Edit<i class="fa fa-edit"></i></a>
                                <!-- <a class="text-danger" href="{{route('challan.destroy', $challan->id)}}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    Delete
                                </a> -->

                                <form id="logout-form" action="{{route('challan.destroy', $challan->id)}}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @else
                <div class="challan-empty">
                    <p class="challan-empty-title">
                        No challans were created.
                        <a href="{{route('challan.create')}}">Create Now!</a>
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
            url : "{{route('challan_search_btn')}}",
            data:{from_date:from_date,to_date:to_date},
            success:function(data){
                console.log(data);
                $('.table_challan tbody').html(data);
            }
         });
    })

    $('.keyword').on('keyup', function(){
        var value = $(this).val();
        $.ajax({
            type : "GET",
            url : "{{route('challan_keyword')}}",
            data:{search:value},
            success:function(data){
                console.log(data);
                $('.table_challan tbody').html(data);
            }
         });
    });
    $('.generate_report').on('click', function(){
        var from_date = $('.from_date').val();
        var to_date = $('.to_date').val();
        $.ajax({
            type : "GET",
            url : "{{route('challan_generate_report')}}",
            data:{from_date:from_date,to_date:to_date},
            success:function(data){
                console.log(data);
                // $('.table_challan tbody').html(data);
            }
         });
    })
})
</script>
@endsection
