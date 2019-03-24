<?php
namespace App\Core;

/**
 * Class Router
 * @package App\Core
 */
class Router implements RouterInterface
{
    /** var array */
    protected $requestedUri;
    /** @var array */
    protected $request = [];
    /** @var string */
    protected $controller;
    /** @var string */
    protected $action;
    /** @var array */
    protected $params = [];

    /**
     * Router constructor.
     */
    public function __construct()
    {
        $parsed = parse_url($_SERVER['REQUEST_URI']);
        $uri = $parsed['path'];

        if (array_key_exists('query', $parsed)) {
            parse_str($parsed['query'], $this->request);
        }
        $this->requestedUri = explode('/', $uri);

        $this->controller = 'App\\Controllers\\' . $this->determineController();
        $this->action = $this->determineAction();
        $this->params = $this->determineParams();
    }

    /**
     * @return string
     */
    public function determineController() : string
    {
        if (isset($this->requestedUri[1]) && !empty($this->requestedUri[1])) {
            return ucfirst($this->requestedUri[1]).'Controller';
        }
        return  'MainController';
    }

    /**
     * @return string
     */
    public function determineAction() : string
    {
        if (isset($this->requestedUri[2]) && !empty($this->requestedUri[2])) {
            return $this->requestedUri[2];
        }
        return  'index';
    }

    /**
     * @return array
     */
    public function determineParams() : array
    {
        if (isset($this->requestedUri[3]) && !empty($this->requestedUri[3])) {
            return array_diff_key($this->requestedUri, array_flip([0, 1, 2]));
        }
        return [];
    }

    /**
     * @return string
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * @return string
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @return array
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @return Request
     */
    public function getParams() : Request
    {
        return new Request($this->params);
    }
}