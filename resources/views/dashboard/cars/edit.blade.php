@extends('dashboard.app')
@section('title','Edit Driver')
@section('description','')
@section('stylesheets')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-body">
            <form action="{{ route('dashboard.cars.update', ['car' => $car->id]) }}" method="post" enctype="multipart/form-data">
                <input type="hidden" name="_method" value="PUT">
                  {{ csrf_field() }}
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="model_id">Car Model</label>
                        {{ Form::select('model_id' , $models , $car->model_id , ['id' => 'model_id' , 'class' => 'form-control']) }}
                    </div>
                </div>

                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="#">Car Plate No.</label>

                        <input name="plate_number" class="form-control" value="{{$car->plate_number}}">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="#">Car Maintenance Date</label>

                        <input name="maintenance_date" class="form-control" value="{{$car->maintenance_date}}">
                        **EX: 2002/2/23
                    </div>
                </div>

                 <div class="col-md-6">
                    <div class="form-group">
                        <label for="#">Car Mile Age</label>

                        <input name="mile_age" class="form-control" value="{{$car->mile_age}}">
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
