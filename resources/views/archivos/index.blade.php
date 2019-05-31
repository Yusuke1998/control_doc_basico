@extends('template.layout')
@section('title') Archivos @stop
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
		        <h4 class="modal-title w-100" id="myModalLabel">Nuevo archivo</h4>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body mx-3">
		      	<div class="md-form mb-5">
		          <input type="text" name="ci" id="ci" class="form-control validate">
		          <label data-error="Error" data-success="Bien" for="toU">Cedula</label>
		        </div>
		        <div class="md-form mb-5">
		          <input type="text" name="code" id="code" class="form-control validate">
		          <label data-error="Error" data-success="Bien" for="code">Codigo</label>
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
		          <select type="text" name="document_type_id" id="document_type_id" class="form-control validate">
		          		<option selected disabled>Tipo de documento</option>
		          		@foreach($tipos as $tipo)
		          			<option value="{{ $tipo->id }}">{{ $tipo->name }}</option>
		          		@endforeach
		          </select>
				</div>
		        <label data-error="Error" data-success="Bien" for="fechaC">Fecha</label>
		        <div class="md-form mb-4">
		          <input  type="date" id="fechaC" autofocus="true" name="date" class="form-control validate">
		        </div>
		        <div class="input-group">
				  <div class="input-group-prepend">
				    <span class="input-group-text" id="inputGroupFileAddon01">Subir</span>
				  </div>
				  <div class="custom-file">
				    <input type="file" name="file" class="custom-file-input" id="file"
				      aria-describedby="inputGroupFileAddon01">
				    <label class="custom-file-label" for="fileU">Selecciona el archivo</label>
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
		        <h4 class="modal-title w-100" id="myModalLabel">Editar archivo</h4>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body mx-3">
		      	<div class="md-form mb-5">
		          <input type="text" name="ci" id="ciU" class="form-control validate">
		          <label data-error="Error" data-success="Bien" for="ciU">Cedula</label>
		        </div>
		        <div class="md-form mb-5">
		          <input type="text" name="code" id="codeU" class="form-control validate">
		          <label data-error="Error" data-success="Bien" for="codeU">Codigo</label>
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
		          <select type="text" name="document_type_id" id="document_type_idU" class="form-control validate">
		          		<option selected disabled>Tipo de documento</option>
		          		@foreach($tipos as $tipo)
		          			<option value="{{ $tipo->id }}">{{ $tipo->name }}</option>
		          		@endforeach
		          </select>
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
		let url = '{{ Route('archivos.store') }}';
		axios.post(url,formData)
	    .then(function(res) {
	      if(res.status==200) {
		    $('#createModal').modal('toggle');
            alertify.success("agregado con exito!");
	        let tabla = $('#tb').DataTable();
		    tabla.ajax.reload( null, false );
	        $('#name').val('');
	      }
	    })
	    .catch(function(err) {
	      alertify.error("error al guardar!");
	    });
	}

	function listar(){
		var tabla = $('#tb').DataTable({
			"processing": 'true',
			 "ajax": 'todos/archivos',
			 "columns": [
	            { "data": "id" },
	            { "data": "ci" },
	            { "data": "title" },
	            { "data": "affair" },
	            { "data": "type" },
	            { "data": "date" },
	            { "data": null, render: function(data,type,row){
	            	return `
	            	<a target="_blank" href='ver/archivo/${data.id}' title='Ver' class='btn btn-info btn-sm'>Ver</a>
	            	<a href='#' onclick='editar("${data.id}")' data-toggle='modal' data-target='#updateModal' title='Editar' class='btn btn-warning btn-sm'>Editar</a>
	            	<a href='#' onclick='eliminar("${data.id}")' title='Eliminar' class='btn btn-danger btn-sm'>Eliminar</a>`;
	            }}
	    	]
		});
	}

	function editar(id){
		let url = 'editar/archivo/'+id;
		axios.get(url).then(response=>{
			$('#ciU').focus();
			$('#ciU').val(response.data.ci);
			$('#codeU').focus();
			$('#codeU').click().val(response.data.code);
			$('#titleU').focus();
			$('#titleU').val(response.data.title);
			$('#affairU').focus();
	        $('#affairU').val(response.data.affair);
			$('#idU').val(response.data.id);
	        $('#document_type_idU').val(response.data.document_type_id);
	        $('#dateU').val(response.data.date);
		});
		
		$('#my_formU').submit(function(e) {
			e.preventDefault();
			actualizar(id);
		});
	}
	

	function actualizar(id){
		var formData = new FormData(document.getElementById("my_formU"));
		formData.append("dato", "valor");
		let url = 'actualizar/archivo/'+id;
		axios.post(url,formData).then(response=>{
		    $('#updateModal').modal('toggle');
	        $('#ciU').val('');
	        $('#codeU').val('');
	        $('#titleU').val('');
	        $('#affairU').val('');
	        $('#textU').val('');
	        $('#document_type_idU').val('');
	        $('#dateU').val('');
	        $('#fromU').val('');
	        $('#toU').val('');
	        $('#headerU').val('');
            alertify.success("editado con exito!");
			
		let tabla = $('#tb').DataTable();
		    tabla.ajax.reload( null, false );
		});

	}

	function eliminar(id){
		let url = 'eliminar/archivo/'+id;
		axios.delete(url).then(response=>{
			alertify.success("eliminado con exito!");
			let tabla = $('#tb').DataTable();
		    tabla.ajax.reload( null, false );
		});
	}
	</script>
	@stop
@stop
