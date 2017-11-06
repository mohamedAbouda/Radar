@extends('dashboard.app')
@section('title','Car models')
@section('content')
<div class="col-md-12">
	<div class="panel panel-default">

		<div class="panel-body">

			<table class="table table-bordered">
				<thead>
					<th>Picture</th>
					<th>Name</th>
					<th>Options</th>
				</thead>
				<tbody>
					@foreach($resources as $resource)
					<tr>
						<td>
							<img src="{{ $resource->pic_url }}" alt="Not found" class="thumbnail" style="width:215px;height:215px;">
						</td>
						<td>
							{{ $resource->name }}
						</td>

						<td>
							<a href="{{ route('dashboard.carmodels.edit', $resource->id) }}" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit</a>
							<form action="{{ route('dashboard.carmodels.destroy', $resource->id) }}" style="display: inline-block" method="post">
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
				{{ $resources->links() }}
			</div>
		</div>
	</div>
</div>
@endsection
