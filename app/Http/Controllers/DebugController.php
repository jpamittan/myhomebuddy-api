<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\{
    BillingAccount,
    Order,
    OrderSchedule,
    Product,
    ProductReview,
    User
};
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
        Order::truncate();
        OrderSchedule::truncate();

        return redirect('/debug?clear=consumers');
    }

    public function clearSellers(): RedirectResponse
    {
        User::where('type', 'Seller')
            ->delete();
        BillingAccount::truncate();

        return redirect('/debug?clear=sellers');
    }

    public function clearProducts(): RedirectResponse
    {
        Product::truncate();
        ProductReview::truncate();

        return redirect('/debug?clear=products');
    }
}
