<?php

namespace Modules\User\App\Actions;

use Modules\User\App\Models\User; // Если нужно, добавьте это пространство имен
use Illuminate\Support\Facades\Hash;

class RegisterAction
{
    public function execute(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
