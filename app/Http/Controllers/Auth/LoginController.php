<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers {
        logout as performLogout;
    }


    


    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    public function redirectTo() {
        $role = Auth::user()->role->id; 
        switch ($role) {
            case '1':
                return "dashboard/admin";
                break;
            case '2':
                return "dashboard/mitra";
                break;
            default:
                return "dashboard/pekerja";
                break;
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function credentials(Request $request)
    {
        return $request->only($this->username(), 'password', 'status');
    }


    protected function attemptLogin(Request $request)
    {
        $request->merge(['status' => '1']);

        return $this->guard()->attempt(
            $this->credentials($request), $request->filled('remember')
        );
    }

    public function logout(Request $request) {
        $this->performLogout($request);
        return redirect()->route('login');
    }
}
