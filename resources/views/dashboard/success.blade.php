@if(Session::has('success'))
<div class="col-md-12">          
    <div class="alert alert-success alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<strong></strong> {{ Session::get('success') }}
	</div>
</div>
@endif