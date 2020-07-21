<?php

namespace App\Repositories\Administrators;

use App\Http\Resources\MessageResource;
use App\Models\Hospital;
use App\Models\Message;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

interface HospitalMessageRepositoryInterface
{
    /**
     * @return AnonymousResourceCollection
     */
    public function index( ): AnonymousResourceCollection;

    /**
     * @param Hospital $hospital
     * @param Message $message
     * @return MessageResource
     */
    public function show( Hospital $hospital, Message $message ): MessageResource;
}
