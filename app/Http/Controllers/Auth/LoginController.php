<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\MstDataPegawai;

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

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }

    public function register(Reqeust $request){
        $this->validate($request, [
            'email' => 'required|email|unique:users,email',
            'password' => 'required'
        ]);

        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
        ]);

        return response()->json(['status' => 'success', 'data' => $user], 200);
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|exists:users,email',
            'password' => 'required'
        ]);

        $input = $request->all();

        $user = User::where('email', $input['email'])->first();
        $pegawai = MstDataPegawai::where('user_id', $user->id)->first();
        $isAdmin = $pegawai->hak_akses == 1 ? true : null;

        $auth = $request->except(['remember_me']);
        if (auth()->attempt($auth, $request->remember_me)) {
            auth()->user()->update(['api_token' => Str::random(40)]);
            return response()->json(['status' => 'success', 'data' => auth()->user()->api_token, 'isAdmin' => $isAdmin], 200);
        }
        return response()->json(['status' => 'failed']);
    }
}
