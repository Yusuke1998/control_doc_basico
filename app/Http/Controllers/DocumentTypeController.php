<?php

namespace App\Http\Controllers;

use App\Document_type;
use Illuminate\Http\Request;

class DocumentTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Document_type $document_type)
    {
        //
    }

    public function edit(Document_type $document_type)
    {
        //
    }

    public function update(Request $request, Document_type $document_type)
    {
        //
    }

    public function destroy(Document_type $document_type)
    {
        //
    }
}
