<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Http\Controllers\PopulateSelectController as PopulateSelect;
use App\Http\Controllers\OTPController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

use App\Rules\GsuiteRule;
use App\Rules\PasswordRule;

class ProfileController extends Controller
{
    public function index(){
        $this->PopulateSelect = new PopulateSelect;
        $user_details = DB::table('accounts AS acc')
        ->leftjoin('emergency_contact AS ec','acc.ec_id', 'ec.ec_id')
        ->leftjoin('family_details AS fd', 'acc.fd_id', 'fd.fd_id')
        ->select('acc.*',
        'ec.first_name AS ec_first_name','ec.middle_name AS ec_middle_name','ec.last_name AS ec_last_name','ec.suffix_name AS ec_suffix_name',
        'ec.relation_to_patient as ec_rtp', 'ec.landline AS ec_landline', 'ec.contact AS ec_contact', 'ec.biz_add_id AS ec_biz_add_id',
        'fd.father_fn AS fd_father_fn'
        )
        ->where('acc_id',Session('user_id'))->first();

        //echo json_encode($user_details);

        $home_add = DB::table('address')->where('add_id', $user_details->home_address_id)->first();
        $birth_add = DB::table('address')->where('add_id', $user_details->birth_address_id)->first();
        $dorm_add = DB::table('address')->where('add_id', $user_details->dorm_address_id)->first();
        $ec_biz_add = DB::table('address')->where('add_id', $user_details->ec_biz_add_id)->first();
        
        $provinces = $this->PopulateSelect->province();//same all
        $departments = $this->PopulateSelect->departments();
        $programs = $this->PopulateSelect->programs($user_details->dept_id);
        //for home
        if(!$home_add){
            $home_municipalities = null;
            $home_barangays = null;
        }
        else{
            $home_municipalities = $this->PopulateSelect->municipality($home_add->province);
            $home_barangays = $this->PopulateSelect->barangay($home_add->municipality);
        }

        //for birth
        if(!$birth_add){
            $birth_municipalities = null;
            $birth_barangays = null;
        }
        else{
            $birth_municipalities = $this->PopulateSelect->municipality($birth_add->province);
            $birth_barangays = $this->PopulateSelect->barangay($birth_add->municipality);
        }

        //for dorm
        if(!$dorm_add){
            $dorm_municipalities = null;
            $dorm_barangays = null;
        }
        else{
            $dorm_municipalities = $this->PopulateSelect->municipality($dorm_add->province);
            $dorm_barangays = $this->PopulateSelect->barangay($dorm_add->municipality);
        }

        //emergency contact 
        if(!$ec_biz_add){
            $emerg_municipalities = null;
            $emerg_barangays = null;
        }
        else{
            $emerg_municipalities = $this->PopulateSelect->municipality($ec_biz_add->province);
            $emerg_barangays = $this->PopulateSelect->barangay($ec_biz_add->municipality);
        }

        return view("patient.profile", compact(
            'user_details','provinces', 
            'home_add',
            'home_municipalities', 'home_barangays',
            'birth_add',
            'birth_municipalities', 'birth_barangays',
            'dorm_add',
            'dorm_municipalities', 'dorm_barangays',
            'ec_biz_add',
            'emerg_municipalities','emerg_barangays',
            'departments', 'programs'
        ));
    }

    public function update_profile(Request $request, $id){

        Session()->put('active_page', 'profile');//set active page

        $rules = [
            'email' => ['required','email','unique:accounts,email,'.$id.',acc_id'],
            'sr_code' => ['required','unique:accounts,sr_code,'.$id.',acc_id'],

            'first_name' => ['required'],
            'middle_name' => ['required'],
            'last_name' => ['required'],

            'gender' => ['required', 'in:male,female'],
            'civil_status' => ['required', 'in:single,married,widowed,divorced'],
            'contact' => ['required','unique:accounts,contact,'.$id.',acc_id'],

            'home_prov' => ['required'],
            'home_mun' => ['required'],
            'home_brgy' => ['required'],

            'birth_prov' => ['required'],
            'birth_mun' => ['required'],
            'birth_brgy' => ['required'],

            'dorm_mun' => ['required_with:dorm_prov'],
            'dorm_brgy' => ['required_with:dorm_mun'],

            'religion' => ['required'],
            'birthdate' => ['required','date'],
            'classification' => ['required','in:student,teacher,school personnel'],
            'department' => ['required'],
            'program' => ['required']

        ];

        $validator = Validator::make( $request->all(), $rules);

        if($validator->fails()){
            $response = [
                'title' => 'Failed!',
                'message' => 'Some data is invalid, Information not updated.',
                'icon' => 'error',
                'status' => 400
            ];
            $response = json_encode($response, true);
            return redirect()->back()->with('status',$response)->withErrors($validator)->withInput($request->all());
        }
        else{

            //gsuite and otp hereeeeeeeee
            $otp_status = true;

            if($request->gsuite_email != null && $request->otp != null){              
                $this->OTPController = new OTPController;
                $otp_request = new Request([
                    'email'   => $request->gsuite_email,
                    'otp' => $request->otp,
                ]);
                $otp_status = $this->OTPController->verify_otp($otp_request);
            }


            if(!$otp_status && $request->gsuite_email != null && $request->otp != null){
                $response = [
                    'title' => 'Failed!',
                    'message' => 'Invalid OTP.',
                    'icon' => 'error',
                    'status' => 200
                ];
                $response = json_encode($response, true);
                return redirect()->back()->with('status',$response)
                    ->withErrors([
                        'otp' => 'Invalid otp!'
                    ])
                    ->withInput($request->all());
            }
            else if($otp_status && $request->gsuite_email != null && $request->otp != null){
                DB::table('accounts')->where('acc_id', $id)->update([
                    'gsuite_email' => $request->gsuite_email
                ]);
            }
            //gsuite and otp hereeeeeeeee

            try{

                DB::transaction(function () use($request, $id) {

                    $user_details = DB::table('accounts')->where('acc_id',$id)->first();

                    //profile pic
                    if($request->profile_pic!=null){
                        $path = '/public/profile_picture/';
                        $file = $request->file('profile_pic');
                        $file_name = time().'_profile_pic'.$id.'.'.$file->extension();
        
                        $upload = $file->storeAs($path, $file_name);

                        DB::table('accounts')->where('acc_id', $id)->update([
                            'profile_pic' => $file_name
                        ]);

                        if($user_details->profile_pic){
                            Storage::delete($path.$user_details->profile_pic);
                        }
                    }

                    //home address
                    if(!$user_details->home_address_id){
                        $user_details->home_address_id = DB::table('address')->insertGetId([
                            'province' => $request->home_prov,
                            'municipality' => $request->home_mun,
                            'barangay' => $request->home_brgy
                        ]);
                    }
                    else{
                        DB::table('address')->where('add_id', $user_details->home_address_id)
                        ->update([
                            'province' => $request->home_prov,
                            'municipality' => $request->home_mun,
                            'barangay' => $request->home_brgy
                        ]);
                    }

                    //birth address
                    if(!$user_details->birth_address_id){
                        $user_details->birth_address_id = DB::table('address')->insertGetId([
                            'province' => $request->birth_prov,
                            'municipality' => $request->birth_mun,
                            'barangay' => $request->birth_brgy
                        ]);
                    }
                    else{
                        DB::table('address')->where('add_id', $user_details->birth_address_id)
                        ->update([
                            'province' => $request->birth_prov,
                            'municipality' => $request->birth_mun,
                            'barangay' => $request->birth_brgy
                        ]);
                    }
                    
                    // dorm addresss
                    if(!$user_details->dorm_address_id && $request->dorm_brgy!=null){
                        $user_details->dorm_address_id = DB::table('address')->insertGetId([
                            'province' => $request->dorm_prov,
                            'municipality' => $request->dorm_mun,
                            'barangay' => $request->dorm_brgy
                        ]);
                    }
                    else{
                        if($request->dorm_brgy!=null){
                            DB::table('address')->where('add_id', $user_details->dorm_address_id)
                            ->update([
                                'province' => $request->dorm_prov,
                                'municipality' => $request->dorm_mun,
                                'barangay' => $request->dorm_brgy
                            ]);
                        }
                        else{
                            DB::table('address')->where('add_id', $user_details->dorm_address_id)
                            ->delete();
                            $user_details->dorm_address_id = null;
                        }
                    }


                    DB::table('accounts')->where('acc_id', $id)
                    ->update([
                        'email' => $request->email,
                        'contact' => $request->contact,
                        'sr_code' => $request->sr_code,
                        'first_name' => $request->first_name,
                        'middle_name' => $request->middle_name,
                        'last_name' => $request->last_name,
                        'suffix_name' => $request->suffix_name,
                        'birthdate' => $request->birthdate,
                        'gender' => $request->gender,
                        'civil_status' => $request->civil_status,
                        'religion' => $request->religion,
                        'home_address_id' => $user_details->home_address_id,
                        'birth_address_id' => $user_details->birth_address_id,
                        'dorm_address_id' => $user_details->dorm_address_id,
                        'classification' => $request->classification,
                        'grade_level' => $request->grade_level,
                        'dept_id' => $request->department,
                        'prog_id' => $request->program,
                    ]);
                });

                $response = [
                    'title' => 'Success!',
                    'message' => 'Profile updated.',
                    'icon' => 'success',
                    'status' => 200
                ];
                $response = json_encode($response, true);
                return redirect()->back()->with('status',$response);
            }catch(Exception $e){
                echo $e;
            }
        }
    }

    public function update_emergency_contact(Request $request, $id){

        Session()->put('active_page', 'emergency contact');//set active page

        $rules = [
            'emerg_fn' => ['required'],
            'emerg_mn' => ['required'],
            'emerg_ln' => ['required'],
            'emerg_contact' => ['required'],
            'emerg_relation' => ['required'],
            'emerg_prov' => ['required'],
            'emerg_mun' => ['required'],
            'emerg_brgy' => ['required']
        ];

        $validator = Validator::make( $request->all(), $rules);

        if($validator->fails()){
            $response = [
                'title' => 'Failed!',
                'message' => 'Some data is invalid, Information not updated.',
                'icon' => 'error',
                'status' => 400
            ];
            $response = json_encode($response, true);
            return redirect()->back()->with('status',$response)->withErrors($validator)->withInput($request->all());
        }
        else{
            $user_ec_id = DB::table('accounts')
                ->select('ec_id')
                ->where('acc_id',$id)
                ->first()->ec_id;

            if(!$user_ec_id){
                try{
                    DB::transaction(function () use($request, $id) {
                        $new_ec_biz_add_id = DB::table('address')->insertGetId([
                            'province' => $request->emerg_prov,
                            'municipality' => $request->emerg_mun,
                            'barangay' => $request->emerg_brgy
                        ]);

                        $new_ec = DB::table('emergency_contact')->insertGetId([
                            'first_name' => $request->emerg_fn,
                            'middle_name' => $request->emerg_mn,
                            'last_name' => $request->emerg_ln,
                            'suffix_name' => $request->emerg_sn,
                            'relation_to_patient' => $request->emerg_relation,
                            'landline' => $request->emerg_landline,
                            'contact' => $request->emerg_contact,
                            'biz_add_id' => $new_ec_biz_add_id
                        ]);

                        DB::table('accounts')->where('acc_id', $id)
                            ->update([
                                'ec_id' => $new_ec
                            ]);
                    });
                    $response = [
                        'title' => 'Success!',
                        'message' => 'Emergency contact updated.',
                        'icon' => 'success',
                        'status' => 200
                    ];
                    $response = json_encode($response, true);
                    return redirect()->back()->with('status',$response);
                }
                catch(Exception $e){
                    echo $e;
                }
            }
            else{
                try{
                    DB::transaction(function () use($request, $user_ec_id) {
                        

                        DB::table('emergency_contact')->where('ec_id', $user_ec_id)
                        ->update([
                            'first_name' => $request->emerg_fn,
                            'middle_name' => $request->emerg_mn,
                            'last_name' => $request->emerg_ln,
                            'suffix_name' => $request->emerg_sn,
                            'landline' => $request->emerg_landline,
                            'contact' => $request->emerg_contact,
                            'relation_to_patient' => $request->emerg_relation
                        ]);

                        $ec_biz_add_id = DB::table('emergency_contact')->where('ec_id', $user_ec_id)->first()->biz_add_id;
                        
                        DB::table('address')->where('add_id', $ec_biz_add_id)
                            ->update([
                                'province' => $request->emerg_prov,
                                'municipality' => $request->emerg_mun,
                                'barangay' => $request->emerg_brgy
                            ]);
                    });
                    
                    $response = [
                        'title' => 'Success!',
                        'message' => 'Emergency contact updated.',
                        'icon' => 'success',
                        'status' => 200
                    ];
                    $response = json_encode($response, true);
                    return redirect()->back()->with('status',$response);
                }
                catch(Exception $e){
                    echo $e;
                }

            }
        }
    }

    public function update_password(Request $request, $id){

        Session()->put('active_page', 'password');//set active page

        $rules = [
            'new_pass' => ['required', 'max:20', new PasswordRule],
            'confirm_pass' => ['required','same:new_pass'],
            'old_pass' => 'required'
        ];

        $message = [
            'new_pass.required' => 'New password is required',
            'confirm_pass.required' => 'Confirm password is required',
            'confirm_pass.same' => 'Password not match',
            'old_pass.required' => 'Old password is required'
        ];

        $validator = validator::make($request->all(), $rules, $message);

        if($validator->fails()){
            $response = [
                'title' => 'Failed!',
                'message' => 'Password not updated.',
                'icon' => 'error',
                'status' => 400
            ];
            $response = json_encode($response, true);
            return redirect()->back()->with('status',$response)->withErrors($validator)->withInput($request->all());
        }
        else{
            $old_pass = DB::table('accounts')->where('acc_id', $id)->first()->password;

            if(Hash::check($request->old_pass, $old_pass)){
                DB::table('accounts')->where('acc_id',$id)->update([
                    'password' => Hash::make($request->new_pass)
                ]);
                $response = [
                    'title' => 'Success!',
                    'message' => 'Password updated.',
                    'icon' => 'success',
                    'status' => 200
                ];
                $response = json_encode($response);
                return redirect()->back()->with('status',$response);
            }
            else{
                $response = [
                    'title' => 'Failed!',
                    'message' => 'Wrong old password.',
                    'icon' => 'error',
                    'status' => 400
                ];  
                $response = json_encode($response, true);
                return redirect()->back()->with('status',$response)->withErrors($validator)->withInput($request->all());
            }
        }       
    }
}
