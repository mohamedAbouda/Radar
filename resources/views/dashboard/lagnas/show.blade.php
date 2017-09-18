@extends('dashboard.app')
@section('title',"Radar details")
@section('content')
<div class="col-md-12">
	<div class="panel panel-default">
		<!-- <div class="panel-heading">
		</div> -->
		<div class="panel-body">
			<div class="">
				<iframe width="100%" height="500px" frameborder="0" style="border:0" src="http://maps.google.com/maps?q={{ $resource->location->latitude.','.$resource->location->longitude }}&z=16&output=embed">
		        </iframe>
			</div>
			<table class="table table-bordered">
				<thead>
					<th>#</th>
					<th>REPORTS</th>
					<th>FINE</th>
					<th>CAUSE</th>
					<th>OPTIONS</th>
				</thead>
				<tbody>
					@foreach($reports as $report)
					<tr>
						<td>
							{{ $counter_offset + $loop->iteration }}
						</td>
						<td>
							@if(!$report->note)
							<p class="text-danger">EMPTY</p>
							@else
							{{ $report->note }}
							@endif
						</td>
						<td>
							{{ $report->fine }}
						</td>
						<td>
							@if(!$report->fine_cause)
							<p class="text-danger">EMPTY</p>
							@else
							{{ $report->fine_cause }}
							@endif
						</td>
						<td>
							<a href="{{ route('dashboard.lagnas.reports.edit', $report->id) }}" class="btn btn-primary pull-left" style="margin-right:5px;"><i class="fa fa-edit"></i></a>
							{{ Form::open(['route' => ['dashboard.lagnas.reports.destroy', $report->id] , 'method' => 'DELETE']) }}
								<button class="btn btn-danger pull-left" type="submit"><i class="fa fa-trash"></i></button>
							{{ Form::close() }}
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		<div class="panel-footer">
			<div class="text-center">
				{{ $reports->links() }}
            </div>
		</div>
	</div>
</div>
@endsection
