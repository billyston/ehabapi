<?php

namespace App\Repositories;

use App\Http\Requests\MessageRequest;
use App\Models\Message;

interface MessageRepositoryInterface
{
    /**
     * @return mixed
     */
    public function index();

    /**
     * @param MessageRequest $messageRequest
     * @return mixed
     */
    public function store( MessageRequest $messageRequest );

    /**
     * @param Message $message
     * @return mixed
     */
    public function show( Message $message );

    /**
     * @param MessageRequest $messageRequest
     * @param Message $message
     * @return mixed
     */
    public function update( MessageRequest $messageRequest, Message $message );

    /**
     * @param Message $message
     * @return mixed
     */
    public function destroy( Message $message );
}
