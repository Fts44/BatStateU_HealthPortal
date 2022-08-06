<?php

namespace App\Http\Controllers\patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmergencyContactController extends Controller
{
    public function index(){

        return view('patient.EmergencyContact');
    }
}
