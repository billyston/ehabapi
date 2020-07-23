<?php

namespace App\Http\Controllers\Administrators;

use App\Http\Controllers\Controller;
use App\Http\Requests\MessageRequest;
use App\Jobs\StoreMessageJob;
use App\Models\Hospital;
use App\Models\Message;
use App\Repositories\Administrators\HospitalMessageRepositoryInterface;
use Illuminate\Http\Response;

class HospitalMessageController extends Controller
{
    private $theRepository;

    /**
     * HospitalMessageController constructor.
     * @param HospitalMessageRepositoryInterface $hospitalMessageRepository
     */
    public function __construct( HospitalMessageRepositoryInterface $hospitalMessageRepository )
    {
        $this -> theRepository = $hospitalMessageRepository;
    }

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return $this -> theRepository -> index();
    }

    /**
     * @param MessageRequest $messageRequest
     * @return Response
     */
    public function store( MessageRequest $messageRequest ) : Response
    {
        return $this -> dispatchNow( new StoreMessageJob( $messageRequest ) );
    }

    /**
     * @param Hospital $hospital
     * @param Message $message
     * @return \App\Http\Resources\MessageResource
     */
    public function show( Hospital $hospital, Message $message )
    {
        return $this -> theRepository -> show( $hospital, $message );
    }
}
