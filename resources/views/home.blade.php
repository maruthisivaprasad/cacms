@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    ”We are what we repeatedly do. Excellence is not an act, but a habit.”  ~ Aristotle
                    <img src="{{URL::asset('/images/banner.png')}}" alt="profile Pic" height="350" width="700">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
