@extends('dashboard.app')
@section('title',"{$user->full_name}")
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
						<td>{{ $user->full_name }}</td>
					</tr>
					<tr>
						<td>E-mail</td>
						<td>{{ $user->email }}</td>
					</tr>

					<tr>
						<td>Phone No.</td>
						<td>{{ $user->phone_number }}</td>
					</tr>

					<tr>
						<td>Car</td>
						<td>{{ $user->car ? $user->car->model : 'The driver has no car' }}</td>
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
