<?php

namespace App\Http\Controllers\Admin\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class ViewPatientDetailsController extends Controller
{
    public function index($acc_id){

        $user_details = DB::table('accounts as acc')
        ->where('acc_id', $acc_id)
        ->select('acc.*', 'gl.gl_name', 'dept.dept_code', 'prog.prog_code',
        'hadd_rp.provDesc as home_prov', 'hadd_rcm.citymunDesc as home_mun', 'hadd_rb.brgyDesc as home_brgy',
        'badd_rp.provDesc as birth_prov', 'badd_rcm.citymunDesc as birth_mun', 'badd_rb.brgyDesc as birth_brgy',
        'badd_rp.provDesc as dorm_prov', 'dadd_rcm.citymunDesc as dorm_mun', 'dadd_rb.brgyDesc as dorm_brgy',
        )

        ->leftjoin('grade_level as gl', 'acc.gl_id', 'gl.gl_id')
        ->leftjoin('department as dept', 'acc.dept_id', 'dept.dept_id')
        ->leftjoin('program as prog', 'acc.prog_id', 'prog.prog_id')

        ->leftjoin('address as hadd', 'acc.home_address_id', 'hadd.add_id')
        ->leftjoin('refprovince as hadd_rp', 'hadd.province', 'hadd_rp.provCode')  
        ->leftjoin('refcitymun as hadd_rcm', 'hadd.municipality', 'hadd_rcm.citymunCode') 
        ->leftjoin('refbrgy as hadd_rb', 'hadd.barangay', 'hadd_rb.brgyCode')

        ->leftjoin('address as badd', 'acc.birth_address_id', 'badd.add_id')
        ->leftjoin('refprovince as badd_rp', 'badd.province', 'badd_rp.provCode')  
        ->leftjoin('refcitymun as badd_rcm', 'badd.municipality', 'badd_rcm.citymunCode') 
        ->leftjoin('refbrgy as badd_rb', 'badd.barangay', 'badd_rb.brgyCode')

        ->leftjoin('address as dadd', 'acc.birth_address_id', 'dadd.add_id')
        ->leftjoin('refprovince as dadd_rp', 'dadd.province', 'dadd_rp.provCode')  
        ->leftjoin('refcitymun as dadd_rcm', 'dadd.municipality', 'dadd_rcm.citymunCode') 
        ->leftjoin('refbrgy as dadd_rb', 'dadd.barangay', 'dadd_rb.brgyCode')

        ->first();

        $user_upload_docs = DB::table('patient_documents as pd')
        ->where('acc_id', $acc_id)
        ->leftjoin('document_type as dt', 'pd.dt_id', 'dt.dt_id')
        ->get();
        // echo json_encode($user_upload_docs);
        return view('admin.patient.AdminViewPatient',compact('user_details','user_upload_docs'));
    }
}
