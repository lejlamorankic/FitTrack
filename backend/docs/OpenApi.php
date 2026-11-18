
<?php

use OpenApi\Attributes as OA;

#[OA\Info(
    title: "FitTrack API",
    version: "1.0.0",
    description: "REST API documentation for the FitTrack fitness tracking application."
)]
#[OA\Server(
    url: "http://localhost:8000",
    description: "Local development server"
)]
class OpenApi
{
}
