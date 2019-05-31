@extends('template.layout')
@section('title') Documentos @stop
@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
		        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#createModal">Nuevo</button>
		    </div>
			<div class="col-md-12">
				<table id="tb" class="display" style="width:100%">
					<thead class="black white-text">
						<tr>
							<th>#</th>
							<th>Cedula</th>
							<th>Titulo</th>
							<th>De</th>
							<th>Para</th>
							<th>Asunto</th>
							<th>Tipo de documento</th>
							<th>Fecha</th>
							<th>Accion</th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>


	<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
	  aria-hidden="true">
		<form action="" method="post" id="my_form" enctype="multipart/form-data">
		{{ csrf_field() }}
		  <div class="modal-dialog modal-lg" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h4 class="modal-title w-100" id="myModalLabel">Nuevo documento</h4>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body mx-3">
		        <div class="md-form mb-5">
		          <input type="text" name="ci" id="ci" class="form-control validate">
		          <label data-error="Error" data-success="Bien" for="ci">Cedula</label>
		        </div>
		        <div class="md-form mb-5">
		          <input type="text" name="title" id="title" class="form-control validate">
		          <label data-error="Error" data-success="Bien" for="title">Titulo</label>
		        </div>
		        <div class="md-form mb-5">
		          <input type="text" name="affair" id="affair" class="form-control validate">
		          <label data-error="Error" data-success="Bien" for="affair">Asunto</label>
		        </div>
		        <div class="md-form mb-5">
		          <input type="text" name="header" id="header" class="form-control validate">
		          <label data-error="Error" data-success="Bien" for="header">Encabezado</label>
		        </div>
		        <div class="md-form mb-5">
		          <input type="text" name="from" id="from" class="form-control validate">
		          <label data-error="Error" data-success="Bien" for="from">De</label>
		        </div>
		        <div class="md-form mb-5">
		          <input type="text" name="to" id="to" class="form-control validate">
		          <label data-error="Error" data-success="Bien" for="to">Para</label>
		        </div>
		        <div class="md-form mb-5">
		          <select type="text" name="document_type_id" id="document_type_id" class="form-control validate">
		          		<option selected disabled>Tipo de documento</option>
		          		@foreach($tipos as $tipo)
		          			<option value="{{ $tipo->id }}">{{ $tipo->name }}</option>
		          		@endforeach
		          </select>
				</div>
		        <div class="md-form mb-4">
		          <textarea name="text" id="text" class="form-control validate"></textarea>
		          <label data-error="Error" data-success="Bien" for="text">Texto</label>
		        </div>
		        <label data-error="Error" data-success="Bien" for="date">Fecha</label>
		        <div class="md-form mb-4">
		          <input  type="date" id="date" autofocus="true" name="date" class="form-control validate">
		        </div>
		        <div class="input-group">
				  <div class="input-group-prepend">
				    <span class="input-group-text" id="inputGroupFileAddon01">Subir</span>
				  </div>
				  <div class="custom-file">
				    <input type="file" name="file" class="custom-file-input" id="file"
				      aria-describedby="inputGroupFileAddon01">
				    <label class="custom-file-label" for="file">Selecciona el archivo</label>
				  </div>
				</div>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
		        <button type="submit" id="bsubmit" class="btn btn-primary btn-sm">Guardar</button>
		      </div>
		    </div>
		  </div>
		</form>
	</div>

	<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
	  aria-hidden="true">
		<form action="" method="post" id="my_formU" enctype="multipart/form-data">
		{{ csrf_field() }}
		  <div class="modal-dialog modal-lg" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h4 class="modal-title w-100" id="myModalLabel">Editar documento</h4>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body mx-3">
		        <div class="md-form mb-5">
		          <input type="hidden" name="id" id="idU">
		          <input type="text" name="ci" id="ciU" class="form-control validate">
		          <label data-error="Error" data-success="Bien" for="ciU">Cedula</label>
		        </div>
		        <div class="md-form mb-5">
		          <input type="text" name="title" id="titleU" class="form-control validate">
		          <label data-error="Error" data-success="Bien" for="titleU">Titulo</label>
		        </div>
		        <div class="md-form mb-5">
		          <input type="text" name="affair" id="affairU" class="form-control validate">
		          <label data-error="Error" data-success="Bien" for="affairU">Asunto</label>
		        </div>
		        <div class="md-form mb-5">
		          <input type="text" name="header" id="headerU" class="form-control validate">
		          <label data-error="Error" data-success="Bien" for="headerU">Encabezado</label>
		        </div>
		        <div class="md-form mb-5">
		          <input type="text" name="from" id="fromU" class="form-control validate">
		          <label data-error="Error" data-success="Bien" for="fromU">De</label>
		        </div>
		        <div class="md-form mb-5">
		          <input type="text" name="to" id="toU" class="form-control validate">
		          <label data-error="Error" data-success="Bien" for="toU">Para</label>
		        </div>
		        <div class="md-form mb-5">
		          <select type="text" name="document_type_id" id="document_type_idU" class="form-control validate">
		          		<option selected disabled>Tipo de documento</option>
		          		@foreach($tipos as $tipo)
		          			<option value="{{ $tipo->id }}">{{ $tipo->name }}</option>
		          		@endforeach
		          </select>
				</div>
		        <div class="md-form mb-4">
		          <textarea name="text" id="textU" class="form-control validate"></textarea>
		          <label data-error="Error" data-success="Bien" for="textU">Texto</label>
		        </div>
		        <label data-error="Error" data-success="Bien" for="dateU">Fecha</label>
		        <div class="md-form mb-4">
		          <input  type="date" id="dateU" autofocus="true" name="date" class="form-control validate">
		        </div>
		        <div class="input-group">
				  <div class="input-group-prepend">
				    <span class="input-group-text" id="inputGroupFileAddon01">Subir</span>
				  </div>
				  <div class="custom-file">
				    <input type="file" name="file" class="custom-file-input" id="fileU"
				      aria-describedby="inputGroupFileAddon01">
				    <label class="custom-file-label" for="fileU">Selecciona el archivo</label>
				  </div>
				</div>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
		        <button type="submit" id="bsubmit" class="btn btn-primary btn-sm">Actualizar</button>
		      </div>
		    </div>
		  </div>
		</form>
	</div>


	@section('my-js')
	<script>
	$(document).ready(function(){
		listar();
		$('#my_form').submit(function(e) {
			e.preventDefault();
			guardar();
		});
	});

	function guardar(){
		var formData = new FormData(document.getElementById("my_form"));
		formData.append("dato", "valor");
		let url = '{{ Route('documentos.store') }}';
		axios.post(url,formData)
	    .then(function(res) {
	      if(res.status==200) {
		    $('#createModal').modal('hide');
            alertify.success("agregado con exito!");
	        let tabla = $('#tb').DataTable();
		    tabla.ajax.reload( null, false );
	      }
	    })
	    .catch(function(err) {
	      alertify.error("error al guardar!");
	    });
	}

	function listar(){
		var tabla = $('#tb').DataTable({
			"processing": 'true',
			 "ajax": 'todos/documentos',
			 "columns": [
	            { "data": "id" },
	            { "data": "ci" },
	            { "data": "title" },
	            { "data": "from" },
	            { "data": "to" },
	            { "data": "affair" },
	            { "data": "type" },
	            { "data": "date" },
	            { "data": null, render: function(data,type,row){
	            	return `
	            	<a target="_blank" href='ver/documento/${data.id}' title='Ver' class='btn btn-info btn-sm'>Ver</a>
	            	<a href='#' onclick='editar("${data.id}")' data-toggle='modal' data-target='#updateModal' title='Editar' class='btn btn-warning btn-sm'>Editar</a>
	            	<a href='#' onclick='eliminar("${data.id}")' title='Eliminar' class='btn btn-danger btn-sm'>Eliminar</a>`;
	            }}
	    	]
		});
	}

	function editar(id){
		let url = 'editar/documento/'+id;
		axios.get(url).then(response=>{
			$('#idU').val(response.data.id);
	        $('#document_type_idU').val(response.data.document_type_id);
	        $('#dateU').val(response.data.date);
			$('#ciU').focus();
			$('#ciU').val(response.data.ci);
			$('#titleU').focus();
			$('#titleU').val(response.data.title);
			$('#affairU').focus();
	        $('#affairU').val(response.data.affair);
			$('#textU').focus();
	        $('#textU').val(response.data.text);
			$('#fromU').focus();
	        $('#fromU').val(response.data.from);
			$('#toU').focus();
	        $('#toU').val(response.data.to);
			$('#headerU').focus();
	        $('#headerU').val(response.data.header);
		});

	}

	$('#my_formU').submit(function(e) {
		e.preventDefault();
		let id = $('#idU').val();
		actualizar(id);
	});

	function actualizar(id){
		var formData = new FormData(document.getElementById("my_formU"));
		formData.append("dato", "valor");
		let url = 'actualizar/documento/'+id;
		axios.post(url,formData)
		.then(response=>{
		  	$('#updateModal').modal('hide');
            alertify.success("editado con exito!");
			let tabla = $('#tb').DataTable();
		    tabla.ajax.reload( null, false );
		});
	}

	function eliminar(id){
		let url = 'eliminar/documento/'+id;
		axios.delete(url).then(response=>{
			alertify.success("eliminado con exito!");
			let tabla = $('#tb').DataTable();
		    tabla.ajax.reload( null, false );
		});
	}
	</script>
	@stop
@stop
