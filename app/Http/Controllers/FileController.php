<?php

namespace App\Http\Controllers;

use App\File;
use App\Document_type;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function index()
    {
        $tipos = Document_type::all();
        $archivos = File::all();
        return view('archivos.index',compact('archivos','tipos'));
    }

    public function store(Request $request)
    {
        //
    }

    public function show(File $file)
    {
        //
    }

    public function edit(File $file)
    {

    }

    public function update(Request $request, File $file)
    {
        //
    }

    public function destroy(File $file)
    {
        //
    }
}
