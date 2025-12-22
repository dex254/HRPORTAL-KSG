<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\HR;
use App\Models\Admin;
use App\Models\Diary;
use App\Models\Staff;
use App\Models\Program;
use App\Models\Password;
use App\Models\Timetable;
use App\Models\Timetable1;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DatatableMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $hr =HR ::all();

        $request->merge(['hr' => $hr]);
        $admin =Admin ::all();

        $request->merge(['admin' => $admin]);
        $password =Password ::all();

        $request->merge(['password' => $password]);
       
        
        return $next($request);
    }
}
