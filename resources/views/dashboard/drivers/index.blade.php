@extends('dashboard.app')
@section('title','Driver')
@section('description','Driver Data')
@section('content')
<div class="col-md-12">
<div class="panel-heading">
			<a href="{{ route('dashboard.drivers.create') }}" class="resizeBtn btn btn-primary">Add Driver</a>
		</div>
	<div class="panel panel-default">
		
		<div class="panel-body">

			<table class="table table-bordered">
				<thead>
					<th>Name</th>
					<th>Options</th>
				</thead>
				<tbody>
				@foreach($drivers as $driver)
					<tr>
						<td>{{ strip_tags($driver->full_name) }}</td>
						<td>
						<a href="{{ route('dashboard.drivers.show', ['driver' => $driver->id]) }}" class="btn btn-info btn-xs"><i class="fa fa-eye"></i> Show</a>
	                        <a href="{{ route('dashboard.drivers.edit', ['driver' => $driver->id]) }}" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit</a>
	                        <form action="{{ route('dashboard.drivers.destroy', ['driver' => $driver->id]) }}" style="display: inline-block" method="post">
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
                {{ $drivers->links() }}
            </div>
		</div>
	</div>
</div>
@endsection