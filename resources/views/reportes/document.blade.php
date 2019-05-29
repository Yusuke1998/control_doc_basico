@extends('layouts.template-reporte')
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
			    	@if(isset($documento['header']))
			    	<div class="col-md-6 text-left">{{ $documento['header'] }}</div>
			    	@endif
			    	@if(isset($documento['date']))
			    	<div class="col-md-6 text-right">{{ $documento['date'] }}</div>
			    	@endif
				</div>
				@if(isset($documento['code']))
			    <h4 class="card-title col-md-12 text-center mb-5">N°{{ $documento['code'] }}</h4>
			    @endif

				@if(isset($documento['from']))
			    <h6 class="card-title col-md-2">De: </h6><h6 class="card-title col-md-10">{{ $documento['from'] }}</h6>
			    @endif
			    
				@if(isset($documento['to']))
			    <h6 class="card-title col-md-2">Para: </h6><h6 class="card-title col-md-10">{{ $documento['to'] }}</h6>
			    @endif
			    
				@if(isset($documento['affair']))
			    <h6 class="card-title col-md-2">Asunto: </h6><h6 class="card-title col-md-10">{{ $documento['affair'] }}</h6>
			    @endif
			    <!-- Text -->
			    <p class="card-text col-md-12 text-justify mb-5 mt-5">{{ $documento['text'] }}</p>
			    @if(isset($documento['user']))
			    <h6 class="card-title col-md-12">Att: {{ $documento['user'] }}</h6>
			    @endif
			    @if(isset($documento['position']))
			    <h6 class="card-title col-md-12">{{ $documento['position'] }}</h6>
			    @endif
			  </div>
			</div>
			<!-- Button -->	
			<a href="#" class="btn btn-primary btn-sm">PDF</a>
			@if(isset($documento['file_id']) && !empty($documento['file_id']))
			<a href="{{ route('archivos.show',$documento['file_id']) }}" title="Ir al archivo" class="btn btn-primary btn-sm">ARCHIVO</a>
			@endif
			<!-- Card -->
		</div>
	</div>
</div>
@stop