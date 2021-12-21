<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Arr;

use App\Models\User;
use App\Models\UsersTokens;

class PasswordController extends Controller
{
    public function __construct()
    {
    }

    public function index(Request $request)
    {
        $token = $_GET['token'];

        return view('auth.passwords.create-password')
            ->with(
                [
                    'token' => $token, 'email' => $request->email
                ]
            );
    }

    public function setPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required',
        ]);

        if ($request->password != $request->password_confirmation) {
            return back()->withInput()->with('error', 'Password don\'t match!');
        }

        $tokenReceived = $request->token;
        $userToken = UsersTokens::where('name', 'set_password_token')
            ->where('token', $tokenReceived)
            ->where('status', 'Active')
            ->first();

        if (isset($userToken, $userToken->id)) {
            $to = Carbon::createFromFormat('Y-m-d H:s:i',  Carbon::now());
            $from = Carbon::createFromFormat('Y-m-d H:s:i', $userToken->created_at);
            $diff_in_minutes = $to->diffInMinutes($from);

            if ($diff_in_minutes > (60 * 12)) {
                $userToken->update([
                    'status' => 'expired'
                ]);

                return redirect()->back()->with('error', 'Your Token is Expired');
                // return message token is expired
            }

            $user = User::where('id', $userToken->user_id)->first();
            $user->update([
                'password' => Hash::make($request->password)
            ]);
            $userToken->update([
                'status' => 'used'
            ]);

            return redirect()->route('regulardashboard')
                ->with('success', 'Your Password has been updated succefully!');
            // return success message
        } else {
            return redirect()->route('home')
                ->with('error', 'Your token is invalid');
            // return with token invalid message
        }
    }

    protected function rules()
    {
        return [
            'token' => 'required',
            'email' => 'required|email',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ];
    }

    protected function validationErrorMessages()
    {
        return [];
    }
}
