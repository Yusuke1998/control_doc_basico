@extends('template.layout')
@section('title') {{ $documento['title'] }} @stop
@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<!-- Card -->
				<div class="card">
				  <!-- Card image -->
				  <div class="view overlay">
				    <a href="#!">
				      <div class="mask rgba-white-slight"></div>
				    </a>
				  </div>
				  <!-- Card content -->
				  <div class="card-body row">
				    <!-- Title -->
				    <div class="card-text col-md-12 row">
				    	<div class="col-md-6 text-left">{{ $documento['header'] }}</div>
				    	<div class="col-md-6 text-right">{{ $documento['date'] }}</div>
					</div>
				    <h4 class="card-title col-md-12 text-center mb-5">{{ $documento['title'] }} N°{{ $documento['code'] }}</h4>
				    <h6 class="card-title col-md-2">De: </h6><h6 class="card-title col-md-10">{{ $documento['from'] }}</h6>
				    <h6 class="card-title col-md-2">Para: </h6><h6 class="card-title col-md-10">{{ $documento['to'] }}</h6>
				    <h6 class="card-title col-md-2">Asunto: </h6><h6 class="card-title col-md-10">{{ $documento['affair'] }}</h6>
				    <!-- Text -->
				    <p class="card-text col-md-12 text-justify mb-5 mt-5">{{ $documento['text'] }}</p>
				    <h6 class="card-title col-md-12">Att: Jhonny Pérez</h6>
				    <h6 class="card-title col-md-12">Director de recursos humanos</h6>
				  </div>
				</div>
				<!-- Button -->	
				<a href="#" class="btn btn-primary btn-sm">PDF</a>
				<!-- Card -->
			</div>
		</div>
	</div>
@stop