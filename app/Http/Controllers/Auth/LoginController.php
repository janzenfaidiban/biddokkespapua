<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Handle login process with role-based redirection.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Silakan masukkan alamat email Anda.',
            'email.email' => 'Format alamat email tidak valid.',
            'password.required' => 'Silakan masukkan kata sandi Anda.',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            return $this->redirectUser($user);
        }

        return back()->withErrors([
            'email' => 'Email atau kata sandi salah.',
        ])->withInput($request->only('email'));
    }

    /**
     * Redirect user based on role after authentication.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function authenticated(Request $request, $user)
    {
        return $this->redirectUser($user);
    }

    /**
     * Determine where to redirect user based on their role.
     *
     * @param  mixed  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    private function redirectUser($user)
    {
        if ($user->hasRole('admin')) {
            return redirect('/admin');
        } elseif ($user->hasRole('operator')) {
            return redirect('/operator');
        }

        return redirect('/login'); // Redirect default jika tidak ada role
    }
}
