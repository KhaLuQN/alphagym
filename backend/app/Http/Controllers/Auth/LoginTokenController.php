<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\LoginTokenMail;
use App\Models\LoginToken;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class LoginTokenController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function sendLoginToken(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users,email']);

        $user = User::where('email', $request->email)->firstOrFail();

        $token = Str::random(64);

        LoginToken::create([
            'user_id'    => $user->id,
            'token'      => $token,
            'expires_at' => now()->addMinutes(15),
        ]);

        Mail::to($user->email)->send(new LoginTokenMail($token));

        return redirect()->route('login')->with('success', 'Chúng tôi đã gửi một liên kết đăng nhập đến email của bạn.');
    }

    public function login($token)
    {
        $loginToken = LoginToken::where('token', $token)->first();

        if (! $loginToken || $loginToken->isExpired()) {
            return redirect()->route('login')->withErrors(['email' => 'Liên kết đăng nhập không hợp lệ hoặc đã hết hạn.']);
        }

        Auth::login($loginToken->user, true);

        $loginToken->delete();

        return redirect()->route('admin.dashboard.index');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Đăng xuất thành công.');
    }
}
