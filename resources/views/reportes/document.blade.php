<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Documento {{ $documento['title'] }}</title>
</head>
	<body>
<style>

html {
	margin: 0;
	padding: 10;
}

p {
  margin-top: 0;
  margin-bottom: 1rem;
}

.container {
  width: 100%;
  padding-right: 25px;
  padding-left: 25px;
  padding-bottom: 30px;
  padding-top: 30px;
  margin-right: auto;
  margin-left: auto;
}

.text-justify {
  text-align: justify;
}

.text-left {
  text-align: left;
}

.text-right {
  text-align: right;
}

.text-center {
  text-align: center;
}

.gray {
	background: lightgray;
}

.underline {
	text-decoration: underline;
}

.mayus {
	text-transform: uppercase;
}

</style>
		<div class="container">
		    <div>
		    	@if(isset($documento['header']))
			    	<div class="text-left">
			    		<small>{{ $documento['header'] }}</small>
			    	</div>
		    	@endif
		    	@if(isset($documento['date']))
			    	<div class="text-right">
			    		<small>{{ $documento['date'] }}</small>
			    	</div>
		    	@endif
			</div>
			@if(isset($documento['code']))
		    	<h3 class="text-center underline mayus">{{ $documento['code'] }}</h3>
		    @endif
			@if(isset($documento['from']))
		    	<p class="mayus">De: {{ $documento['from'] }}</p>
		    @endif
			@if(isset($documento['to']))
		    	<p class="mayus">Para: {{ $documento['to'] }}</p>
		    @endif
			@if(isset($documento['affair']))
		    	<p class="mayus">Asunto: {{ $documento['affair'] }}</p>
		    @endif
			<div class="text-justify mayus">
			    <p>
			    	{{ $documento['text'] }}
			    </p>
			</div>
		    @if(isset($documento['user']))
		    	<p >Att: {{ $documento['user'] }}</p>
		    @endif
		    @if(isset($documento['position']))
		    	<p >{{ $documento['position'] }}</p>
		    @endif
		</div>
	</body>
</html>