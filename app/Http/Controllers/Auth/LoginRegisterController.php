<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Jobs\SendMailJob;
use App\Mail\SendEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class LoginRegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function register()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:250',
            'email' => 'required|email|max:250|unique:users',
            'password' => 'required|min:8|confirmed',
        ]);

        DB::beginTransaction();
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        if (checkdnsrr(explode('@', $request->email)[1], 'MX')) {
            $email = new SendEmail([
                'name' => $request->name,
                'email' => $request->email,
                'subject' => 'Welcome to our website!',
            ]);
            SendMailJob::dispatch($request->email, $email);
        }
        DB::commit();

        auth()->login($user);
        session()->regenerate();

        return redirect()->route('dashboard')->with('success', 'You are registered!');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (auth()->attempt($credentials)) {
            session()->regenerate();
            return redirect()->route('dashboard')->with('success', 'You are logged in!');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('login')->with('success', 'You are logged out!');
    }
}
