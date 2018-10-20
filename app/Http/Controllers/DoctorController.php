<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Validator;
use Response;

class DoctorController extends Controller
{

    
    protected $rules = [
        'name' => 'required|min:5|max:50',
        'email' => 'required|email',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Doctor $new)
    {

        $doctors = Doctor::all();
        $blank = Doctor::blank();
        $fillables   =  Doctor::getFillableFields();
        $showables = Doctor::getShowableFields();
        return view('admin.doctor.doctor',compact('doctors','fillables','showables','blank'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(Input::all(), $this->rules);
        if ($validator->fails()) {
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
        } else {
            $doctor = new Doctor();
            $doctor->name = $request->name;
            $doctor->email = $request->email;
            $doctor->save();
            return response()->json($doctor);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Doctor  $Doctor
     * @return \Illuminate\Http\Response
     */
    public function show(Doctor $doctor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function edit(Doctor $doctor)
    {
        
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Doctor $doctor)
    {

        $validator = Validator::make(Input::all(), $this->rules);
        if ($validator->fails()) {
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
        } else {
            $doctor = Doctor::findOrFail($doctor->id);
            $doctor->name = $request->name;
            $doctor->email = $request->email;
            $doctor->save();
            return response()->json($doctor);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Doctor $doctor)
    {
        $doctor = Doctor::findOrFail($doctor->id);
        $doctor->delete();
        return response()->json($doctor);
    

    }
}
