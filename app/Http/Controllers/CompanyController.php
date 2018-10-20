<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Validator;
use Response;

class CompanyController extends Controller
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
    public function index(Company $new)
    {

        $companies = Company::all();
        $blank = Company::blank();
        $fillables   =  Company::getFillableFields();
        $showables = Company::getShowableFields();
        return view('admin.company.company',compact('companies','fillables','showables','blank'));
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
            $company = new Company();
            $company->name = $request->name;
            $company->email = $request->email;
            $company->save();
            return response()->json($company);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Company  $Company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {

        $validator = Validator::make(Input::all(), $this->rules);
        if ($validator->fails()) {
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
        } else {
            $company = Company::findOrFail($company->id);
            $company->name = $request->name;
            $company->email = $request->email;
            $company->save();
            return response()->json($company);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $company = Company::findOrFail($company->id);
        $company->delete();
        return response()->json($company);
    

    }
}
