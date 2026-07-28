<?php
namespace App\Http\Middleware;
use App\Models\Setting;use Closure;use Illuminate\Http\Request;
class MaintenanceMode {public function handle(Request $request,Closure $next){$enabled=Setting::value('maintenance_mode','0')==='1';$admin=$request->user()?->is_active && $request->user()->hasRole('super_admin');if($enabled && !$admin)return response()->view('errors.maintenance',[],503);return $next($request);}}
