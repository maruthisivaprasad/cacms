@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @if(Session::has('message'))
            <div class='alert alert-success'>{{ Session::get('message')}}</div>
            @endif
            <div class="panel panel-default">
                <div class="panel-heading">Director</div>
                <div class="panel-body">
                    <table class="table">
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
                </div>
                {{ link_to_route('director.create', 'Add Director', null, ['class'=>'btn btn-primary']) }}
            </div>
        </div>
    </div>
</div>
@endsection
