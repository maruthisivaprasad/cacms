@extends('layouts.app')
@section('page_heading','Tables')
@section('content')
<div class="container">
    <div class="row">
        @section ('ctable_panel_title','Task Information')
        @section ('ctable_panel_body')    
            <table class="table table-condensed">
                <tbody>
                    <tr>
                        <td>Subject</td>
                        <td><?php echo $task->subject; ?></td>
                    </tr>
                    <tr>
                        <td>Description</td>
                        <td><?php echo $task->description; ?></td>
                    </tr>
                    <tr>
                        <td>Priority</td>
                        <td><?php echo $task->priority; ?></td>
                    </tr>
                    <tr>
                        <td>Due Date</td>
                        <td><?php echo $task->duedate; ?></td>
                    </tr>
                    <tr>
                        <td>Remarks</td>
                        <td><?php echo $task->remarks; ?></td>
                    </tr>
                    <tr>
                        <td>Assigned User</td>
                        <td><?php echo $task->assigned_to; ?></td>
                    </tr>
                </tbody>
            </table>
        @endsection
        @include('widgets.panel', array('header'=>true, 'as'=>'ctable'))
    </div>
</div>
@endsection
