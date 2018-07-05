<?php 

namespace App\Http\Middleware;

use Closure;
use Log;

class CorsMiddleware {
  public function handle($request, Closure $next)
  {
    $response = $next($request);
    
    $response->header('Access-Control-Allow-Methods', 'HEAD, GET, POST, PUT, PATCH, DELETE, OPTIONS');
    $response->header('Access-Control-Allow-Headers', $request->header('Access-Control-Request-Headers'));
    $response->header('Access-Control-Allow-Origin', '*');

    return $response;
  }
}
