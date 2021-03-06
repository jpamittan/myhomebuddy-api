<?php

namespace App\Http\Controllers;

use Auth, Hash, Str;
use App\Mail\ForgotPassword;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\{
    RedirectResponse,
    Request
};

class LoginController extends Controller
{
    public function index(): View
    {
        $authenticate = app('request')->input('authenticate');

        return view('auth.login', [
            'authenticate' => ($authenticate == "false") ? false : true
        ]);
    }

    public function auth(Request $request): RedirectResponse
    {
        $userData = [
            'email' => $request->get('email'),
            'password' => $request->get('password')
        ];

        return (Auth::attempt($userData)) ? redirect('/') : redirect('/login?authenticate=false');
    }

    public function logout(): RedirectResponse
    {
        Auth::logout();

        return redirect('/login');
    }
}
