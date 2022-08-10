<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class AdminPatientUploads extends Controller
{
    public function index(){
        $PatientUploads = DB::table('patient_documents as pd')
        ->leftjoin('document_type as dt', 'pd.dt_id', 'dt.dt_id')
        ->leftjoin('accounts as acc', 'pd.acc_id', 'acc.acc_id')
        ->get();

        // echo json_encode($PatientUploads);
        return view('admin.AdminPatientUploads', compact('PatientUploads'));
    }
}
