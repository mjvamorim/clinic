<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Http\Controllers\TenantController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;


class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('admin');
    }

  

  //Assim funciona
    public function doctor($id)
    {
        $doctor=Doctor::find($id);
        return '</br>'.$doctor;
    }

    //Este não funciona
    public function doctorViaModel(Doctor $doctor)
    {
        return '</br>'.$doctor;
    }
}
