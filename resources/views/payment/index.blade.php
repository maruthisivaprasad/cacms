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
                    <th>Client Name</th>
                    <th>Fee ID</th>
                    <th>Service Name</th>
                    <th>Amount Payable</th>
                    <th>Amount Paid</th>
                    <th>Payment Mode</th>
                    <th></th>
                </tr>
            @foreach($payments as $payment)
            <tr>
                @if($payment->ctype=='Business')
                <td>{{ $payment->bname }}</td>
                @else
                <td>{{ $payment->cname }}</td>
                @endif
                <td>{{ $payment->fee_id }}</td>
                <td>{{ $payment->service_name }}</td>
                <td>{{ $payment->payment_amount }}</td>
                <td>{{ $payment->paid_amount }}</td>
                <td>{{ $payment->payment_mode }}</td>
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
        @endsection
        @include('widgets.panel', array('header'=>true, 'as'=>'table'))
        {{ link_to_route('payment.create', 'Add Payment', null, ['class'=>'btn btn-primary']) }}
    </div>
</div>
@endsection
