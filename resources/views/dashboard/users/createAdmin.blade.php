@extends('dashboard.app')
@section('title','Create User')
@section('description','')
@section('content')
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-body">
            <form action="{{ route('dashboard.admin.store.admin') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="#">Full Name</label>
                        <input type="text" name="full_name" value="{{ old('full_name') }}" class="form-control">
                    </div>
                </div>
              
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="#">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="#">Password</label>
                        <input type="text" name="password" value="{{ old('password') }}" class="form-control">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="#">Phone number</label>
                        <input type="text" name="phone_number" value="{{ old('phone_number') }}" class="form-control">
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