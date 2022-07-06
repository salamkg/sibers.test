<?php

namespace app\core;

use app\core\Request;

class Router {

    protected array $routes = [];
    public Request $request;
    public Response $response;

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function get($path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    public function post($path, $callback)
    {
        $this->routes['post'][$path] = $callback;
    }

    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();
        $callback = $this->routes[$method][$path] ?? false;

        if ($callback === false) {
            $this->response->setStatusCode(404);
            return $this->render('404');
        }
        if (is_string($callback)) {
            return $this->render($callback);
        }
        if (is_array($callback)) {
            Application::$app->controller = new $callback[0]();
            $callback[0] = Application::$app->controller;
        }
        return call_user_func($callback, $this->request);
    }

    public function render($view, $data = [])
    {
        $contentLayout = $this->contentLayout();
        $viewContent = $this->renderView($view, $data);
        return str_replace('{{content}}', $viewContent, $contentLayout);
    }

    public function renderContent($viewContent)
    {
        $contentLayout = $this->contentLayout();
        return str_replace('{{content}}', $viewContent, $contentLayout);
    }

    protected function contentLayout()
    {
        $layout = Application::$app->controller->layout;
        ob_start();
        include_once __DIR__."/../views/layouts/$layout.php";
        return ob_get_clean();
    }

    protected function renderView($view, $data)
    {
        foreach($data as $key => $value) {
            $$key = $value;
        }
        ob_start();
        include_once __DIR__."/../views/$view.php";
        return ob_get_clean();
    }

}