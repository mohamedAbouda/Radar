@extends('dashboard.app')
@section('title','Cars')
@section('description','Car Data')
@section('content')
<div class="col-md-12">
<div class="panel-heading">

		</div>
	<div class="panel panel-default">

		<div class="panel-body">

			<table class="table table-bordered">
				<thead>
					<th>Model</th>
					<th>Plate No.</th>
					<th>Registration Code</th>
					<th>Options</th>
				</thead>
				<tbody>
				@foreach($cars as $car)
					<tr>
						<td>{{ $car->model ? strip_tags($car->model->name) : '' }}</td>
						<td>{{ strip_tags($car->plate_number) }}</td>
						<td>{{ strip_tags($car->registration_code) }}</td>


						<td>
						<a href="{{ route('dashboard.cars.show', ['car' => $car->id]) }}" class="btn btn-info btn-xs"><i class="fa fa-eye"></i> Show</a>
	                        <a href="{{ route('dashboard.cars.edit', ['car' => $car->id]) }}" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit</a>
	                        <form action="{{ route('dashboard.cars.destroy', ['car' => $car->id]) }}" style="display: inline-block" method="post">
	                            {{ csrf_field() }}
	                            <input type="hidden" name="_method" value="DELETE">
	                            <button class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> DELETE</button>
	                        </form>
						</td>
					</tr>
				@endforeach
				</tbody>
			</table>
		</div>
		<div class="panel-footer">
			<div class="text-center">
                {{ $cars->links() }}
            </div>
		</div>
	</div>
</div>
@endsection
