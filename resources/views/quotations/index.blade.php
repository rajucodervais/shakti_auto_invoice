@extends('layouts.adminLayout')
@section('content')
<div class="container-fluid">

<div class="card card-default">
        <div class="card-header">
            <div class="clearfix">
                <span class="card-title">Quotations</span>
                <a href="{{route('quotation.create')}}" class="btn btn-success pull-right">Create</a>
            </div>
        </div>
        <div class="card-body">
            @if(session()->has('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if($quotations->count())
            <table class="table table-bordered" style="">
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
</div>
@endsection
