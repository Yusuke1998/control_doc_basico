<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>
		@yield('title')
	</title>
</head>
<body>
<style>
	.page-break {
	    page-break-after: always;
	}

	table {
	  width: 100%;
	  margin: 0 auto;
	  clear: both;
	  border-collapse: separate;
	  border-spacing: 0;
	}

	thead th, tfoot th {
	  font-weight: bold;
	}
	
	thead th, thead td {
	  padding: 10px 18px;
	  border-bottom: 1px solid #111;
	}

	tfoot td {
	  padding: 10px 18px 6px 18px;
	  border-top: 1px solid #111;
	}

	td {
		text-align: center;
	}

	div {
	    display: block;
	}

	.list-group {
	    display: -webkit-box;
	    display: -ms-flexbox;
	    display: flex;
	    -webkit-box-orient: vertical;
	    -webkit-box-direction: normal;
	    -ms-flex-direction: column;
	    flex-direction: column;
	    padding-left: 0;
	    margin-bottom: 0;
	}

	.list-group-item {
	    position: relative;
	    display: block;
	    padding: .75rem 1.25rem;
	    margin-bottom: -1px;
	    background-color: #fff;
	    border: 1px solid rgba(0,0,0,.125);
	}

	.list-group-item-action {
	    width: 100%;
	    color: #495057;
	    text-align: inherit;
	}

	.bd-example {
	    position: relative;
	    padding: 1rem;
	    margin: 1rem -15px 0;
	    border: solid #f7f7f9;
	    border-width: .2rem 0 0;
	}

	.bd-example::after {
	    display: block;
	    clear: both;
	    content: "";
	}
</style>
@yield('style')
	<p style="text-align: right;">Fecha: {{ date('d/m/Y') }}</p>
	<p align="center"> @yield('title') </p>
	@yield('content')
</body>
</body>
</html>