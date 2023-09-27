<?php

namespace app\controllers;

use app\views\BaseView;
use app\database\DB;

abstract class BaseController {
    public array $route;
    public string $controller;
    public ?string $layout = "";
    public string $model;
    public string $view;
    public array $data = [];
    public $connection;
    public $categories;

    public function __construct(array $route)
    {
        $this->route = $route;
        $this->controller = $route['controller'];
        $this->view = $route['action'];
        $this->connection = (new DB())->connect();
    }

    //вызываем вид
    public function getView() {
        $viewObject = new BaseView($this->route, $this->layout, $this->view);
        $viewObject->render($this->data);
    }

    //устанавливаем данные, которые затем передаем в вид
    public function set(array $data) {
        $this->data = $data;
    }

    //Ajax запрос или нет
    public function isAjax() {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
    }
}