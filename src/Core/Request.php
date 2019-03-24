<?php

namespace App\Core;

class Request
{
    const EXCEPT_FIELDS = ['password', 'password_confirmation'];
    /**
     * @var array
     */
    private $uriParams;
    private $params;
    private $onlyGetParams;
    private $onlyPostParams;

    /**
     * Request constructor.
     * @param array $params
     */
    public function __construct(array $params)
    {
        $this->uriParams = $params;
        $this->params = $_REQUEST;
        $this->onlyGetParams = $_GET;
        $this->onlyPostParams = $_POST;
    }

    /**
     * Returns query param. Query param is everything what's after controller&method
     * @param $param
     * @return mixed
     */
    public function getUriParam($param)
    {
        if (in_array($param, self::EXCEPT_FIELDS)) {
            if (array_key_exists($param, $this->uriParams)) {
                return $this->uriParams[$param];
            }
        } else {
            if (array_key_exists($param, $this->uriParams)) {
                return trim($this->uriParams[$param]);
            }
        }
        return null;
    }

    /**
     * @param $key
     * @return null|mixed
     */
    public function get($key)
    {
        return $this->params[$key] ?? null;
    }

    /**
     * @param $key
     * @return mixed|null
     */
    public function getPost($key)
    {
        return $this->onlyPostParams[$key] ?? null;
    }
    /**
     * @param $key
     * @return mixed|null
     */
    public function getExactGet($key)
    {
        return $this->onlyGetParams[$key] ?? null;
    }

    /**
     * @return mixed
     */
    public function method() : string
    {
        return strtoupper($_SERVER['REQUEST_METHOD']);
    }
}