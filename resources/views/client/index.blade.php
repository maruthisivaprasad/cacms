@extends('layouts.app')
@section('page_heading','Tables')
@section('content')
<div class="container">
    <div class="row">
        @if(Session::has('message'))
        <div class='alert alert-success'>{{ Session::get('message')}}</div>
        @endif
        @section ('table_panel_title','Client')
        @section ('table_panel_body')
            <table class="table">
                <tr>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Client Type</th>
                    <th>Client Status</th>
                    <th></th>
                </tr>
            @foreach($clients as $client)
            <tr>
                @if($client->client_type=='Business')
                <td>{{ link_to_route('client.show', $client->business_name, [$client->client_id]) }}</td>
                @else
                <td>{{ link_to_route('client.show', $client->name, [$client->client_id]) }}</td>
                @endif
                <td>{{ $client->mobile }}</td>
                <td>{{ $client->email }}</td>
                <td>{{ $client->client_type }}</td>
                <td>{{ $client->client_status }}</td>
                
                <td>{!! Form::open(array('route' => ['client.destroy', $client->client_id], 'method'=>'Delete')) !!}
                        {!! Form::button('Delete',['type'=>'submit', 'class'=>'btn btn-danger']) !!}
                    {!! Form::close() !!}    
                </td>
            </tr>
            @endforeach
            </table>
        @endsection
        @include('widgets.panel', array('header'=>true, 'as'=>'table'))
        {{ link_to_route('client.create', 'Add Client', null, ['class'=>'btn btn-primary']) }}
    </div>
</div>
@endsection

