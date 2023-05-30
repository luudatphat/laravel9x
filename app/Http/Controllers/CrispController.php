<?php

namespace App\Http\Controllers;

use App\Services\CrispChatService;
use Illuminate\Http\Request;

class CrispController extends Controller
{
    // const EMAIL = 'phat.luniq6@gmail.com';
    const EMAIL         = 'phat.luniq8@gmail.com';
    // const IDENTIFIER    = 'd0a6feca-a048-4f0c-be9e-49c9c968d6b4';
    // const KEY           = 'd3cea291bb5273ed2e85012e9c198b069ac294b6c1ce6a6fd03826bdbfe599dc';
    // const WEBSITEID     = 'd0929417-5a55-4927-8e27-af8a02853726';

    // const IDENTIFIER_T     = '9a1514bf-1cce-4d92-853a-44a5cce66f9b';
    // const KEY_T            = 'd012a4ce303a37f748c29fc2358cff7c3a4da30ba66614718e66fcff95f8fa1e';
    // const WEBSITEID_T      = "d0929417-5a55-4927-8e27-af8a02853726";

    const KEY_ALIREVIEW_NEW            = '47e391d3dfa41df86bf92a09810b0fc1b7660a66156d87a2a576d8d1af89e967';
    const IDENTIFIER_ALIREVIEW_NEW      = '28978ff2-0f11-4e51-94e5-191ba17ab0a9';

    protected $crispChatService;

    public function __construct(CrispChatService $crispChatService)
    {
        $this->crispChatService = $crispChatService;
    }

    public function index()
    {
        // $login = sprintf('%s:%s', self::IDENTIFIER_ALIREVIEW_NEW, self::KEY_ALIREVIEW_NEW);
        // $base = sprintf('Basic %s', base64_encode($login));
        // dd($base);

        // $login = sprintf('%s:%s', self::IDENTIFIER_T, self::KEY_T);
        // $base = sprintf('Basic %s', base64_encode($login));
        // dd($base);
        // Find By Email
        $email = self::EMAIL;
        $email = $this->crispChatService->findByEmail($email);
        $peopleId = $email['people_id'];
        $cons = $this->crispChatService->listPeopleConversations($peopleId);
        if (empty($cons)) {
            $session = $this->crispChatService->createConversations();
        } else {
            // check từng cái để lấy đc session đúng nhất
            foreach ($cons as $session) {
                $data = $this->crispChatService->getAConversation($session);
                dd($data['meta']['data']['shopify_domain']);
            }
            // "shopify_domain": "phatluniq.myshopify.com",
            // "shopify_domain": "phatluniq-01.myshopify.com",
        }
        dd($session);
    }

    public function check()
    {
        $email = self::EMAIL;
        // $this->crispChatService->checkEmail($email);
        $con = $this->crispChatService->conversations($email);
        dd($con);
    }

    public function conversations()
    {
        $email = self::EMAIL;
        $this->crispChatService->conversations($email);
    }

    public function listconversations()
    {
        $email = self::EMAIL;
        $this->crispChatService->listPeopleConversations($email);
    }

    public function createconversations()
    {
        $email = self::EMAIL;
        $this->crispChatService->createConversations($email);
    }
}
