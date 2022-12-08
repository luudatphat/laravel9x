<?php

namespace App\Services\Shopify;

use Gnikyt\BasicShopifyAPI\BasicShopifyAPI;
use Gnikyt\BasicShopifyAPI\Options;

class BasicShopifyService
{
    public function buildClient()
    {
        $options = new Options();
        $options->setType(false)
            ->setVersion(config('shopify.version'))
            ->setApiKey(config('shopify.api_key'))
            ->setApiSecret(config('shopify.secret_key'));

        return new BasicShopifyAPI($options);
    }
}
