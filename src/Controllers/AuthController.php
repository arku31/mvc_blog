<?php
namespace App\Controllers;

use App\Core\Request;
use App\Core\Response;
use App\Core\Session;
use App\Core\User\UserAlreadyExistException;
use App\Core\User\UserService;
use App\Core\User\UserSessionNotFound;
use App\Core\User\UserWrongPassword;
use App\Core\Validator\ValidatorException;

class AuthController
{
    protected $userService;

    public function __construct()
    {
        $this->userService = UserService::init();
    }
    /**
     * @param Request $request
     */
    public function login(Request $request)
    {
        $this->userService->redirectToIfAuthenticated();
        try {
            $this->userService->getSessionUser();
        } catch (UserSessionNotFound $exception) {
            (new Response())->view('auth/login', [
                'action' => '/auth/checkLogin',
                'errors' => Session::getOnce('errors')
            ]);
            exit;
        }
        (new Response())->redirect('blog');
    }

    /**
     * @param Request $request
     */
    public function checkLogin(Request $request)
    {
        $this->userService->redirectToIfAuthenticated();
        try {
            $this->userService->isValidUser($request->get('email'), $request->get('password'));
            (new Response())->redirect('blog');
        } catch (UserWrongPassword $e) {
            Session::set('errors', [$e->getMessage()]);
            (new Response())->redirect('auth/login');
        }
    }

    /**
     * @param Request $request
     */
    public function register(Request $request)
    {
        $this->userService->redirectToIfAuthenticated();
        $templateData = ['action' => '/auth/register', 'errors' => Session::getOnce('errors')];
        if ($request->method() == 'GET') {
            (new Response())->view('auth/register', $templateData);
        } else {
            try {
                $this->userService->registerByRequest($request);
                (new Response())->redirect('blog');
            } catch (UserAlreadyExistException|ValidatorException $exception) {
                Session::set('errors', [$exception->getMessage()]);
                (new Response())->redirect('auth/register');
            }
        }
    }

    /**
     *
     */
    public function logout()
    {
        Session::set('user_id', null);
        (new Response())->redirect('auth/login');
    }
}