<?php

protected $routeMiddleware = [
    'client.auth' => \App\Http\Middleware\ClientAuth::class,
];