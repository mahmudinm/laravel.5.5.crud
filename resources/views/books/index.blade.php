@extends('layouts.app')

@section('content')


    <div class="modal fade" id="modal-id">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Modal title</h4>
                </div>
                <div class="modal-body">
                    <div class="copy-field hidden">
                        <div class="col-md-4">
                          <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                              {!! Form::label('name', 'Name') !!}
                              {!! Form::text('name[]', null, ['class' => 'form-control name', 'required' => 'required']) !!}
                              <small class="text-danger">{{ $errors->first('name') }}</small>
                          </div>                                              
                        </div>
                        
                        <div class="col-md-2">
                          <div class="form-group{{ $errors->has('quantity') ? ' has-error' : '' }}">
                              {!! Form::label('quantity', 'Quantity') !!}
                              {!! Form::text('quantity[]', null, ['class' => 'form-control quantity', 'required' => 'required']) !!}
                              <small class="text-danger">{{ $errors->first('quantity') }}</small>
                          </div>                            
                        </div>    

                        <div class="col-md-2">
                            <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                                {!! Form::label('price', 'Price') !!}
                                {!! Form::text('price[]', null, ['class' => 'form-control price', 'required' => 'required']) !!}
                                <small class="text-danger">{{ $errors->first('price') }}</small>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group{{ $errors->has('total') ? ' has-error' : '' }}">
                                {!! Form::label('total', 'Total') !!}
                                {!! Form::text('total[]', null, ['class' => 'form-control total', 'required' => 'required']) !!}
                                <small class="text-danger">{{ $errors->first('total') }}</small>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group{{ $errors->has('ppn') ? ' has-error' : '' }}">
                                {!! Form::label('ppn', 'PPN') !!}
                                {!! Form::text('ppn[]', null, ['class' => 'form-control ppn', 'required' => 'required']) !!}
                                <small class="text-danger">{{ $errors->first('ppn') }}</small>
                            </div>
                        </div>                        
                    </div>
                    
                    {!! Form::open(['method' => 'POST', 'route' => 'books.store']) !!}
                          
                        <div class="col-md-4">
                          <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                              {!! Form::label('name', 'Name') !!}
                              {!! Form::text('name[]', null, ['class' => 'form-control name', 'required' => 'required']) !!}
                              <small class="text-danger">{{ $errors->first('name') }}</small>
                          </div>                                              
                        </div>
                        
                        <div class="col-md-2">
                          <div class="form-group{{ $errors->has('quantity') ? ' has-error' : '' }}">
                              {!! Form::label('quantity', 'Quantity') !!}
                              {!! Form::text('quantity[]', null, ['class' => 'form-control quantity', 'required' => 'required']) !!}
                              <small class="text-danger">{{ $errors->first('quantity') }}</small>
                          </div>                            
                        </div>    

                        <div class="col-md-2">
                            <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                                {!! Form::label('price', 'Price') !!}
                                {!! Form::text('price[]', null, ['class' => 'form-control price', 'required' => 'required']) !!}
                                <small class="text-danger">{{ $errors->first('price') }}</small>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group{{ $errors->has('total') ? ' has-error' : '' }}">
                                {!! Form::label('total', 'Total') !!}
                                {!! Form::text('total[]', null, ['class' => 'form-control total', 'required' => 'required']) !!}
                                <small class="text-danger">{{ $errors->first('total') }}</small>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group{{ $errors->has('ppn') ? ' has-error' : '' }}">
                                {!! Form::label('ppn', 'PPN') !!}
                                {!! Form::text('ppn[]', null, ['class' => 'form-control ppn', 'required' => 'required']) !!}
                                <small class="text-danger">{{ $errors->first('ppn') }}</small>
                            </div>
                        </div>

                        <div id="newForm"></div>
                            

                        {!! Form::submit("Add", ['class' => 'btn btn-primary']) !!}
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                {!! Form::close() !!}                                          
                </div>
                <div class="modal-footer" >
                    <a href="#" class="btn btn-primary" id="add">Add new form</a>
                </div>
            </div>
        </div>
    </div>


<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">            
            <div class="panel panel-default">
                <div class="panel-heading">
                	Dashboard
                    <a class="btn btn-primary btn-xs pull-right" data-toggle="modal" href='#modal-id'>Create New</a>
                </div>      
                <div class="panel-body">
                	<table class="table table-hover">
                		<thead>
                			<tr>
                				<th>Name</th>
                				<th>Quantity</th>
                                <th>Price</th>
                                <th>Total</th>
                                <th>PPN</th>
                				<th>Action</th>
                			</tr>
                		</thead>
                		<tbody>
                            @foreach($books as $boks)
                                <tr>
                                    <td>{{ $boks->name }}</td>
                                    <td>{{ $boks->quantity }}</td>
                                    <td>{{ $boks->price }}</td>
                                    <td>{{ $boks->total }}</td>
                                    <td>{{ $boks->ppn }}</td>
                                    <td>
                                        {!! Form::model($boks, ['route' => ['books.destroy', $boks], 'method' => 'delete', 'class' => 'form-inline'] ) !!}
                                          <a href="{{ route('books.show', $boks->id)}}" class="btn btn-xs btn-info">Show</a> &nbsp;
                                          <a href="{{ route('books.edit', $boks->id)}}" class="btn btn-xs btn-success">Edit</a> &nbsp;
                                          {!! Form::submit('delete', ['class'=>'btn btn-xs btn-danger']) !!}
                                        {!! Form::close()!!}
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $("#add").click(function(){ 
                var html = $(".copy-field").html();
                $("#newForm").after(html);
            });
        });
    </script>
@endsection