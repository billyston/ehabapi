<?php

namespace App\Repositories;

use App\Http\Requests\AppointmentRequest;
use App\Http\Requests\MessageRequest;
use App\Http\Resources\AppointmentResource;
use App\Http\Resources\MessageResource;
use App\Jobs\StoreAppointmentJob;
use App\Jobs\StoreMessageJob;
use App\Jobs\UpdateAppointmentJob;
use App\Jobs\UpdateMessageJob;
use App\Models\Appointment;
use App\Models\Message;
use App\Traits\Relatives;

class MessageRepository implements MessageRepositoryInterface
{
    use Relatives;

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection|mixed
     */
    public function index()
    {
        return MessageResource::collection( Message::all() );
    }

    /**
     * @param MessageRequest $messageRequest
     * @return mixed|void
     */
    public function store( MessageRequest $messageRequest )
    {
        return ( new StoreMessageJob( $messageRequest ) ) -> handle();
    }

    /**
     * @param Message $message
     * @return MessageResource|mixed
     */
    public function show( Message $message )
    {
        if ( $this -> loadRelationships() ) { $message -> load( $this -> relationships ); }
        return new MessageResource( $message );
    }

    /**
     * @param MessageRequest $messageRequest
     * @param Message $message
     * @return mixed|void
     */
    public function update( MessageRequest $messageRequest, Message $message )
    {
        return ( new UpdateMessageJob( $messageRequest, $message ) ) -> handle();
    }

    /**
     * @param Message $message
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function destroy( Message $message )
    {
        try
        {
            $message -> delete();
            return response()->json('', 204);
        }

        catch ( \Exception $exception )
        {
            report($exception);
            return errorResponse();
        }
    }
}
