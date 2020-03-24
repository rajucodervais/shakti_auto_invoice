@extends('layouts.adminLayout')
@section('content')
<div class="container-fluid">

<div class="card card-default">
        <div class="card-header">
            <div class="clearfix">
                <span class="card-title">Tax Invoices</span>
                <a href="{{route('invoice.create')}}" class="btn btn-success pull-right">Create</a>
            </div>
        </div>
        <div class="card-body">
            @if(session()->has('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if($invoices->count())
            <table class="table table-bordered" style="">
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
                                <a href="{{route('invoice.edit', $invoice->id)}}" class="text-primary btn-sm">print<i class="fa fa-edit"></i></a>
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
</div>
@endsection
