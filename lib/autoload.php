<?php

spl_autoload_register(function ($strClassname) {
    $strFile = __DIR__ . '/' . $strClassname . '.php';
    if (file_exists($strFile)) {
        require_once $strFile;
        return true;
    }
});