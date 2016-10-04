@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @if(Session::has('message'))
            <div class='alert alert-success'>{{ Session::get('message')}}</div>
            @endif
            <div class="panel panel-default">
                <div class="panel-heading">Fee</div>
                <div class="panel-body">
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
                </div>
                {{ link_to_route('fee.create', 'Add Fee', null, ['class'=>'btn btn-primary']) }}
            </div>
        </div>
    </div>
</div>
@endsection
