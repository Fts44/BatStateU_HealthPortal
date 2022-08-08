<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AdminMedicineController extends Controller
{
    public function index(){
        
        return view('admin.AdminMedicine');
    }




    
    public function index_type(){
        $medicine_types = DB::table('medicine_types')->get();

        return view('admin.AdminMedicineType', compact('medicine_types'));
    }
    public function create_type(Request $request){
        $rules = [
            'mt_name' => ['required','unique:medicine_types']
        ];
        $messages = [
            'mt_name.required' => 'Medicine type is required.',
            'mt_name.unique' => 'Medicine type already exist.'
        ];
        $validator = Validator::make( $request->all(), $rules, $messages);

        if($validator->fails()){
            $message = 'Medicine type not inserted!';
            return redirect()->back()->with('failed',$message)->withErrors($validator)->withInput($request->all());
        }
        else{
            DB::table('medicine_types')->insert([
                'mt_name' => $request->mt_name
            ]);
            $message = 'Medicine type inserted!';
            return redirect()->back()->with('success', $message);
        }
    }
    public function delete_type($mt_id){
        DB::table('medicine_types')->where('mt_id', $mt_id)->delete();
        
        $message = 'Medicine type deleted!';
        return redirect()->back()->with('success', $message);
    }
    public function update_type(Request $request, $mt_id){
        $rules = [
            'mt_name' => ['required','unique:medicine_types,mt_name,'.$mt_id.',mt_id']
        ];
        $messages = [
            'mt_name.required' => 'Medicine type is required.',
            'mt_name.unique' => 'Medicine type already exist.'
        ];
        $validator = Validator::make( $request->all(), $rules, $messages);

        if($validator->fails()){
            $message = 'Medicine type not updated!';
            return redirect()->back()->with('failed',$message)->withErrors($validator)->withInput($request->all());
        }
        else{
            DB::table('medicine_types')->where('mt_id', $mt_id)->update([
                'mt_name' => $request->mt_name
            ]);
            $message = 'Medicine type updated!';
            return redirect()->back()->with('success', $message);
        }
    }

    public function index_category(){
        $medicine_categories = DB::table('medicine_category')->get();

        return view('admin.AdminMedicineCategory', compact('medicine_categories'));
    }   
    public function create_category(Request $request){
        $rules = [
            'mc_name' => ['required','unique:medicine_category']
        ];
        $messages = [
            'mc_name.required' => 'Medicine category is required.',
            'mc_name.unique' => 'Medicine category already exist.'
        ];
        $validator = Validator::make( $request->all(), $rules, $messages);

        if($validator->fails()){
            $message = 'Medicine category not inserted!';
            return redirect()->back()->with('failed',$message)->withErrors($validator)->withInput($request->all());
        }
        else{
            DB::table('medicine_category')->insert([
                'mc_name' => $request->mc_name
            ]);
            $message = 'Medicine category inserted!';
            return redirect()->back()->with('success', $message);
        }
    }
    public function delete_category($mc_id){
        DB::table('medicine_category')->where('mc_id', $mc_id)->delete();
        
        $message = 'Medicine category deleted!';
        return redirect()->back()->with('success', $message);
    }
    public function update_category(Request $request, $mc_id){
        $rules = [
            'mc_name' => ['required','unique:medicine_category,mc_name,'.$mc_id.',mc_id']
        ];
        $messages = [
            'mc_name.required' => 'Medicine category is required.',
            'mc_name.unique' => 'Medicine category already exist.'
        ];
        $validator = Validator::make( $request->all(), $rules, $messages);

        if($validator->fails()){
            $message = 'Medicine category not updated!';
            return redirect()->back()->with('failed',$message)->withErrors($validator)->withInput($request->all());
        }
        else{
            DB::table('medicine_category')->where('mc_id', $mc_id)->update([
                'mc_name' => $request->mc_name
            ]);
            $message = 'Medicine category updated!';
            return redirect()->back()->with('success', $message);
        }
    }
}
