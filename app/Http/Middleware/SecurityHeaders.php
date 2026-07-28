<?php
namespace App\Http\Middleware;use Closure;use Illuminate\Http\Request;
class SecurityHeaders {public function handle(Request $r,Closure $next){$res=$next($r);$res->headers->set('X-Content-Type-Options','nosniff');$res->headers->set('X-Frame-Options','SAMEORIGIN');$res->headers->set('Referrer-Policy','strict-origin-when-cross-origin');$res->headers->set('Permissions-Policy','camera=(), microphone=(), geolocation=()');return $res;}}
