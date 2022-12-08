<?php

namespace App\Http\Middleware;

use App\Repository\UserRepository;
use App\Services\Shopify\ApiShopifyService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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

        // Shop
        $userRepo = new UserRepository();
        $user = $userRepo->getShop($shop);
        // Log::debug('login', $request->all());

        if (empty($user) || empty($user->access_token) || !$isEmbeddApp) {
            // Shopify
            $api = new ApiShopifyService();
            $api->setShop($shop);

            $urlInstall = $api->installShopify();
            return redirect($urlInstall);
        }

        return $next($request);
    }
}
