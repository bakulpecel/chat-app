<?php

namespace App\Middleware;

/**
* 
*/
class AuthMiddleware extends Middleware
{
    public function __invoke($request, $response, $next)
    {
        if (!$this->container->auth->check($request->getHeader('HTTP_AUTHORIZATION')[0])) {
            $data['status']  = 401;
            $data['message'] = 'You must sign in';

            return $response->withHeader('Content-type', 'application/json')->withJson($data, $data['status']);
        }

        $response = $next($request, $response);

        return $response;
    }
}