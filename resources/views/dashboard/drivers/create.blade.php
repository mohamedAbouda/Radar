@extends('dashboard.app')
@section('title','Create Driver')
@section('description','')
@section('stylesheets')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
@if(isset($error))

<div class="alert alert-danger fade in">
{{$error}}
</div>
@endif
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-body">
            <form action="{{ route('dashboard.drivers.index') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="#">Driver Name</label>
                     
                        <input name="full_name" class="form-control" value="{{isset($full_name)? $full_name:old('full_name')}}">
                    </div>
                </div>
                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="#">Driver E-mail</label>
                      
                        <input name="email" class="form-control" value="{{isset($email)? $email:old('email')}}">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="#">Driver Phone Number</label>
                      
                        <input name="phone_number" class="form-control" value="{{isset($phone_number)? $phone_number:old('phone_number')}}">
                    </div>
                </div>

                 <div class="col-md-6">
                    <div class="form-group">
                        <label for="#">Driver Password</label>
                      
                        <input name="password" class="form-control" value="{{isset($password)? $password :old('password')}}">
                    </div>
                </div>

                 <div class="col-md-12">
                    <div class="form-group">
                        <label for="#">Car Registeration Code</label>
                      
                        <input name="car_id" class="form-control" value="{{old('car_id')}}">
                    </div>
                </div>
            

                <div class="col-md-12">
                    <div class="form-group">
                        <button class="btn btn-primary">Save</button>
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