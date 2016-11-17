@extends('layouts.app')
@section('page_heading','Form')
@section('content')
<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">Update Contact</div>
            <div class="panel-body">
                {!! Form::model($director, array('route' => ['director.update', $director->director_id], 'method'=>'PUT')) !!}
                <div class="row">
                    <div class="col-xs-2">
                        {!! Form::label('client_id', 'Client') !!}
                    </div>
                    <div class="col-xs-4">
                        <select name="client_id" id="client_id" class="form-control">
                            @foreach($clients as $client)
                                @if($client->ctype=='Business')
                                <option value="{{$client->client_id}}" <?php if($director->client_id==$client->client_id) {?>selected<?php }?>>{{$client->bname}}</option>
                                @else
                                <option value="{{$client->client_id}}" <?php if($director->client_id==$client->client_id) {?>selected<?php }?>>{{$client->cname}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-xs-2">
                        {!! Form::label('name', 'Name') !!}
                    </div>
                    <div class="col-xs-4">
                        {!! Form::text('name',null,['class'=>'form-control']) !!}
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-2">
                        {!! Form::label('din', 'DIN') !!}
                    </div>
                    <div class="col-xs-4">
                        {!! Form::text('din',null,['class'=>'form-control']) !!}
                    </div>
                    <div class="col-xs-2">
                        {!! Form::label('phone', 'Phone') !!}
                    </div>
                    <div class="col-xs-4">
                        {!! Form::text('phone',null,['class'=>'form-control']) !!}
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-2">
                        {!! Form::label('email', 'Email') !!}
                    </div>
                    <div class="col-xs-4">
                        {!! Form::text('email',null,['class'=>'form-control']) !!}
                    </div>
                    <div class="col-xs-2">
                        {!! Form::label('digital_sig', 'Digital Signature') !!}
                    </div>
                    <div class="col-xs-4">
                        {!! Form::select('digital_sig',array('yes' => 'Yes', 'no' => 'No'), null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-2">
                        {!! Form::label('designation', 'Designation') !!}
                    </div>
                    <div class="col-xs-4">
                        {!! Form::text('designation',null,['class'=>'form-control']) !!}
                    </div>
                    <div class="col-xs-2">
                        {!! Form::label('pcontact', 'Is Primary Contact?') !!}
                    </div>
                    <div class="col-xs-4">
                        {!! Form::radio('pcontact', '1') !!}Yes
                        {!! Form::radio('pcontact', '0') !!}No
                    </div>
                </div>
                <div id="digitasignal" class="row" style="display:none">
                    <div class="col-md-2">
                        {!! Form::label('expiry_date', 'Expiry Date') !!}
                    </div>
                    <div class="col-md-4">
                        {!! Form::text('expiry_date',null,['class'=>'form-control datepicker']) !!}
                    </div>
                </div>
                <div class="row">
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
      var ctype = $("#digital_sig").val();
        if(ctype=='yes')
            $("#digitasignal").show();
        else
            $("#digitasignal").hide();
    });
    $("#digital_sig").on("change", function() {
        var ctype = $("#digital_sig").val();
        if(ctype=='yes')
            $("#digitasignal").show();
        else
            $("#digitasignal").hide();
    });
</script>    
@endsection