<?php

namespace App\Jobs;

use App\Http\Requests\MessageRequest;
use App\Http\Resources\MessageResource;
use App\Models\Message;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class StoreMessageJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $theRequest;

    /**
     * StoreMessageJob constructor.
     * @param MessageRequest $messageRequest
     */
    public function __construct( MessageRequest $messageRequest )
    {
        $this -> theRequest = $messageRequest;
    }

    /**
     * @return \Illuminate\Http\JsonResponse|object
     */
    public function handle()
    {
        $Message = new Message( $this -> theRequest [ 'data.attributes' ] );
        $Message -> service() -> associate( $this -> theRequest [ 'data.relationships.service.data.id' ] );

        $Message -> save();

        // Return appointment resource
        return ( new MessageResource( $Message ) ) -> response() -> setStatusCode(201 );
    }
}
