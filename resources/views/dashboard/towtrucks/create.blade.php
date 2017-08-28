@extends('dashboard.app')
@section('title','Create a tow truck')
@section('description','')
@section('content')
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="col-md-12">
                {{ Form::open(['route' => 'dashboard.towtrucks.store' , 'files' => true]) }}
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control">
                    <p class="text-danger">{{ $errors->first('name') }}</p>
                </div>
                <div class="form-group">
                    <label for="phone">Phone number</label>
                    <input type="text" name="phone" id="phone" value="{{ old('phone') }}" class="form-control">
                    <p class="text-danger">{{ $errors->first('phone') }}</p>
                </div>
                <div class="form-group">
                    <label for="pic">Picture</label>
                    <img style="max-height: 200px;max-width: 200px;margin-bottom:0px !important;" class="thumbnail" id="logo-preview" src="" alt="No image uploaded">
                    <label for="pic" class="btn btn-default">
                        Upload tow-truck picture
                        <input type="file" name="pic" id="pic" style="display:none;" onchange="preview(this);" accept="image/*">
                    </label>
                    <span id="logo-text" class="text-primary"></span>
                    <p class="text-danger">{{ $errors->first('pic') }}</p>
                </div>
                <button class="btn btn-primary" type="submit">Save</button>
                <button class="btn btn-default" type="reset">Reset</button>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@stop

@section('scripts')
<script type="text/javascript">
    function preview(fileInput)
    {
        document.getElementById('logo-text').innerHTML = document.getElementById('pic').value;

        var preview = document.getElementById('logo-preview');
        var file    = fileInput.files[0];
        var reader  = new FileReader();

        reader.addEventListener("load", function () {
            preview.src = reader.result;
        }, false);

        if (file) {
            reader.readAsDataURL(file);
        }
    }
</script>
@stop
