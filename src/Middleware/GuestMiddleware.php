<?php

namespace App\Middleware;

/**
* 
*/
class GuestMiddleware extends Middleware
{
    public function __invoke($request, $response, $next)
    {
        if ($this->container->auth->check($request->getHeaders()['HTTP_AUTHORIZATION'][0])) {
            $data['status']  = 200;
            $data['message'] = 'Your was sign in';

            return $response->withHeader('Content-type', 'application/json')->withJson($data, $data['status']);
        }

        $response = $next($request, $response);

        return $response;
    }
}