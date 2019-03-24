<?php
namespace App\Core\User;

use App\Core\Hash;
use App\Core\Response;
use App\Core\Session;
use App\Core\Validator\Validator;
use App\Models\User;

class UserService
{
    protected $user;
    private static $instance;

    protected function __construct()
    {
        //
    }


    /**
     * @return UserService
     */
    public static function init()
    {
        if (empty(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * @param \App\Core\Request $request
     * @return int
     * @throws UserAlreadyExistException
     * @throws \App\Core\Validator\ValidatorException
     */
    public function registerByRequest(\App\Core\Request $request)
    {
        $email = Validator::getValidatedEmail($request->get('email'));
        $name = Validator::getSanitized($request->get('name'));
        $password = Validator::getValidatedPassword($request->get('password'), $request->get('password_confirmation'));

        $userId = $this->registerUser($email, $name, $password);

        Session::set('user_id', $userId);
        return $userId;
    }

    /**
     * @param string $email
     * @param string $name
     * @param string $password
     * @return int
     * @throws UserAlreadyExistException
     */
    private function registerUser(string $email, string $name, string $password)
    {
        $user = new User();

        if (!$user->isEmailExist($email)) {
            return $user->create($email, $name, Hash::make($password));
        } else {
            throw new UserAlreadyExistException('User already Exist');
        }
    }

    /**
     * @return mixed|null
     * @throws UserSessionNotFound
     */
    public function getSessionUser()
    {
        $userId = Session::get('user_id');
        if (empty($userId)) {
            throw new UserSessionNotFound();
        }
        if (empty($this->user)) {
            $user = new User();
            $this->user = $user->find($userId);
        }
        return $this->user;
    }

    /**
     * @param $email
     * @param $password
     * @return mixed
     * @throws UserWrongPassword
     */
    public function isValidUser($email, $password)
    {
        $user = new User();
        if ($userId = $user->isValidUser($email, Hash::make($password))) {
            Session::set('user_id', $userId);
            return true;
        } else {
            throw new UserWrongPassword('Wrong password or email');
        }
    }

    /**
     *
     */
    public function redirectIfNotAuthenticated()
    {
        try {
            $this->getSessionUser();
        } catch (UserSessionNotFound $exception) {
            (new Response())->redirect('auth/login');
        }
    }

    /**
     * @param string $to
     * @return null
     */
    public function redirectToIfAuthenticated($to = 'blog')
    {
        try {
            $this->getSessionUser();
        } catch (UserSessionNotFound $exception) {
            return null;
        }
        (new Response())->redirect($to);
    }
}