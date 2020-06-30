<?php

namespace App\Traits;

use App\Http\Requests\UserLoginRequest;
use App\Http\Resources\AdministratorResource;
use App\Http\Resources\SystemAdminResource;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

Trait AuthenticatesJwtUsers
{
    private $guard_name = null;

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function login( UserLoginRequest $request )
    {
        $token = guard( $this -> guard_name ) -> attempt( $request -> validated() ['data']['attributes'] );
        if ( $token ) { return $this -> respondWithToken( $token, $this -> getResource() ); }
        return response() -> json([ 'error' => true, 'message' => 'Authentication failed' ], 401) ;
    }

    /**
     * @param string $token
     * @param array $resource
     * @return JsonResponse
     */
    public function respondWithToken( string $token, array $resource )
    {
        $resource[ 'data' ][ 'attributes' ] = array_merge
        (
            $resource[ 'data' ][ 'attributes' ],
            [
                'include' =>
                [
                    'token_type' => 'bearer',
                    'expires' => guard( $this -> guard_name) -> factory() -> getTTL() * 60,
                    'access_token' => $token
                ]
            ]
        );

        return response() -> json( $resource, 200 );
    }

    /**
     * Get the authenticated UserResource.
     *
     * @return JsonResponse
     */
    public function me()
    {
        return response() -> json( guard( $this -> guard_name ) -> user() );
    }

    /**
     * Refresh a token.
     *
     * @return JsonResponse
     */
    public function refresh()
    {
        return $this -> respondWithToken( guard( $this -> guard_name ) -> refresh(), $this -> getResource() );
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return JsonResponse
     */
    public function logout()
    {
        guard( $this -> guard_name ) -> logout();

        return response() -> json
        ([
            'error' => false,
            'message' => 'Successfully logged out'
        ], 200 );
    }

    /**
     * @param string|null $name
     * @return string
     */
    public function setGuardName( string $name = null )
    {
        return $this -> guard_name = $name;
    }

    /**
     * @param Request $request
     * @return JsonResponse|void
     */
    public function changePassword( Request $request )
    {
        $validator = Validator::make( $request -> all(),
        [
            'password' => 'required|min:6|confirmed'
        ]);

        if ( $validator -> fails() )
        {
            return failedValidationResponse( $validator -> errors() -> all() );
        }

        try
        {
            guard( $this -> guard_name ) -> user() -> first() -> update
            ([
                'password' => $request -> input( 'password' )
            ]);
        }
        catch ( Exception $exception )
        {
            report( $exception );
            return errorResponse();
        }

        return successResponse( 'password changed!' );
    }

    /**
     * @return array
     */
    public function getResource()
    {
        $relationships = includeResources();
        $user = auth( $this -> guard_name ) -> user();

        if ( count( $relationships )) { $user -> load( $relationships ); }

        if ( $this -> guard_name        === 'system' )              { return [ 'data' => ( new SystemAdminResource( $user ) )   -> toArray( request() ) ]; }
        elseif ( $this -> guard_name    === 'administrator' )       { return [ 'data' => ( new AdministratorResource( $user ) ) -> toArray( request() ) ]; }
    }
}
