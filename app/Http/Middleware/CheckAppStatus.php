<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\ApplicationConfig;
use Illuminate\Database\Eloquent\Model;

class CheckAppStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $status = ApplicationConfig::first();

        if ($status->application_info_id == 1) {
            return redirect('/offline');
        }
        return $next($request);
    }
}
