@extends('template.layout')
@section('title') Tipo de documentos @stop
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
	        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#createModal">Nuevo</button>
	    </div>
		<div class="col-md-12">
			<table id="tb" class="table table-striped table-bordered tb">
				<thead class="black white-text">
					<tr>
						<th>#</th>
						<th>Nombre</th>
						<th>Descripcion</th>
						<th>Accion</th>
					</tr>
				</thead>
				<tbody>
					@foreach($tipos as $tipo)
					<tr>
						<td>{{ $tipo->id }}</td>
						<td>{{ $tipo->name }}</td>
						<td>{{ $tipo->description }}</td>
						<td>
							<a class="btn btn-sm" data-toggle="modal" data-target="#updateModal" onclick="editar({{ $tipo->id }});" title="">Editar</a>

			      			<a class="btn btn-sm" id="eliminar" onclick="eliminar({{ $tipo->id }});" title="Eliminar">Eliminar</a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
	  aria-hidden="true">
	<form action="{{ route('tipos.store') }}" method="post" id="my_form">
	{{ csrf_field() }}
	  <div class="modal-dialog modal-md" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h4 class="modal-title w-100" id="myModalLabel">Nuevo tipo de documento</h4>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body mx-3">
	        <div class="md-form mb-5">
	          <input type="text" name="name" id="nombre" class="form-control validate">
	          <label data-error="Error" data-success="Bien" for="nombre">Nombre</label>
	        </div>
	        <div class="md-form mb-4">
	          <input type="text" name="description" id="descripcion" class="form-control validate">
	          <label data-error="Error" data-success="Bien" for="descripcion">Descripcion</label>
	        </div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
	        <button type="button" id="bsubmit" class="btn btn-primary btn-sm">Guardar</button>
	      </div>
	    </div>
	  </div>
	</form>
</div>

<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
	  aria-hidden="true">
	<form method="post" id="my_form_u">
	{{ csrf_field() }}
	  <div class="modal-dialog modal-md" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h4 class="modal-title w-100" id="myModalLabelu">Editar tipo de documento</h4>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body mx-3">
	        <div class="md-form mb-5">
              <input type="hidden" id="idu" name="id">
	          <input type="text" name="name" id="nombreu" class="form-control validate">
	          <label data-error="Error" data-success="Bien" for="nombreu">Nombre</label>
			</div>
	        <div class="md-form mb-4">
	          <input type="text" name="description" id="descripcionu" class="form-control validate">
	          <label data-error="Error" data-success="Bien" for="orangeForm-pass">Descripcion</label>
			</div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
	        <button type="button" id="bsubmitu" class="btn btn-primary btn-sm">Actualizar</button>
	      </div>
	    </div>
	  </div>
	</form>
</div>
	@section('my-js')
	<script type="text/javascript">
	    $(document).ready(function() {
	        var table = $('#tb').DataTable();
	    });
	</script>
	<script>

		$('#bsubmit').on('click', function(e){
    		e.preventDefault();
    		$.ajaxSetup({
		        headers: {
		            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		        }
		    });
            var form = $('#my_form').serialize();
		    var url = '{{ Route('tipos.store') }}';
		    $.ajax({
		        type: 'post',
		        url: url,
		        data: form,
		        dataType: 'json',
		        success: function(data) {
                        $("#tb").load(" #tb");
                        $('#createModal').modal('hide');
                        alertify.success("agregado con exito");
    		            console.log('success: '+data);
		        },
		        error: function(data) {
                    alertify.error("Fallo al agregar");
		            var errors = data.responseJSON;
		        }
		    });
		});

		function editar(id){
            $.ajaxSetup({
		        headers: {
		            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		        }
            });
            var url2 = location.href+'/editar/'+id;
		    $.ajax({
		        type: 'get',
		        url: url2,
		        success: function(data) {
                    $('#idu').val(data.id);
                    $('#nombreu').focus();
                    $('#nombreu').val(data.name);
                    $('#descripcionu').focus();
                    $('#descripcionu').val(data.description);
		        },
		        error: function(data) {
		            var errors = data.responseJSON;
		        }
		    });
		};

		$('#bsubmitu').on('click', function(e){  
	        e.preventDefault();
		    $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var id = $('#idu').val();
            var my_form_u = $('#my_form_u').serialize();
			var urlu = location.href+'/actualizar/'+id;
            $.ajax({
                type: 'post',
                url: urlu,
                data: my_form_u,
	        	dataType: 'JSON',
                success: function(data) {
                	console.log('ajax success');
                    $("#tb").load(" #tb");
                    $('#updateModal').modal('hide');
                    alertify.success("Editado con exito!");
                },
                error: function() {
                	console.log('ajax error');
                    $("#tb").load(" #tb");
                    $('#updateModal').modal('hide');
                    alertify.error("Problema para editar!");
                }
            });
        });

		function eliminar(id){
            $.ajaxSetup({
		        headers: {
		            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		        }
            });
            var url2 = location.href+'/eliminar/'+id;
		    $.ajax({
		        type: 'post',
		        url: url2,
		        success: function(data) {
                    $("#tb").load(" #tb");
		        	alertify.success('Eliminado con exito!');
		        },
		        error: function(data) {
		        	alertify.error('Problema para eliminar!');
		        }
		    });
		};
	</script>
	@stop
@stop