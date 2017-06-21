@extends('dashboard.app')
@section('title','Create Car Owner')
@section('description','')
@section('stylesheets')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-body">
            <form action="{{ route('dashboard.carOwners.index') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="#">Car Owner Name</label>
                      
                        <input name="full_name" class="form-control" value="{{old('full_name')}}">
                    </div>
                </div>

                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="#">Car Owner E-mail</label>
                      
                        <input name="email" class="form-control" value="{{old('email')}}">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="#">Car Owner Phone Number</label>
                      
                        <input name="phone_number" class="form-control" value="{{old('phone_number')}}">
                    </div>
                </div>

                 <div class="col-md-6">
                    <div class="form-group">
                        <label for="#">Car Owner Password</label>
                      
                        <input name="password" class="form-control" value="{{old('password')}}">
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



</script>
@endsection