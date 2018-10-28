<?php

namespace App\Tenant;

use Illuminate\Http\Request;
use App\Tenant\Models\Company;
use App\Tenant\TenantConnector;
use App\Tenant\TenantConfigDB;
use App\Http\Controllers\Controller;

class TenantController extends Controller
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
    public function select(Request $request,  Company $company) {

        TenantConfigDB::createDatabase($company);
        $this->reconnect($this->company->findOrFail($company->id)); 
        $request->session()->put('tenant', $company);
        TenantConfigDB::createTenantTables();
        $output = array(
            'tenant'     =>  $company,
        );
        echo json_encode($output);
    }
    public function selectTenant(Request $request, Company $company) {
        TenantConfigDB::createDatabase($company);
        $this->reconnect($this->company->findOrFail($company->id)); 
        $request->session()->put('tenant', $company);
        TenantConfigDB::createTenantTables();
    }
}