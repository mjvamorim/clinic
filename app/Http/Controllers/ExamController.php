<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Validator;
use Response;
use DataTables;

class ExamController extends Controller
{   
    public function __construct()
    {
        $this->middleware('tenant');
    }

    function index()
    {
        $showables  = Exam::getShowableFields();
        $model = 'exam';
        return view('admin.model',compact('showables','model'));
    }

    function getData()
    {
        $exams = Exam::all();
        return DataTables::of($exams)
            ->addColumn('action', function($exam){
                $btedit = '<button class="btn edit" id="'.$exam->id.'" title="Alterar" data-toggle="tooltip" ><i class="glyphicon glyphicon-edit"></i> </button>';
                $btdelt = '<button class="btn delt" id="'.$exam->id.'" title="Apagar" data-toggle="tooltip" ><i class="glyphicon glyphicon-trash"></i> </button>';
                return '<div align="center">'.$btedit.'<span> </span>'.$btdelt.'</div>';
            })
            ->make(true);
    }

    function fetchData(Request $request,Exam $exam )
    {
        $id = $request->input('id');
        $exam = Exam::find($id);
        echo json_encode($exam);
    }


    function postData(Request $request)
    {
        if($request->get('button_action') == 'delete')
        {
            $id = $request->input('id');

            $deleted = Exam::destroy($id);
            if ($deleted) {
                $error_array = [];
                $success_output = '<div class="alert alert-success">Data Deleted</div>';
            } else {
                $success_output = '<div class="alert alert-danger">Data Deleted</div>';
                $error_array = [];
            }

        }
        else {

            $rules = Exam::getRules();
            $validation = Validator::make($request->all(), Exam::getRules());      
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
                    $exam = new Exam;
                    $input =  $request->only($exam->fillable);
                    $exam->fill($input);
                    $exam->save();
                    $success_output = '<div class="alert alert-success">Data Inserted</div>';
                }

                if($request->get('button_action') == 'update')
                {
                    $exam = Exam::find($request->get('id'));
                    $input =  $request->only($exam->fillable);
                    $exam->fill($input);
                    $exam->save();
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
