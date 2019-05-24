<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Entrance;
use App\Document;
use App\Delivery;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	$documentos = Document::all();
        $entradas = Entrance::orderBy('created_at','DESC')
        ->select('id','created_at','date','commentary','functionary_e','functionary_r','area_id','site_id','document_id')
        ->latest('created_at')
        ->take(2)
        ->get();

        $salidas = Delivery::orderBy('created_at','DESC')
        ->select('id','created_at','date','commentary','functionary_e','functionary_r','area_id','site_id','document_id')
        ->latest('created_at')
        ->take(2)
        ->get();

        return view('dashboard',compact('documentos','entradas','salidas'));
    }
}
