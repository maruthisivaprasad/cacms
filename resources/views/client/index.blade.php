@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @if(Session::has('message'))
            <div class='alert alert-success'>{{ Session::get('message')}}</div>
            @endif
            <div class="panel panel-default">
                <div class="panel-heading">Client</div>
                <div class="panel-body">
                    <table class="table">
                        <tr>
                            <th>Client Type</th>
                            <th>Client Status</th>
                            <th></th>
                        </tr>
                    @foreach($clients as $client)
                    <tr>
                        <td>{{ $client->client_type }}</td>
                        <td>{{ $client->client_status }}</td>
                        @if($client->client_type=='Business')
                        <td>{{ $client->business_name }}</td>
                        @else
                        <td>{{ $client->name }}</td>
                        @endif
                        <td>{!! Form::open(array('route' => ['client.destroy', $client->client_id], 'method'=>'Delete')) !!}
                                {{ link_to_route('client.edit', 'Edit', [$client->client_id], ['class'=>'btn btn-primary']) }} 
                                | 
                                {!! Form::button('Delete',['type'=>'submit', 'class'=>'btn btn-danger']) !!}
                            {!! Form::close() !!}    
                        </td>
                    </tr>
                    @endforeach
                    </table>
                </div>
                {{ link_to_route('client.create', 'Add Client', null, ['class'=>'btn btn-primary']) }}
            </div>
        </div>
    </div>
</div>
@endsection
