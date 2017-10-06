@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Edit New Item
            	</div>

                <div class="panel-body">
                    {!! Form::model($item, ['route' => ['items.update', $item], 'method' => 'patch' , 'enctype' => 'multipart/form-data'])!!}
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            {!! Form::label('name', 'Name') !!}
                            {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
                            <small class="text-danger">{{ $errors->first('name') }}</small>
                        </div>

                        <div class="form-group{{ $errors->has('quantity') ? ' has-error' : '' }}">
                            {!! Form::label('quantity', 'Quantity') !!}
                            {!! Form::text('quantity', null, ['class' => 'form-control', 'required' => 'required']) !!}
                            <small class="text-danger">{{ $errors->first('quantity') }}</small>
                        </div>

                        <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                            {!! Form::label('image', 'Image') !!}
                            {!! Form::file('image', ['required' => 'required']) !!}
                            <small class="text-danger">{{ $errors->first('image') }}</small>
                            <br>
                            <img src="{{ url('upload/'.$item->image) }}" alt="">
                        </div>
                        
                        <br>
                        {!! Form::submit("Update Item", ['class' => 'btn btn-primary btn-block']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection