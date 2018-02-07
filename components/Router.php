<?php

class Router
{
    private function getURI()
    {
        if(!empty($_SERVER['REQUEST_URI']))
            return trim($_SERVER['REQUEST_URI'], '/');
    }

    private function buildController($name)
    {
        return ucfirst($name)."Controller";
    }
    private function buildAction($name)
    {
        return "action".ucfirst($name);
    }
    private function controllerFile($name)
    {
        return ROOT."/controller/".$name.".php";
    }

    public function run()
    {
        $controller = 'site';
        $action = 'index';
        $params = array();

        $uri = $this->getURI();
        $parts = explode('/',$uri);
        if($parts[0]!="")
        {
            $controller = $parts[0];
            unset($parts[0]);
            if (isset($parts[1]))
            {
                $action = $parts[1];
                unset($parts[1]);
                if (isset($parts[2]))
                {
                    $params = $parts;
                }
            }
        }
        $controller = $this->buildController($controller);
        $action = $this->buildAction($action);
        if (file_exists($this->controllerFile($controller)))
        {
            require_once($this->controllerFile($controller));
            $controller = new $controller;
            if(method_exists($controller,$action))
            {
                call_user_func_array(array($controller, $action), $params);
                return;
            }
        }
        header("Location:/error/404");
    }
}