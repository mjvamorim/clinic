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
    protected $rules = [
        'name' => 'required|min:5|max:50',
        'email' => 'required|email',
    ];

    function index()
    {
     return view('admin.doctor.doctor');
    }

    function getdata()
    {
     $doctors = Doctor::all();
     return DataTables::of($doctors)
            ->addColumn('action', function($doctor){
                return '<a href="#" class="btn btn-xs btn-primary edit" id="'.$doctor->id.'"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
            })
            ->make(true);
    }

    function fetchdata(Request $request)
    {
        $id = $request->input('id');
        $doctor = Doctor::find($id);
        $output = array(
            'name'    =>  $doctor->name,
            'email'     =>  $doctor->email
        );
        echo json_encode($output);
    }

    function postdata(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'email'  => 'required',
        ]);
        
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
                $doctor = new Doctor([
                    'name'    =>  $request->get('name'),
                    'email'     =>  $request->get('email')
                ]);
                $doctor->save();
                $success_output = '<div class="alert alert-success">Data Inserted</div>';
            }

            if($request->get('button_action') == 'update')
            {
                $doctor = Doctor::find($request->get('doctor_id'));
                $doctor->name = $request->get('name');
                $doctor->email = $request->get('email');
                $doctor->save();
                $success_output = '<div class="alert alert-success">Data Updated</div>';
            }
            
        }
        
        $output = array(
            'error'     =>  $error_array,
            'success'   =>  $success_output
        );
        echo json_encode($output);
    }
}
