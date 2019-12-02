<?php

spl_autoload_register('loadClass');

function loadClass(string $className) {
    $className = str_replace('App\\', '', $className);
    $pathName = $_SERVER['DOCUMENT_ROOT'] . '/src/'. str_replace('\\', '/', $className) . '.php';

    if (is_file($pathName)) {
        require_once $pathName;

        return true;
    }

    return false;
}