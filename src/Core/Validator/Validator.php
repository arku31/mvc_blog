<?php
namespace App\Core\Validator;

class Validator
{
    /**
     * @param $email
     * @return string
     * @throws ValidatorException
     */
    public static function getValidatedEmail($email) : string
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return $email;
        }
        throw new ValidatorException('Email is not valid');
    }

    /**
     * @param $password1
     * @param $password2
     * @return string
     * @throws ValidatorException
     */
    public static function getValidatedPassword($password1, $password2) : string
    {
        if ($password1 === $password2) {
            return $password1;
        }
        throw new ValidatorException('Passwords are not equal');
    }

    /**
     * @param $value
     * @return string
     */
    public static function getSanitized($value)
    {
        return htmlentities(strip_tags($value), ENT_QUOTES);
    }

    /**
     * @param $variable
     * @return mixed
     * @throws ValidatorException
     */
    public static function getNotEmptyVariable($variable)
    {
        if (empty($variable)) {
            throw new ValidatorException('empty');
        }
        return $variable;
    }
}