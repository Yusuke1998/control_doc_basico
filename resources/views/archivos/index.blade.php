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
							<th>Titulo</th>
							<th>Asunto</th>
							<th>Tipo de documento</th>
							<th>Fecha</th>
							<th>Accion</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>data</td>
							<td>data</td>
							<td>data</td>
							<td>data</td>
							<td>data</td>
							<td>data</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>


	<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
	  aria-hidden="true">
		<form action="" method="post" id="my_form" enctype="multipart/form-data">
		{{-- enctype='multipart/form-data' --}}
		{{ csrf_field() }}
		  <!-- Change class .modal-sm to change the size of the modal -->
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
		{{-- enctype='multipart/form-data' --}}
		{{ csrf_field() }}
		  <!-- Change class .modal-sm to change the size of the modal -->
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
		        <button type="submit" id="bsubmit" class="btn btn-primary btn-sm">Guardar</button>
		      </div>
		    </div>
		  </div>
		</form>
	</div>


	@section('my-js')
	<script>
		$(document).ready(function(){
			alert('Hola mundo!');
		});
	</script>
	@stop
@stop
