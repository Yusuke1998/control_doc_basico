<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Carbon;
use App\Document;
use App\Entrance;
use App\Delivery;
use App\Binnacle;

class ReportesController extends Controller
{
	public function __construct()
    {
        $this->middleware(['auth']);
    }
    
    public function index(){
        return view('reportes.index');
    }

    public function bitacora_pdf($tipo){
        switch ($tipo) {
            case 'todo':
            $title = ['Reporte de la bitacora en el sistema','sistema','bitacora'];
            $bitacoras = Binnacle::all();
                break;
            case 'dia':
            $title = ['Reporte del dia de la bitacora','dia','bitacora'];
            $fecha = Carbon::now()->format('Y-m-d');
            $bitacoras = Binnacle::whereDate('date', '=', $fecha)->get();
                break;
            case 'semana':
            $title = ['Reporte de la semana de la bitacora','semana','bitacora'];
            $InicioSemana = Carbon::now()->startOfWeek();
            $FinSemana = Carbon::now()->endOfWeek();
            $bitacoras = Binnacle::whereBetween('date', [$InicioSemana,$FinSemana])->get();
                break;
            case 'mes':
            $title = ['Reporte del mes de la bitacora','mes','bitacora'];
            $fecha = Carbon::now()->format('m');
            $bitacoras = Binnacle::whereMonth('date','=',$fecha)->get();
                break;
            case 'anio':
            $title = ['Reporte del año de la bitacora','año','bitacora'];
            $fecha = Carbon::now()->format('Y');
            $bitacoras = Binnacle::whereYear('date','=',$fecha)->get();
                break;
            default:
            $title = ['Reporte de la bitacora en el sistema','sistema','bitacora'];
            $bitacoras = Binnacle::all();
                break;
        }
        $pdf = PDF::loadView('reportes.bitacora', compact('bitacoras','title'));
        return $pdf->stream('reporte_'.$title[1].'_'.$title[2].'.pdf');
    }

    public function documento_pdf($tipo){
        switch ($tipo) {
            case 'todo':
            $title = ['Reporte de todos los documentos en el sistema','sistema','documentos'];
            $documentos = Document::all();
                break;
            case 'dia':
            $title = ['Reporte de todos los documentos del dia','sistema','dia'];
            $fecha = Carbon::now()->format('Y-m-d');
            $documentos = Document::whereDate('date', '=', $fecha)->get();
                break;
            case 'semana':
            $title = ['Reporte de todos los documentos de la semana','sistema','semana'];
            $InicioSemana = Carbon::now()->startOfWeek();
            $FinSemana = Carbon::now()->endOfWeek();
            $documentos = Document::whereBetween('date', [$InicioSemana,$FinSemana])->get();
                break;
            case 'mes':
            $title = ['Reporte de todos los documentos del mes','sistema','mes'];
            $fecha = Carbon::now()->format('m');
            $documentos = Document::whereMonth('date','=',$fecha)->get();
                break;
            case 'anio':
            $title = ['Reporte de todos los documentos del año','sistema','año'];
            $fecha = Carbon::now()->format('Y');
            $documentos = Document::whereYear('date','=',$fecha)->get();
                break;
            default:
            $title = ['Reporte de todos los documentos en el sistema','sistema','documentos'];
            $documentos = Document::all();
                break;
        }
        $pdf = PDF::loadView('reportes.documentos', compact('documentos','title'));
        return $pdf->stream('reporte_'.$title[1].'_'.$title[2].'.pdf');
    }

    public function documento($id){
        $documento = Document::find($id);
        $documento = [
            'id'        => $documento->id,
            'code'      => $documento->code,
            'title'     => $documento->title,
            'header'    => $documento->header,
            'from'      => $documento->from,
            'to'        => $documento->to,
            'text'      => $documento->text,
            'affair'    => $documento->affair,
            'date'      => date('d/m/Y',strtotime($documento->date)),
            'person'    => $documento->person->firstname.' '.$documento->person->lastname,
            'user'      => $documento->user->person->firstname.' '.$documento->user->person->lastname,
            'ci'        => $documento->user->person->ci,
            'position'  => $documento->user->person->position,
            'file_id'      => isset($documento->file)?$documento->file->id:''
        ];

        $pdf = PDF::loadView('reportes.document', compact('documento'));
        return $pdf->stream($documento['code'].'_reporte_documentos.pdf');
    }

    public function entrada_pdf($tipo){
        switch ($tipo) {
            case 'todo':
            $title = ['Reporte de todas las entradas en el sistema','sistema','entradas'];
            $datos = Entrance::all();
                break;
            case 'dia':
            $title = ['Reporte de todas las entradas del dia','dia','entradas'];
            $fecha = Carbon::now()->format('Y-m-d');
            $datos = Entrance::whereDate('date', '=', $fecha)->get();
                break;
            case 'semana':
            $title = ['Reporte de todas las entradas de la semana','semana','entradas'];
            $InicioSemana = Carbon::now()->startOfWeek();
            $FinSemana = Carbon::now()->endOfWeek();
            $datos = Entrance::whereBetween('date', [$InicioSemana,$FinSemana])->get();
                break;
            case 'mes':
            $title = ['Reporte de todas las entradas del mes','mes','entradas'];
            $fecha = Carbon::now()->format('m');
            $datos = Entrance::whereMonth('date','=',$fecha)->get();
                break;
            case 'anio':
            $title = ['Reporte de todas las entradas del año','año','entradas'];
            $fecha = Carbon::now()->format('Y');
            $datos = Entrance::whereYear('date','=',$fecha)->get();
                break;
            default:
            $title = ['Reporte de todas las entradas en el sistema','sistema','entradas'];
            $datos = Entrance::all();
                break;
        }
        $pdf = PDF::loadView('reportes.entradas-salidas', compact('datos','title'));
        return $pdf->stream('reporte_'.$title[1].'_'.$title[2].'.pdf');
    }

    public function salida_pdf($tipo){
        switch ($tipo) {
            case 'todo':
            $title = ['Reporte de todas las salidas en el sistema','sistema','salidas'];
            $datos = Entrance::all();
                break;
            case 'dia':
            $title = ['Reporte de todas las salidas del dia','dia','salidas'];
            $fecha = Carbon::now()->format('Y-m-d');
            $datos = Entrance::whereDate('date', '=', $fecha)->get();
                break;
            case 'semana':
            $title = ['Reporte de todas las salidas de la semana','semana','salidas'];
            $InicioSemana = Carbon::now()->startOfWeek();
            $FinSemana = Carbon::now()->endOfWeek();
            $datos = Entrance::whereBetween('date', [$InicioSemana,$FinSemana])->get();
                break;
            case 'mes':
            $title = ['Reporte de todas las salidas del mes','mes','salidas'];
            $fecha = Carbon::now()->format('m');
            $datos = Entrance::whereMonth('date','=',$fecha)->get();
                break;
            case 'anio':
            $title = ['Reporte de todas las salidas del año','año','salidas'];
            $fecha = Carbon::now()->format('Y');
            $datos = Entrance::whereYear('date','=',$fecha)->get();
                break;
            default:
            $title = ['Reporte de todas las salidas en el sistema','sistema','salidas'];
            $datos = Entrance::all();
                break;
        }
        $pdf = PDF::loadView('reportes.entradas-salidas', compact('datos','title'));
        return $pdf->stream('reporte_'.$title[1].'_'.$title[2].'.pdf');
    }
}
