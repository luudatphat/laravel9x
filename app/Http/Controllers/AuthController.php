<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\UserRepository;
use App\Services\Shopify\ApiShopifyService;

class AuthController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function auth(Request $request, UserRepository $userRepo)
    {
        $shop = $request->query('shop');
        $host = $request->query('host');
        $code = $request->query('code');

        // Shopify
        $api = new ApiShopifyService();
        $api->setShop($shop);

        $shopInfoApi = $api->getShop($code);
        $shopInfoApi = $shopInfoApi['body']['container']['shop'];

        $recordShop = [
            'shop_id'       => $shopInfoApi['id'],
            'shop_name'     => $shopInfoApi['myshopify_domain'] ?? null,
            'domain'        => $shopInfoApi['domain'] ?? null,
            'shop_email'    => $shopInfoApi['email'] ?? null,
            'name'          => $shopInfoApi['name'] ?? null,
            'shop_phone'    => $shopInfoApi['phone'] ?? null,
            'shop_status'   => 1,
            'shop_country'  => $shopInfoApi['country'] ?? null,
            'shop_owner'    => $shopInfoApi['shop_owner'] ?? null,
            'plan_name'     => $shopInfoApi['plan_name'] ?? null,
            'app_plan'      => '',
            'access_token'  => $api->getAccessToken(),
            'currency'      => $shopInfoApi['currency'] ?? null,
        ];

        // save info shop
        $userRepo->createShop($shop, $recordShop);

        // Đk webhook ( nếu có thời gian để làm)

        // Chuyển vào trang admin

        $decodedHost = base64_decode($host, true);
        $redirectUrl =  "https://$decodedHost/apps/" . config('shopify.api_key');
        return redirect($redirectUrl);
    }
}
