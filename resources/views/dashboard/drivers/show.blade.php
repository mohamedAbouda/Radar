@extends('dashboard.app')
@section('title',"{$driver->full_name}")
@section('description','Driver Data')
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
						<td>Name</td>
						<td>{{ $driver->full_name }}</td>
					</tr>
					<tr>
						<td>E-mail</td>
						<td>{{ $driver->email }}</td>
					</tr>

					<tr>
						<td>Phone No.</td>
						<td>{{ $driver->phone_number }}</td>
					</tr>

					<tr>
						<td>Car</td>
						<td><a href="{{ route('dashboard.cars.show', ['car' => $driver->car->id]) }}" >{{ $driver->car->model }}</a></td>
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