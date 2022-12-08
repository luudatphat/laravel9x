<?php

namespace App\Services\Shopify;

use App\Services\Shopify\BasicShopifyService;
use Gnikyt\BasicShopifyAPI\Session;

class ApiShopifyService extends BasicShopifyService
{
    protected $api;
    public function __construct()
    {
        $this->api = $this->buildClient();
    }

    public function setShop($shop)
    {
        $this->api->setSession(new Session($shop));
    }

    public function getAccessToken($code = null)
    {
        if ($code) {
            return $this->api->requestAccessToken($code);
        }
        return $this->api->getSession()->getAccessToken();
    }

    public function getShop($code)
    {
        $this->api->requestAndSetAccess($code);

        return $this->api->getRestClient()->request('GET', '/admin/shop.json');
    }

    public function installShopify()
    {
        return $this->api->getAuthUrl(config('shopify.scope'), env('APP_URL') . '/auth/callback');
    }
}
