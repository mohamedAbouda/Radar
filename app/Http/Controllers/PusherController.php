<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;

class PusherController extends Controller
{
    protected $title;
    protected $body;
    protected $data;
    protected $token;

    function __construct($title,$body,$data,$token)
    {
        $this->title = $title;
        $this->body = $body;
        $this->data = $data;
        $this->token = $token;
    }
    public function send()
    {
        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive(60*20);

        $notificationBuilder = new PayloadNotificationBuilder($this->title);
        $notificationBuilder->setBody($this->body)
        ->setSound('default');

        $dataBuilder = new PayloadDataBuilder();
        $dataBuilder->addData($this->data);

        $option = $optionBuilder->build();
        $notification = $notificationBuilder->build();
        $data = $dataBuilder->build();

        $token = $this->token;

        $downstreamResponse = FCM::sendTo($token, $option, $notification, $data);

        return [
            'success' => $downstreamResponse->numberSuccess(),
            'failure' => $downstreamResponse->numberFailure(),
            'modification' => $downstreamResponse->numberModification(),
            //return Array - you must remove all this tokens in your database
            'toDelete' => $downstreamResponse->tokensToDelete(),
            //return Array (key : oldToken, value : new token - you must change the token in your database )
            'toModify' => $downstreamResponse->tokensToModify(),
            //return Array - you should try to resend the message to the tokens in the array
            'toRetry' => $downstreamResponse->tokensToRetry()
        ];
    }
}
