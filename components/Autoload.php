<?php

function __autoload($class_name)
{
    # List of all the class directories in the array.
    $array_paths = array(
        '/model/',
        '/components/',
        '/db/'
    );

    foreach ($array_paths as $path) {
        $path = ROOT . $path . $class_name . '.php';
        if (is_file($path))
        {
            include_once $path;
        }
    }
}
