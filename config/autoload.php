<?php

function models($classname)
{
    $filename = "/models/". $classname .".php";
    require_once($filename);
}

function controllers($classname)
{
    $filename = "/controllers/". $classname .".php";
    require_once($filename);
}

spl_autoload_register('models');
spl_autoload_register('controllers');
