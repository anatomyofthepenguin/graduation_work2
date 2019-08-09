<?php

namespace Controller;

class UserController
{
    public function indexAction()
    {
        include '../views/index.php';
    }

    public function registerAction()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
        } else {
            include '../views/reg.php';
        }
    }
}