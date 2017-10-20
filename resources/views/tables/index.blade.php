@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            {!! Form::open(['url' => 'tables', 'method'=>'get', 'class'=>'form-inline']) !!}
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
                	<a data-toggle="modal" href='#modal-create' class="btn btn-primary btn-xs pull-right">Create New</a>	
            	</div>

                <div class="panel-body">
                	<table class="table table-hover">
                		<thead>
                			<tr>
                				<th>ID</th>
                				<th>Name</th>
                				<th>Quantity</th>
                				<th>Weight</th>
                                <th>Date</th>
                				<th>Action</th>
                			</tr>
                		</thead>
                		<tbody>
                            @foreach($tables as $table)
                                <tr class="item-{{$table->id}}">
                                    <td>{{ $table->id }}</td>
                                    <td>{{ $table->name }}</td>
                                    <td>{{ $table->quantity }}</td>
                                    <td>{{ $table->weight }}</td>
                                    <td>{{ date('d F Y ', strtotime($table->created_at)) }}</td>
                                    <td>
                                        {!! Form::model($table, ['route' => ['tables.destroy', $table], 'method' => 'delete', 'class' => 'form-inline'] ) !!}
                                          <a href="{{ route('tables.show', $table->id)}}" class="btn btn-xs btn-info">Show</a> &nbsp;
                                          <a href="#modal-edit" id="edit-modal" data-toggle="modal" class="btn btn-xs btn-success" data-id="{{$table->id}}" data-name="{{$table->name}}" data-quantity="{{$table->quantity}}" data-weight="{{$table->weight}}">Edit</a> &nbsp;
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


<!-- ============ Create Form ============ -->
<div class="modal fade" id="modal-create">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Modal title</h4>
            </div>
            {!! Form::open(['method' => 'POST', 'route' => 'tables.store']) !!}
                <div class="modal-body modal-body--padding charge-group">                        
                        <div class="col-md-4">
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                {!! Form::label('name', 'Name') !!}
                                {!! Form::text('name[]', null, ['class' => 'form-control', 'required' => 'required']) !!}
                                <small class="text-danger">{{ $errors->first('name') }}</small>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="form-group{{ $errors->has('quantity') ? ' has-error' : '' }}">
                                {!! Form::label('quantity', 'Quantity') !!}
                                {!! Form::text('quantity[]', null, ['class' => 'form-control', 'required' => 'required']) !!}
                                <small class="text-danger">{{ $errors->first('quantity') }}</small>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="form-group{{ $errors->has('weight') ? ' has-error' : '' }}">
                                {!! Form::label('weight', 'Weight') !!}
                                <div class="input-group">
                                    {!! Form::text('weight[]', null, ['class' => 'form-control', 'required' => 'required']) !!}
                                    <span class="input-group-btn">
                                        <a href="#" id="add" class="btn btn-default"><i class="fa fa-plus"></i></a>
                                    </span>
                                </div>                                        
                                <small class="text-danger">{{ $errors->first('weight') }}</small>
                            </div>
                        </div>             
                        
                        <div class="clearfix"></div>

                        <div id="newFields"></div>

                </div>
                <div class="modal-footer">
                        {!! Form::submit("Add", ['class' => 'btn btn-primary']) !!}
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
<!-- ============ End Of Create Form ============ -->


<!-- ============ Copy Fields ============ -->
<div id="copy-fields" class="hidden" >    
    <div class="fields-group">
        <div class="col-md-4">
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                {!! Form::label('name', 'Name') !!}
                {!! Form::text('name[]', null, ['class' => 'form-control', 'required' => 'required']) !!}
                <small class="text-danger">{{ $errors->first('name') }}</small>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="form-group{{ $errors->has('quantity') ? ' has-error' : '' }}">
                {!! Form::label('quantity', 'Quantity') !!}
                {!! Form::text('quantity[]', null, ['class' => 'form-control', 'required' => 'required']) !!}
                <small class="text-danger">{{ $errors->first('quantity') }}</small>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="form-group{{ $errors->has('weight') ? ' has-error' : '' }}">
                {!! Form::label('weight', 'Weight') !!}
                <div class="input-group">
                    {!! Form::text('weight[]', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    <span class="input-group-btn">
                        <a href="#" class="btn btn-danger remove"><i class="fa fa-minus"></i></a>
                    </span>
                </div>                                        
                <small class="text-danger">{{ $errors->first('weight') }}</small>
            </div>
        </div>              
        
        <div class="clearfix"></div>        
    </div>
</div>
<!-- ============ End Of Copy Fields ============ -->



<!-- ============ Edit Form ============ -->
<div class="modal fade" id="modal-edit">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Modal title</h4>
            </div>

            {{-- {!! Form::open(['method' => 'POST', 'route' => 'tables.create']) !!} --}}
            <form role="form">
                <div class="modal-body modal-body--padding">                        
                        <div class="col-md-4">
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                {!! Form::label('name', 'Name') !!}
                                {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required', 'id' => 'name_edit']) !!}
                                <small class="text-danger">{{ $errors->first('name') }}</small>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="form-group{{ $errors->has('quantity') ? ' has-error' : '' }}">
                                {!! Form::label('quantity', 'Quantity') !!}
                                {!! Form::text('quantity', null, ['class' => 'form-control', 'required' => 'required', 'id' => 'quantity_edit']) !!}
                                <small class="text-danger">{{ $errors->first('quantity') }}</small>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="form-group{{ $errors->has('weight') ? ' has-error' : '' }}">
                                {!! Form::label('weight', 'Weight') !!}
                                {!! Form::text('weight', null, ['class' => 'form-control', 'required' => 'required', 'id' => 'weight_edit']) !!}                                
                                <small class="text-danger">{{ $errors->first('weight') }}</small>
                            </div>
                        </div>             
                        
                        <div class="clearfix"></div>

                        <div id="newFields"></div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary edit" data-dismiss="modal">
                        <span class='fa fa-check'></span> Update
                    </button>
                    <button type="button" class="btn btn-warning" data-dismiss="modal">
                        <span class='fa fa-remove'></span> Close
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- ============ End Of Edit Form ============ -->


@endsection

@section('script')
    <script>
        $(document).ready(function($) {
            $("#add").click(function(event) {
                var html = $("#copy-fields").html();
                $(".charge-group").append(html);
            });

            $('.charge-group').on('click', '.remove', function(){
                $(this).parents('.fields-group').remove();
            });

            /*--------------------------------------------------------------
            # Edit / Update Form 
            --------------------------------------------------------------*/
            $(document).on('click', '#edit-modal', function(event) {
                var name = $(this).data('name');
                var quantity = $(this).data('quantity');
                var weight = $(this).data('weight');
                id = $(this).data('id');
                $('#name_edit').val(name);
                $('#quantity_edit').val(quantity);
                $('#weight_edit').val(weight);
            });
            $('.modal-footer').on('click', '.edit', function(event) {
                $.ajax({
                    type: 'PUT',
                    url: 'tables/' + id,
                    data: {
                        '_token' : $('input[name=_token]').val(),
                        'name' : $('#name_edit').val(),
                        'quantity' : $('#quantity_edit').val(),
                        'weight' : $('#weight_edit').val()
                    },
                    success: function(data) {
                        // alert(data.id);
                        $('.item-' + data.id).replaceWith("<tr class='item-" + data.id + "'> <td>" + data.id + " </td><td> " + data.name + " </td><td>" + data.quantity + "</td><td>" + data.weight + "</td><td>07 October 2017 </td><td> <form method='POST' action='http://localhost:8000/tables/" + data.id + "' accept-charset='UTF-8' class='form-inline'><input name='_method' type='hidden' value='DELETE'><input name='_token' type='hidden' value='" + $('input[name=_token]').val() + "'> <a href='http://localhost:8000/tables/" + data.id + "' class='btn btn-xs btn-info'>Show</a> &nbsp; <a href='#modal-edit' id='edit-modal' data-toggle='modal' class='btn btn-xs btn-success' data-id='" + data.id + "' data-name='" + data.name + "' data-quantity='" + data.quantity + "' data-weight='" + data.weight + "' data-id='" + data.id + "'>Edit</a> &nbsp; <input class='btn btn-xs btn-danger' type='submit' value='delete'> </form> </td></tr>");                           
                    }
                });
                
            });


        });
    </script>
@endsection