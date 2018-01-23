<?php

class Router
{
    private $routes;

    public function __construct()
    {
        $routesPath = ROOT . '/config/routes.php';
        $this->routes = include($routesPath);
    }

    /**
     * Returns request string
     */
    private function getURI()
    {
        if (!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }

    /**
     * Get URL and redirect
    */
    public function run()
    {
        // Get URL
        $uri = $this->getURI();

        // Check routes.php array
        foreach ($this->routes as $uriPattern => $path)
        {
            // Check $uriPattern and $uri
            if (preg_match("~$uriPattern~", $uri))
            {
                // Get path
                $internalRoute = preg_replace("~$uriPattern~", $path, $uri);

                // Identify controller, action
                $segments = explode('/', $internalRoute);

                $controllerName = array_shift($segments) . 'Controller';
                $controllerName = ucfirst($controllerName);

                $actionName = 'action' . ucfirst(array_shift($segments));

                $parameters = $segments;

                // Include controller
                $controllerFile = ROOT . '/controllers/' . $controllerName . '.php';

                if (file_exists($controllerFile))
                {
                    include_once($controllerFile);
                }

                // Init. and call action
                $controllerObject = new $controllerName;
                $result = call_user_func_array(array($controllerObject, $actionName), $parameters);

                if ($result != null)
                {
                    return;
                }
            }
        }
        header("Location:/error/404");
    }

}