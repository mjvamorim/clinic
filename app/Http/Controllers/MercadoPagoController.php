<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use App\Tenant\TenantController;


class MercadoPagoController extends Controller
{


    public function mp(Request $request)
    {
        return view('mp.index');
    }

    public function mpPost(Request $request)
    {
        return view('mp.post_payment');
    }


    public function mpPostBoleto(Request $request)
    {
        return view('mp.post_boleto');
    }


}