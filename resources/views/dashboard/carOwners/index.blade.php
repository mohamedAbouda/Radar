@extends('dashboard.app')
@section('title','car owner')
@section('description','Car owner Data')
@section('content')
<div class="col-md-12">
<div class="panel-heading">
			<a href="{{ route('dashboard.carOwners.create') }}" class="resizeBtn btn btn-primary">Add Car Owner</a>
		</div>
	<div class="panel panel-default">
		
		<div class="panel-body">

			<table class="table table-bordered">
				<thead>
					<th>Name</th>
					<th>Options</th>
				</thead>
				<tbody>
				@foreach($carOwners as $carOwner)
					<tr>
						<td>{{ strip_tags($carOwner->full_name) }}</td>
						<td>
	                        <a href="{{ route('dashboard.carOwners.edit', ['carOwner' => $carOwner->id]) }}" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit</a>
	                        <form action="{{ route('dashboard.carOwners.destroy', ['carOwner' => $carOwner->id]) }}" style="display: inline-block" method="post">
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
                {{ $carOwners->links() }}
            </div>
		</div>
	</div>
</div>
@endsection