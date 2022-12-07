<?php

namespace App\Http\Middleware;

use App\Models\Session as ModelsSession;
use Closure;
use Illuminate\Http\Request;
use Gnikyt\BasicShopifyAPI\BasicShopifyAPI;
use Gnikyt\BasicShopifyAPI\Options;
use Gnikyt\BasicShopifyAPI\Session;

class AuthShopify
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
        $isEmbeddApp = $request->query('embedded');
        $shop = $request->query('shop');

        // Shopify
        $options = new Options();
        $options->setType(true); // Makes it private
        $options->setVersion(config('shopify.version'));
        $options->setApiKey(config('shopify.api_key'));
        // $options->setApiPassword(config('shopify.secret_key'));

        // Create the client and session
        $api = new BasicShopifyAPI($options);
        $api->setSession(new Session($request->query('shop')));

        $shopInfo = ModelsSession::where('shop', $shop)->where('access_token', '<>', null)->exists();

        if(!$isEmbeddApp && !$shopInfo){
            $installApp = $api->getAuthUrl(config('shopify.scope'), env('APP_URL') . '/auth/callback');
            return redirect($installApp);
        }

        $code = $request->query('code');

        $baseUrl = $api->getRestClient()->getBaseUri();
        $shopInShopify = $api->getRestClient()->request('GET', '/admin/shop.json');
        $accessToken =  $api->requestAccessToken($code);
        dd($baseUrl, $shopInShopify, $accessToken);

        return $next($request);
    }
}
