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
            return $this->render("404");
        }
        if (is_string($callback)) {
            return $this->render($callback);
        }

        return call_user_func($callback);
    }

    public function render($view)
    {
        $contentLayout = $this->contentLayout();
        $viewContent = $this->renderView($view);
        return str_replace('{{content}}', $viewContent, $contentLayout);
    }

    public function renderContent($viewContent)
    {
        $contentLayout = $this->contentLayout();
        return str_replace('{{content}}', $viewContent, $contentLayout);
    }

    protected function contentLayout()
    {
        ob_start();
        include_once __DIR__."/../views/layouts/main.php";
        // include_once Application::$ROOT_DIR."/views/layouts/main.php";
        return ob_get_clean();
    }

    protected function renderView($view)
    {
        ob_start();
        // include_once Application::$ROOT_DIR."/views/$view.php";
        include_once __DIR__."/../views/$view.php";
        return ob_get_clean();
    }

}