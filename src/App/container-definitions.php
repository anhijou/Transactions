<?php

use Framework\{TemplateEngine, Database};
use App\Services\ValidatorService;
use App\Config\Paths;

return [
    TemplateEngine::class => fn () => new TemplateEngine(Paths::VIEW),
    ValidatorService::class => fn () => new ValidatorService(),
    Database::class => fn () => new Database(
        $_ENV['DB_DRIVER'],
        [
            "host" => $_ENV['DB_HOST'],
            "port" => $_ENV['DB_PORT'],
            "dbname" => $_ENV['DB_NAME']
        ],
        $_ENV['DB_USER'],
        $_ENV['DB_PASS']
    )
];
