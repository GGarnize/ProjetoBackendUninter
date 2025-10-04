<?php

namespace App\Http\Middleware;

use App\Models\AuditLog;
use Closure;

class AuditLogMiddleware
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        try {
            if (in_array($request->method(), ['POST','PUT','PATCH','DELETE'])) {
                $payload = $request->except(['password','senha','token']);
                AuditLog::create([
                    'user_id'=>optional($request->user())->id,
                    'method'=>$request->method(),
                    'route'=>$request->path(),
                    'ip'=>$request->ip(),
                    'payload_hash'=>hash('sha256', json_encode($payload)),
                ]);
            }
        } catch (\Throwable $e) {}
        return $response;
    }
}


