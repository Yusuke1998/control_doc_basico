@extends('template.layout')
@section('title') Entrada de documentos @stop
@section('content')
<div class="text-center">
<a href="" class="btn btn-default btn-rounded mb-4" data-toggle="modal" data-target="#modalnewentrance">Nueva entrada</a>
</div>
<div class="row wow fadeIn">
<div class="col-md-12 mb-12">
  <div class="card">
	     <div class="card-header">Entradas</div>
    <div class="card-body">
      <table id="tb" class="table table-hover">
        <thead class="blue-grey lighten-4">
          <tr>
            <th>Codigo de documento</th>
            <th>De</th>
            <th>Para</th>
            <th>Comentario</th>
            <th>Fecha</th>
            <th scope="col">accion</th>
          </tr>
        </thead>
        <tbody>
          @forelse($entradas as $entrada)
          <tr>
            <td>{{ $entrada->document->code }}</td>
            <td>{{ $entrada->from }}</td>
            <td>{{ $entrada->to }}</td>
            <td>{{ $entrada->commentary }}</td>
            <td>{{ $entrada->date }}</td>
            <td>
                <a class="btn btn-sm" data-toggle="modal" data-target="#updateModal" onclick="editarP({{ $entrada->id }});" title="">Editar</a>

                <a class="btn btn-sm" id="eliminar" onclick="eliminar({{ $entrada->id }});">Eliminar</a>
            </td>
          </tr>
          @empty
          <tr>
            <p>No hay entradas...</p>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>
</div>

<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
aria-hidden="true">
  <form id="my_form" method="post">
    {{ csrf_field() }}
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header text-center">
          <h4 class="modal-title w-100 font-weight-bold">Detalles de la entrada</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body mx-3">
          <div class="md-form mb-5">
            <i class="fas fa-envelope prefix grey-text"></i>
            <input type="text" id="code" name="code" class="form-control validate">
            <label data-error="wrong" data-success="right" for="code">Codigo de documento</label>
          </div>
          <div class="md-form mb-5">
            <i class="fas fa-envelope prefix grey-text"></i>
            <input type="text" id="from" name="from" class="form-control validate">
            <label data-error="wrong" data-success="right" for="from">De</label>
          </div>
          <div class="md-form mb-4">
            <i class="fas fa-lock prefix grey-text"></i>
            <input type="text" name="to" id="to" class="form-control validate">
            <label data-error="Error" data-success="Bien" for="to-pass">Para</label>
          </div>
          <div class="md-form mb-5">
            <i class="fas fa-pencil-alt prefix"></i>
            <textarea type="text" id="commentary" name="commentary" class="md-textarea form-control" rows="3"></textarea>
            <label data-error="wrong" data-success="right" for="commentary">Comentario</label>
          </div>
          <select class="browser-default custom-select" name="product_id">
            <option selected disabled>Area</option>
            @foreach($areas as $area)
            	<option value="{{ $area->id }}">{{ $area->name }}</option>
            @endforeach
          </select>
          <select class="browser-default custom-select" name="product_id">
            <option selected disabled>Lugar</option>
            @foreach($lugares as $lugar)
            	<option value="{{ $lugar->id }}">{{ $lugar->name }}</option>
            @endforeach
          </select>
          
          <div class="md-form mb-5">
            <input placeholder="Ingresa fecha" type="date" name="date" id="date" class="form-control datepicker">
          </div>
        </div>
        <div class="modal-footer d-flex justify-content-center">
          <button id="esubmit" class="btn btn-default">Guardar</button>
        </div>
      </div>
    </div>
  </form>
</div>

<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
aria-hidden="true">
  <form id="my_form" method="post">
    {{ csrf_field() }}
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header text-center">
          <h4 class="modal-title w-100 font-weight-bold">Actualizar la entrada</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body mx-3">
          <div class="md-form mb-5">
            <i class="fas fa-envelope prefix grey-text"></i>
            <input type="text" id="codeu" name="code" class="form-control validate">
            <label data-error="wrong" data-success="right" for="code">Codigo de documento</label>
          </div>
          <div class="md-form mb-5">
            <i class="fas fa-envelope prefix grey-text"></i>
            <input type="text" id="fromu" name="from" class="form-control validate">
            <label data-error="wrong" data-success="right" for="from">De</label>
          </div>
          <div class="md-form mb-4">
            <i class="fas fa-lock prefix grey-text"></i>
            <input type="text" name="to" id="tou" class="form-control validate">
            <label data-error="Error" data-success="Bien" for="to-pass">Para</label>
          </div>
          <div class="md-form mb-5">
            <i class="fas fa-pencil-alt prefix"></i>
            <textarea type="text" id="commentaryu" name="commentary" class="md-textarea form-control" rows="3"></textarea>
            <label data-error="wrong" data-success="right" for="commentary">Comentario</label>
          </div>
          <select class="browser-default custom-select" id="areau" name="area_id">
            <option selected disabled>Area</option>
            @foreach($areas as $area)
            	<option value="{{ $area->id }}">{{ $area->name }}</option>
            @endforeach
          </select>
          <select class="browser-default custom-select" name="site_id" id="siteu">
            <option selected disabled>Lugar</option>
            @foreach($lugares as $lugar)
            	<option value="{{ $lugar->id }}">{{ $lugar->name }}</option>
            @endforeach
          </select>
          
          <div class="md-form mb-5">
            <input placeholder="Ingresa fecha" type="date" name="date" id="dateu" class="form-control datepicker">
          </div>
        </div>
        <div class="modal-footer d-flex justify-content-center">
          <button id="esubmit" class="btn btn-default">Guardar</button>
        </div>
      </div>
    </div>
  </form>
</div>
@stop
