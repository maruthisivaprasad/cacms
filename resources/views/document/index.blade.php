@extends('layouts.app')
@section('page_heading','Tables')
@section('content')
<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">Create Document</div>
            <div class="panel-body">
                {!! Form::open(array('route' => 'document.store', 'files'=>true)) !!}
                <div class="form-group">
                    <div class="col-xs-2">
                        {!! Form::label('client_id', 'Client') !!}
                    </div>
                    <div class="col-xs-4">
                        {!! Form::select('client_id',$clients, null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="col-md-2">
                        {!! Form::label('title', 'Title') !!}
                    </div>
                    <div class="col-md-4">
                        {!! Form::text('title',null,['class'=>'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-2">
                        {!! Form::label('path', 'Document') !!}
                    </div>
                    <div class="col-md-4">
                         {!! Form::file('path') !!}
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col-md-12">
                     {!! Form::button('Create',['type'=>'submit', 'class'=>'btn btn-primary']) !!} 
                    </div> 
                </div>
                {!! Form::close() !!}
            </div>
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        @if(Session::has('message'))
        <div class='alert alert-success'>{{ Session::get('message')}}</div>
        @endif
        @section ('table_panel_title','Document')
        @section ('table_panel_body')
            <table class="table">
                <tr>
                    <th>Client Name</th>
                    <th>Title</th>
                    <th>Path</th>
                    <th></th>
                </tr>
            @foreach($documents as $document)
            <tr>
                <td>{{ $document->cname }}</td>
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
        @include('widgets.panel', array('header'=>true, 'as'=>'table'))
    </div>
</div>
@endsection