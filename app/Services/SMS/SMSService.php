<?php

namespace App\Services\SMS;

use App\Traits\SMSNotification;

class SMSService
{
    use SMSNotification;

    /**
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function sendSMS()
    {
        return $this -> performSendSMS();
    }
}
