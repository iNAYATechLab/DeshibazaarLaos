<?php
namespace App\Http\Middleware;use Closure;use Illuminate\Http\Request;use Illuminate\Support\Facades\App;
class SetLocale { public function handle(Request $r,Closure $next){App::setLocale(session('locale','en'));return $next($r);} }
