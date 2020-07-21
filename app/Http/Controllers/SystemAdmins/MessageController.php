<?php

namespace App\Http\Controllers\SystemAdmins;

use App\Http\Controllers\Controller;
use App\Http\Requests\MessageRequest;
use App\Models\Message;
use App\Repositories\MessageRepositoryInterface;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    private $theRepository;

    /**
     * MessageController constructor.
     * @param MessageRepositoryInterface $messageRepository
     */
    public function __construct ( MessageRepositoryInterface $messageRepository )
    {
        return $this -> theRepository = $messageRepository;
    }

    /**
     * @return mixed
     */
    public function index()
    {
        return $this -> theRepository -> index();
    }

    /**
     * @param MessageRequest $messageRequest
     * @return mixed
     */
    public function store( MessageRequest $messageRequest)
    {
        return $this -> theRepository -> store( $messageRequest );
    }

    /**
     * @param Message $message
     * @return mixed
     */
    public function show( Message $message )
    {
        return $this -> theRepository -> show( $message );
    }

    /**
     * @param MessageRequest $messageRequest
     * @param Message $message
     * @return mixed
     */
    function update( MessageRequest $messageRequest, Message $message )
    {
        return $this -> theRepository -> update( $messageRequest, $message );
    }

    /**
     * @param Message $message
     * @return mixed
     */
    public function destroy( Message $message )
    {
        return $this -> theRepository -> destroy( $message );
    }
}
