@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4 col-sm-6 col-xs-12">
            <fieldset class="fieldset">
                <legend class="legend">Client Information</legend>
                <table class="detail-view">
                    <tr class="odd">
                        <th>Client Type</th>
                        <td><?php echo $client->client_type; ?></td>
                    </tr>
                    <tr class="even">
                        <th>Client Status</th>
                        <td><?php echo $client->client_status; ?></td>
                    </tr>
                    <tr class="odd">
                        <th>Name</th>
                        <td><?php echo $client->name; ?></td>
                    </tr>
                    <tr class="even">
                        <th>Father Name</th>
                        <td><?php echo $client->fname; ?></td>
                    </tr>
                    <tr class="odd">
                        <th>Date of Birth</th>
                        <td><?php echo $client->dob; ?></td>
                    </tr>
                    <tr class="even">
                        <th>Address</th>
                        <td><?php echo $client->address; ?></td>
                    </tr>
                    <tr class="odd">
                        <th>Mobile</th>
                        <td><?php echo $client->mobile; ?></td>
                    </tr>
                    <tr class="even">
                        <th>Email</th>
                        <td><?php echo $client->email; ?></td>
                    </tr>
                    <tr class="odd">
                        <th>PAN</th>
                        <td><?php echo $client->pan; ?></td>
                    </tr>
                    <tr class="even">
                        <th>UIDAI</th>
                        <td><?php echo $client->uidai; ?></td>
                    </tr>
                </table>
            </fieldset>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <fieldset class="fieldset">
                <legend class="legend">Business Information</legend>
                <table class="detail-view">
                    <tr class="odd">
                        <th>Business Name</th>
                        <td><?php echo $client->business_name; ?></td>
                    </tr>
                    <tr class="even">
                        <th>Office Address</th>
                        <td><?php echo $client->office_address; ?></td>
                    </tr>
                    <tr class="odd">
                        <th>Office Landline</th>
                        <td><?php echo $client->office_landline; ?></td>
                    </tr>
                    <tr class="even">
                        <th>Website</th>
                        <td><?php echo $client->website; ?></td>
                    </tr>
                    <tr class="odd">
                        <th>Business Nature</th>
                        <td><?php echo $client->business_nature; ?></td>
                    </tr>
                    <tr class="even">
                        <th>Company Type</th>
                        <td><?php echo $client->company_type; ?></td>
                    </tr>
                    <tr class="odd">
                        <th>Assigned User</th>
                        <td><?php echo $user->name; ?></td>
                    </tr>
                </table>
            </fieldset>
        </div>
    </div>
</div>
@endsection
