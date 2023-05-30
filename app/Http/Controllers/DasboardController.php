<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DasboardController extends Controller
{
    protected $guard = 'admin';

    public function __construct()
    {
        // $this->middleware('auth:admin');
    }

    public function index()
    {
        $user = Auth::check();
        return view('home');
    }

    public function admin()
    {
        $admin = Auth::guard('admin')->check();
        dd($admin, 'admin');

        return view('home');
    }
}
