@extends('layouts.template-reporte')
@section('content')
	<small>
		<p align="center">Reporte de documentos.</p>
	</small>
	<table id="tb" class="table table-striped table-bordered tb" cellspacing="0" width="100%">
	  <thead class="black white-text">
	    <tr>
	      <th scope="col">Codigo</th>
	      <th scope="col">De</th>
	      <th scope="col">Para</th>
	      <th scope="col">Asunto</th>
	      <th scope="col">Cedula</th>
	      <th scope="col">Fecha</th>
	      <th scope="col">Archivo</th>
	    </tr>
	  </thead>
	  <tbody>
	    @foreach($documentos as $documento)
	    <tr>
          <th>{{ $documento->code }}</th>
	      <td>{{ $documento->from }}</td>
	      <td>{{ $documento->to }}</td>
	      <td>{{ $documento->affair }}</td>
	      <td>{{ $documento->person->ci }}</td>
	      <td>{{ $documento->date }}</td>
	      <td>{{ ($documento->file)?'Si':'No' }}</td>
	    </tr>
	    @endforeach
	  </tbody>
	</table>
@stop