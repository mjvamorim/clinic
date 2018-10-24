<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Validator;
use Response;
use DataTables;

class UserController extends Controller
{   
    public function __construct()
    {
    }

    function index()
    {
        $showables  = User::getShowableFields();
        $model = 'user';
        return view('admin.model',compact('showables','model'));
    }

    function getData()
    {
        $users = User::all();
        return DataTables::of($users)
            ->addColumn('action', function($user){
                $btedit = '<button class="btn edit" id="'.$user->id.'" title="Alterar" data-toggle="tooltip" ><i class="glyphicon glyphicon-edit"></i> </button>';
                $btdelt = '<button class="btn delt" id="'.$user->id.'" title="Apagar" data-toggle="tooltip" ><i class="glyphicon glyphicon-trash"></i> </button>';
                return '<div align="center">'.$btedit.'<span> </span>'.$btdelt.'</div>';
            })
            ->make(true);
    }

    function fetchData(Request $request,User $user )
    {
        $id = $request->input('id');
        $user = User::find($id);
        echo json_encode($user);
    }


    function postData(Request $request)
    {
        if($request->get('button_action') == 'delete')
        {
            $id = $request->input('id');

            $deleted = User::destroy($id);
            if ($deleted) {
                $error_array = [];
                $success_output = '<div class="alert alert-success">Data Deleted</div>';
            } else {
                $success_output = '<div class="alert alert-danger">Data Deleted</div>';
                $error_array = [];
            }

        }
        else {

            $rules = User::getRules();
            $validation = Validator::make($request->all(), User::getRules());      
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
                    $user = new User;
                    $input =  $request->only($user->fillable);
                    $user->fill($input);
                    $user->save();
                    $success_output = '<div class="alert alert-success">Data Inserted</div>';
                }

                if($request->get('button_action') == 'update')
                {
                    $user = User::find($request->get('id'));
                    $input =  $request->only($user->fillable);
                    $user->fill($input);
                    $user->save();
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
