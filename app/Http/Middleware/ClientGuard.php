<?php

namespace App\Http\Middleware;

use Closure;

class ClientGuard
{
    /**
     * @param $request
     * @param Closure $next
     * @param null $guard
     * @return mixed
     */
    public function handle( $request, Closure $next )
    {
        if ( guard( 'client' ) -> check() ) { return $next( $request ); }
        return redirect() -> route('login');
    }
}
