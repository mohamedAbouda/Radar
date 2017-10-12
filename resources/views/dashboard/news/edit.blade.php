@extends('dashboard.app')
@section('title','News editing')
@section('description','')
@section('content')
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="col-md-12">
                {{ Form::open(['route' => ['dashboard.news.update',$resource->id] , 'files' => true , 'method' => 'PATCH']) }}
                <div class="form-group">
                    <label for="title">
                        <strong>
                            TITLE
                        </strong>
                    </label>
                    <input type="text" name="title" id="title" value="{{ $resource->title }}" class="form-control">
                    <p class="text-danger">{{ $errors->first('title') }}</p>
                </div>
                <div class="form-group">
                    <label for="cover_picture">
                        <strong>
                            COVER PICTURE
                        </strong>
                    </label>
                    <img style="max-height: 200px;max-width: 200px;margin-bottom:0px !important;" class="thumbnail" src="{{ $resource->cover_picture_url }}" alt="No image uploaded">
                    <label for="cover_picture" class="btn btn-default">
                        Upload cover picture
                        <input type="file" name="cover_picture" id="cover_picture" style="display:none;" accept="image/*">
                    </label>
                    <span class="text-primary"></span>
                    <p class="text-danger">{{ $errors->first('cover_picture') }}</p>
                </div>
                <div class="form-group">
                    <label for="description">
                        <strong>
                            DESCRIPTION
                        </strong>
                    </label>
                    {{ Form::textarea('description',$resource->description,['id' => 'description','class' => 'form-control']) }}
                    <p class="text-danger">{{ $errors->first('description') }}</p>
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
{{ Html::script('js/lib/ckeditor/ckeditor.js') }}
<script type="text/javascript">
    $(document).ready(function(){
        $('input[type=file]').change(function(){
            var parent = $(this).parents('div.form-group');
            parent.find('span').text($(this).val());

            var preview = parent.find('img');
            var file    = $(this)[0].files[0];
            var reader  = new FileReader();

            reader.addEventListener("load", function () {
                preview.attr('src',reader.result);
            }, false);

            if (file) {
                reader.readAsDataURL(file);
            }
        });

        CKEDITOR.replace('description');
    });
</script>
@stop
