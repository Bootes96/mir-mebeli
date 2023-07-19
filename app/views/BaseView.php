<?php 

namespace app\views;

class BaseView {
    public array $route;
    public string $controller;
    public string $model;
    public string $view;
    public string $layout;
    public array $data = [];

    public function __construct(array $route, string $layout = '', string $view = '') 
    {
        $this->route = $route;
        $this->controller = $route['controller'];
        $this->view = $view;
        
        if($layout === false) {
            $this->layout = false;
        }else {
            $this->layout = $layout ?: LAYOUT;
        }
    }
    //рендер вида
    public function render($data) {
        if(is_array($data)) extract($data);
        $viewFile = APP . "/views/{$this->controller}/{$this->view}.php";
        if(is_file($viewFile)) {
            //вставляем вид в шаблон
            ob_start();
            require_once $viewFile;
            $content = ob_get_clean(); //можно использовать $content в любом месте 
        } else {
            throw new \Exception("Не найден вид {$viewFile}", 500);
        }
        if(false !==$this->layout) {
            $layoutFile = APP . "/views/layouts/{$this->layout}.php";
            if(is_file($layoutFile)) {
                require_once $layoutFile;
            } else {
                throw new \Exception("Не найден шаблон {$this->layout}", 500);
            }
        }
    }
}