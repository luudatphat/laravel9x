<?php

namespace App\Services;

use Crisp\CrispClient;

class CrispChatService
{
    const IDENTIFIER    = '28978ff2-0f11-4e51-94e5-191ba17ab0a9'; //'5956d369-c168-4763-8cca-af9a0b61d507';//'d0a6feca-a048-4f0c-be9e-49c9c968d6b4'; //
    // const KEY           = 'd012a4ce303a37f748c29fc2358cff7c3a4da30ba66614718e66fcff95f8fa1e'; //'3e47952695c4bcf55395854b4168d26a610b29842af644a811b5c2bdd787cde8'; //'d3cea291bb5273ed2e85012e9c198b069ac294b6c1ce6a6fd03826bdbfe599dc'; //
    // const WEBSITEID     = 'd0929417-5a55-4927-8e27-af8a02853726';

    // ALIREVIEW_NEW
    const KEY            = '47e391d3dfa41df86bf92a09810b0fc1b7660a66156d87a2a576d8d1af89e967';
    const WEBSITEID      = 'd0929417-5a55-4927-8e27-af8a02853726';

    protected $crispClient;


    public function __construct()
    {
        $this->crispClient = new CrispClient();
        $this->crispClient->authenticate(self::IDENTIFIER, self::KEY);
        $this->crispClient->setTier('plugin');
    }

    public function findByEmail($email)
    {
        $data = $this->crispClient->websitePeople->findByEmail(self::WEBSITEID, $email);
        return $data;
    }

    public function checkEmail($email)
    {
        $data = $this->crispClient->websitePeople->checkPeopleProfileExists(self::WEBSITEID, $email);
        dd('check', $email, $data);
    }

    public function conversations($email)
    {
        // $peopleId = '77a3a3c3-b94d-4b5b-8153-347e0013ccbe';
        // $peopleId = '1059d9c5-82cd-453b-8b60-3b5f996796fb';
        // $data = $this->crispClient->websitePeople->listPeopleConversations(self::WEBSITEID, $peopleId, 1);
        $data = $this->crispClient->websitePeople->listPeopleEvent(self::WEBSITEID, $email, 1);
        return $data;
        dd('Conversation', $email, $data);

        // $peopleId = '77a3a3c3-b94d-4b5b-8153-347e0013ccbe';
        // $crispClient = new \Crisp\CrispClient();
        // $crispClient->authenticate(self::IDENTIFIER, self::KEY);
        // $value = $crispClient->websitePeople->listPeopleConversations(self::WEBSITEID, $peopleId, 1);
        // dd($value);
    }

    public function listPeopleConversations($peopleId)
    {
        // dd($email);
        // $peopleId = '1059d9c5-82cd-453b-8b60-3b5f996796fb';
        // $data = $this->crispClient->websitePeople->listPeopleConversations(self::WEBSITEID, $peopleId, 1);
        // // dd('Conversation', $email, $data);
        // $session = $data[0];

        // $urlChatCrip = 'https://app.crisp.chat/website/d0929417-5a55-4927-8e27-af8a02853726/inbox/' . $session;
        // dd($urlChatCrip);


        return $this->crispClient->websitePeople->listPeopleConversations(self::WEBSITEID, $peopleId, $page = 1);
    }

    public function createConversations()
    {
        //v1/website/{website_id}/conversation
        // CrispClient->websiteConversations->create(websiteId)

        // $session = $this->crispClient->websiteConversations->create(self::WEBSITEID);
        // dd($session);

        return $this->crispClient->websiteConversations->create(self::WEBSITEID);
    }

    public function sendMailConversation()
    {
        //v1/website/{website_id}/conversation/{session_id}/message
        // CrispClient->websiteConversations->sendMessage(websiteId, sessionId, message)


    }

    public function updateConversationMetas()
    {
        //v1/website/{website_id}/conversation/{session_id}/meta
        //CrispClient->websiteConversations->updateMeta(websiteId, sessionId, params)
    }

    public function getAConversation($sessionId)
    {
        return $this->crispClient->websiteConversations->getOne(self::WEBSITEID, $sessionId);
    }
}
