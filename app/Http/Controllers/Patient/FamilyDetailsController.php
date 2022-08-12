<?php

namespace App\Http\Controllers\patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class FamilyDetailsController extends Controller
{
    public function index(){
        $user_fd_id = DB::table('accounts')
            ->where('acc_id', Session('user_id'))
            ->first()->fd_id;

        $user_fd_details = DB::table('family_details AS fd')
            ->leftjoin('family_health_history AS fhh', 'fd.fhh_id', 'fhh.fhh_id')
            ->where('fd_id', $user_fd_id)
            ->first();

        // echo json_encode($user_fd_details);

        if(!$user_fd_details){
            
            $user_fd_details = [
                'father_fn' => null,
                'father_mn' => null,
                'father_ln' => null,
                'father_sn' => null,
                'father_occupation' => null,
                'mother_fn' => null,
                'mother_mn' => null,
                'mother_ln' => null,
                'mother_sn' => null,
                'mother_occupation' => null,
                'marital_status' => null,
                'diabetes' => null,
                'heart_disease' => null,
                'mental_illness' => null,
                'cancer' => null,
                'hypertension' => null,
                'kidney_disease' => null,
                'epilepsy' => null,
                'others' => null
            ];

            // $user_fd_details = (object)$user_fd_details;
        }

        return view('patient.FamilyDetails', compact('user_fd_details'));
    }

    public function update(Request $request, $id){

        $rules = [
            'father_fn' => ['required'],
            'father_mn' => ['required'],
            'father_ln' => ['required'],
            'father_occupation' => ['required'],
            'mother_fn' => ['required'],
            'mother_mn' => ['required'],
            'mother_ln' => ['required'],
            'mother_occupation' => ['required'],
            'marital_status' => ['required', 'in:married,separated,unmarried'],
        ];

        $validator = validator::make($request->all(), $rules);

        if($validator->fails()){
            $response = [
                'title' => 'Failed!',
                'message' => 'Invalid data, Family details not updated.',
                'icon' => 'error',
                'status' => 400
            ];
            $response = json_encode($response, true);
            return redirect()->back()->with('status',$response)->withErrors($validator)->withInput($request->all());
        }
        else{
            $user = DB::table('accounts')->where('acc_id', $id)->first();

            //if family details is null add new
            if(!$user->fd_id){
                try{
                    DB::transaction(function() use($request, $id){

                        $new_fhh_id = null;
                        if($request->diabetes || $request->heart_disease || $request->mental_illness || $request->cancer || $request->hypertension || $request->kidney_disease || $request->epilepsy || $request->others!=null){
                            $new_fhh_id = DB::table('family_health_history')->insertGetId([
                                'diabetes' => (($request->diabetes=='on') ? '1' : '0'),
                                'heart_disease' => (($request->heart_disease=='on') ? '1' : '0'),
                                'mental_illness' => (($request->mental_illness=='on') ? '1' : '0'),
                                'cancer' => (($request->cancer=='on') ? '1' : '0'),
                                'hypertension' => (($request->hypertension=='on') ? '1' : '0'),
                                'kidney_disease' => (($request->kidney_disease=='on') ? '1' : '0'),
                                'epilepsy' => (($request->epilepsy=='on') ? '1' : '0'),
                                'others' => $request->others
                            ]);
                        }

                        $new_fd_id = DB::table('family_details')->insertGetId([
                            'father_fn' => $request->father_fn,
                            'father_mn' => $request->father_mn,
                            'father_ln' => $request->father_ln,
                            'father_sn' => $request->father_sn,
                            'father_occupation' => $request->father_occupation,
                            'mother_fn' => $request->mother_fn,
                            'mother_mn' => $request->mother_mn,
                            'mother_ln' => $request->mother_ln,
                            'mother_sn' => $request->mother_sn,
                            'mother_occupation' => $request->mother_occupation,
                            'marital_status' => $request->marital_status,
                            'fhh_id' => $new_fhh_id
                        ]);

                        DB::table('accounts')->where('acc_id',$id)->update([
                            'fd_id' => $new_fd_id
                        ]);
                        
                    });
                    $response = [
                        'title' => 'Success!',
                        'message' => 'Family Details updated.',
                        'icon' => 'success',
                        'status' => 200
                    ];
                    $response = json_encode($response);
                    return redirect()->back()->with('status',$response);
                }
                catch(Exception $e){
                    echo $e;
                }
            }
            else{
                try{
                    DB::transaction(function() use($request, $id){
                        $user = DB::table('accounts')->where('acc_id',$id)->first();
                        $fd_details = DB::table('family_details')->where('fd_id', $user->fd_id)->first();
                        if($fd_details->fhh_id){
                            if($request->diabetes || $request->heart_disease || $request->mental_illness || $request->cancer || $request->hypertension || $request->kidney_disease || $request->epilepsy || $request->others!=null){
                                DB::table('family_health_history')->where('fhh_id', $fd_details->fhh_id)->update([
                                    'diabetes' => (($request->diabetes=='on') ? '1' : '0'),
                                    'heart_disease' => (($request->heart_disease=='on') ? '1' : '0'),
                                    'mental_illness' => (($request->mental_illness=='on') ? '1' : '0'),
                                    'cancer' => (($request->cancer=='on') ? '1' : '0'),
                                    'hypertension' => (($request->hypertension=='on') ? '1' : '0'),
                                    'kidney_disease' => (($request->kidney_disease=='on') ? '1' : '0'),
                                    'epilepsy' => (($request->epilepsy=='on') ? '1' : '0'),
                                    'others' => $request->others
                                ]);
                            }
                            else{
                   
                                DB::table('family_health_history')->where('fhh_id', $fd_details->fhh_id)->delete();
                                $fd_details->fhh_id = null;
                                DB::table('family_details')->where('fd_id', $user->fd_id)->update([
                                    'fhh_id' => NULL
                                ]);
                            }
                        }
                        else{
                            if($request->diabetes || $request->heart_disease || $request->mental_illness || $request->cancer || $request->hypertension || $request->kidney_disease || $request->epilepsy || $request->others!=null){
                                $fd_details->fhh_id = DB::table('family_health_history')->insertGetId([
                                    'diabetes' => (($request->diabetes=='on') ? '1' : '0'),
                                    'heart_disease' => (($request->heart_disease=='on') ? '1' : '0'),
                                    'mental_illness' => (($request->mental_illness=='on') ? '1' : '0'),
                                    'cancer' => (($request->cancer=='on') ? '1' : '0'),
                                    'hypertension' => (($request->hypertension=='on') ? '1' : '0'),
                                    'kidney_disease' => (($request->kidney_disease=='on') ? '1' : '0'),
                                    'epilepsy' => (($request->epilepsy=='on') ? '1' : '0'),
                                    'others' => $request->others
                                ]);
                            }
                        }
                        DB::table('family_details')->where('fd_id', $fd_details->fd_id)->update([
                            'father_fn' => $request->father_fn,
                            'father_mn' => $request->father_mn,
                            'father_ln' => $request->father_ln,
                            'father_sn' => $request->father_sn,
                            'father_occupation' => $request->father_occupation,
                            'mother_fn' => $request->mother_fn,
                            'mother_mn' => $request->mother_mn,
                            'mother_ln' => $request->mother_ln,
                            'mother_sn' => $request->mother_sn,
                            'mother_occupation' => $request->mother_occupation,
                            'marital_status' => $request->marital_status,
                            'fhh_id' => $fd_details->fhh_id
                        ]);
                    });
                    $response = [
                        'title' => 'Success!',
                        'message' => 'Family Details updated.',
                        'icon' => 'success',
                        'status' => 200
                    ];
                    $response = json_encode($response);
                    return redirect()->back()->with('status',$response);
                }
                catch(Exception $e){
                    echo $e;
                }
            }
        }
    }   
}
