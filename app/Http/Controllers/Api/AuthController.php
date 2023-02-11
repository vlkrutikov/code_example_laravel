<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SetPasswordRequest;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * @var UserService
     */
    private $service;

    /**
     * AuthController constructor.
     *
     * @param UserService $service
     */
    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    /**
     * @param SetPasswordRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function setPassword(SetPasswordRequest $request)
    {
        $this->service->setPassword($request);

        return response()->json(['data' => [
            'status' => 'ok'
        ]], Response::HTTP_ACCEPTED);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended();
        }
    }

    public function logout()
    {
        Auth::logout();
    }
}
