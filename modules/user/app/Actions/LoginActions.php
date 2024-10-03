<?php

namespace Modules\User\App\Actions;

use Illuminate\Support\Facades\Auth;

class LoginAction
{
    public function execute(array $credentials)
    {
        if (Auth::attempt($credentials)) {
            return Auth::user();
        }

        return null;
    }
}
