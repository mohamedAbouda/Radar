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
				</thead>
				<tbody>
					@foreach($reports as $report)
					<tr>
						<td>
							{{ $counter_offset + $loop->iteration }}
						</td>
						<td>
							<p>
								{{ $report->note }}
							</p>
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
