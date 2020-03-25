@extends('layouts.adminLayout')
@section('content')
<div class="container-fluid">

<div class="card card-default">
        <div class="card-header">
            <div class="clearfix">
                <span class="card-title">Tax challans</span>
                <a href="{{route('challan.create')}}" class="btn btn-success pull-right">Create</a>
            </div>
        </div>
        <div class="card-body">
            @if(session()->has('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if($challan->count())
            <table class="table table-bordered" style="">
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
</div>
@endsection
