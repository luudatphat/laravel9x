<?php

namespace App\Http\Middleware;

use App\Models\Session;
use Closure;
use Illuminate\Http\Request;
use Shopify\Auth\OAuth;
use Shopify\Auth\OAuthCookie;
use Shopify\Context;
use Shopify\Utils;
use App\Lib\DbSessionStorage;
use Shopify\ApiVersion;

class ShopifyAuthTest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        Context::initialize(
            env('SHOPIFY_API_KEY', 'not_defined'),
            env('SHOPIFY_API_SECRET', 'not_defined'),
            env('SCOPES', 'not_defined'),
            'https://2df1-42-96-52-2.ap.ngrok.io',
            new DbSessionStorage(),
            ApiVersion::LATEST,
            true,
            false,
        );

        $shop = $request->query('shop') ? Utils::sanitizeShopDomain($request->query('shop')) : null;

        $appInstalled = $shop && Session::where('shop', $shop)->where('access_token', '<>', null)->exists();

        // Embedded App
        if ($request->query("embedded", false)) {
            dd("embedded");
            return redirect(Utils::getEmbeddedAppUrl($request->query("host", null)) . "/" . $request->path());
        }


        // Install app
        if ($shop && !$appInstalled) {
            // $urlInstall = OAuth::begin($shop, '/auth', $isOnline = false);
            $cookiesSet = [];
            $cookieCallback = function (OAuthCookie $cookie) use (&$cookiesSet) {
                $cookiesSet[$cookie->getName()] = $cookie;
                return !empty($cookie->getValue());
            };

            $urlInstall = OAuth::begin(
                $shop,
                '/auth/callback',
                $isOnline = false,
                $cookieCallback,
            );
            dd('install', $urlInstall);
            return redirect($urlInstall);
        }

        dd("Next");
        return $next($request);
    }
}
