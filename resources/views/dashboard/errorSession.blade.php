@if(Session::has('error'))
<div class="col-md-12">          
    <div class="alert alert-danger alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<strong></strong> {{ Session::get('error') }}
	</div>
</div>
@endif