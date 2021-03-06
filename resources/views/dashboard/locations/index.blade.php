@extends('dashboard.app')
@section('content')
<div class="col-md-12">
	<div class="panel-heading">
	</div>
	<div class="panel panel-default">
		<div class="panel-body">
			<div class="table-responsive">
				<table class="table">
					<thead>
						<th>#</th>
						<th>LATITUDE-LONGITUDE</th>
						<th>BEARING</th>
						<th>SPEED</th>
						<th>TYPE</th>
						<th style="padding: 0px;">
							<div style="margin:10px;" class="pull-left">OPTIONS</div>
							<!-- <a href="{{ route('dashboard.locations.create') }}" class="btn btn-primary pull-right" target="_blank" style="margin-top: 3px;">
								Add new
							</a> -->
						</th>
					</thead>
					<tbody>
						@foreach($resources as $resource)
						<tr>
							<td>
                                {{ $counter_offset + $loop->iteration }}
                            </td>
							<td>
								<a href="{{ route('dashboard.location.simpleMap', [$resource->latitude,$resource->longitude]) }}" target="_blank">
									{{ $resource->latitude.'-'.$resource->longitude }}
								</a>
							</td>
							<td>
								{{ $resource->bearing }}
							</td>
							<td>
								{{ $resource->speed }}
							</td>
							<td>
								{{ $resource->type }}
							</td>
							<td>
								<!-- <a href="{{ route('dashboard.locations.show', $resource->id) }}" class="btn btn-info pull-left" style="margin-right:5px;"><i class="fa fa-eye"></i></a> -->
								<a href="{{ route('dashboard.locations.edit', $resource->id) }}" class="btn btn-primary pull-left" style="margin-right:5px;"><i class="fa fa-edit"></i></a>
								{{ Form::open(['route' => ['dashboard.locations.destroy', $resource->id] , 'method' => 'DELETE']) }}
									<button class="btn btn-danger pull-left" type="submit"><i class="fa fa-trash"></i></button>
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
@endsection
