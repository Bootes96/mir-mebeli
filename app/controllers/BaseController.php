<?php

namespace app\controllers;

use app\views\BaseView;

abstract class BaseController {
    public array $route;
    public string $controller;
    public ?string $layout = "";
    public string $model;
    public string $view;
    public array $data = [];

    public function __construct(array $route)
    {
        $this->route = $route;
        $this->controller = $route['controller'];
        $this->view = $route['action'];
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
}