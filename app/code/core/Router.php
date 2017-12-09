<?php

namespace App\Code\Core;

use App\Code\Modules\Login\Models\Login;

class Router
{
    protected $routes = [
        'GET' => [],
        'POST' => [],
        'ACCESS' => []
    ];

    public static function load($file)
    {
        $router = new static;

        require $file;

        return $router;
    }

    public function register($routes)
    {
        $this->routes = $routes;
    }

    public function get($uri, $controller, $access = '')
    {
        $this->routes['GET'][$uri] = $controller;
        $this->routes['ACCESS'][$uri] = $access;
    }

    public function post($uri, $controller, $access = '')
    {
        $this->routes['POST'][$uri] = $controller;
        $this->routes['ACCESS'][$uri] = $access;
    }

    public function call($uri, $request)
    {
        $loggedIn = Login::isLoggedIn();
        if (array_key_exists($uri, $this->routes[$request])) {
            if ($this->routes['ACCESS'][$uri] == 'restricted') {
                if (!$loggedIn) {
                    App::get('helper')->redirect('/');
                }
            } else if ($this->routes['ACCESS'][$uri] == 'login') {
                if ($loggedIn) {
                    App::get('helper')->redirect('dashboard');
                }
            }

            /*
             * $data[0] => Controller
             * $data[1] => Action
             */
            $data = explode('@', $this->routes[$request][$uri]);

            //call controller action assigned to the uri
            return $this->callAction($data[0], $data[1]);
        } else {
            $explode = explode('/', $uri);
            $uri = $explode[0];
            unset($explode[0]);
            $explode = array_values($explode);
            $explode = (count($explode) < 2) ? $explode[0] : $explode;

            if (array_key_exists($uri, $this->routes[$request])) {
                if ($this->routes['ACCESS'][$uri] == 'restricted') {
                    if (!$loggedIn) {
                        App::get('helper')->redirect('/');
                    }
                } else if ($this->routes['ACCESS'][$uri] == 'login') {
                    if ($loggedIn) {
                        App::get('helper')->redirect('dashboard');
                    }
                }

                /*
                 * $data[0] => Controller
                 * $data[1] => Action
                 */
                $data = explode('@', $this->routes[$request][$uri]);

                //call controller action assigned to the uri
                return $this->callAction($data[0], $data[1], $explode);
            }
        }

        throw new \Exception('No routes defined for this URI');
    }

    /*
     * Run controller action
     */
    protected function callAction($controller, $action, $uri = '')
    {
        $controller = App::get('code_url') . "\\" . $controller;
        $controller = new $controller;
        if (!method_exists($controller, $action)) {
            throw new \Exception('No method {$action} defined in {$controller}');
        }
        if (isset($uri)) {
            return $controller->$action($uri);
        } else {
            return $controller->$action();
        }
    }
}