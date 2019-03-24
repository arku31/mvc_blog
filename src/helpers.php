<?php
/**
 * Wrapper for config
 * @param $namespace
 * @param null $value
 * @return mixed|null
 */
function config($namespace, $value = null)
{
    return \App\Core\Config::init()->get($namespace, $value);
}

/**
 * Requires specific template
 * @param $name
 */
function template($name)
{
    require ROOT_PATH.'templates/'.$name.'.php';
}

/**
 * return user
 * @return mixed|null
 */
function user()
{
    $userService = \App\Core\User\UserService::init();
    try {
        return $userService->getSessionUser();
    } catch (\App\Core\User\UserSessionNotFound $e) {
        return null;
    }
}