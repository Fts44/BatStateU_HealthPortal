<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminPatientController extends Controller
{
    public function index(){
        $patients = DB::table('accounts AS acc')
        ->select('acc.*', 'dept.*', 'prog.*', 'gl.*',
        'hadd_rp.provDesc as home_prov', 'hadd_rcm.citymunDesc as home_mun', 'hadd_rb.brgyDesc as home_brgy',
        'badd_rp.provDesc as birth_prov', 'badd_rcm.citymunDesc as birth_mun', 'badd_rb.brgyDesc as birth_brgy',
        'badd_rp.provDesc as dorm_prov', 'dadd_rcm.citymunDesc as dorm_mun', 'dadd_rb.brgyDesc as dorm_brgy',
        'ec.first_name as ec_fn', 'ec.middle_name as ec_mn', 'ec.last_name as ec_ln', 'ec.suffix_name as ec_sn',
        'ec.relation_to_patient as ec_rtp', 'ec.landline as ec_landline', 'ec.contact as ec_contact',
        'ecadd_rp.provDesc as ec_prov', 'ecadd_rcm.citymunDesc as ec_mun', 'ecadd_rb.brgyDesc as ec_brgy',
        'fd.father_fn as fd_ffn', 'fd.father_mn as fd_fmn', 'fd.father_ln as fd_fln', 'fd.father_occupation as fd_fo',
        'fd.mother_fn as fd_mfn', 'fd.mother_mn as fd_mmn', 'fd.mother_sn as fd_msn', 'fd.mother_occupation as fd_mo',
        'fd.marital_status as fd_ms'
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

        ->leftjoin('emergency_contact as ec', 'acc.ec_id', 'ec.ec_id')
        ->leftjoin('address as ecadd', 'ec.biz_add_id', 'ecadd.add_id')
        ->leftjoin('refprovince as ecadd_rp', 'ecadd.province', 'ecadd_rp.provCode')
        ->leftjoin('refcitymun as ecadd_rcm', 'ecadd.municipality', 'ecadd_rcm.citymunCode')
        ->leftjoin('refbrgy as ecadd_rb', 'ecadd.barangay', 'ecadd_rb.brgyCode')

        ->leftjoin('family_details as fd', 'acc.fd_id', 'fd.fd_id')

        ->where('position','!=','admin')
        ->where('position','=','patient')
        ->get();

        return view('admin.AdminPatient', compact('patients'));
    }

    public function show($acc_id){
        $acc_details = DB::table('accounts AS acc')
        ->select('acc.*', 'dept.*', 'prog.*', 'gl.*',
        'hadd_rp.provDesc as home_prov', 'hadd_rcm.citymunDesc as home_mun', 'hadd_rb.brgyDesc as home_brgy',
        'badd_rp.provDesc as birth_prov', 'badd_rcm.citymunDesc as birth_mun', 'badd_rb.brgyDesc as birth_brgy',
        'badd_rp.provDesc as dorm_prov', 'dadd_rcm.citymunDesc as dorm_mun', 'dadd_rb.brgyDesc as dorm_brgy',
        'ec.first_name as ec_fn', 'ec.middle_name as ec_mn', 'ec.last_name as ec_ln', 'ec.suffix_name as ec_sn',
        'ec.relation_to_patient as ec_rtp', 'ec.landline as ec_landline', 'ec.contact as ec_contact',
        'ecadd_rp.provDesc as ec_prov', 'ecadd_rcm.citymunDesc as ec_mun', 'ecadd_rb.brgyDesc as ec_brgy',
        'fd.father_fn as fd_ffn', 'fd.father_mn as fd_fmn', 'fd.father_ln as fd_fln', 'fd.father_occupation as fd_fo',
        'fd.mother_fn as fd_mfn', 'fd.mother_mn as fd_mmn', 'fd.mother_sn as fd_msn', 'fd.mother_occupation as fd_mo',
        'fd.marital_status as fd_ms'
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

        ->leftjoin('emergency_contact as ec', 'acc.ec_id', 'ec.ec_id')
        ->leftjoin('address as ecadd', 'ec.biz_add_id', 'ecadd.add_id')
        ->leftjoin('refprovince as ecadd_rp', 'ecadd.province', 'ecadd_rp.provCode')
        ->leftjoin('refcitymun as ecadd_rcm', 'ecadd.municipality', 'ecadd_rcm.citymunCode')
        ->leftjoin('refbrgy as ecadd_rb', 'ecadd.barangay', 'ecadd_rb.brgyCode')

        ->leftjoin('family_details as fd', 'acc.fd_id', 'fd.fd_id')

        ->where('position','!=','admin')
        ->get();
        
        echo json_encode($acc_details, true);
    }

    public function update_verification($acc_id, $vstatus){
        DB::table('accounts')->where('acc_id', $acc_id)
        ->update([
            'is_verified' => (($vstatus==1) ? 0 : 1)
        ]);

        $response = json_encode([
            'status' => 200,
            'title' => 'Success!',
            'message' => 'Verification status updated.',
            'icon' => 'success'
        ]);

        echo $response;   
    }
}