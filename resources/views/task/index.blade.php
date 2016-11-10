@extends('layouts.app')
@section('page_heading','Tables')
@section('content')
<div class="container">
    <div class="row">
        @if(Session::has('message'))
        <div class='alert alert-success'>{{ Session::get('message')}}</div>
        @endif
        @section ('table_panel_title','Task')
        @section ('table_panel_body')
            <table class="table">
                <tr>
                    <th>Subject</th>
                    <th>Description</th>
                    <th>Priority</th>
                    <th>Due Date</th>
                    <th>Remarks</th>
                    <th></th>
                </tr>
            @foreach($tasks as $task)
            <tr>
                <td>{{ $task->subject }}</td>
                <td>{{ $task->description }}</td>
                <td>{{ $task->priority }}</td>
                <td>{{ $task->duedate }}</td>
                <td>{{ $task->remarks }}</td>
                <td>{!! Form::open(array('route' => ['task.destroy', $task->task_id], 'method'=>'Delete')) !!}
                        {{ link_to_route('task.show', 'View', [$task->task_id], ['class'=>'btn btn-primary']) }} 
                        |
                        {{ link_to_route('task.edit', 'Edit', [$task->task_id], ['class'=>'btn btn-primary']) }} 
                        | 
                        {!! Form::button('Delete',['type'=>'submit', 'class'=>'btn btn-danger']) !!}
                    {!! Form::close() !!}    
                </td>
            </tr>
            @endforeach
            </table>
        @endsection
        @include('widgets.panel', array('header'=>true, 'as'=>'table'))
        {{ link_to_route('task.create', 'Add Task', null, ['class'=>'btn btn-primary']) }}
    </div>
</div>
@endsection
