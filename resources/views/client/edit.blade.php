@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Update Client</div>
                <div class="panel-body">
                    {!! Form::model($client, array('route' => ['client.update', $client->client_id], 'method'=>'PUT', 'files'=>true)) !!}
                    <div class="row">
                        <div class="col-md-2">
                            {!! Form::label('assigned_user', 'Assigned User') !!}
                        </div>
                        <div class="col-md-4">
                            {!! Form::select('assigned_user',$users, null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            {!! Form::label('client_type', 'Client Type') !!}
                        </div>
                        <div class="col-md-4">
                            {!! Form::select('client_type',array('Salaried' => 'Salaried', 'Business' => 'Business', 'Others' => 'Others'), null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="col-md-2">
                            {!! Form::label('client_status', 'Client Status') !!}
                        </div>
                        <div class="col-md-4">
                            {!! Form::select('client_status',array('Lead' => 'Lead', 'Prospect' => 'Prospect', 'Client' => 'Client'), null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div id="personal">
                        <div class="row">
                            <div class="col-md-2">
                                {!! Form::label('name', 'Name') !!}
                            </div>
                            <div class="col-md-4">
                                {!! Form::text('name',null,['class'=>'form-control']) !!}
                            </div>
                            <div class="col-md-2">
                                {!! Form::label('fname', 'Father Name') !!}
                            </div>
                            <div class="col-md-4">
                                {!! Form::text('fname',null,['class'=>'form-control']) !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                {!! Form::label('dob', 'Date Of Birth') !!}
                            </div>
                            <div class="col-md-4">
                                {!! Form::text('dob',null,['class'=>'form-control datepicker']) !!}
                            </div>
                            <div class="col-md-2">
                                {!! Form::label('address', 'Address') !!}
                            </div>
                            <div class="col-md-4">
                                {!! Form::text('address',null,['class'=>'form-control']) !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                {!! Form::label('mobile', 'Mobile') !!}
                            </div>
                            <div class="col-md-4">
                                {!! Form::text('mobile',null,['class'=>'form-control']) !!}
                            </div>
                            <div class="col-md-2">
                                {!! Form::label('email', 'Email') !!}
                            </div>
                            <div class="col-md-4">
                                {!! Form::text('email',null,['class'=>'form-control']) !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                {!! Form::label('pan', 'PAN') !!}
                            </div>
                            <div class="col-md-4">
                                {!! Form::text('pan',null,['class'=>'form-control']) !!}
                            </div>
                            <div class="col-md-2">
                                {!! Form::label('uidai', 'UIDAI') !!}
                            </div>
                            <div class="col-md-4">
                                {!! Form::text('uidai',null,['class'=>'form-control']) !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                {!! Form::label('photo', 'PHOTO') !!}
                            </div>
                            <div class="col-md-4">
                                {!! Form::file('photo') !!}
                                <div id="defaultimage">
                                    @if($client->photo!='' || $client->photo!='NULL')
		                    <img height="45" width="145" class="image saved-sign" alt="no sign"
		                    src="{{ URL::to('images/clientimage/'.$client->photo) }}" />
		                    @endif
		                </div>
                            </div>
                        </div>
                    </div>  
                    <div id="business">
                        <div class="row">
                            <div class="col-md-2">
                                {!! Form::label('office_address', 'Office Address') !!}
                            </div>
                            <div class="col-md-4">
                                {!! Form::text('office_address',null,['class'=>'form-control']) !!}
                            </div>
                            <div class="col-md-2">
                                {!! Form::label('office_landline', 'Office Landline') !!}
                            </div>
                            <div class="col-md-4">
                                {!! Form::text('office_landline',null,['class'=>'form-control']) !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                {!! Form::label('website', 'Website') !!}
                            </div>
                            <div class="col-md-4">
                                {!! Form::text('website',null,['class'=>'form-control']) !!}
                            </div>
                            <div class="col-md-2">
                                {!! Form::label('business_nature', 'Nature of Business') !!}
                            </div>
                            <div class="col-md-4">
                                {!! Form::text('business_nature',null,['class'=>'form-control']) !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                {!! Form::label('company_type', 'Company Name') !!}
                            </div>
                            <div class="col-md-4">
                                {!! Form::text('company_type',null,['class'=>'form-control']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
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
<script>
    $(document).ready(function() {
      $( ".datepicker" ).datepicker({
        dateFormat: "yy-mm-dd"
    });
      var ctype = $("#client_type").val();
        if(ctype=='Business')
        {
            $("#personal").hide();
            $("#business").show();
        }
        else
        {
            $("#business").hide();
            $("#personal").show();
        }
    });
    $("#client_type").on("change", function() {
        var ctype = $("#client_type").val();
        if(ctype=='Business')
        {
            $("#personal").hide();
            $("#business").show();
        }
        else
        {
            $("#business").hide();
            $("#personal").show();
        }
    });
</script> 
@endsection