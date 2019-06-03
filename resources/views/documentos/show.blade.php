@extends('template.layout')
@section('title') @if(isset($documento['title'])) {{ $documento['title'] }} @else Documento sin titulo @endif @stop
@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
				  <div class="card-body row">
				    <div class="card-text col-md-12 row">
					    @if(isset($documento['header'])&&!empty($documento['header']))
					    	<div class="col-md-12 text-left">
					    		{{ $documento['header'] }}
					    	</div>
					    @endif
					    @if(isset($documento['date'])&&!empty($documento['date']))
					    	<div class="col-md-12 text-right">
					    		{{ $documento['date'] }}
					    	</div>
					    @endif
					</div>
					@if(isset($documento['code'])&&!empty($documento['code']))
				    	<h4 class="card-title col-md-12 text-center mb-5">{{ $documento['code'] }}</h4>
				    @endif

					@if(isset($documento['from'])&&!empty($documento['from']))
				    	<h6 class="card-title col-md-2">De: </h6><h6 class="card-title col-md-10">{{ $documento['from'] }}</h6>
				    @endif
				    
					@if(isset($documento['to'])&&!empty($documento['to']))
				    	<h6 class="card-title col-md-2">Para: </h6><h6 class="card-title col-md-10">{{ $documento['to'] }}</h6>
				    @endif
				    
					@if(isset($documento['affair'])&&!empty($documento['affair']))
				    	<h6 class="card-title col-md-2">Asunto: </h6><h6 class="card-title col-md-10">{{ $documento['affair'] }}</h6>
				    @endif

				    @if(isset($documento['text'])&&!empty($documento['text']))
				    	<p class="card-text col-md-12 text-justify mb-5 mt-5">{{ $documento['text'] }}</p>
				    @endif
				    @if(isset($documento['user'])&&!empty($documento['user']))
				    	<h6 class="card-title col-md-12">Att: {{ $documento['user'] }}</h6>
				    @endif
				    @if(isset($documento['position'])&&!empty($documento['position']))
				    	<h6 class="card-title col-md-12">{{ $documento['position'] }}</h6>
				    @endif
				  </div>
				</div>
				<!-- Button -->	
				<a href="{{ route('pdf',$documento['id']) }}" class="btn btn-primary btn-sm">PDF</a>
				@if(isset($documento['file_id']) && !empty($documento['file_id']))
				<a href="{{ route('archivos.ver',$documento['file_id']) }}" title="Ir al archivo" class="btn btn-primary btn-sm">ARCHIVO</a>
				@endif
				<!-- Card -->
			</div>
		</div>
	</div>
@stop