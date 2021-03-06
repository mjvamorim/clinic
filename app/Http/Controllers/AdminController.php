<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Amorim\Tenant\Models\Company;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Amorim\Tenant\Controllers\TenantController;


class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request, TenantController $stc)
    {
        if (auth()->check()) {
            $stc->selectTenant($request, auth()->user()->company);
        }
        return view('admin.index');
    }

    public function payments() 
    {
        return view('admin.payments');
    }

}
