<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Validator;
use Response;
use DataTables;

class DoctorController extends Controller
{   
    public function __construct()
    {
        $this->middleware('tenant');
    }

    function index()
    {
        $showables  = Doctor::getShowableFields();
        return view('admin.doctor.doctor',compact('showables'));
    }

    function getData()
    {
        $doctors = Doctor::all();
        return DataTables::of($doctors)
            ->addColumn('action', function($doctor){
                $btedit = '<button class="btn edit" id="'.$doctor->id.'" title="Alterar" data-toggle="tooltip" ><i class="glyphicon glyphicon-edit"></i> </button>';
                $btdelt = '<button class="btn delt" id="'.$doctor->id.'" title="Apagar" data-toggle="tooltip" ><i class="glyphicon glyphicon-trash"></i> </button>';
                return '<div align="center">'.$btedit.'<span> </span>'.$btdelt.'</div>';
            })
            ->make(true);
    }

    function fetchData(Request $request,Doctor $doctor )
    {
        $id = $request->input('id');
        $doctor = Doctor::find($id);
        echo json_encode($doctor);
    }


    function postData(Request $request)
    {
        if($request->get('button_action') == 'delete')
        {
            $id = $request->input('id');

            $deleted = Doctor::destroy($id);
            if ($deleted) {
                $error_array = [];
                $success_output = '<div class="alert alert-success">Data Deleted</div>';
            } else {
                $success_output = '<div class="alert alert-danger">Data Deleted</div>';
                $error_array = [];
            }

        }
        else {

            $rules = Doctor::getRules();
            $validation = Validator::make($request->all(), Doctor::getRules());      
            $error_array = array();
            $success_output = '';
            if ($validation->fails())
            {
                foreach ($validation->messages()->getMessages() as $field_name => $messages)
                {
                    $error_array[] = $messages; 
                }
            }
            else
            {
                if($request->get('button_action') == 'insert')
                {
                    $doctor = new Doctor;
                    $input =  $request->only($doctor->fillable);
                    $doctor->fill($input);
                    $doctor->save();
                    $success_output = '<div class="alert alert-success">Data Inserted</div>';
                }

                if($request->get('button_action') == 'update')
                {
                    $doctor = Doctor::find($request->get('id'));
                    $input =  $request->only($doctor->fillable);
                    $doctor->fill($input);
                    $doctor->save();
                    $success_output = '<div class="alert alert-success">Data Updated</div>';
                }
            }
        }
            
        $output = array(
            'error'     =>  $error_array,
            'success'   =>  $success_output,
            'eu'        => 'Mauricio Amorim',
        );
        echo json_encode($output);
    }
}
