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
            $bitacoras = Binnacle::all();
                break;
            case 'dia':
            $fecha = Carbon::now()->format('Y-m-d');
            $bitacoras = Binnacle::whereDate('date', '=', $fecha)->get();
                break;
            case 'semana':
            $InicioSemana = Carbon::now()->startOfWeek();
            $FinSemana = Carbon::now()->endOfWeek();
            $bitacoras = Binnacle::wwhereBetween('date', [$InicioSemana,$FinSemana])->get();
                break;
            case 'mes':
            $fecha = Carbon::now()->format('m');
            $bitacoras = Binnacle::whereMonth('date','=',$fecha)->get();
                break;
            case 'anio':
            $fecha = Carbon::now()->format('Y');
            $bitacoras = Binnacle::whereYear('date','=',$fecha)->get();
                break;
            default:
            $bitacoras = Binnacle::all();
                break;
        }
        $pdf = PDF::loadView('reportes.bitacora', compact('bitacoras'));
        return $pdf->stream('reporte_bitacora.pdf');
    }

    public function documento_pdf($tipo){
        switch ($tipo) {
            case 'todo':
            $documentos = Document::all();
                break;
            case 'dia':
            $fecha = Carbon::now()->format('Y-m-d');
            $documentos = Document::whereDate('date', '=', $fecha)->get();
                break;
            case 'semana':
            $InicioSemana = Carbon::now()->startOfWeek();
            $FinSemana = Carbon::now()->endOfWeek();
            $documentos = Document::whereBetween('date', [$InicioSemana,$FinSemana])->get();
                break;
            case 'mes':
            $fecha = Carbon::now()->format('m');
            $documentos = Document::whereMonth('date','=',$fecha)->get();
                break;
            case 'anio':
            $fecha = Carbon::now()->format('Y');
            $documentos = Document::whereYear('date','=',$fecha)->get();
                break;
            default:
            $documentos = Document::all();
                break;
        }
        $pdf = PDF::loadView('reportes.documentos', compact('documentos'));
        return $pdf->stream('reporte_documentos.pdf');
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
}
