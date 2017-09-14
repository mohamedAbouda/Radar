@extends('dashboard.app')
@section('title','News feeds')
@section('content')
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table" id="resources-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>TITLE</th>
                            <th>COVER PICTURE</th>
                            <th>OPTIONS</th>
                            <th style="padding-bottom: 0px;">
                                <a href="{{ route('dashboard.news.create') }}" class="btn btn-primary pull-right" target="_blank">
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
                                {{ $resource->title }}
                            </td>
                            <td>
                                @if($resource->cover_picture)
                                <a href="{{ $resource->cover_picture_url }}" target="_blank">
                                    view
                                </a>
                                @else
                                No image found
                                @endif
                            </td>

                            <td>
                                <a href="{{ route('dashboard.news.edit' , $resource->id) }}" class="btn btn-warning">
                                    <i class="fa fa-pencil"></i>
                                </a>
                            </td>
                            <td>
                                {{ Form::open(['route' => ['dashboard.news.destroy' , $resource->id] , 'method' => 'DELETE']) }}
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
