<?php

namespace App\Http\Controllers\Administrators;

use App\Http\Controllers\Controller;
use App\Models\Hospital;
use App\Models\Message;
use App\Repositories\Administrators\HospitalMessageRepositoryInterface;
use Illuminate\Http\Request;

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
     * @param Hospital $hospital
     * @param Message $message
     * @return \App\Http\Resources\MessageResource
     */
    public function show( Hospital $hospital, Message $message )
    {
        return $this -> theRepository -> show( $hospital, $message );
    }
}
