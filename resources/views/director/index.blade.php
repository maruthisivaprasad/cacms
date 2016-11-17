@extends('layouts.app')
@section('page_heading','Tables')
@section('content')
<div class="container">
    <div class="row">
        @if(Session::has('message'))
        <div class='alert alert-success'>{{ Session::get('message')}}</div>
        @endif
        @section ('table_panel_title','Contact')
        @section ('table_panel_body')
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
        @endsection
        @include('widgets.panel', array('header'=>true, 'as'=>'table'))
        {{ link_to_route('director.create', 'Add Contact', null, ['class'=>'btn btn-primary']) }}
        {{ link_to_route('director.excel', 'Export to Excel', null, ['class' => 'btn btn-primary']) }}
    </div>
</div>
@endsection
