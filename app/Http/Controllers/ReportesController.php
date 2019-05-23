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
    public function index(){
        return view('reportes.index');
    }

    public function bitacora_pdf(){
    	return "HOLA MUNDO";
    }

    public function bitacora_excel(){
    	return "HOLA MUNDO";
    }
}
