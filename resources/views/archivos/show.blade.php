@extends('template.layout')
@section('title') Archivo @stop
@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<!-- Card -->
				<div class="card">
				  <!-- Card image -->
				  <div class="view overlay">
				    <a href="#!">
				      <div class="mask rgba-white-slight">
				      </div>
				    </a>
				  </div>
				  <!-- Card content -->
				  <div class="card-body row">
				      	<div class="col-md-12 text-right">{{ $archivo['date'] }}</div>
				      	<div class="col-md-4 text-left">TITULO:</div>
				      	<div class="col-md-6">{{ $archivo['title'] }}</div>
				      	<div class="col-md-4 text-left">CODIGO:</div>
				      	<div class="col-md-6">{{ $archivo['code'] }}</div>
				      	<div class="col-md-4 text-left">ASUNTO:</div>
				      	<div class="col-md-6">{{ $archivo['affair'] }}</div>
				      	<div class="col-md-4 text-left">CEDULA:</div>
				      	<div class="col-md-6">{{ $archivo['ci'] }}</div>
				      	<div class="col-md-4 text-left">ARCHIVO:</div>
				      	<div class="col-md-6">{{ $archivo['file'] }}</div>
				  </div>
				</div>
				<!-- Button -->	
				<a href="{{ route('archivos.descargar',$archivo['id']) }}" class="btn btn-primary btn-sm">DESCARGAR ARCHIVO</a>
				<!-- Card -->
			</div>
		</div>
	</div>
@stop