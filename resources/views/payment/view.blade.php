@extends('layouts.app')
@section('page_heading','Tables')
@section('content')
<div class="container">
    <div class="row">
        @section ('ctable_panel_title','Payment Information')
        @section ('ctable_panel_body')  
        <?php
            $feed = strlen($payment->fee_id);
            if($feed == 1)
                $feeid = ":00".$payment->fee_id;
            elseif($feed == 2)
                $feeid = ":0".$payment->fee_id;
            else
                $feeid = ":".$payment->fee_id;
        ?>  
            <table class="table table-condensed">
                <tbody>
                    <tr>
                        <td>Client Name</td>
                        <td><?php if($payment->ctype=='Business') { echo $payment->bname; } else { echo $payment->cname; }  ?></td>
                    </tr>
                    <tr>
                        <td>Fee ID</td>
                        <td><?php if($payment->ctype=='Business') { echo $payment->bname.$feeid; } else { echo $payment->cname.":".$feeid; }  ?></td>
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
