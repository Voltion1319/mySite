<?php

class ErrorController
{
    /**
     * display page for unknown urls
     */
    public function action404()
    {
        require_once(ROOT.'/views/error/404.php');
        return true;
    }
}