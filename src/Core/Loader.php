<?php
namespace App\Core;

class Loader
{
    /** @var RouterInterface */
    private $router;

    /**
     * Simple PSR-4 autoloader
     */
    public function __construct()
    {
        session_start();
        spl_autoload_register(function ($class) {
            $prefix = 'App';
            $base_dir = __DIR__ . '/../';
            $len = strlen($prefix);
            if (strncmp($prefix, $class, $len) !== 0) {
                return;
            }
            $relative_class = substr($class, $len);
            $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
            if (file_exists($file)) {
                require $file;
            }
        });
    }

    /**
     * @param RouterInterface $router
     */
    public function initRouter(RouterInterface $router)
    {
        $this->router = $router;
    }

    /**
     * @return mixed
     * @throws LoaderException
     */
    public function fireAction()
    {
        $class = $this->router->getController();
        if (!class_exists($class)) {
            throw new LoaderException('Class '.$class.' not found');
        }
        $controller =  new $class;

        $action = $this->router->getAction();
        if (!method_exists($controller, $action)) {
            throw new LoaderException('Method '.$action.' not found');
        }

        return $controller->$action($this->router->getParams());
    }
}
