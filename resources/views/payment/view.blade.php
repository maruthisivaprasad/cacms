@extends('layouts.app')
@section('page_heading','Tables')
@section('content')
<div class="container">
    <div class="row">
        @section ('ctable_panel_title','Payment Information')
        @section ('ctable_panel_body')    
            <table class="table table-condensed">
                <tbody>
                    <tr>
                        <td>Client Name</td>
                        <td><?php if($payment->ctype=='Business') { echo $payment->bname; } else { echo $payment->cname; }  ?></td>
                    </tr>
                    <tr>
                        <td>Fee ID</td>
                        <td><?php if($payment->ctype=='Business') { echo $payment->bname."".$payment->fee_id; } else { echo $payment->cname."".$payment->fee_id; }  ?></td>
                    </tr>
                    <tr>
                        <td>Date</td>
                        <td><?php echo $payment->paymentdate; ?></td>
                    </tr>
                    <tr>
                        <td>Service Name</td>
                        <td><?php echo $payment->service_name; ?></td>
                    </tr>
                    <tr>
                        <td>Amount Payable</td>
                        <td><?php echo $payment->payment_amount; ?></td>
                    </tr>
                    <tr>
                        <td>Amount Paid</td>
                        <td><?php echo $payment->paid_amount; ?></td>
                    </tr>
                    <tr>
                        <td>Payment Mode</td>
                        <td><?php echo $payment->payment_mode; ?></td>
                    </tr>
                    <tr>
                        <td>Enter No.</td>
                        <td><?php echo $payment->check_no; ?></td>
                    </tr>
                    <tr>
                        <td>Remarks</td>
                        <td><?php echo $payment->remarks; ?></td>
                    </tr>
                </tbody>
            </table>
        @endsection
        @include('widgets.panel', array('header'=>true, 'as'=>'ctable'))
    </div>
</div>
@endsection
