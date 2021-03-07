<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
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

    public function users(): View
    {
        return view('dashboard.user-list');
    }

    public function consumers(): View
    {
        $users = User::where('type', 'Consumer')
            ->orderBy('created_at', 'DESC')
            ->paginate(20);

        return view('dashboard.consumers', [
            'users' => $users
        ]);
    }

    public function consumer(User $user): View
    {
        return view('dashboard.consumer-detail', [
            'user' => $user
        ]);
    }

    public function sellers(): View
    {
        $users = User::where('type', 'Seller')
            ->orderBy('created_at', 'DESC')
            ->paginate(20);

        return view('dashboard.sellers', [
            'users' => $users
        ]);
    }

    public function seller(User $user): View
    {
        return view('dashboard.seller-detail', [
            'user' => $user
        ]);
    }
}
