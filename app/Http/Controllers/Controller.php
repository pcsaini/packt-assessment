<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use stdClass;
use Symfony\Component\HttpFoundation\Response;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected int $serverError = Response::HTTP_INTERNAL_SERVER_ERROR;
    protected int $success = Response::HTTP_OK;
    protected int $badRequest = Response::HTTP_BAD_REQUEST;
    protected int $unauthorized = Response::HTTP_UNAUTHORIZED;
    protected int $notFound = Response::HTTP_NOT_FOUND;
    protected int $forbidden = Response::HTTP_FORBIDDEN;
    protected int $upgradeRequired = 426;

    protected stdClass $response;

    public function __construct()
    {
        $this->response = new stdClass();
    }
}
