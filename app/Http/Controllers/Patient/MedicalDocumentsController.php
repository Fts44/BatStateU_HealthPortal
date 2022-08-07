<?php

namespace App\Http\Controllers\patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MedicalDocumentsController extends Controller
{
    public function index(){

        $user_documents = DB::table('patient_documents AS pd')
        ->leftjoin('document_type AS dt', 'pd.dt_id', 'dt.dt_id')
        ->where('acc_id', Session('user_id'))->get();

        $document_type = DB::table('document_type')->get();
        
        return view('patient.MedicalDocuments', compact('user_documents','document_type'));
    }

    public function upload(Request $request, $id){

        $rules = [
            'document_type' => ['required'],
            'file' => ['required','max:5000','mimes:jpg,pdf']
        ];

        $message = [
            'document_type.required' => 'Document type is required.',
            'file.required' => 'File is required.'
        ];

        $validator = Validator::make( $request->all(), $rules);

        if($validator->fails()){
            $response = [
                'title' => 'Failed!',
                'message' => 'Invalid data, File not uploaded.',
                'icon' => 'error',
                'status' => 400
            ];
            return redirect()->back()->with('status',$response)->withErrors($validator)->withInput($request->all());
        }
        else{
            if($request->file('file')->isValid()){
                $path = '/public/documents/'.$request->document_type;
                $file = $request->file('file');
                $file_name = time().'_'.$request->document_type.'_'.$id.'.'.$file->extension();
                $upload = $file->storeAs($path, $file_name);

                DB::table('patient_documents')->insert([
                    'dt_id' => $request->document_type,
                    'filename' => $file_name,
                    'acc_id' => $id
                ]);

                $response = [
                    'title' => 'Succes!',
                    'message' => 'Document uploaded.',
                    'icon' => 'success',
                    'status' => 200
                ];
                $response = json_encode($response);
                return redirect()->back()->with('status',$response);
            }
        }    
    }

    public function delete(Request $request, $pd_id){
        $pd_details = DB::table('patient_documents')->first();
        DB::table('patient_documents')->where('pd_id', $pd_id)->delete();
        $path = '/public/documents/'.$pd_details->dt_id;
        Storage::delete($path.$pd_details->filename);

        $response = [
            'title' => 'Succes!',
            'message' => 'Document deleted.',
            'icon' => 'success',
            'status' => 200
        ];
        $response = json_encode($response);
        return redirect()->back()->with('status',$response);
    }

    public function view($pd_id){


        $doc_details = DB::table('patient_documents')->where('pd_id',$pd_id)->first();

        if(str_contains($doc_details->filename,'.pdf')){
            return view('ViewPDF', compact('doc_details'));
        }
        else{
            return view('ViewImage', compact('doc_details'));
        }
    }
}
