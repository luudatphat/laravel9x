<?php
return [
    'app_name'      => env('SHOPIFY_APP_NAME', 'alireviews'),
    'api_key'       => env('API_KEY', null),
    'secret_key'    => env('API_SECRET', null),
    'embedded_app'  => env('SHOPIFY_EMBEDDED_APP', true),
    'version'       => '2020-01',
    'scope'         => [
        'read_products',
        'write_products',

        'read_script_tags',
        'write_script_tags',

        'read_themes',
        'write_themes',

        'write_content',
        'read_orders',

        'read_customers',
        // 'read_product_listings',

        'read_resource_feedbacks',
        'write_resource_feedbacks',

        'read_price_rules',
    ],
    'redirect_before_install'   => env('APP_URL') . '/auth',
    'new_user_shopify_plan'     => [
        'lite',
        'dormant',
        'basic',
        'professional',
        'unlimited',
        'shopify_plus',
        'trial',
        'staff',
        'staff_business'
    ],
    'paid_plans' => [
        'lite',
        'dormant',
        'basic',
        'professional',
        'unlimited',
        'shopify_plus',
    ],
];
