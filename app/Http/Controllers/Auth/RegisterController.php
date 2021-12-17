<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\UsersTokens;
use Illuminate\Foundation\Auth\RegistersUsers;
use DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Mail\SetupPasswordEmail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'username' => $data['username'],
            'email' => $data['email'],
        ]);
        $user->assignRole('Regular');

        $userToken = UsersTokens::create([
            'user_id' => $user->id,
            'name' => 'set_password_token',
            'status' => 'Active',
            'token' => str_random(60),
        ]);

        $user['password_token'] = $userToken->token;
        return $user;
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $setupPasswordMail = new SetupPasswordEmail($user);

        Mail::to($user->email)->send($setupPasswordMail);
        if (count(Mail::failures()) > 0) {
            return view('auth.verify')
                ->with('error', 'Created user but the email to setup password could not be sent!');
        } else {
            DB::table('users')->where('id', $user->id)->update(['setup_password_email_sent_at' => date("Y-m-d H:i:s")]);

            return view('auth.verify')
                ->with('success', 'Successfully created user and sent an email to the user to setup the password!');
        }
    }

    public function showRegistrationForm()
    {
        return view('auth.register')
            ->with('currentpage', 'register');
    }
}
