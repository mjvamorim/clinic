<?php

namespace Amorim\Subscriptions\Controllers;

use App\Http\Controllers\Controller;

use Amorim\Subscriptions\Models\Subscription;

class SubscriptionsController extends Controller
{   

    function index()
    {
        $subscriptions = Subscription::all();
        return view('subscriptions::index',compact('subscriptions'));
    }

   
}

