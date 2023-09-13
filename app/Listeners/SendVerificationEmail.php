<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
// use Google\Cloud\PubSub\PubSubClient;
use Google\Cloud\PubSub\PubSubClient;

class SendVerificationEmail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(UserRegistered $event)
    {
        $pubSub = new PubSubClient();
        $topic = $pubSub->topic(env('GCP_EMAIL_TOPIC'));

        // Publish a message to the topic.
        $topic->publish([
            'attributes' => [
                'email'             => $event->user['email'],
                'email_for'         => 'User Registered',
                'verification_code' => $event->user['verification_code'],
            ]
        ]);
    }
}
