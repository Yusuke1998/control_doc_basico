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
							<th>Accion</th>
						</tr>
					</thead>
					<tbody>
						@foreach($tipos as $tipo)
						<tr>
							<td>{{ $tipo->id }}</td>
							<td>{{ $tipo->name }}</td>
							<td>
								<a class="btn btn-sm" data-toggle="modal" data-target="#updateModal" onclick="editar({{ $tipo->id }});" title="">Editar</a>

				      			<a class="btn btn-sm" id="eliminar" href="{{ Route('tipos.eliminar',$tipo->id) }}" title="Eliminar">Eliminar</a>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
@stop