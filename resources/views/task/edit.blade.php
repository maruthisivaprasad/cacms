@extends('layouts.app')
@section('page_heading','Form')
@section('content')
<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">Update Task</div>
            <div class="panel-body">
                {!! Form::model($task, array('route' => ['task.update', $task->task_id], 'method'=>'PUT')) !!}
                <div class="form-group">
                    <div class="col-xs-2">
                        {!! Form::label('client_id', 'Client') !!}
                    </div>
                    <div class="col-xs-4">
                        <select name="client_id" id="client_id" class="form-control">
                            @foreach($clients as $client)
                                @if($client->ctype=='Business')
                                <option value="{{$client->client_id}}" <?php if($task->client_id==$client->client_id) {?>selected<?php }?>>{{$client->bname}}</option>
                                @else
                                <option value="{{$client->client_id}}" <?php if($task->client_id==$client->client_id) {?>selected<?php }?>>{{$client->cname}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-xs-2">
                        {!! Form::label('subject', 'Subject') !!}
                    </div>
                    <div class="col-xs-4">
                        {!! Form::text('subject',null,['class'=>'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-2">
                        {!! Form::label('description', 'Description') !!}
                    </div>
                    <div class="col-xs-4">
                        {!! Form::text('description',null,['class'=>'form-control']) !!}
                    </div>
                    <div class="col-xs-2">
                        {!! Form::label('priority', 'Priority') !!}
                    </div>
                    <div class="col-xs-4">
                        <select name="priority" id="priority" class="form-control">
                            <option value="High">High</option>
                            <option value="Medium">Medium</option>
                            <option value="Low">Low</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-2">
                        {!! Form::label('duedate', 'Due Date') !!}
                    </div>
                    <div class="col-md-4">
                        {!! Form::text('duedate',null,['class'=>'form-control datepicker']) !!}
                    </div>
                    <div class="col-xs-2">
                        {!! Form::label('remarks', 'Remarks') !!}
                    </div>
                    <div class="col-xs-4">
                        {!! Form::text('remarks',null,['class'=>'form-control']) !!}
                    </div>
                </div>
                <input type="hidden" name="assigned_to" id="assigned_to" value="{{ Auth::user()->id }}">
                <div class="form-group">
                    <div class="col-md-12">
                     {!! Form::button('Save',['type'=>'submit', 'class'=>'btn btn-primary']) !!}  
                    </div> 
                </div>
                {!! Form::close() !!}
            </div>
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
      $( ".datepicker" ).datepicker({
        dateFormat: "yy-mm-dd"
    });
});
</script>    
@endsection