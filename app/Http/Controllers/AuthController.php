<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Fungsi untuk menampilkan form lupa password
    public function showForgotPasswordForm(){
        return view('lupapassword');
    }

    // Fungsi untuk lupa password
    public function forgotPassword(Request $request){
        $request->validate([
            'email' => 'required|email',
            'new_password' => 'required',
            'confirm_new_password' => 'required|same:new_password',
        ]);

        $user = User::where('email',$request->email)->first();

        if (!$user){
            return back()->with('error', 'Email tidak terdaftar');
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->route('login')->with('success', 'Password berhasil direset. Silahkan login menggunakan password baru Anda.');
    }

    // Fungsi untuk menampilkan form ganti password
    public function showChangePasswordForm()
    {
        return view('gantipassword');
    }

    // Fungsi untuk mengubah password pengguna
    public function changePassword(Request $request)
    {
        // Validasi input
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required',
            'confirm_new_password' => 'required|same:new_password',
        ]);

        // Mendapatkan data pengguna yang sedang login
        $user = Auth::user();

        // Memeriksa apakah password lama cocok dengan password yang tersimpan di database
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'Password saat ini salah.');
        }

        // Memeriksa apakah password baru dan konfirmasi password cocok
        if ($request->new_password !== $request->confirm_new_password) {
            return back()->with('error', 'Konfirmasi kata sandi baru tidak cocok.');
        }

        // Hash password baru
        $newPasswordHash = Hash::make($request->new_password);

        // Perbarui password pengguna langsung di dalam database
        User::where('id', $user->id)->update(['password' => $newPasswordHash]);

        return redirect()->route('dashboard')->with('success', 'Password berhasil diubah.');
    }

    public function index()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('/dashboard');
        }

        return redirect()->back()->with('error', 'Email atau password yang Anda masukkan salah.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login');
    }

    public function showRegistrationForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string',
        ], [
            'email.unique' => 'Email sudah terdaftar, silahkan gunakan email lain.',
        ]);

        try {
            $data['name'] = $request->name;
            $data['email'] = $request->email;
            $data['password'] = Hash::make($request->password);

            $user = User::create($data);

            if ($user) {
                return redirect(route('register'))->with("success", "Registrasi berhasil, silahkan untuk login untuk mengakses aplikasi!");
            }
        } catch (\Exception $e) {
            return redirect(route('register'))->with("error", "Registrasi gagal, silahkan coba lagi.");
        }
    }
}
