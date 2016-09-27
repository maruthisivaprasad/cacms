@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Update Contact</div>
                <div class="panel-body">
                    {!! Form::model($contact, array('route' => ['contact.update', $contact->contact_id], 'method'=>'PUT')) !!}
                    <div class="form-group">
                        <div class="col-xs-2">
                            {!! Form::label('first_name', 'First Name') !!}
                        </div>
                        <div class="col-xs-4">
                            {!! Form::text('first_name',null,['class'=>'form-control']) !!}
                        </div>
                        <div class="col-xs-2">
                            {!! Form::label('last_name', 'Last Name') !!}
                        </div>
                        <div class="col-xs-4">
                            {!! Form::text('last_name',null,['class'=>'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-2">
                            {!! Form::label('email', 'Email') !!}
                        </div>
                        <div class="col-xs-4">
                            {!! Form::text('email',null,['class'=>'form-control']) !!}
                        </div>
                        <div class="col-xs-2">
                            {!! Form::label('phone', 'Phone') !!}
                        </div>
                        <div class="col-xs-4">
                            {!! Form::text('phone',null,['class'=>'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                         {!! Form::button('Save',['type'=>'submit', 'class'=>'btn btn-primary']) !!}   
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
