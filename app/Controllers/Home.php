<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        echo 'hola';
        return view('welcome_message');
    }
}
