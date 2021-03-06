@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Create New Item
            	</div>

                <div class="panel-body">
                    {!! Form::open(['method' => 'POST', 'route' => 'items.store', 'enctype' => 'multipart/form-data']) !!}
                    
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            {!! Form::label('name', 'Name') !!}
                            {!! Form::text('name', null, ['class' => 'form-control']) !!}
                            <small class="text-danger">{{ $errors->first('name') }}</small>
                        </div>

                        <div class="form-group{{ $errors->has('quantity') ? ' has-error' : '' }}">
                            {!! Form::label('quantity', 'Quantity') !!}
                            {!! Form::text('quantity', null, ['class' => 'form-control']) !!}
                            <small class="text-danger">{{ $errors->first('quantity') }}</small>
                        </div>

                        <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                            {!! Form::label('image', 'Image') !!}
                            {!! Form::file('image') !!}
                            <small class="text-danger">{{ $errors->first('image') }}</small>
                        </div>
                        
                        <br>

                        {!! Form::submit("Create Item", ['class' => 'btn btn-info btn-block']) !!}
                    
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
