<?php

namespace App\Http\Controllers;

use App\Mail\ActivateSeller;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;

class ActivateController extends Controller
{
    public function consumer(User $user, string $hash): View
    {
        $view = 'activate.index';
        if (md5($user->last_name) == $hash) {
            $user->is_activated = 1;
            $user->save();
        } else {
            $view = 'activate.error';
        }

        return view($view);
    }

    public function seller(User $user): RedirectResponse
    {
        $user->is_activated = 1;
        if($user->save()) {
            Mail::to($user->email)
                ->send(
                    new ActivateSeller(
                        $user->first_name
                    )
                );
        }

        return redirect('/users/sellers');
    }
}
