<?php

namespace App\Observers;

use App\Models\Message;

class MessageObserver
{
    public function creating( Message $message )
    {
        $message -> smart_id = uniqid();
    }
}
