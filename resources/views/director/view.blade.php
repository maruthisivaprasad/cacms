@extends('layouts.app')
@section('page_heading','Tables')
@section('content')
<div class="container">
    <div class="row">
        @section ('ctable_panel_title','Contact Information')
        @section ('ctable_panel_body')    
            <table class="table table-condensed">
                <tbody>
                    <tr>
                        <td>Client Name</td>
                        <td><?php if($client->client_type=='Business') { echo $client->business_name; } else { echo $client->name; }  ?></td>
                    </tr>
                    <tr>
                        <td>Name</td>
                        <td><?php echo $director->name; ?></td>
                    </tr>
                    <tr>
                        <td>DIN</td>
                        <td><?php echo $director->din; ?></td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td><?php echo $director->phone; ?></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><?php echo $director->email; ?></td>
                    </tr>
                    <tr>
                        <td>Digital Signature</td>
                        <td><?php echo $director->digital_sig; ?></td>
                    </tr>
                </tbody>
            </table>
        @endsection
        @include('widgets.panel', array('header'=>true, 'as'=>'ctable'))
    </div>
</div>
@endsection
