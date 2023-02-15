<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Pcsaini\ResponseBuilder\ResponseBuilder;

class UserController extends Controller
{
    public function profile(Request $request) {
        try {
            $user = $request->user();

            $this->response->user = $user;

            return ResponseBuilder::success($this->response);
        } catch (\Exception $e) {
            Log::error($e);
            return ResponseBuilder::error(__('api.default_error_message'), $this->serverError);
        }
    }
    public function logout(Request $request) {
        try {
            $user = $request->user();

            $user->currentAccessToken()->delete();

            return ResponseBuilder::success(null, __('api.logout_success'));
        } catch (\Exception $e) {
            Log::error($e);
            return ResponseBuilder::error(__('api.default_error_message'), $this->serverError);
        }
    }
}
