<?php

namespace DocsWorker\Middleware;

use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as Handler;
use Psr\Http\Message\ResponseInterface as Response;

class JsonMiddleware implements MiddlewareInterface
{
    function process(Request $request, Handler $handler): Response {
        return $handler->handle($request)
            ->withHeader('Content-Type', 'application/json');
    }
}