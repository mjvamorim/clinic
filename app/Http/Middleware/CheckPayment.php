<?php

namespace App\Http\Middleware;

use App\Tenant\Models\Company;
use Closure;

class CheckPayment {

    public function __construct(Company $company) {

    }

    public function handle($request, Closure $next) {
        if (auth()->user()->id!=1)
            return redirect()->route('payments')->withErrors(['error' => __('Pague o que voce deve.')]);
        return $next($request);
    }
}
