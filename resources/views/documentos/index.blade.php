@extends('template.layout')
@section('title') Documentos @stop
@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
		        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#createModal">Nuevo</button>
		    </div>
			<div class="col-md-12">
				<table id="tb" class="table table-striped table-bordered">
					<thead class="black white-text">
						<tr>
							<th>#</th>
							<th>Titulo</th>
							<th>De</th>
							<th>Para</th>
							<th>Asunto</th>
							<th>Fecha</th>
							<th>Tipo de documento</th>
							<th>Accion</th>
						</tr>
					</thead>
					<tbody>
						@foreach($documentos as $documento)
						<tr>
							<td>data</td>
							<td>data</td>
							<td>data</td>
							<td>data</td>
							<td>data</td>
							<td>data</td>
							<td>data</td>
							<td>
								<a class="btn btn-sm" href="{{ Route('documentos.ver',$documento->id) }}" title="">Ver</a>

								<a class="btn btn-sm" data-toggle="modal" data-target="#updateModal" onclick="editar({{ $documento->id }});" title="">Editar</a>

				      			<a class="btn btn-sm" id="eliminar" href="{{ Route('documentos.destroy',$documento->id) }}" title="Eliminar">Eliminar</a>
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
		<form action="" method="post" id="my_form">
		{{-- enctype='multipart/form-data' --}}
		{{ csrf_field() }}
		  <!-- Change class .modal-sm to change the size of the modal -->
		  <div class="modal-dialog modal-md" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h4 class="modal-title w-100" id="myModalLabel">Nuevo producto</h4>
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
		          <select type="text" name="type" id="tipo" class="form-control validate">
		          		<option selected disabled>Tipo de documento</option>
		          </select>
				</div>
		        <div class="md-form mb-4">
		          <textarea name="text" id="text" class="form-control validate"></textarea>
		          <label data-error="Error" data-success="Bien" for="text">Texto</label>
		        </div>
		        <label data-error="Error" data-success="Bien" for="fechaC">Fecha</label>
		        <div class="md-form mb-4">
		          <input type="date" id="fechaC" autofocus="true" name="date" class="form-control validate">
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
@stop