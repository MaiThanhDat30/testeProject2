<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Yêu cầu đã đăng nhập
        if (!auth()->check()) {
            abort(401, 'Bạn cần đăng nhập.');
        }

        // Kiểm tra role
        if (!in_array(auth()->user()->role, $roles)) {
            abort(403, 'Bạn không có quyền truy cập.');
        }

        // Trước khi vào controller (nếu muốn làm gì đó)
        $response = $next($request);

        // Sau khi controller trả response (nếu muốn gắn header/log)
        $response->headers->set('X-Checked-By', 'CheckRole');

        return $response;
    }
}
