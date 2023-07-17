<?php 

namespace app;

use Exception;

class Router {
    //все имеющиеся маршруты
    protected static array $routes = [];
    //текущий маршрут
    protected static array $route = [];

    //правила в таблице маршрутов
    public static function add(string $regexp, array $route = []) {
        self::$routes[$regexp] = $route;
    }

    //принимает url. Вызывается в App
    public static function dispatch(string $url) {
        if(self::matchRoute($url)) {
            $controller = "app\controllers\\" . self::$route['controller'] . "Controller";
            //если существует класс 
            if(class_exists($controller)) {
                $controllerObject = new $controller(self::$route);
                $action = self::lowerCase(self::$route['action']) . 'Action';
                //если метод существует, вызываем его
                if(method_exists($controllerObject, $action)){
                    $controllerObject->$action();
                } else {
                    throw new \Exception("Метод $controller::$action не найден", 404);
                }
            } else {
                throw new \Exception("Контроллер $controller не найден", 404);
            }
        } else {
            throw new \Exception("Страница не найдена", 404);
        }
    }

    //ищет соответствие в таблице маршрутов
    public static function matchRoute(string $url) {
        foreach(self::$routes as $pattern => $route) {
            if(preg_match("#{$pattern}#", $url, $matches)) {
                foreach($matches as $k => $v) {
                    if(is_string($k)) {
                        $route[$k] = $v;
                    }
                }
                //если экшена нет, то по умолчанию будет index
                if(empty($route['action'])) {
                    $route['action'] = 'index';
                }
                $route['controller'] = self::upperCamelCase($route['controller']);
                self::$route = $route;
                return true;
            }
        }
        return false;
    }

    //для контроллеров
    public static function upperCamelCase(string $name) {
        return str_replace(' ', '' ,ucwords(str_replace('-', ' ', $name)));
    }
    //для экшенов
    public static function lowerCase(string $name) {
        return lcfirst(self::upperCamelCase($name));
    }
}