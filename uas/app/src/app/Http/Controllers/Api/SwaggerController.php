<?php

namespace App\Http\Controllers\Api;

use OpenApi\Attributes as OA;

/**
 * @OA\Info(
 *     title="TeamAnuBot API Documentation",
 *     version="1.0.0",
 *     description="Dokumentasi API untuk semua endpoint di sistem."
 * )
 *
 * @OA\SecurityScheme(
 *     securityScheme="ApiKeyAuth",
 *     type="apiKey",
 *     in="header",
 *     name="x-api-token"
 * )
 */
class SwaggerController
{
    // File ini hanya untuk anotasi global Swagger.
}