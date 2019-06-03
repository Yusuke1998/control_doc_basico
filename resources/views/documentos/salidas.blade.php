@extends('template.layout')
@section('title') Salida de documentos @stop
@section('content')
<div class="text-center">
<a href="" class="btn btn-default btn-rounded mb-4" data-toggle="modal" data-target="#createModal">Nueva salida</a>
</div>
<div class="row wow fadeIn">
<div class="col-md-12 mb-12">
  <div class="card">
	     <div class="card-header">Salidas</div>
    <div class="card-body">
      <table id="tb" class="table table-hover">
        <thead class="blue-grey lighten-4">
          <tr>
            <th>Codigo de documento</th>
            <th>De</th>
            <th>Para</th>
            <th>Comentario</th>
            <th>Fecha</th>
            <th scope="col">accion</th>
          </tr>
        </thead>
        <tbody>
          @foreach($salidas as $salida)
          <tr>
            <td>{{ $salida->document->code }}</td>
            <td>{{ $salida->from }}</td>
            <td>{{ $salida->to }}</td>
            <td>{{ $salida->commentary }}</td>
            <td>{{ $salida->date }}</td>
            <td>
                <a class="btn btn-sm" data-toggle="modal" data-target="#updateModal" onclick="editar({{ $salida->id }});" title="">Editar</a>

                <a class="btn btn-sm" id="eliminar" onclick="eliminar({{ $salida->id }});">Eliminar</a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
</div>

<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
aria-hidden="true">
  <form id="my_form" method="post">
    {{ csrf_field() }}
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header text-center">
          <h4 class="modal-title w-100 font-weight-bold">Detalles de la salida</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body mx-3">
          <div class="md-form mb-1">
            <i class="fas fa-envelope prefix grey-text"></i>
            <input type="hidden" name="document_id" id="document_id">
            <input type="text" id="code" name="code" class="form-control validate">
            <label data-error="wrong" data-success="right" for="code">Codigo de documento</label>
          </div>
          <div class="md-form mb-5">
            <div class="text-center col-md-12">
              <button type="button" id="btn-code" class="btn btn-sm btn-pink btn-block btn-rounded z-depth-1">Buscar documento</button>
            </div>
          </div>
          <div class="md-form mb-5">
            <i class="fas fa-envelope prefix grey-text"></i>
            <input type="text" id="from" name="from" class="form-control validate">
            <label data-error="wrong" data-success="right" for="from">De</label>
          </div>
          <div class="md-form mb-4">
            <i class="fas fa-lock prefix grey-text"></i>
            <input type="text" name="to" id="to" class="form-control validate">
            <label data-error="Error" data-success="Bien" for="to-pass">Para</label>
          </div>
          <div class="md-form mb-5">
            <i class="fas fa-pencil-alt prefix"></i>
            <textarea type="text" id="commentary" name="commentary" class="md-textarea form-control" rows="3"></textarea>
            <label data-error="wrong" data-success="right" for="commentary">Comentario</label>
          </div>
          <select class="browser-default custom-select" name="area_id" id="area_id">
            <option selected disabled>Area</option>
            @foreach($areas as $area)
              <option value="{{ $area->id }}">{{ $area->name }}</option>
            @endforeach
          </select>
          <select class="browser-default custom-select" id="site_id" name="site_id">
            <option selected disabled>Lugar</option>
          </select>
          <div class="md-form mb-5">
            <input placeholder="Ingresa fecha" type="date" name="date" id="date" class="form-control datepicker">
          </div>
        </div>
        <div class="modal-footer d-flex justify-content-center">
          <button id="bsubmit" class="btn btn-default">Guardar</button>
        </div>
      </div>
    </div>
  </form>
</div>

<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
aria-hidden="true">
  <form id="my_form_u" method="post">
    {{ csrf_field() }}
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header text-center">
          <h4 class="modal-title w-100 font-weight-bold">Actualizar la salida</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body mx-3">
          <div class="md-form mb-5">
            <i class="fas fa-envelope prefix grey-text"></i>
            <input type="hidden" name="id" id="idu">
            <input type="hidden" name="document_id" id="document_idu">
            <input type="text" id="codeu" name="code" class="form-control validate">
            <label data-error="wrong" data-success="right" for="codeu">Codigo de documento</label>
          </div>
          <div class="md-form mb-5">
            <i class="fas fa-envelope prefix grey-text"></i>
            <input type="text" id="fromu" name="from" class="form-control validate">
            <label data-error="wrong" data-success="right" for="fromu">De</label>
          </div>
          <div class="md-form mb-4">
            <i class="fas fa-lock prefix grey-text"></i>
            <input type="text" name="to" id="tou" class="form-control validate">
            <label data-error="Error" data-success="Bien" for="tou">Para</label>
          </div>
          <div class="md-form mb-5">
            <i class="fas fa-pencil-alt prefix"></i>
            <textarea type="text" id="commentaryu" name="commentary" class="md-textarea form-control" rows="3"></textarea>
            <label data-error="wrong" data-success="right" for="commentaryu">Comentario</label>
          </div>
          <select class="browser-default custom-select" id="areau" name="area_id">
            <option selected disabled>Area</option>
            @foreach($areas as $area)
            	<option value="{{ $area->id }}">{{ $area->name }}</option>
            @endforeach
          </select>
          <select class="browser-default custom-select" name="site_id" id="siteu">
            <option selected disabled>Lugar</option>
            @foreach($lugares as $lugar)
            	<option value="{{ $lugar->id }}">{{ $lugar->name }}</option>
            @endforeach
          </select>
          
          <div class="md-form mb-5">
            <input placeholder="Ingresa fecha" type="date" name="date" id="dateu" class="form-control datepicker">
          </div>
        </div>
        <div class="modal-footer d-flex justify-content-center">
          <button id="bsubmitu" class="btn btn-default">Actualizar</button>
        </div>
      </div>
    </div>
  </form>
</div>
@section('my-js')
	<script type="text/javascript">
	    $(document).ready(function() {
	        var table = $('#tb').DataTable();
	    });
	</script>
	<script>

		$('#bsubmit').on('click', function(e){
    		e.preventDefault();
    		$.ajaxSetup({
		        headers: {
		            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		        }
		    });
            var form = $('#my_form').serialize();
		    var url = '{{ Route('salidas.store') }}';
		    $.ajax({
		        type: 'post',
		        url: url,
		        data: form,
		        dataType: 'json',
		        success: function(data) {
                        $("#tb").load(" #tb");
                        $('#createModal').modal('hide');
                        alertify.success("agregado con exito");
    		            console.log('success: '+data);
		        },
		        error: function(data) {
                    alertify.error("Fallo al agregar");
		            var errors = data.responseJSON;
		        }
		    });
		});

		$('#btn-code').click(function(event){
			event.preventDefault();
			var code = $('#code').val();
			var url = location.href+'/buscar/'+code;
      if (code == '') {
        alertify.error('Debes ingresar un codigo!');
      }
			$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
	        type: 'get',
	        url: url,
	        success: function(data) {
            if (data.code) {
                $('#document_id').val(data.id);
                $('#code').focus();
                $('#code').val(data.code);
                $('#from').focus();
                $('#from').val(data.from);
                $('#to').focus();
                $('#to').val(data.to);
                alertify.success('El documento fue encontrado!');
            }else{
                alertify.error('El documento no existe!');
                $('#document_id').val('');
                $('#code').val('');
                $('#from').val('');
                $('#to').val('');
            }
	        },
	        error: function(data) {
	            console.log('Error de conexion o busqueda!');
	        }
	    });
		});

		function editar(id){
            $.ajaxSetup({
		        headers: {
		            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		        }
            });
            var url2 = location.href+'/editar/'+id;
		    $.ajax({
		        type: 'get',
		        url: url2,
		        success: function(data) {
                    $('#idu').val(data.id);
                    $('#document_idu').val(data.document_id);
                    $('#codeu').focus();
                    $('#codeu').val(data.code);
                    $('#fromu').focus();
                    $('#fromu').val(data.from);
                    $('#tou').focus();
                    $('#tou').val(data.to);
                    $('#commentaryu').focus();
                    $('#commentaryu').val(data.commentary);
                    $('#areau').focus();
                    $('#areau').val(data.area_id);
                    $('#siteu').focus();
                    $('#siteu').val(data.site_id);
                    $('#dateu').focus();
                    $('#dateu').val(data.date);
		        },
		        error: function(data) {
		            var errors = data.responseJSON;
		        }
		    });
		};

		$('#bsubmitu').on('click', function(e){  
	        e.preventDefault();
		    $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var id = $('#idu').val();
            var my_form_u = $('#my_form_u').serialize();
			var urlu = location.href+'/actualizar/'+id;
            $.ajax({
                type: 'post',
                url: urlu,
                data: my_form_u,
	        	dataType: 'JSON',
                success: function(data) {
                	console.log('ajax success');
                    $("#tb").load(" #tb");
                    $('#updateModal').modal('hide');
                    alertify.success("Editado con exito!");
                },
                error: function() {
                	console.log('ajax error');
                    $("#tb").load(" #tb");
                    $('#updateModal').modal('hide');
                    alertify.error("Problema para editar!");
                }
            });
        });

		function eliminar(id){
            $.ajaxSetup({
		        headers: {
		            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		        }
            });
            var url2 = location.href+'/eliminar/'+id;
		    $.ajax({
		        type: 'post',
		        url: url2,
		        success: function(data) {
                    $("#tb").load(" #tb");
		        	alertify.success('Eliminado con exito!');
		        },
		        error: function(data) {
		        	alertify.error('Problema para eliminar!');
		        }
		    });
		};

  function changed(url2, campoID=[]) {
    axios.get(url2).then(function(response) {
      var respuesta = response.data;
      if (respuesta.length>0) {
        $('#'+campoID[0]).html('<option value="">Seleccionar</option>')
        $('#'+campoID[0]).removeAttr('disabled')
        $('.'+campoID[0]).removeClass('text-muthed')
        $('.'+campoID[0]).addClass('text-danger')
        for (var i = 0; i < respuesta.length; i++) {
          var html = '<option value="'+respuesta[i]['id']+'">'+respuesta[i]['name']+'</option>'
          var dom = $('#'+campoID[0]).html()
          var juntos = dom + html
          $('#'+campoID[0]).html(juntos)
        }
      }else{
        reset(campoID)
      }
    }).catch(function(error) {
      console.log(error);
      reset(campoID)
    })
  }
  
  function reset(campoID=[]) {
    campoID.forEach(function(valor, indice, array) {
      $('#'+valor).html('')
      $('#'+valor).prop('disabled',true)
    })
  }

  $('#area_id').change(function() {
    var url2 = location.href+'/lugar/'+$('#area_id').val();
    reset(['site_id']);
    changed(url2, ['site_id']);
  });
  
	</script>
	@stop
@stop
