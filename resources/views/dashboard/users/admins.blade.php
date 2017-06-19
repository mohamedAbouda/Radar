@extends('dashboard.app')
@section('title','User')
@section('description','User Data')
@section('content')
   @if(Auth::user()->hasRole('admin'))

<div class="col-md-12">
<div class="panel-heading">
		<a href="{{ route('dashboard.admin.create.admin') }}" class="resizeBtn btn btn-primary">Add Admin</a>
		
		</div>
	<div class="panel panel-default">
		


		<div class="panel-body">
	
			<table class="table table-bordered">
				<thead>
					<th>Name</th>
					<th>Options</th>
				</thead>
				<tbody>
				@foreach($users as $user)
					<tr>
						<td>{{ $user->full_name }}</td>
						<td>
	                       <!--  <a href="{{ route('dashboard.users.show', ['user' => $user->id]) }}" class="btn btn-info btn-xs"><i class="fa fa-eye"></i> Show</a> -->
	                        <a href="{{ route('dashboard.users.edit', ['user' => $user->id]) }}" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit</a>
	                      	@if(Auth::user()->id != $user->id)

	                        @if($user->activated == '1')
	                        <form action="{{ route('dashboard.admin.deactivate.user') }}" style="display: inline-block" method="post">
	                            {{ csrf_field() }}
	                            <input type="hidden" name="id" value="{{$user->id}}">
	                            <button class="btn btn-danger btn-xs">Deactivate</button>
	                        </form>
	                        @else
	                        <form action="{{ route('dashboard.admin.activate.user') }}" style="display: inline-block" method="post">
	                            {{ csrf_field() }}
	                            <input type="hidden" name="id" value="{{$user->id}}">
	                            <button class="btn btn-primary btn-xs">activate</button>
	                        </form>
	                        @endif
	                 
	                        @if($user->hasRole('admin'))
	                         <form action="{{ route('dashboard.admin.remove.admin') }}" style="display: inline-block" method="post">
	                            {{ csrf_field() }}
	                            <input type="hidden" name="id" value="{{$user->id}}">
	                            <button class="btn btn-danger btn-xs">Remove admin</button>
	                        </form>
	                        @else
	                        <form action="{{ route('dashboard.admin.make.admin') }}" style="display: inline-block" method="post">
	                            {{ csrf_field() }}
	                            <input type="hidden" name="id" value="{{$user->id}}">
	                            <button class="btn btn-warning btn-xs">Make Admin</button>
	                        </form>
	                        @endif
	                       
	                        @endif
	                       
						</td>
					</tr>
				@endforeach
				</tbody>
			</table>
							<div id="ajaxerror"></div>

		</div>
		<div class="panel-footer">
			<div class="text-center">
                {{ $users->links() }}
            </div>
		</div>
	</div>
</div>
@endif
@endsection
@section('scripts')

<script type="text/javascript">
	 
</script>
@endsection