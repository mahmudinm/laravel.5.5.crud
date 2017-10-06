@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
    
            {!! Form::open(['url' => 'items', 'method'=>'get', 'class'=>'form-inline']) !!}
                <div class="form-group {!! $errors->has('q') ? 'has-error' : '' !!}">
                  {!! Form::text('q', isset($q) ?  : null, ['class'=>'form-control', 'placeholder' => 'Search...']) !!}
                  {!! $errors->first('q', '<p class="help-block">:message</p>') !!}
                </div>
              {!! Form::submit('Search', ['class'=>'btn btn-primary']) !!}
            {!! Form::close() !!}
            
            <br>

            <div class="panel panel-default">
                <div class="panel-heading">
                	Dashboard

                	<a href="{{ route('items.create') }}" class="btn btn-primary btn-xs pull-right">Create New</a>	
            	</div>

                <div class="panel-body">
                	<table class="table table-hover">
                		<thead>
                			<tr>
                				<th>ID</th>
                				<th>Name</th>
                				<th>Image</th>
                				<th>Quantity</th>
                                <th>Date</th>
                				<th>Action</th>
                			</tr>
                		</thead>
                		<tbody>
                            @foreach($items as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td><img src="{{ url('upload/'.$item->image) }}" alt="" style="width:50px;height:50px;"></td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ date('d F Y ', strtotime($item->created_at)) }}</td>
                                    <td>
                                        {!! Form::model($item, ['route' => ['items.destroy', $item], 'method' => 'delete', 'class' => 'form-inline'] ) !!}
                                          <a href="{{ route('items.show', $item->id)}}" class="btn btn-xs btn-info">Show</a> &nbsp;
                                          <a href="{{ route('items.edit', $item->id)}}" class="btn btn-xs btn-success">Edit</a> &nbsp;
                                          {!! Form::submit('delete', ['class'=>'btn btn-xs btn-danger']) !!}
                                        {!! Form::close()!!}
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    <div class="text-center">{{ $items->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
