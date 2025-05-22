<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | Controller ini menangani proses autentikasi user dan
    | mengarahkan mereka ke halaman dashboard setelah login.
    |
    */

    use AuthenticatesUsers;

    /**
     * Redirect path setelah user login berhasil.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Membuat instance controller baru.
     */
    public function __construct()
    {
        // Middleware: hanya guest yang bisa akses kecuali logout
        $this->middleware('guest')->except('logout');
        // Middleware: hanya user terautentikasi yang bisa logout
        $this->middleware('auth')->only('logout');
    }
}
