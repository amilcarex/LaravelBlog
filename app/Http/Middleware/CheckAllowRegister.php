<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckAllowRegister
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $allow  = DB::table('general_settings')->select('allowRegister')->first();
        if ($allow->allowRegister == 0) {
            return redirect()->route('login');
        }
        return $next($request);
    }
}
