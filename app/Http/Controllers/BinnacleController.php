<?php

namespace App\Http\Controllers;

use App\Binnacle;
use Illuminate\Http\Request;

class BinnacleController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','admin']);
    }

    public function index()
    {
        $bitacoras = Binnacle::all();
        return view('bitacora.index',compact('bitacoras'));
    }
}
