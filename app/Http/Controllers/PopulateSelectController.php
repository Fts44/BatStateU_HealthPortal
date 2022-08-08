<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PopulateSelectController extends Controller
{
    public function province(){
        $provinces = DB::table('refprovince')
        ->orderBy('provDesc','ASC')
        ->get();
        return $provinces;
    }

    public function municipality($provCode){     
        if($provCode == 'all'){
            $municipalities = DB::table('refcitymun')
            ->orderBy('citymunDesc','ASC')
            ->get();
        }
        else{
            $municipalities = DB::table('refcitymun')
            ->where('provCode','=',$provCode)
            ->orderBy('citymunDesc','ASC')
            ->get();
        }
        return $municipalities;
    }

    public function barangay($citymunCode){
        if($citymunCode == 'all'){
            $barangays = DB::table('refbrgy')
            ->orderBy('brgyDesc','ASC')
            ->get();
        }
        else{
            $barangays = DB::table('refbrgy')
            ->where('citymunCode','=',$citymunCode)
            ->orderBy('brgyDesc','ASC')
            ->get();
        }
        return $barangays;
    }

    public function departments(){
        $departments = DB::table('department')
        ->orderBy('dept_code','ASC')
        ->get();

        return $departments;
    }

    public function programs($dept_id){
        $programs = DB::table('program')
        ->orderBy('prog_code','ASC')
        ->where('dept_id', $dept_id)->get();

        return $programs;
    }

    public function medicine_category(){
        $medicine_category = DB::table('medicine_category')
        ->orderBy('mc_name','ASC')
        ->get();

        return $medicine_category;
    }

    public function medicine_types(){
        $medicine_types = DB::table('medicine_types')
        ->orderBy('mt_name','ASC')
        ->get();

        return $medicine_types;
    }
}
