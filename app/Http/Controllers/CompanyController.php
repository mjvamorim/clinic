<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Validator;
use Response;

class CompanyController extends Controller
{

    public function index(Company $company)
    {

        $companies  = Company::all();
        $blank      = Company::blank();
        $fillables  = Company::getFillableFields();
        $showables  = Company::getShowableFields();
        return view('admin.company.company',compact('companies','fillables','showables','blank'));
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
        $validator = Validator::make(Input::all(), Company::getRules());
        if ($validator->fails()) {
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
        } else {
            $company = new Company();
            $input =  $request->only($company->fillable);
            $company->fill($input);
            $company->save();
            return response()->json($company);
        }
    }

    public function show(Company $company)
    {
    }

    public function edit(Company $company)
    {
    }

    public function update(Request $request)
    {
        $company = new Company;
        $validator = Validator::make(Input::all(), Company::getRules());
        if ($validator->fails()) {
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
        } else {
            $company = Company::findOrFail($company->id);
            $input =  $request->only($company->fillable);
            $company->fill($input);
            $company->save();
            return response()->json($company);
        }

    }

    public function destroy(Company $company)
    {
        $company = Company::findOrFail($company->id);
        $company->delete();
        return response()->json($company);
    

    }
}
