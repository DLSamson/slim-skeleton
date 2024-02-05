<?php

use DI\Container;
use Psr\Log\LoggerInterface;

use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Contracts\Translation\Translator;
use Illuminate\Validation\Factory as ValidationFactory;
use Illuminate\Translation\FileLoader;

use function DI\create;
use function DI\factory;
use function DI\get;

return [
    LoggerInterface::class => factory(function() {
        return (new \Monolog\Logger("App"))
            ->pushHandler(new \Monolog\Handler\StreamHandler(PATH_LOGS . "/app.log"));
    }),

    Fenom::class => factory(function() {
        $fenom = new Fenom(new Fenom\Provider(PATH_TEMPLATES));
        $fenom->setCompileDir(PATH_CACHE);
        $fenom->setOptions([
            'auto_reload' => true,
            'auto_escape' => true,
            'strip' => true,
            'force_verify' => true,
            'disable_cache' => true,
        ]);
        return $fenom;
    }),

    Filesystem::class => create(\Illuminate\Filesystem\Filesystem::class),

    FileLoader::class => create(FileLoader::class)
        ->constructor(get(Filesystem::class), PATH_LANG),

    Translator::class => create(\Illuminate\Translation\Translator::class)
        ->constructor(get(FileLoader::class), 'ru'),

    ValidationFactory::class => create(ValidationFactory::class)
        ->constructor(get(Translator::class)),
];