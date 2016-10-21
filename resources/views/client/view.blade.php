@extends('layouts.app')
@section('page_heading','Tables')
@section('content')
<script>
	 $(function() {
	   $( "#tabs" ).tabs();
	 });
 </script>
<div class="container">
    <div id="tabs">
        <ul class="ul-tabs">
            <li><a href="#tabs-1">Client Information</a></li>
            @if($client->client_type=='Business')
            <li><a href="#tabs-2">Directors</a></li>
            @endif
            <li><a href="#tabs-3">Fees</a></li>
            <li><a href="#tabs-4">Documents</a></li>
        </ul>
        @if($client->client_type=='Business')
        <div id="tabs-1">
            <div class="row">
                <div class="col-md-2">Client Type</div>
                <div class="col-md-4"><?php echo $client->client_type; ?></div>
                <div class="col-md-2">Client Status</div>
                <div class="col-md-4"><?php echo $client->client_status; ?></div>
            </div>
            <div class="row">
                <div class="col-md-2">Business Name</div>
                <div class="col-md-4"><?php echo $client->business_name; ?></div>
                <div class="col-md-2">Office Address</div>
                <div class="col-md-4"><?php echo $client->office_address; ?></div>
            </div>
            <div class="row">
                <div class="col-md-2">Primary Phone</div>
                <div class="col-md-4"><?php echo $client->mobile; ?></div>
                <div class="col-md-2">Primary Email</div>
                <div class="col-md-4"><?php echo $client->email; ?></div>
            </div>
            <div class="row">
                <div class="col-md-2">Office Landline</div>
                <div class="col-md-4"><?php echo $client->office_landline; ?></div>
                <div class="col-md-2">Address</div>
                <div class="col-md-4"><?php echo $client->address; ?></div>
            </div>
            <div class="row">
                <div class="col-md-2">Website</div>
                <div class="col-md-4"><?php echo $client->website; ?></div>
                <div class="col-md-2">Business Nature</div>
                <div class="col-md-4"><?php echo $client->business_nature; ?></div>
            </div>
            <div class="row">
                <div class="col-md-2">Assigned User</div>
                <div class="col-md-4"><?php echo $user->name; ?></div>
                <div class="col-md-2">Company Type</div>
                <div class="col-md-4"><?php echo $client->company_type; ?></div>
            </div>
            <div class="row">
                <div class="col-md-12">
                {{ link_to_route('client.edit', 'Edit', [$client->client_id], ['class'=>'btn btn-primary']) }} 
                </div>
            </div>
        </div>
        @else
        <div id="tabs-1">
            <div class="row">
                <div class="col-md-2">Client Type</div>
                <div class="col-md-4"><?php echo $client->client_type; ?></div>
                <div class="col-md-2">Client Status</div>
                <div class="col-md-4"><?php echo $client->client_status; ?></div>
            </div>
            <div class="row">
                <div class="col-md-2">Name</div>
                <div class="col-md-4"><?php echo $client->name; ?></div>
                <div class="col-md-2">Father Name</div>
                <div class="col-md-4"><?php echo $client->fname; ?></div>
            </div>
            <div class="row">
                <div class="col-md-2">Primary Phone</div>
                <div class="col-md-4"><?php echo $client->mobile; ?></div>
                <div class="col-md-2">Primary Email</div>
                <div class="col-md-4"><?php echo $client->email; ?></div>
            </div>
            <div class="row">
                <div class="col-md-2">Date of Birth</div>
                <div class="col-md-4"><?php echo $client->dob; ?></div>
                <div class="col-md-2">Address</div>
                <div class="col-md-4"><?php echo $client->address; ?></div>
            </div>
            <div class="row">
                <div class="col-md-2">PAN</div>
                <div class="col-md-4"><?php echo $client->pan; ?></div>
                <div class="col-md-2">UIDAI</div>
                <div class="col-md-4"><?php echo $client->uidai; ?></div>
            </div>
            <div class="row">
                <div class="col-md-12">
                {{ link_to_route('client.edit', 'Edit', [$client->client_id], ['class'=>'btn btn-primary']) }} 
                </div>
            </div>
        </div>
        @endif
        @if($client->client_type=='Business')
        <div id="tabs-2">
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
        </div>
        @endif
        <div id="tabs-3">
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
                    <td>{{ $fee->fees }}</td>
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
        </div>
        <div id="tabs-4">
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
        </div>
    </div>
</div>
@endsection
