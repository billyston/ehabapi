<?php

namespace App\Jobs;

use App\Http\Resources\NextOfKinResource;
use App\Models\NextOfKin;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class StoreNextOfKinJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $theRequest; private $theModel;

    /**
     * StoreNextOfKinJob constructor.
     * @param array $theRequest
     * @param Model $theModel
     */
    public function __construct( array $theRequest, Model $theModel )
    {
        $this -> theRequest = $theRequest;
        $this -> theModel = $theModel;
    }

    /**
     * @return NextOfKinResource
     */
    public function handle()
    {
        $nextOfKin = new NextOfKin( $this -> theRequest[ 'attributes' ] );
        $nextOfKin -> client() -> associate( $this -> theModel );
        $nextOfKin -> save();

        return new NextOfKinResource( $nextOfKin );
    }
}
