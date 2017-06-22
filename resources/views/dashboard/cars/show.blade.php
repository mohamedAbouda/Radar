@extends('dashboard.app')
@section('title',"{$car->model}")
@section('description','Car Data')
@section('content')
<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-heading">
		</div>
		<div class="panel-body">
			<table class="table table-bordered">
				<thead>
					<th>Name</th>
					<th>Data</th>
				</thead>
				<tbody>
					<tr>
						<td>Model</td>
						<td>{{ $car->model }}</td>
					</tr>
					<tr>
						<td>Plate Number</td>
						<td>{{ $car->plate_number }}</td>
					</tr>

					<tr>
						<td>Maintenance Date</td>
						<td>{{ $car->maintenance_date }}</td>
					</tr>

					<tr>
						<td>Mile Age</td>
						<td>{{ $car->mile_age }}</td>
					</tr>

					<tr>
						<td>Registration Code</td>
						<td>{{ $car->registration_code }}</td>
					</tr>

					<tr>
						<td>Driver</td>
						<td>
						@if($car->driver)
						<a href="{{ route('dashboard.drivers.show', ['driver' => $car->driver->id]) }}">{{ $car->driver->full_name }}</a>
						@endif
						</td>
					</tr>

						<tr>
						<td>Owner</td>
						<td><a href="{{ route('dashboard.carOwners.show', ['owner' => $car->owner->id]) }}">{{ $car->owner->full_name }}</a></td>
					</tr>
				
					
				</tbody>
			</table>
		</div>
		<div class="panel-footer">
			<div class="text-center">
                
            </div>
		</div>
	</div>
</div>
@endsection