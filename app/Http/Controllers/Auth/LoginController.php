<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;            
use Illuminate\Support\Facades\Validator; 
use Illuminate\Support\Facades\Hash;      
use Illuminate\Support\Facades\Auth;      
use App\Models\User;                    
use App\Models\Role;                      


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
        $this->middleware('auth')->only('logout');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Pastikan Anda juga memiliki Model RoleUser di App\Models jika digunakan
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::with(['roleUser' => function ($query) {
            $query->where('status', 1);
        }])->where('email', $request->email)->first();

        if (!$user) {
            return redirect()->back()
                ->withErrors(['email' => 'Email tidak ditemukan.'])
                ->withInput();
        }

        if (!Hash::check($request->password, $user->password)) {
            return redirect()->back()
                ->withErrors(['password' => 'Password salah.'])
                ->withInput();
        }
        
        // Pastikan user memiliki setidaknya satu role yang aktif sebelum mengakses indeks [0]
        $activeRole = $user->roleUser[0] ?? null;

        $namaRole = null;
        if ($activeRole && $activeRole->idrole) {
            $namaRole = Role::where('idrole', $activeRole->idrole)->first();
        }
        
        Auth::login($user);

        $request->session()->put([
            'user_id' => $user->iduser,
            'user_name' => $user->nama,
            'user_email' => $user->email,
            'user_role' => $activeRole->idrole ?? 'user',
            'user_role_name' => $namaRole->nama_role ?? 'User',
            'user_status' => $activeRole->status ?? 'active' // Disesuaikan logikanya
        ]);

        // return redirect()->intended('/home')->with('success', 'Login berhasil.');

        $userRole = $user->roleUser[0]->idrole ?? null;
        
        switch ($userRole) {
            case '1':
                return redirect()->route('admin.dashboard')->with('success', 'Login berhasil sebagai Administrator.');
                break;
            case '2':
                return redirect()->route('dokter.dashboard')->with('success', 'Login berhasil sebagai Dokter.');
                break;
            case '3':
                return redirect()->route('perawat.dashboard')->with('success', 'Login berhasil sebagai Perawat.');
                break;
            case '4':
                return redirect()->route('resepsionis.dashboard')->with('success', 'Login berhasil sebagai Resepsionis.');
                break;
            default:
                return redirect()->route('pemilik.dashboard')->with('success', 'Login berhasil sebagai Pengguna.');
                break;
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Logout berhasil.');
    }
}
