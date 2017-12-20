@extends('dashboard.app')
@section('title','Create Car')
@section('description','')
@section('stylesheets')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-body">
            <form action="{{ route('dashboard.cars.index') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="col-md-6">
                <input type="hidden" name="owner_id" value="{{$id}}">
                    <div class="form-group">
                        <label for="model_id">Car Model</label>
                        {{ Form::select('model_id' , $models , old('model_id') , ['id' => 'model_id' , 'class' => 'form-control']) }}
                    </div>
                </div>

                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="#">Car Plate No.</label>

                        <input name="plate_number" class="form-control" value="{{old('plate_number')}}">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="#">Car Maintenance Date</label>

                        <input name="maintenance_date" class="form-control" value="{{old('maintenance_date')}}">
                        **EX: 4/1/2001 or 12/12/2001
                    </div>
                </div>

                 <div class="col-md-6">
                    <div class="form-group">
                        <label for="#">Car Mile Age</label>

                        <input name="mile_age" class="form-control" value="{{old('mile_age')}}">
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
