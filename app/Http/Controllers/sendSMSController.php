<?php

namespace App\Http\Controllers;

use App\Services\SMS\SMSService;
use Illuminate\Http\Request;

class sendSMSController extends Controller
{
    public $SMSService;

    public function __construct( SMSService $SMSService )
    {
        $this -> SMSService = $SMSService;
    }

    /**
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function sendNotification()
    {
        return $this -> SMSService -> sendSMS();
    }
}
