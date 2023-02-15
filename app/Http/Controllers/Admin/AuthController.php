<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Pcsaini\ResponseBuilder\ResponseBuilder;

class AuthController extends Controller
{
    public function login(Request $request) {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'email|required',
                'password' => 'required'
            ]);

            if ($validator->fails()) {
                return ResponseBuilder::error($validator->errors()->first(), $this->badRequest);
            }

            $user = User::query()->where('email', $request->get('email'))->first();

            if (empty($user)) {
                return ResponseBuilder::error(__('Sorry! this email is not registered with us.'), $this->badRequest);
            }

            if (!Hash::check($request->get('password'), $user->password)) {
                return ResponseBuilder::error(__('Please enter valid password'), $this->badRequest);
            }

            $token = $user->createToken('FWG')->plainTextToken;

            $this->response->user = $user;

            return ResponseBuilder::asSuccess()
                ->with('auth_token', $token)
                ->withData($this->response)
                ->build();

        } catch (\Exception $e) {
            Log::error($e);
            return ResponseBuilder::error('Whoops! something went wrong. Please try again later. ', $this->serverError);
        }
    }
}
