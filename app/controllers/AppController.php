<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;

class AppController extends Controller{


    public function home()
    {
        $data = [
            'name' => 'NAME',
            'email' => 'email@email.com'
        ];
        return $this->render('home', $data);
    }

    public function contact()
    {
        return $this->render('contact');
    }


    public function handleContact(Request $request)
    {
        $body = $request->getBody();
        return 'handleContact method';
    }
}