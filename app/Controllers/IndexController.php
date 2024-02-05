<?php
namespace DocsWorker\Controllers;

use Psr\Http\Message\ResponseInterface as Response;

class IndexController extends HttpController
{
    public function __invoke(Response $response) {
        $render = $this->render('index');
        $response->getBody()->write($render);
        return $response
            ->withStatus(200);
    }
}