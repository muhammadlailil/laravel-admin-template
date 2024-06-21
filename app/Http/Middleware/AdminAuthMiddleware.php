<?php

namespace App\Http\Middleware;

use App\Services\Util\NotificationService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!admin()->user) {
            return to_route('admin.auth.login')->with(['message' => 'Please login first !']);
        }


        $notification = (new NotificationService)->findTopNotification();
        view()->share('notification', $notification);
        return $next($request);
    }
}
