<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\PopulateSelectController as PopulateSelect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class AdminMedicineController extends Controller
{
    public function __construct(){
        $this->PopulateSelect = new PopulateSelect;
    }

    public function index(){
        $medicine_infos = $this->PopulateSelect->medicine_info();

        $inventory_medicines = DB::table('inventory_medicine as im')
        ->select('im.*', 'mi.mi_name', 'mi.mi_prescription_req', 'mc.mc_name', 'mt.mt_name',
        'acc.first_name', 'acc.middle_name', 'acc.last_name', 'acc.position'
        )
        ->leftjoin('medicine_info as mi', 'im.mi_id', 'mi.mi_id')
        ->leftjoin('medicine_category as mc', 'mi.mc_id', 'mc.mc_id')
        ->leftjoin('medicine_types as mt', 'mi.mt_id', 'mt.mt_id')
        ->leftjoin('accounts as acc', 'im.created_by', 'acc.acc_id')
        ->get();

        // echo json_encode($inventory_medicines);
        return view('admin.AdminMedicineProduct', compact('medicine_infos','inventory_medicines'));
    }

    public function create(Request $request){

        $rules = [
            'product' => ['required','exists:medicine_info,mi_id'],
            'expiry' => ['required','date'],
            'quantity' => ['required'],
        ];
        $validator = Validator::make( $request->all(), $rules);

        if($validator->fails()){
            $message = 'Medicine not inserted!';
            return redirect()->back()->with('failed',$message)->withErrors($validator)->withInput($request->all());
        }
        else{
            DB::table('inventory_medicine')->insert([
                'mi_id' => $request->product,
                'expiry' => $request->expiry,
                'stockin' => $request->quantity,
                'stockout' => 0,
                'created_by' => session('user_id')
            ]);
            $message = 'Medicine inserted!';
            return redirect()->back()->with('success',$message);
        }
    }
    public function delete($im_id){
        DB::table('inventory_medicine')->where('im_id', $im_id)->delete();
        $message = 'Medicine deleted!';
        return redirect()->back()->with('success', $message);
    }
    public function update(Request $request, $im_id){
        $rules = [
            'product' => ['required','exists:medicine_info,mi_id'],
            'expiry' => ['required','date'],
            'quantity' => ['required'],
        ];
        $validator = Validator::make( $request->all(), $rules);

        if($validator->fails()){
            $message = 'Medicine not inserted!';
            return redirect()->back()->with('failed',$message)->withErrors($validator)->withInput($request->all());
        }
        else{
            DB::table('inventory_medicine')->where('im_id',$im_id)->update([
                'mi_id' => $request->product,
                'expiry' => $request->expiry,
                'stockin' => $request->quantity,
                'created_by' => session('user_id')
            ]);
            $message = 'Medicine updated!';
            return redirect()->back()->with('success',$message);
        }
    }

    public function index_summary(){
        $summary_medicine = DB::table('inventory_medicine as im')
        ->leftjoin('medicine_info as mi', 'im.mi_id', 'mi.mi_id')
        ->select('mi_name', DB::raw('SUM(im.stockin) as TotalStockin'),DB::raw('SUM(im.stockout) as TotalStockout'))
        ->groupBy('mi_name')
        ->get();

        return view('admin.AdminMedicine',compact('summary_medicine'));
    }

    public function index_info(){
        

        $categories = $this->PopulateSelect->medicine_category();
        $types = $this->PopulateSelect->medicine_types();

        $medicine_infos = DB::table('medicine_info as mi')
        ->select('mi.*', 'mc.mc_name', 'mt.mt_name')
        ->leftjoin('medicine_category as mc', 'mi.mc_id', 'mc.mc_id')
        ->leftjoin('medicine_types as mt', 'mi.mt_id', 'mt.mt_id')
        ->get();
     
        return view('admin.AdminMedicineInfo', compact('categories','types','medicine_infos'));
    }
    public function create_info(Request $request){
        $rules = [
            'name' => ['required','unique:medicine_info,mi_name'],
            'category' => ['required'],
            'type' => ['required'],
            'rx' => ['required','in:1,0']
        ];
        $messages = [
            'name.required' => 'Medicine type is required.',
            'name.unique' => 'Medicine name already exist.',
            'category.required' => 'Category is required.',
            'type.required' => 'Type is required.',
            'rx.required' => 'This field is required.',
        ];
        $validator = Validator::make( $request->all(), $rules, $messages);

        if($validator->fails()){
            $message = 'Medicine info not inserted!';
            return redirect()->back()->with('failed',$message)->withErrors($validator)->withInput($request->all());
        }
        else{
            DB::table('medicine_info')->insert([
                'mi_name' => $request->name,
                'mc_id' => $request->category,
                'mt_id' => $request->type,
                'mi_prescription_req' => $request->rx
            ]);
            $message = 'Medicine info inserted!';
            return redirect()->back()->with('success',$message);
        }
    }
    public function delete_info($mi_id){
        DB::table('medicine_info')->where('mi_id', $mi_id)->delete();
        
        $message = 'Medicine info deleted!';
        return redirect()->back()->with('success', $message);
    }
    public function update_info(Request $request, $mi_id){
        $rules = [
            'name' => ['required','unique:medicine_info,mi_name,'.$mi_id.",mi_id"],
            'category' => ['required'],
            'type' => ['required'],
            'rx' => ['required','in:1,0']
        ];
        $messages = [
            'name.required' => 'Medicine type is required.',
            'name.unique' => 'Medicine name already exist.',
            'category.required' => 'Category is required.',
            'type.required' => 'Type is required.',
            'rx.required' => 'This field is required.',
        ];
        $validator = Validator::make( $request->all(), $rules, $messages);

        if($validator->fails()){
            $message = 'Medicine info not updated!';
            return redirect()->back()->with('failed',$message)->withErrors($validator)->withInput($request->all());
        }
        else{
            DB::table('medicine_info')->where('mi_id', $mi_id)->update([
                'mi_name' => $request->name,
                'mc_id' => $request->category,
                'mt_id' => $request->type,
                'mi_prescription_req' => $request->rx
            ]);
            $message = 'Medicine info updated!';
            return redirect()->back()->with('success',$message);
        }
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
