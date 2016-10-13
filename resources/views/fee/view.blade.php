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
</div>
@endsection
