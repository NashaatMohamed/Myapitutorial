<?php

namespace App\Http\Middleware;

use App\traits\Generaltrait;
use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Contracts\JWTSubject;

class CheckAdminPassword
{
    use Generaltrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = null;
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                return $this->returnError('E3001', 'INVALID TOKEN');
            } else if ($e instanceof \Tymon\JWTAuth\Exceptions \TokenExpiredException) {
                return $this->returnError('E3001', 'EXPIRED_TOKEN');
            } else {
                return $this->ReturnError('5050', 'token notfound');
            }
        }
        catch (\Throwable $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                return $this-> returnError (  'E3001', 'INVALID TOKEN');
            } else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                return $this-> returnError( 'E3001', 'EXPIRED_TOKEN');
            } else {
                return $this-> returnError(  'E3001',  'TOKEN_NOTFOUND');
            }
}
if (!$user){
    return $this ->ReturnError('33','user not found');
}
        return $next($request);
    }
}
