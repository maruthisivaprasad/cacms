@extends('layouts.app')
@section('page_heading','Form')
@section('content')
<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">Create Invoice</div>
            <div class="panel-body">
                {!! Form::open(array('route' => 'fee.store')) !!}
                <div class="form-group">
                    <div class="col-xs-2">
                        {!! Form::label('client_id', 'Client') !!}
                    </div>
                    <div class="col-xs-4">
                        <select name="client_id" id="client_id" class="form-control">
                            @foreach($clients as $client)
                                @if($client->ctype=='Business')
                                <option value="{{$client->client_id}}">{{$client->bname}}</option>
                                @else
                                <option value="{{$client->client_id}}">{{$client->cname}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-xs-2">
                        {!! Form::label('service_name', 'Service Name') !!}
                    </div>
                    <div class="col-xs-4">
                        {!! Form::text('service_name',null,['class'=>'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-2">
                        {!! Form::label('type', 'Type') !!}
                    </div>
                    <div class="col-xs-4">
                        {!! Form::text('type',null,['class'=>'form-control']) !!}
                    </div>
                    <div class="col-xs-2">
                        {!! Form::label('fees', 'Fees') !!}
                    </div>
                    <div class="col-xs-4">
                        {!! Form::text('fees',null,['class'=>'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-2">
                        {!! Form::label('amount_receive', 'Amount Receive') !!}
                    </div>
                    <div class="col-xs-4">
                        {!! Form::text('amount_receive','0.00',['class'=>'form-control', 'readonly' => 'true']) !!}
                    </div>
                    <div class="col-xs-2">
                        {!! Form::label('balance', 'Balance') !!}
                    </div>
                    <div class="col-xs-4">
                        {!! Form::text('balance',null,['class'=>'form-control', 'readonly' => 'true']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-2">
                        {!! Form::label('service_deliver', 'Service Delivered') !!}
                    </div>
                    <div class="col-xs-4">
                        {!! Form::select('service_deliver',array('yes' => 'Yes', 'no' => 'No'), null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                     {!! Form::button('Create',['type'=>'submit', 'class'=>'btn btn-primary']) !!}   
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
$( "#fees" ).blur(function() {
    fee = $( "#fees" ).val();
    $('#balance').val(fee);
});
</script>
@endsection