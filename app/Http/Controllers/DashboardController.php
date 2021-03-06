<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(): View
    {
        if (Auth::user()->type == "Admin") {
            return view('index');
        }

        return view('dashboard.user-index');
    }

    public function consumers(): View
    {
        return view('dashboard.consumers', [

        ]);
    }

    public function sellers(): View
    {
        return view('dashboard.sellers', [

        ]);
    }
}
