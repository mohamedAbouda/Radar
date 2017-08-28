@extends('dashboard.app')
@section('title','Tow trucks')
@section('content')
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table" id="resources-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>PICTURE</th>
                            <th>NAME</th>
                            <th>PHONE</th>
                            <th colspan="">OPTIONS</th>
                            <th style="padding-bottom: 0px;">
                                <a href="{{ route('dashboard.towtrucks.create') }}" class="btn btn-primary pull-right" target="_blank">
                                    Add new
                                </a>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($resources as $resource)
                        <tr>
                            <td>
                                {{ $counter_offset + $loop->iteration }}
                            </td>
                            <td>
                                <img style="height: 160px;width: 200px;margin-bottom:0px !important;" class="thumbnail" id="logo-preview" src="{{ $resource->pic_url }}" alt="No image uploaded">
                            </td>
                            <td>
                                {{ $resource->name }}
                            </td>
                            <td>
                                {{ $resource->phone }}
                            </td>
                            <td>
                                <a href="{{ route('dashboard.towtrucks.edit' , $resource->id) }}" class="btn btn-warning">
                                    <i class="fa fa-pencil"></i>
                                </a>
                            </td>
                            <td>
                                {{ Form::open(['route' => ['dashboard.towtrucks.destroy' , $resource->id] , 'method' => 'DELETE']) }}
                                <button href="#" class="btn btn-danger">
                                    <i class="fa fa-trash"></i>
                                </button>
                                {{ Form::close() }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="panel-footer">
            <div class="text-center">
                {{ $resources->links() }}
            </div>
        </div>
    </div>
</div>
@stop
