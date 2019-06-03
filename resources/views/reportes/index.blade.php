 @extends('template.layout')
@section('title') DOCUMENTOS @stop
@section('content')
	<div class="container">
		<div class="row">
		    <div class="col-md-12">
				<p class="h3" align="center">Todos los reportes ofrecidos por el sistema</p>
		    </div>
		    <div class="col-md-12 row mt-3">
		    	<p class="h5 col-md-12" align="center">TOTAL DE DOCUMENTOS</p>
		    	<table class="table text-center">
		    		<thead>
		    			<tr>
		    				<th>DIA</th>
		    				<th>SEMANA</th>
		    				<th>MES</th>
		    				<th>AÑO</th>
		    			</tr>
		    		</thead>
		    		<tbody>
		    			<tr>
		    				<td>
		    					<div class="btn-group btn-group-lg" role="group" aria-label="Basic example">
		    						<a href="{{ route('documento.pdf','dia') }}" class="btn btn-primary btn-sm">PDF</a>
		    					</div>
		    				</td>
		    				<td>
		    					<div class="btn-group btn-group-lg" role="group" aria-label="Basic example">
		    						<a href="{{ route('documento.pdf','semana') }}" class="btn btn-primary btn-sm">PDF</a>
		    					</div>
		    				</td>
		    				<td>
		    					<div class="btn-group btn-group-lg" role="group" aria-label="Basic example">
		    						<a href="{{ route('documento.pdf','mes') }}" class="btn btn-primary btn-sm">PDF</a>
		    					</div>
		    				</td>
		    				<td>
		    					<div class="btn-group btn-group-lg" role="group" aria-label="Basic example">
		    						<a href="{{ route('documento.pdf','anio') }}" class="btn btn-primary btn-sm">PDF</a>
		    					</div>
		    				</td>
		    			</tr>
		    		</tbody>
		    	</table>
		    </div>
		</div>
	</div>
@stop