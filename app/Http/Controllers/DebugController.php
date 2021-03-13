<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\{
    RedirectResponse,
    Request
};

class DebugController extends Controller
{
    public function index(): View
    {
        return view('debug.index');
    }

    public function clearConsumers(): RedirectResponse
    {
        User::where('type', 'Consumer')
            ->delete();

        return redirect('/debug?clear=consumers');
    }

    public function clearSellers(): RedirectResponse
    {
        User::where('type', 'Seller')
            ->delete();

        return redirect('/debug?clear=sellers');
    }
}
