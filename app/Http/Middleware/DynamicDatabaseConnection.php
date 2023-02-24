<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class DynamicDatabaseConnection
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (session('dynamic_database') == null) {

            $dynamic_database = config('database.connections.mysql_dynamic.database');
            session(['dynamic_database' => $dynamic_database]);

        }

        $dynamic_database = session('dynamic_database');

        Config::set([
            'database.connections.mysql.database' => $dynamic_database,
        ]);

        return $next($request);
    }
}
