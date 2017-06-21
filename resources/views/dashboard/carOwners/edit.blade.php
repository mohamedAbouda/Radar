@extends('dashboard.app')
@section('title','Edit Car Owner')
@section('description','')
@section('stylesheets')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-body">
            <form action="{{ route('dashboard.carOwners.update', ['carOwner' => $carOwner->id]) }}" method="post" enctype="multipart/form-data">
                <input type="hidden" name="_method" value="PUT">
                  {{ csrf_field() }}
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="#">Car Owner Name</label>
                      
                        <input name="full_name" class="form-control" value="{{$carOwner->full_name}}">
                    </div>
                </div>

                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="#">Car Owner E-mail</label>
                      
                        <input name="email" class="form-control" value="{{$carOwner->email}}">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="#">Car Owner Phone Number</label>
                      
                        <input name="phone_number" class="form-control" value="{{$carOwner->phone_number}}">
                    </div>
                </div>

                 <div class="col-md-6">
                    <div class="form-group">
                        <label for="#">Car Owner Password</label>
                      
                        <input name="password" class="form-control" >
                    </div>
                </div>

               
            

                <div class="col-md-12">
                    <div class="form-group">
                        <button class="btn btn-primary">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

<script>
 $("#phamracy_id").select2({
  placeholder:'choose a phamracy',
});


</script>
@endsection