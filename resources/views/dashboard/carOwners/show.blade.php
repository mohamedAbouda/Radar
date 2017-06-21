@extends('dashboard.app')
@section('title',"{$carOwner->full_name}")
@section('description','Car Owner Data')
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
						<td>{{ $carOwner->full_name }}</td>
					</tr>
					<tr>
						<td>E-mail</td>
						<td>{{ $carOwner->email }}</td>
					</tr>

					<tr>
						<td>Phone No.</td>
						<td>{{ $carOwner->phone_number }}</td>
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