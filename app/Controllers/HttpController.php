<?php
namespace DocsWorker\Controllers;

use Fenom;
use Illuminate\Validation\Factory as Validator;
use Psr\Log\LoggerInterface;

abstract class HttpController
{
    protected Fenom $fenom;
    protected Validator $validator;
    protected LoggerInterface $log;

    public function __construct(LoggerInterface $log, Fenom $fenom, Validator $validator)
    {
        $this->fenom = $fenom;
        $this->validator = $validator;
        $this->log = $log;
    }

    public function render(string $template, array $data = []) : string {
        return $this->fenom->fetch(
            implode('/', explode('.', $template)).'.tpl',
            $data
        );
    }

    public function validate(array $data, array $rules, array $messages = []) : array {
        return $this->validator->validate($data, $rules, $messages);
    }
}