@extends('dashboard.app')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">
                    Edit car model
                </h3>
            </div>
            {{ Form::open(['route' => ['dashboard.carmodels.update' , $resource->id] , 'method' => 'PATCH' , 'files' => true]) }}
            <div class="row">
                <div class="col-md-12">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="col-md-12">
                            <label for="pic">
                                Car model picture
                            </label>
                            <div class="clearfix"></div>
                            <label for="pic">
                                <img src="{{ $resource->pic ? $resource->pic_url : asset('/img/gall-img-1.jpg') }}" alt="" class="thumbnail" style="width:215px;height:215px;cursor: pointer; cursor: hand;">
                                <input type="file" name="pic" id="pic" style="display:none;" onchange="preview(this);">
                            </label>
                        </div>
                        <div class="col-md-12">
                            <label for="name">
                                Car model name
                            </label>
                            <div class="clearfix"></div>
                            {{ Form::text('name',$resource->name,['id'=>'name','class'=>'form-control']) }}
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="row" style="margin-top:30px;">
                <div class="col-md-12">
                    <div class="box-footer clearfix">
                        <button type="submit" class="btn btn-primary">
                            Save
                        </button>
                        <a href="{{ route('dashboard.carmodels.index') }}" class="btn btn-default">
                            Cancel
                        </a>
                    </div>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
function preview(input)
{
    var parent = $(input).parent();
    var preview = parent.find('img');
    var file    = input.files[0];
    var reader  = new FileReader();

    reader.addEventListener("load", function () {
        preview.attr('src',reader.result);
    }, false);

    if (file) {
        reader.readAsDataURL(file);
    }
}
</script>
@stop
