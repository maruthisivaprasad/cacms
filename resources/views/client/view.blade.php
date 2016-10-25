@extends('layouts.app')
@section('page_heading','Tables')
@section('content')
<div class="container">
    <div class="row">
        @section ('ctable_panel_title','Client Information')
        @section ('ctable_panel_body')
            @if($client->client_type=='Business')
            <table class="table table-condensed">
                <tbody>
                    <tr>
                        <td>Client Type</td>
                        <td><?php echo $client->client_type; ?></td>
                    </tr>
                    <tr>
                        <td>Client Status</td>
                        <td><?php echo $client->client_status; ?></td>
                    </tr>
                    <tr>
                        <td>Business Name</td>
                        <td><?php echo $client->business_name; ?></td>
                    </tr>
                    <tr>
                        <td>Office Address</td>
                        <td><?php echo $client->office_address; ?></td>
                    </tr>
                    <tr>
                        <td>Primary Phone</td>
                        <td><?php echo $client->mobile; ?></td>
                    </tr>
                    <tr>
                        <td>Primary Email</td>
                        <td><?php echo $client->email; ?></td>
                    </tr>
                    <tr>
                        <td>Office Landline</td>
                        <td><?php echo $client->office_landline; ?></td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td><?php echo $client->address; ?></td>
                    </tr>
                    <tr>
                        <td>Website</td>
                        <td><?php echo $client->website; ?></td>
                    </tr>
                    <tr>
                        <td>Business Nature</td>
                        <td><?php echo $client->business_nature; ?></td>
                    </tr>
                    <tr>
                        <td>Assigned User</td>
                        <td><?php echo $user->name; ?></td>
                    </tr>
                    <tr>
                        <td>Company Type</td>
                        <td><?php echo $client->company_type; ?></td>
                    </tr>
                </tbody>
            </table>
            @else
            <table class="table table-condensed">
                <tbody>
                    <tr>
                        <td>Client Type</td>
                        <td><?php echo $client->client_type; ?></td>
                    </tr>
                    <tr>
                        <td>Client Status</td>
                        <td><?php echo $client->client_status; ?></td>
                    </tr>
                    <tr>
                        <td>Name</td>
                        <td><?php echo $client->name; ?></td>
                    </tr>
                    <tr>
                        <td>Father Name</td>
                        <td><?php echo $client->fname; ?></td>
                    </tr>
                    <tr>
                        <td>Primary Phone</td>
                        <td><?php echo $client->mobile; ?></td>
                    </tr>
                    <tr>
                        <td>Primary Email</td>
                        <td><?php echo $client->email; ?></td>
                    </tr>
                    <tr>
                        <td>Date of Birth</td>
                        <td><?php echo $client->dob; ?></td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td><?php echo $client->address; ?></td>
                    </tr>
                    <tr>
                        <td>PAN</td>
                        <td><?php echo $client->pan; ?></td>
                    </tr>
                    <tr>
                        <td>UIDAI</td>
                        <td><?php echo $client->uidai; ?></td>
                    </tr>
                </tbody>
            </table>
            @endif
        {{ link_to_route('client.edit', 'Edit', [$client->client_id], ['class'=>'btn btn-primary']) }} 
        @endsection
        @include('widgets.panel', array('header'=>true, 'as'=>'ctable'))
    </div>
    @if($client->client_type=='Business')
    <div class="row">    
        @section ('dtable_panel_title','Director')
        @section ('dtable_panel_body')
        <table class="table table-condensed">
            <tr>
                <th>Client Name</th>
                <th>Name</th>
                <th>DIN</th>
                <th>Phone</th>
                <th>Email</th>
                <th></th>
            </tr>
            @foreach($directors as $director)
            <tr>
                @if($director->ctype=='Business')
                <td>{{ $director->bname }}</td>
                @else
                <td>{{ $director->cname }}</td>
                @endif
                <td>{{ $director->dname }}</td>
                <td>{{ $director->din }}</td>
                <td>{{ $director->dphone }}</td>
                <td>{{ $director->demail }}</td>
                <td>{!! Form::open(array('route' => ['director.destroy', $director->director_id], 'method'=>'Delete')) !!}
                        {{ link_to_route('director.show', 'View', [$director->director_id], ['class'=>'btn btn-primary']) }} 
                        |
                        {{ link_to_route('director.edit', 'Edit', [$director->director_id], ['class'=>'btn btn-primary']) }} 
                        | 
                        {!! Form::button('Delete',['type'=>'submit', 'class'=>'btn btn-danger']) !!}
                    {!! Form::close() !!}    
                </td>
            </tr>
            @endforeach
        </table>
        {{ link_to_route('director.create', 'Add Director', null, ['class'=>'btn btn-primary']) }}
        @endsection
        @include('widgets.panel', array('header'=>true, 'as'=>'dtable'))
    </div> 
    @endif
    <div class="row">
        @section ('ftable_panel_title','Fees')
        @section ('ftable_panel_body')
        <table class="table table-condensed">
            <tr>
                <th>Client Name</th>
                <th>Service Name</th>
                <th>Type</th>
                <th>Fees</th>
                <th></th>
            </tr>
            @foreach($fees as $fee)
            <tr>
                @if($fee->ctype=='Business')
                <td>{{ $fee->bname }}</td>
                @else
                <td>{{ $fee->cname }}</td>
                @endif
                <td>{{ $fee->service_name }}</td>
                <td>{{ $fee->type }}</td>
                <td>Rs. {{ $fee->fees }}</td>
                <td>{!! Form::open(array('route' => ['fee.destroy', $fee->fee_id], 'method'=>'Delete')) !!}
                        {{ link_to_route('fee.show', 'View', [$fee->fee_id], ['class'=>'btn btn-primary']) }} 
                        |
                        {{ link_to_route('fee.edit', 'Edit', [$fee->fee_id], ['class'=>'btn btn-primary']) }} 
                        | 
                        {!! Form::button('Delete',['type'=>'submit', 'class'=>'btn btn-danger']) !!}
                    {!! Form::close() !!}    
                </td>
            </tr>
            @endforeach
        </table>
        {{ link_to_route('fee.create', 'Add Fee', null, ['class'=>'btn btn-primary']) }}
        @endsection
        @include('widgets.panel', array('header'=>true, 'as'=>'ftable'))
    </div>
    <div class="row">
        @section ('drtable_panel_title','Documents')
        @section ('drtable_panel_body')
        <table class="table">
            <tr>
                <th>Client Name</th>
                <th>Title</th>
                <th>Path</th>
                <th></th>
            </tr>
        @foreach($documents as $document)
        <tr>
            @if($document->ctype=='Business')
            <td>{{ $document->bname }}</td>
            @else
            <td>{{ $document->cname }}</td>
            @endif
            <td>{{ $document->title }}</td>
            <td><a href="images/{{ $document->client_id }}/{{$document->path}}">{{$document->path}}</a></td>
            <td>{!! Form::open(array('route' => ['document.destroy', $document->document_id], 'method'=>'Delete')) !!}
                    {!! Form::button('Delete',['type'=>'submit', 'class'=>'btn btn-danger']) !!}
                {!! Form::close() !!}    
            </td>
        </tr>
        @endforeach
        </table>
        @endsection
        @include('widgets.panel', array('header'=>true, 'as'=>'drtable'))
    </div>
    <div class="row">
        @section ('table_panel_title','Payment')
        @section ('table_panel_body')
            <table class="table">
                <tr>
                    <th>Date</th>
                    <th>Fee ID</th>
                    <th>Service Name</th>
                    <th>Amount Payable</th>
                    <th>Payment Mode</th>
                    <th></th>
                </tr>
            @foreach($payments as $payment)
            <?php
                $feed = strlen($payment->fee_id);
                if($feed == 1)
                    $feeid = ":00".$payment->fee_id;
                elseif($feed == 2)
                    $feeid = ":0".$payment->fee_id;
                else
                    $feeid = ":".$payment->fee_id;
            ?>    
            <tr>
                <td>{{ $payment->paymentdate }}</td>
                @if($payment->ctype=='Business')
                <td>{{ $payment->bname }}{{ $feeid }}</td>
                @else
                <td>{{ $payment->cname }}{{ $feeid }}</td>
                @endif
                <td>{{ $payment->service_name }}</td>
                <td>Rs. {{ $payment->paid_amount }}</td>
                <td>{{ $payment->payment_mode }}</td>
                <td>{!! Form::open(array('route' => ['payment.destroy', $payment->payment_id], 'method'=>'Delete')) !!}
                        {{ link_to_route('payment.show', 'View', [$payment->payment_id], ['class'=>'btn btn-primary']) }}                         
                    {!! Form::close() !!}    
                </td>
            </tr>
            @endforeach
            </table>
        {{ link_to_route('payment.create', 'Add Payment', null, ['class'=>'btn btn-primary']) }}
        @endsection
        @include('widgets.panel', array('header'=>true, 'as'=>'table'))
    </div>
</div>
@endsection
