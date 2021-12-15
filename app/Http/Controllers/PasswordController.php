<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Validator;

class PasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $token = $request->route()->parameter('token');
        return view('auth.passwords.create-password')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    protected function create(array $data)
    {
        $user = User::create([
            'password' => Hash::make($data['password']),
        ]);
        return $user;
    }

    protected function rules()
    {
        return [
            'token' => 'required',
            'email' => 'required|email',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ];
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function validationErrorMessages()
    {
        return [];
    }
}
