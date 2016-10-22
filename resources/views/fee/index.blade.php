@extends('layouts.app')
@section('page_heading','Tables')
@section('content')
<div class="container">
    <div class="row">
            @if(Session::has('message'))
            <div class='alert alert-success'>{{ Session::get('message')}}</div>
            @endif
            @section ('table_panel_title','Fee')
            @section ('table_panel_body')
                <table class="table">
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
                    <td>Rs. {{ number_format($fee->fees,2) }}</td>
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
            @endsection
            @include('widgets.panel', array('header'=>true, 'as'=>'table'))
            {{ link_to_route('fee.create', 'Add Fee', null, ['class'=>'btn btn-primary']) }}
    </div>
</div>
@endsection
