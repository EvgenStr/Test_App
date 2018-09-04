<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    protected $users;

    public function __construct(User $users)
    {
        $this->users = $users;
    }

    // функция для роута админ
    public function index()
    {
        echo "Hello admin";
    }

    // аутентификация и авторизация пользователя
    public function login(Request $request)
    {
        $user = $this->users->where('email', $request->email)->first();
        $password = $request->password;
        if (!isset($user)) {
            return response()->json('Wrong e-mail');
        } elseif (Hash::check($password, $user->password)) {
            if ($user->root === 1) {
                return response()->json('admin');
            } else {
                return response()->json('user');
            }
        } else {
            return response()->json('Wrong password');
        }
    }

    // регистрация нового пользователя
    public function registration(Request $request)
    {
        $user = $this->users->where('email', $request->email)->first();
        if (isset($user)) {
            return response()->json("Error");
        } else {
            return $this->users::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
        }
    }
}