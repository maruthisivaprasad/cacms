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
                    <td>Rs. <?php echo number_format($fee->fees,2); ?></td>
                </tr>
                <tr>
                    <td>Amount Receive</td>
                    <td>Rs. <?php echo number_format($fee->amount_receive,2); ?></td>
                </tr>
                <tr>
                    <td>Balance</td>
                    <td>Rs. <?php echo number_format($fee->balance,2); ?></td>
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
                <td>Rs. {{ number_format($payment->payment_amount,2) }}</td>
                <td>Rs. {{ number_format($payment->paid_amount,2) }}</td>
                <td>{{ $payment->payment_mode }}</td>
                <td>{{ $payment->paymentdate }}</td>
                <td>{!! Form::open(array('route' => ['payment.destroy', $payment->payment_id], 'method'=>'Delete')) !!}
                        {{ link_to_route('payment.show', 'View', [$payment->payment_id], ['class'=>'btn btn-primary']) }} 
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