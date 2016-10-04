@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4 col-sm-6 col-xs-12">
            <fieldset class="fieldset">
                <legend class="legend">Director Information</legend>
                <table class="detail-view">
                    <tr class="even">
                        <th>Client Name</th>
                        <td><?php if($client->client_type=='Business') { echo $client->business_name; } else { echo $client->name; }  ?></td>
                    </tr>
                    <tr class="odd">
                        <th>Name</th>
                        <td><?php echo $director->name; ?></td>
                    </tr>
                    <tr class="even">
                        <th>DIN</th>
                        <td><?php echo $director->din; ?></td>
                    </tr>
                    <tr class="odd">
                        <th>Phone</th>
                        <td><?php echo $director->phone; ?></td>
                    </tr>
                    <tr class="even">
                        <th>Email</th>
                        <td><?php echo $director->email; ?></td>
                    </tr>
                    <tr class="odd">
                        <th>Digital Signature</th>
                        <td><?php echo $director->digital_sig; ?></td>
                    </tr>
                </table>
            </fieldset>
        </div>
    </div>
</div>
@endsection
