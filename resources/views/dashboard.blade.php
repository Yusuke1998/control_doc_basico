@extends('template.layout')
@section('title') Control y seguimiento de documentos @stop
@section('content')
  <!--Grid row-->
      <div class="row wow fadeIn">
        <!--Grid column-->
        <div class="col-md-9 mb-4">
          <!--Card-->
          <div class="card">
            <!--Card content-->
            <div class="card-body">
              <canvas id="myChart"></canvas>
            </div>
          </div>
          <!--/.Card-->
        </div>
        <!--Grid column-->
        <!--Grid column-->
        <div class="col-md-3 mb-4">
            <!--Card-->
            <div class="card mb-4">
              <!--Card content-->
              <div class="card-body">

                <!-- List group links -->
                <div class="list-group list-group-flush">
                  <a href="{{ route('documentos.index') }}" class="list-group-item list-group-item-action waves-effect">Documentos
                    <span id="documentos" class="float-right badge badge-warning badge-pill pull-right"></span>
                  </a>
                  <a href="{{ route('archivos.index') }}" class="list-group-item list-group-item-action waves-effect">Archivos
                    <span id="archivos" class="float-right badge badge-warning badge-pill pull-right"></span>
                  </a>
                  <a href="{{ route('entradas.index') }}" class="list-group-item list-group-item-action waves-effect">Entradas
                    <span id="entradas" class="float-right badge badge-primary badge-pill pull-right"></span>
                  </a>
                  <a href="{{ route('salidas.index') }}" class="list-group-item list-group-item-action waves-effect">Salidas
                    <span id="salidas" class="float-right badge badge-danger badge-pill pull-right"></span>
                  </a>
                </div>
                <!-- List group links -->
              </div>
            </div>
          <!--/.Card-->
        <!--Card-->
          <div class="card mb-4">
            <!--Card content-->
            <div class="card-body">
              <canvas id="pieChart"></canvas>
            </div>
          </div>
        <!--/.Card-->
        </div>
        <!--Grid column-->
      </div>
      <!--Grid row-->
      <!--Grid row-->
      <div class="row wow fadeIn">
        <!--Grid column-->
        <div class="col-md-6 mb-4">
          <!--Card-->
          <div class="card">
      <div class="card-header">Entradas Recientes</div>
            <!--Card content-->
            <div class="card-body">
              <!-- Table  -->
              <table id="tabla_entradas" class="table table-hover">
                <thead class="blue-grey lighten-4">
                  <tr>
                    <th>Documento</th>
                    <th>Fecha</th>
                    <th>Opción</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($entradas as $entrada)
                  <tr>
                      <td>
                        <a href="{{ route('documentos.ver',$entrada->document_id) }}" class="btn btn-sm" title="Ver documento">{{ $entrada->document->title }}</a>
                      </td>
                      <td>
                        {{ $entrada->created_at->format('d-m-Y') }}
                        <br>
                        {{ $entrada->created_at->diffForHumans() }}
                      </td>
                      <td>
                        <a href="{{ route('entradas.ver',$entrada->id) }}" class="btn btn-sm" title="Ver entrada">Ver entrada</a>
                      </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              <!-- Table  -->
            </div>
          </div>
          <!--/.Card-->
        </div>
        <!--Grid column-->
        <!--Grid column-->
        <div class="col-md-6 mb-4">
          <!--Card-->
          <div class="card">
      <div class="card-header">Salidas Recientes</div>
            <!--Card content-->
            <div class="card-body">
              <!-- Table  -->
              <table id="tabla_salidas" class="table table-hover">
                <thead class="blue lighten-4">
                  <tr>
                    <th>Documento</th>
                    <th>Fecha</th>
                    <th>Opcion</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($salidas as $salida)
                  <tr>
                      <td>
                        <a href="{{ route('documentos.ver',$salida->document_id) }}" class="btn btn-sm" title="Ver documento">{{ $salida->document->title }}</a>
                      </td>
                      <td>
                        {{ $salida->created_at->format('d-m-Y') }}
                        <br>
                        {{ $salida->created_at->diffForHumans() }}
                      </td>
                      <td>
                        <a href="{{ route('salidas.ver',$salida->id) }}" class="btn btn-sm" title="Ver entrada">Ver entrada</a>
                      </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              <!-- Table  -->
            </div>
          </div>
          <!--/.Card-->
        </div>
        <!--Grid column-->
      </div>
      <!--Grid row-->
  @section('my-js')
  	<!-- Charts -->
	  <script>
	    // Line
        var ctx = document.getElementById("myChart").getContext('2d');
        var url = '{{ Route('charts') }}';

          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
          $.ajax({
              type: 'get',
              url: url,
              success: function(data) {

	    var myChart = new Chart(ctx, {
	      type: 'bar',
	      data: {
	        labels: ["Documentos", "archivos", "Entradas", "Salidas"],
	        datasets: [{
	          label: 'Estadisticas generales',
	          data: data,
	          backgroundColor: [
              'rgba(255, 206, 86, 0.2)',
	            'rgba(255, 206, 86, 0.2)',
	            'rgba(54, 162, 235, 0.2)',
	            'rgba(255,99,132, 0.2)',
	          ],
	          borderColor: [
              'rgba(255, 206, 86,1)',
	            'rgba(255, 206, 86,1)',
	            'rgba(54, 162, 235, 1)',
	            'rgba(255, 99, 132, 1)',
	          ],
	          borderWidth: 1
	        }]
	      },
	      options: {
	        scales: {
	          yAxes: [{
	            ticks: {
	              beginAtZero: true
	            }
	          }]
	        }
          }
        });
    },
      error: function(data) {
          var errors = data.responseJSON;
      }
    });
	    //pie
          var ctxP = document.getElementById("pieChart").getContext('2d');

          var url = '{{ Route('charts') }}';

          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });

          $.ajax({
              type: 'get',
              url: url,
              success: function(data) {
                var myPieChart = new Chart(ctxP, {
                  type: 'pie',
                  data: {
                    labels: ["Documentos", "Archivos", "Entradas", "Salidas"],
                    datasets: [{
                      data: data,
                      backgroundColor: ["#ffcc00", "#ffcc00", "#4285f4", "#ff3547"],
                      hoverBackgroundColor: ["#ffaa00", "#4265f4", "#ff3560"]
                    }]
                  },
                  options: {
                    responsive: true,
                    legend: false
                  }
                });
              },
              error: function(data) {
                  var errors = data.responseJSON;
              }
          });

          $(document).ready(function(){
              $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
              });
              $.ajax({
                  type: 'get',
                  url: url,
                  success: function(data) {
                    console.log(data);
                    $('#documentos').text(data[0]);
                    $('#archivos').text(data[1]);
                    $('#entradas').text(data[2]);
                    $('#salidas').text(data[3]);
              },
                  error: function(data) {
                      var errors = data.responseJSON;
                  }
              });
          });
	  </script>
  	<!-- Charts -->
  @stop
@stop
