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

    public function getCallback()
    {
        $method = $this->request->getMethod();
        $path = $this->request->getPath();
        // trim slashes
        $path = trim($path, '/');

        $routes = $this->routes[$method] ?? [];

        $routeParams = false;

        foreach($routes as $route => $callback) {
            $route = trim($route, '/');
            $routeNames = [];

            if (!$route) {
                continue;
            }

            if (preg_match_all('/\{(\w+)(:[^}]+)?}/', $route, $matches)) {
                $routeNames = $matches[1];
            }

            //Convert route into regex
            $routeRegex = "@^" . preg_replace_callback('/\{\w+(:([^}]+))?}/', fn($m) => isset($m[2]) ? "({$m[2]})" : '(\w+)', $route) . "$@";

            if (preg_match_all($routeRegex, $path, $valueMatches)) {
                
                $values = [];
                for($i = 1; $i < count($valueMatches); $i++) {
                    $values[] = $valueMatches[$i][0];
                }
                $routeParams = array_combine($routeNames, $values);

                $this->request->setRouteParams($routeParams);

                return $callback;
            }
        }
        return false;
    }

    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();
        $callback = $this->routes[$method][$path] ?? false;

        if (!$callback) {
            $callback = $this->getCallback();

            if ($callback === false) {
                $this->response->setStatusCode(404);
                return $this->render('404');
            }
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