@extends('dashboard.app')
@section('title','Edit a lagna\'s report')
@section('description','')
@section('content')
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="col-md-12">
                {{ Form::open(['route' => ['dashboard.lagnas.reports.update',$resource->id],'method'=>'PATCH']) }}
                <div class="form-group">
                    <label for="note">
                        NOTE
                    </label>
                    {{ Form::textarea('note',$resource->note,['id' => 'note' , 'class' => 'form-control' , 'rows' => 15 , 'width' => '100%']) }}
                </div>
                <div class="form-group">
                    <label for="fine">
                        FINE
                    </label>
                    {{ Form::number('fine',$resource->fine?$resource->fine:0,['id' => 'fine' , 'class' => 'form-control' , 'min' => 0]) }}
                </div>
                <div class="form-group">
                    <label for="fine_cause">
                        FINE-CAUSE
                    </label>
                    {{ Form::textarea('fine_cause',$resource->fine_cause,['id' => 'fine_cause' , 'class' => 'form-control' , 'rows' => 15 , 'width' => '100%']) }}
                </div>
                <div class="form-group">
                    <button class="btn btn-primary">Save</button>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@stop
