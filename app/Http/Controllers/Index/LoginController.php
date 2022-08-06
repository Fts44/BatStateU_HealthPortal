<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use DB;
use Session;

class LoginController extends Controller
{
    public function index(){
        return view('Index.Login');
    }

    public function login(Request $request){
        $rules = [
            'userid' => 'required',
            'pass' => 'required',
        ];

        $validator = Validator::make( $request->all(), $rules);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }
        else{
            $user = DB::table('accounts')
                ->where('gsuite_email','=',$request->userid)
                ->orWhere('email','=',$request->userid)
                ->orWhere('sr_code','=',$request->userid)
                ->first();

            if($user){
                if(Hash::check($request->pass, $user->password)){
                    $request->session()->put('user_id', $user->acc_id);
                    $request->session()->put('user_type', $user->position);
                    return redirect($user->position);
                }
                else{
                    return redirect()->back()->withErrors(['pass' => 'Incorrect password!'])->withInput($request->all());
                }
            }
            else{
                return redirect()->back()->withErrors(['userid' => 'Userid is not connected to any account!'])->withInput($request->all());
            }
        }
        
    }

    public function logout(){
        Session::flush();
        return redirect('/');
    }
}
