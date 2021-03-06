<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('index', [

        ]);
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
