@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Update Contact</div>
                <div class="panel-body">
                    {!! Form::model($contact, array('route' => ['contact.update', $contact->contact_id], 'method'=>'PUT')) !!}
                    <div class="row">
                        <div class="col-xs-2">
                            {!! Form::label('client_id', 'Client') !!}
                        </div>
                        <div class="col-xs-4">
                            {!! Form::select('client_id',$clients, null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="col-xs-2">
                            {!! Form::label('service_name', 'Service Name') !!}
                        </div>
                        <div class="col-xs-4">
                            {!! Form::text('service_name',null,['class'=>'form-control']) !!}
                        </div>
                    </div>
                    <div class="row">
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
                    <div class="row">
                        <div class="col-xs-2">
                            {!! Form::label('amount_receive', 'Amount Receive') !!}
                        </div>
                        <div class="col-xs-4">
                            {!! Form::text('amount_receive',null,['class'=>'form-control']) !!}
                        </div>
                        <div class="col-xs-2">
                            {!! Form::label('balance', 'Balance') !!}
                        </div>
                        <div class="col-xs-4">
                            {!! Form::text('balance',null,['class'=>'form-control']) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-2">
                            {!! Form::label('service_deliver', 'Service Delivered') !!}
                        </div>
                        <div class="col-xs-4">
                            {!! Form::select('service_deliver',array('yes' => 'Yes', 'no' => 'No'), null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                         {!! Form::button('Create',['type'=>'submit', 'class'=>'btn btn-primary']) !!}   
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
</div>
@endsection