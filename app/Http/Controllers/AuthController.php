<?php

namespace App\Http\Controllers;

use App\Models\Session as ModelsSession;
use Gnikyt\BasicShopifyAPI\BasicShopifyAPI;
use Gnikyt\BasicShopifyAPI\Options;
use Gnikyt\BasicShopifyAPI\Session;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function auth(Request $request)
    {
        $shop = $request->query('shop');
        $host = $request->query('host');
        $code = $request->query('code');

        // Shopify
        $options = new Options();
        $options->setType(false)
            ->setVersion(config('shopify.version'))
            ->setApiKey(config('shopify.api_key'))
            ->setApiSecret(config('shopify.secret_key'));
            // ->setApiPassword('abc');;

        // Create the client and session
        $api = new BasicShopifyAPI($options);
        $api->setSession(new Session($request->query('shop')));


        $baseUrl = $api->getRestClient()->getBaseUri();
        // $shopInShopify = $api->getRestClient()->request('GET', '/admin/shop.json');
        // $accessToken =  $api->requestAndSetAccess($code);

        // $api->requestAndSetAccess($code);

        // You can now make API calls
        $result = $api->requestAccessToken($code);
        // $response = $api->rest('GET', '/admin/shop.json'););
    }
}
