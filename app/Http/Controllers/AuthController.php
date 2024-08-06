<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Menampilkan halaman login.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('pages.auth.login');
    }

    /**
     * Proses autentikasi pengguna.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function authenticate(Request $request)
    {
        try {
            // 1. Log data inputan
            Log::info('Request data: ', $request->all());

            // 2. Validasi input
            $validatedData = $request->validate([
                'email' => 'required|email',
                'password' => 'required|min:6|max:12',
            ]);

            Log::info('Validated data: ', $validatedData);

            // 3. Cari akun berdasarkan email
            $user = User::where('email', $request->email)->first();

            // 4. Log hasil pencarian akun
            if ($user) {
                Log::info('User found for email: ' . $request->email);
            } else {
                Log::info('User not found for email: ' . $request->email);
            }

            // 5. Debugging logika hashing
            if ($user) {
                $hashedPassword = $user->password;
                $inputPassword = $request->password;

                Log::info('Database hashed password: ' . $hashedPassword);
                Log::info('Input password hash: ' . Hash::make($inputPassword));
                Log::info('Password match: ' . Hash::check($inputPassword, $hashedPassword));
            }

            // 6. Periksa keberhasilan pencarian akun dan cocokkan password
            if ($user && Hash::check($request->password, $user->password)) {
                // Autentikasi berhasil, login user
                Auth::loginUsingId($user->id);

                Log::info('Login successful for email: ' . $request->email);

                $role = $user->role;
                Log::info('Login successful for email: ' . $request->email . ', role: ' . $role);
                // Redirect sesuai dengan role
              // Redirect sesuai dengan role
                if (strtolower($user->role) === 'admin') {
                    return redirect()->route('index.kalender');
                } else {
                    return redirect()->route('index.user');
                }

            }

            // 7. Jika autentikasi gagal, log kegagalan dan kembalikan ke halaman login
            Log::warning('Login attempt failed for email: ' . $request->email);
            return back()->withErrors([
                'email' => 'Email atau password tidak cocok.',
            ]);
        } catch (\Exception $e) {
            // 8. Tangani error secara rinci
            Log::error('Error during authentication: ' . $e->getMessage());
            return back()->withErrors([
                'email' => 'Terjadi kesalahan saat proses login.',
            ]);
        }
    }

    public function logout(Request $request)
    {
        $userId = Auth::id();
        try {
            // Log out the user
            Auth::logout();

            // Invalidate the session
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            // Redirect to login page with success message
            Log::info('Logout successful for user ID: ' . $userId);

            return redirect()->route('auth')->with('success', 'You have been logged out successfully.');
        } catch (\Exception $e) {
            Log::error('Logout failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Logout failed. Please try again.');
        }
    }
}
