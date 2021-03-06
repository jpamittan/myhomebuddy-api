<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;

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
}
