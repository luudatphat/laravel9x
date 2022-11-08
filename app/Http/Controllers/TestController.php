<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Artisan::call('mail:send {user}');
        dd(123);
    }

    public function postText()
    {
        dd(123);
    }
    public function indexApi(Request $request)
    {
        // dd(123);
        $data = $request->session()->all();
        dd($data);
        $value = $request->session()->get('test123', 'default');

    }

    public function getSession()
    {
        session(['key' => 'value']);
        $value = session('key_test', 'default');
        dd($value);
    }
}
