@extends('dashboard.app')
@section('title','Edit Cook')
@section('description','')
@section('content')
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-body">
            <form action="{{ route('dashboard.users.update', ['user' => $user->id]) }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="PUT">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="#">Full Name</label>
                        <input type="text" name="full_name" value="{{ $user->full_name }}" class="form-control">
                    </div>
                </div>
              
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="#">Email</label>
                        <input type="email" name="email" value="{{ $user->email }}" class="form-control">
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
                        <input type="text" name="phone_number" value="{{ $user->phone_number }}" class="form-control">
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