@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @if(Session::has('message'))
            <div class='alert alert-success'>{{ Session::get('message')}}</div>
            @endif
            <div class="panel panel-default">
                <div class="panel-heading">Contact</div>
                <div class="panel-body">
                    <table class="table">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th></th>
                        </tr>
                    @foreach($contacts as $contact)
                    <tr>
                        <td>{{ $contact->first_name." ".$contact->last_name }}</td>
                        <td>{{ $contact->email }}</td>
                        <td>{{ $contact->phone }}</td>
                        <td>{!! Form::open(array('route' => ['contact.destroy', $contact->contact_id], 'method'=>'Delete')) !!}
                                {{ link_to_route('contact.edit', 'Edit', [$contact->contact_id], ['class'=>'btn btn-primary']) }} 
                                | 
                                {!! Form::button('Delete',['type'=>'submit', 'class'=>'btn btn-danger']) !!}
                            {!! Form::close() !!}    
                        </td>
                    </tr>
                    @endforeach
                    </table>
                </div>
                {{ link_to_route('contact.create', 'Add Contact', null, ['class'=>'btn btn-primary']) }}
            </div>
        </div>
    </div>
</div>
@endsection
