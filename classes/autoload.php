<?php

spl_autoload_register(function($class) {
    require_once (Config::PHP_PATH.'\\classes\\'.$class.'.php');
});
?>