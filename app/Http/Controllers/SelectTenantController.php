<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use App\Models\Company;
use App\Models\Doctor;
use App\Http\Middleware\Tenant;
use App\Support\TenantConnector;

class SelectTenantController extends Controller
{
    use TenantConnector;
    protected  $company;
    public function __construct()
    {
        $this->company = Company::findOrFail(1);
    }
    /**
     * @GET
     * @param Request $request
     * @param $company
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function select(Request $request,  $company) {

        $this->reconnect($this->company->findOrFail($company)); 
        $request->session()->put('tenant', $company);
        $output = array(
            'tenant'     =>  $company,
        );
        echo json_encode($output);

    }
}