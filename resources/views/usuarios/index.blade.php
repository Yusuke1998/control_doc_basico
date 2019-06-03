@extends('template.layout')
@section('title') Usuarios @stop
@section('content')
<div class="container">

  <div class="row">
    <div class="col-md-12">
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#createModal">Nuevo</button>
    </div>
    <div id="all-users" class="col-md-12">
    <table id="tb" class="table table-striped table-bordered">
		  <thead class="black white-text">
		    <tr>
		      <th scope="col">#</th>
		      <th scope="col">Usuario</th>
		      <th scope="col">Correo electronico</th>
		      <th scope="col">Tipo</th>
		      <th scope="col">Opcion</th>
		    </tr>
		  </thead>
		  <tbody>
		  	@foreach($usuarios as $usuario)
		    <tr>
		      <td scope="col">{{ $usuario->id }}</td>
		      <td>{{ $usuario->name }}</td>
		      <td>{{ $usuario->email }}</td>
		      <td>{{ $usuario->type }}</td>
		      <td>
                @if($usuario->id!=1)
                <a class="btn btn-sm btn-info" data-toggle="modal" data-target="#updateModal" onclick="editar({{ $usuario->id }});" title="">Editar</a>
		      	<a class="btn btn-info btn-sm" onclick="eliminar({{$usuario->id}})">Eliminar</a>
                @endif
		      </td>
		    </tr>
		    @endforeach
		  </tbody>
		</table>
    </div>
  </div>
</div>
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
      aria-hidden="true">
    <form action="{{ route('usuarios.store') }}" method="post" id="my_form">
    {{ csrf_field() }}
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title w-100" id="myModalLabel">Nuevo usuario</h4>
            <small class="modal-title w-100">Los campos marcados con (<span style="color:red;">*</span>) son obligatorios</small>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body mx-3">
            <div class="md-form mb-5">
              <input type="text" name="name" id="nombre" class="form-control validate">
              <label data-error="Error" data-success="Bien" for="nombre"><span style="color:red;">*</span>Nombre de usuario</label>
            </div>
            <div class="md-form mb-5">
              <input type="email" name="email" id="correo" class="form-control validate">
              <label data-error="Error" data-success="Bien" for="correo"><span style="color:red;">*</span>Correo electronico</label>
            </div>
            <div class="md-form mb-5">
              <input type="text" name="password" id="clave" class="form-control validate">
              <label data-error="Error" data-success="Bien" for="clave"><span style="color:red;">*</span>Contraseña</label>
            </div>
            <div class="md-form mb-5">
                <select name="type" id="tipo" class="form-control validate">
                    <option selected disable><span style="color:red;">*</span>Tipo de usuario</option>
                    <option value="administrador">Administrador</option>
                    <option value="secretaria">Secretaria</option>
                </select>
            </div>
            <div class="md-form mb-4">
              <input type="text" name="firstname" id="nombres" class="form-control validate">
              <label data-error="Error" data-success="Bien" for="nombres"><span style="color:red;">*</span>Nombres</label>
            </div>
            <div class="md-form mb-4">
              <input type="text" name="lastname" id="apellidos" class="form-control validate">
              <label data-error="Error" data-success="Bien" for="apellidos"><span style="color:red;">*</span>Apellidos</label>
            </div>
            <div class="md-form mb-4">
              <input type="text" name="ci" id="ci" class="form-control validate">
              <label data-error="Error" data-success="Bien" for="ci"><span style="color:red;">*</span>Numero de identificacion</label>
            </div>
            <div class="md-form mb-5">
                <select name="type_ci" id="tipo_ci" class="form-control validate">
                    <option selected disable><span style="color:red;">*</span>Tipo de identificacion</option>
                    <option value="cedula">Cedula</option>
                    <option value="pasaporte">Pasaporte</option>
                </select>
            </div>
            <div class="md-form mb-4">
              <input type="text" name="position" id="cargo" class="form-control validate">
              <label data-error="Error" data-success="Bien" for="cargo"><span style="color:red;">*</span>Cargo que desempeña</label>
            </div>
            <div class="md-form mb-4">
              <input type="text" name="address" id="direccion" class="form-control validate">
              <label data-error="Error" data-success="Bien" for="direccion">Direccion</label>
            </div>
            <div class="md-form mb-4">
              <input type="text" name="phone" id="telefono" class="form-control validate">
              <label data-error="Error" data-success="Bien" for="telefono">Telefono</label>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
            <button type="button" id="bsubmit" class="btn btn-primary btn-sm">Guardar</button>
          </div>
        </div>
      </div>
    </form>
</div>

<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
      aria-hidden="true">
    <form method="post" id="my_form_u">
    {{ csrf_field() }}
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title w-100" id="myModalLabelu">Editar usuario</h4>
            <small class="modal-title w-100">Los campos marcados con (<span style="color:red;">*</span>) son obligatorios</small>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body mx-3">
            <div class="md-form mb-5">
              <input type="hidden" id="idu" name="id">
              <input type="text" name="name" id="nombreu" class="form-control validate">
              <label data-error="Error" data-success="Bien" for="nombreu"><span style="color:red;">*</span>Nombre de usuario</label>
            </div>
            <div class="md-form mb-5">
              <input type="email" name="email" id="correou" class="form-control validate">
              <label data-error="Error" data-success="Bien" for="correou"><span style="color:red;">*</span>Correo electronico</label>
            </div>
            <div class="md-form mb-5">
              <input type="text" name="password" placeholder="Escribe una contraseña solo si quieres cambiar la anterior" id="claveu" class="form-control validate">
              <label data-error="Error" data-success="Bien" for="claveu">Contraseña</label>
            </div>
            <div class="md-form mb-5">
                <select name="type" id="tipou" class="form-control validate">
                    <option selected disable><span style="color:red;">*</span>Tipo de usuario</option>
                    <option value="administrador">Administrador</option>
                    <option value="secretaria">Secretaria</option>
                </select>
            </div>
            <div class="md-form mb-4">
              <input type="text" name="firstname" id="nombresu" class="form-control validate">
              <label data-error="Error" data-success="Bien" for="nombresu"><span style="color:red;">*</span>Nombres</label>
            </div>
            <div class="md-form mb-4">
              <input type="text" name="lastname" id="apellidosu" class="form-control validate">
              <label data-error="Error" data-success="Bien" for="apellidosu"><span style="color:red;">*</span>Apellidos</label>
            </div>
            <div class="md-form mb-4">
              <input type="text" name="ci" id="ciu" class="form-control validate">
              <label data-error="Error" data-success="Bien" for="ci"><span style="color:red;">*</span>Numero de identificacion</label>
            </div>
            <div class="md-form mb-5">
                <select name="type_ci" id="tipo_ciu" class="form-control validate">
                    <option selected disable><span style="color:red;">*</span>Tipo de identificacion</option>
                    <option value="cedula">Cedula</option>
                    <option value="pasaporte">Pasaporte</option>
                </select>
            </div>
            <div class="md-form mb-4">
              <input type="text" name="position" id="cargou" class="form-control validate">
              <label data-error="Error" data-success="Bien" for="cargou"><span style="color:red;">*</span>Cargo que desempeña</label>
            </div>
            <div class="md-form mb-4">
              <input type="text" name="address" id="direccionu" class="form-control validate">
              <label data-error="Error" data-success="Bien" for="direccionu">Direccion</label>
            </div>
            <div class="md-form mb-4">
              <input type="text" name="phone" id="telefonou" class="form-control validate">
              <label data-error="Error" data-success="Bien" for="telefonou">Telefono</label>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
            <button type="button" id="bsubmitu" class="btn btn-primary btn-sm">Actualizar</button>
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
            var url = '{{ Route('usuarios.store') }}';
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
                    $('#claveu').val('');
                    $('#nombreu').focus();
                    $('#nombreu').val(data.name);
                    $('#correou').focus();
                    $('#correou').val(data.email);
                    $('#tipou').focus();
                    $('#tipou').val(data.type);
                    $('#nombresu').focus();
                    $('#nombresu').val(data.firstname);
                    $('#apellidosu').focus();
                    $('#apellidosu').val(data.lastname);
                    $('#ciu').focus();
                    $('#ciu').val(data.ci);
                    $('#tipo_ciu').focus();
                    $('#tipo_ciu').val(data.type_ci);
                    $('#cargou').focus();
                    $('#cargou').val(data.position);
                    $('#telefonou').focus();
                    $('#telefonou').val(data.phone);
                    $('#direccionu').focus();
                    $('#direccionu').val(data.address);
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
            console.log(urlu);

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
    </script>
    @stop
@stop
