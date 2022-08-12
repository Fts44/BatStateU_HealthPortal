<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Barryvdh\DomPDF\Facade\Pdf;


class CreatePDFController extends Controller
{
    public function index(){
        $pdf =  Pdf::loadView('StudentHealthRecord')->setPaper('a4', 'portrait');
        return $pdf->stream();
    }
}
