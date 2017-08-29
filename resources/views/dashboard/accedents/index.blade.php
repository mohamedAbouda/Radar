@extends('dashboard.app')
@section('title','Accidents')
@section('content')
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table" id="resources-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>DRIVER</th>
                            <th>CAR</th>
                            <th>REPORTER</th>
                            <th>LOCATION</th>
                            <th>OPTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($resources as $resource)
                        <tr>
                            <td>
                                {{ $counter_offset + $loop->iteration }}
                            </td>

                            <td>
                                {{ $resource->driver ? $resource->driver->full_name : '[deleted]' }}
                            </td>
                            <td>
                                {{ $resource->car ? $resource->car->model.'-'.$resource->car->plate_number : '[deleted]' }}
                            </td>
                            <td>
                                {{ $resource->reporter ? $resource->reporter->full_name : '[deleted]' }}
                            </td>
                            <td>
                                <a href="{{ route('dashboard.location.simpleMap', [$resource->location->latitude,$resource->location->longitude]) }}" target="_blank">
                                    {{ $resource->location ? $resource->location->latitude.'-'.$resource->location->longitude : '[deleted]' }}
                                </a>
                            </td>

                            <td>
                                {{ Form::open(['route' => ['dashboard.accidents.destroy' , $resource->id] , 'method' => 'DELETE']) }}
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
