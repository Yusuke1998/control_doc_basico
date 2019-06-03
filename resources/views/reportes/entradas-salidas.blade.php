@extends('layouts.template-reporte')
@section('content')
	<small>
		<p align="center">{{ $title[0] }}.</p>
	</small>
	<table id="tb" class="table table-striped table-bordered tb" cellspacing="0" width="100%">
	  <thead class="black white-text">
	    <tr>
	      <th scope="col">Codigo</th>
	      <th scope="col">De</th>
	      <th scope="col">Para</th>
	      <th scope="col">Cedula</th>
	      <th scope="col">Area</th>
	      <th scope="col">Lugar</th>
	      <th scope="col">Fecha</th>
	      <th scope="col">Archivo</th>
	    </tr>
	  </thead>
	  <tbody>
	    @foreach($datos as $dato)
	    <tr>
          <th>{{ ($dato->document)?$dato->document->code:'No especificado' }}</th>
	      <td>{{ ($dato->from)?$dato->from:'No especificado' }}</td>
	      <td>{{ ($dato->to)?$dato->to:'No especificado' }}</td>
	      <td>{{ ($dato->document)?$dato->document->person->ci:'No especificado' }}</td>
	      <td>{{ ($dato->area)?$dato->area->name:'No especificado' }}</td>
	      <td>{{ ($dato->site)?$dato->site->name:'No especificado' }}</td>
	      <td>{{ $dato->date }}</td>
	      <td>{{ ($dato->document->file)?'Si':'No' }}</td>
	    </tr>
	    @endforeach
	  </tbody>
	</table>
@stop