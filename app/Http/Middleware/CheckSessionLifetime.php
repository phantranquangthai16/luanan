<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckSessionLifetime
{
    public function handle($request, Closure $next)
    {
        // Kiểm tra nếu người dùng đã đăng nhập
        if (Auth::check()) {
            // Lấy thời gian bắt đầu của session
            $sessionStartTime = Session::get('session_start_time');

            // Kiểm tra nếu session đã hết hạn
            if ($sessionStartTime && now()->diffInMinutes($sessionStartTime) >= config('session.lifetime')) {
                // Logout người dùng
                Auth::logout();

                // Xóa session_start_time để tránh logout lặp lại
                Session::forget('session_start_time');

                // Redirect hoặc thực hiện hành động nào đó khi logout
                return redirect()->route('login')->with('error', 'Phiên làm việc của bạn đã hết hạn. Vui lòng đăng nhập lại.');
            }
        }

        // Nếu chưa hết hạn, tiếp tục xử lý request
        return $next($request);
    }
}
