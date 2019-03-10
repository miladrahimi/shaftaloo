<?php

namespace App\Http\Controllers\Api;

use Auth;
use Illuminate\Http\JsonResponse;

/**
 * Class UsersController
 *
 * @package App\Http\Controllers\Api
 */
class UsersController extends ApiController
{

    public function getProfile()
    {
        return new JsonResponse(Auth::user());
    }
}
