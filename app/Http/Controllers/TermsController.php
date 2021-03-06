<?php

namespace App\Http\Controllers;

use App\Models\Term;
use Illuminate\Contracts\View\View;
use Illuminate\Http\{
    RedirectResponse,
    Request
};

class TermsController extends Controller
{
    public function index(): View
    {
        $consumerTerm = Term::find(1);
        $sellerTerm = Term::find(2);

        return view('terms.index', [
            'consumerTerm' => $consumerTerm,
            'sellerTerm' => $sellerTerm
        ]);
    }

    public function consumers(): View
    {
        $term = Term::find(1);
        $userType = "Consumers";

        return view('terms.details', [
            'term' => $term,
            'userType' => $userType
        ]);
    }

    public function sellers(): View
    {
        $term = Term::find(2);
        $userType = "Sellers";

        return view('terms.details', [
            'term' => $term,
            'userType' => $userType
        ]);
    }

    public function update(Term $term, Request $request): RedirectResponse
    {
        $term->content = $request->input('content');
        $term->save();

        return redirect('/terms');
    }
    
}
