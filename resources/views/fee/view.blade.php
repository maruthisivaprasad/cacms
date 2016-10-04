@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4 col-sm-6 col-xs-12">
            <fieldset class="fieldset">
                <legend class="legend">Fee Information</legend>
                <table class="detail-view">
                    <tr class="even">
                        <th>Client Name</th>
                        <td><?php if($client->client_type=='Business') { echo $client->business_name; } else { echo $client->name; }  ?></td>
                    </tr>
                    <tr class="even">
                        <th>Service Name</th>
                        <td><?php echo $fee->service_name; ?></td>
                    </tr>
                    <tr class="odd">
                        <th>Type</th>
                        <td><?php echo $fee->type; ?></td>
                    </tr>
                    <tr class="even">
                        <th>Fees</th>
                        <td><?php echo $fee->fees; ?></td>
                    </tr>
                    <tr class="odd">
                        <th>Amount Receive</th>
                        <td><?php echo $fee->amount_receive; ?></td>
                    </tr>
                    <tr class="even">
                        <th>Balance</th>
                        <td><?php echo $fee->balance; ?></td>
                    </tr>
                    <tr class="odd">
                        <th>Service Deliver</th>
                        <td><?php echo $fee->service_deliver; ?></td>
                    </tr>
                </table>
            </fieldset>
        </div>
    </div>
</div>
@endsection
