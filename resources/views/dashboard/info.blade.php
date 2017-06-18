@if(Session::has('info'))
<div class="col-md-12">          
    <div class="alert alert-info alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<strong>Heads up!</strong> {{ Session::get('info') }}
	</div>
</div>
@endif