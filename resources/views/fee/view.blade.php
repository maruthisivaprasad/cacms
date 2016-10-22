@extends('layouts.app')
@section('page_heading','Tables')
@section('content')
<div class="container">
    <div class="row">
        @section ('ctable_panel_title','Fee Information')
        @section ('ctable_panel_body')
            <table class="table table-condensed">
                <tr>
                    <td>Client Name</td>
                    <td><?php if($client->client_type=='Business') { echo $client->business_name; } else { echo $client->name; }  ?></td>
                </tr>
                <tr>
                    <td>Service Name</td>
                    <td><?php echo $fee->service_name; ?></td>
                </tr>
                <tr>
                    <td>Type</td>
                    <td><?php echo $fee->type; ?></td>
                </tr>
                <tr>
                    <td>Fees</td>
                    <td><?php echo $fee->fees; ?></td>
                </tr>
                <tr>
                    <td>Amount Receive</td>
                    <td><?php echo $fee->amount_receive; ?></td>
                </tr>
                <tr>
                    <td>Balance</td>
                    <td><?php echo $fee->balance; ?></td>
                </tr>
                <tr>
                    <td>Service Deliver</td>
                    <td><?php echo $fee->service_deliver; ?></td>
                </tr>
            </table>
        @endsection
        @include('widgets.panel', array('header'=>true, 'as'=>'ctable'))
   </div>

    <div class="row">
        @if(Session::has('message'))
        <div class='alert alert-success'>{{ Session::get('message')}}</div>
        @endif
        @section ('table_panel_title','Payment')
        @section ('table_panel_body')
            <table class="table">
                <tr>
                    <th>Service Name</th>
                    <th>Amount Payable</th>
                    <th>Amount Paid</th>
                    <th>Payment Mode</th>
                    <th>Date</th>
                    <th></th>
                </tr>
            @foreach($payments as $payment)
            <tr>
                <td>{{ $payment->service_name }}</td>
                <td>{{ $payment->payment_amount }}</td>
                <td>{{ $payment->paid_amount }}</td>
                <td>{{ $payment->payment_mode }}</td>
                <td>{{ $payment->paymentdate }}</td>
                <td>{!! Form::open(array('route' => ['payment.destroy', $payment->payment_id], 'method'=>'Delete')) !!}
                        {{ link_to_route('payment.show', 'View', [$payment->payment_id], ['class'=>'btn btn-primary']) }} 
                        |
                        {{ link_to_route('payment.edit', 'Edit', [$payment->payment_id], ['class'=>'btn btn-primary']) }} 
                        | 
                        {!! Form::button('Delete',['type'=>'submit', 'class'=>'btn btn-danger']) !!}
                    {!! Form::close() !!}    
                </td>
            </tr>
            @endforeach
            </table>
        {{ link_to_route('payment.create', 'Create', [$fee->fee_id], ['class'=>'btn btn-primary']) }} 
        @endsection
        @include('widgets.panel', array('header'=>true, 'as'=>'table'))
    </div>
</div>
@endsection