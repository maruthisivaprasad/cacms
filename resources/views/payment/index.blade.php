@extends('layouts.app')
@section('page_heading','Tables')
@section('content')
<div class="container">
    <div class="row">
        @if(Session::has('message'))
        <div class='alert alert-success'>{{ Session::get('message')}}</div>
        @endif
        @section ('table_panel_title','Payment')
        @section ('table_panel_body')
            <table class="table">
                <tr>
                    <th>Date</th>
                    <th>Fee ID</th>
                    <th>Service Name</th>
                    <th>Amount Payable</th>
                    <th>Payment Mode</th>
                    <th></th>
                </tr>
            @foreach($payments as $payment)
            <?php
                $feed = strlen($payment->fee_id);
                if($feed == 1)
                    $feeid = ":00".$payment->fee_id;
                elseif($feed == 2)
                    $feeid = ":0".$payment->fee_id;
                else
                    $feeid = ":".$payment->fee_id;
            ?>    
            <tr>
                <td>{{ $payment->paymentdate }}</td>
                @if($payment->ctype=='Business')
                <td>{{ $payment->bname }}{{ $feeid }}</td>
                @else
                <td>{{ $payment->cname }}{{ $feeid }}</td>
                @endif
                <td>{{ $payment->service_name }}</td>
                <td>Rs. {{ $payment->paid_amount }}</td>
                <td>{{ $payment->payment_mode }}</td>
                <td>{!! Form::open(array('route' => ['payment.destroy', $payment->payment_id], 'method'=>'Delete')) !!}
                        {{ link_to_route('payment.show', 'View', [$payment->payment_id], ['class'=>'btn btn-primary']) }}                         
                    {!! Form::close() !!}    
                </td>
            </tr>
            @endforeach
            </table>
        @endsection
        @include('widgets.panel', array('header'=>true, 'as'=>'table'))
        {{ link_to_route('payment.create', 'Add Payment', null, ['class'=>'btn btn-primary']) }}
    </div>
</div>
@endsection
