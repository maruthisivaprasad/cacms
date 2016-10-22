@extends('layouts.app')
@section('page_heading','Form')
@section('content')
<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">Update Payment</div>
            <div class="panel-body">
                {!! Form::model($payment, array('route' => ['payment.update', $payment->payment_id], 'method'=>'PUT')) !!}
                <div class="form-group">
                    <div class="col-xs-2">
                        {!! Form::label('fee_id', 'Fee ID') !!}
                    </div>
                    <div class="col-xs-4">
                        <select name="fee_id" id="fee_id" class="form-control">
                            @foreach($payinfo as $paydata)
                                @if($paydata->ctype=='Business')
                                <option value="{{$paydata->fee_id}}" <?php if($payment->fee_id==$paydata->fee_id) {?>selected<?php }?>>{{$paydata->bname."".$paydata->fee_id}}</option>
                                @else
                                <option value="{{$paydata->fee_id}}" <?php if($payment->fee_id==$paydata->fee_id) {?>selected<?php }?>>{{$paydata->cname."".$paydata->fee_id}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-xs-2">
                        {!! Form::label('paymentdate', 'Date') !!}
                    </div>
                    <div class="col-xs-4">
                        {!! Form::text('paymentdate',null,['class'=>'form-control datepicker']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-2">
                        {!! Form::label('service_name', 'Service Name') !!}
                    </div>
                    <div class="col-xs-4">
                        {!! Form::text('service_name',null,['class'=>'form-control']) !!}
                    </div>
                    <div class="col-xs-2">
                        {!! Form::label('payment_amount', 'Amount Payable') !!}
                    </div>
                    <div class="col-xs-4">
                        {!! Form::text('payment_amount',null,['class'=>'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-2">
                        {!! Form::label('paid_amount', 'Amount Paid') !!}
                    </div>
                    <div class="col-xs-4">
                        {!! Form::text('paid_amount',null,['class'=>'form-control']) !!}
                    </div>
                    <div class="col-xs-2">
                        {!! Form::label('payment_mode', 'Payment Mode') !!}
                    </div>
                    <div class="col-xs-4">
                        <select name="payment_mode" id="payment_mode" class="form-control">
                            <option value="Cash" <?php if($payment->payment_mode=='Cash') {?>selected<?php }?>>Cash</option>
                            <option value="Cheque" <?php if($payment->payment_mode=='Cheque') {?>selected<?php }?>>Cheque</option>
                            <option value="DD" <?php if($payment->payment_mode=='DD') {?>selected<?php }?>>DD</option>
                        </select>
                    </div>
                </div>
                <div id="paymentdisplay" class="form-group" style="display: none">
                    <div class="col-xs-2">
                        {!! Form::label('check_no', 'Enter No.') !!}
                    </div>
                    <div class="col-xs-4">
                        {!! Form::text('check_no',null,['class'=>'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-2">
                        {!! Form::label('remarks', 'Remarks') !!}
                    </div>
                    <div class="col-xs-4">
                        {!! Form::textArea('remarks',null,['class'=>'form-control']) !!}
                    </div>
                </div>
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
    payment = $("#payment_mode").val();
    if(payment!='Cash')
    {
        $("#paymentdisplay").show();
    }
    else
    {
        $("#paymentdisplay").hide();
    }
});    
$( "#payment_mode" ).change(function() {
    payment = $("#payment_mode").val();
    if(payment!='Cash')
    {
        $("#paymentdisplay").show();
    }
    else
    {
        $("#paymentdisplay").hide();
    }
});
</script>    
@endsection