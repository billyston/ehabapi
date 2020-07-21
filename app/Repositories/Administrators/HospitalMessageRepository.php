<?php

namespace App\Repositories\Administrators;

use App\Http\Resources\MessageResource;
use App\Models\Hospital;
use App\Models\Message;
use App\Traits\Relatives;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class HospitalMessageRepository implements HospitalMessageRepositoryInterface
{
    use Relatives;

    /**
     * @return AnonymousResourceCollection
     */
    public function index (): AnonymousResourceCollection
    {
        return MessageResource::collection( Message::query() -> paginate( 20 ) );
    }

    /**
     * @param Hospital $hospital
     * @param Message $message
     * @return MessageResource
     */
    public function show( Hospital $hospital, Message $message ) : MessageResource
    {
        if ( $this -> loadRelationships() ) { $message -> load( $this -> relationships ); }
        return new MessageResource( $message );
    }
}
