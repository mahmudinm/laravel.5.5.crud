@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Name :{{ $item->name }}
            	</div>

                <div class="panel-body">
                    <p>Name :{{ $item->name }}</p>
                    <p>Quantity :{{ $item->quantity }}</p>
                    <img src="{{ url('upload/'.$item->image) }}" alt="">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
