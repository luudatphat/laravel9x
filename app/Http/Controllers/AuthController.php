<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Shopify\Auth\OAuth;
use Shopify\Utils;

class AuthController extends Controller
{
    public function index(Request $request)
    {
        return view('welcome');
    }

    public function auth(Request $request)
    {
        $session = OAuth::callback(
            $request->cookie(),
            $request->query(),
        );

        $host = $request->query('host');
        $shop = Utils::sanitizeShopDomain($request->query('shop'));

        $redirectUrl = Utils::getEmbeddedAppUrl($host);
        return redirect($redirectUrl);
    }
}
