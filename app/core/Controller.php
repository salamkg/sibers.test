<?php

namespace app\core;


class Controller {

    public $view;
    public string $layout = 'main';

    public function __construct()
    {
        
    }

    public function setLayout($layout)
    {
        $this->layout = $layout;
    }

    public function render($view, $data = [])
    {
        // echo '<pre>';
        // var_dump($data);
        // echo '</pre>';
        // exit;
        return Application::$app->router->render($view, $data);
    }
}