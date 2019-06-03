@extends('template.layout')
@section('title') {{ $dato->document->title }} @stop
@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
				  <div class="card-body row">
				    <div class="card-text col-md-12 row">
				    	<div class="col-md-12 text-center">
				    		<b> {{ $dato->document->code }}</b>
				    	</div>
					</div>
					<hr>
					<div class="card-text col-md-12 row">
				    	<div class="col-md-12 text-left">
				    		DE: <b> {{ $dato->from}}</b>
				    	</div>
					</div>
					<hr>
					<div class="card-text col-md-12 row">
				    	<div class="col-md-12 text-left">
				    		PARA: <b> {{ $dato->to}}</b>
				    	</div>
					</div>
					<hr>
					<div class="card-text col-md-12 row">
				    	<div class="col-md-12 text-left">
				    		COMENTARIO: <b> {{ $dato->commentary}}</b>
				    	</div>
					</div>
					<hr>
					<div class="card-text col-md-12 row">
				    	<div class="col-md-12 text-left">
				    		TITULO DE DOCUMENTO: <b> {{ $dato->document->title}}</b>
				    	</div>
					</div>
					<hr>
					<div class="card-text col-md-12 row">
				    	<div class="col-md-12 text-left">
				    		ASUNTO DE DOCUMENTO: <b> {{ $dato->document->affair}}</b>
				    	</div>
					</div>
					<hr>
					<div class="card-text col-md-12 row">
				    	<div class="col-md-12 text-left">
				    		TEXTO DE DOCUMENTO: <b> {{ $dato->document->text}}</b>
				    	</div>
					</div>
					<hr>
					<div class="card-text col-md-12 row">
				    	<div class="col-md-12 text-left">
				    		CEDULA DE PERSONA ASOCIADA AL DOCUMENTO: <b> {{ $dato->document->person->ci}}</b>
				    	</div>
					</div>
					<hr>
					<div class="card-text col-md-12 row">
				    	<div class="col-md-12 text-left">
				    		NOMBRES DE PERSONA ASOCIADA AL DOCUMENTO: <b> {{ $dato->document->person->firstname}}</b>
				    	</div>
					</div>
					<hr>
					<div class="card-text col-md-12 row">
				    	<div class="col-md-12 text-left">
				    		APELLIDOS DE PERSONA ASOCIADA AL DOCUMENTO: <b> {{ $dato->document->person->lastname}}</b>
				    	</div>
					</div>
					<hr>
					<div class="card-text col-md-12 row">
				    	<div class="col-md-12 text-left">
				    		FECHA: <b> {{ date('d/m/Y',strtotime($dato->date)) }}</b></div>
				    	</div>
					</div>
				  </div>
				</div>
			</div>
		</div>
	</div>
@stop