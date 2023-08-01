<?php 

namespace app;

class ErrorHandler {
    
    public function __construct()
    {
       //если режим разработки, то показываем ошибки, иначе - скрываем
        if(DEBUG) {
            error_reporting(-1);
        } else {
            error_reporting(0);
        }

        //назначаем свою функцию для обработки ошибок
        set_exception_handler([$this, 'exceptionHandler']);
    }

    public function exceptionHandler($e) {
        $this->logErrors($e->getMessage(), $e->getFile(), $e->getLine());
        $this->displayError('Исключение', $e->getMessage(), $e->getFile(), $e->getLine(), $e->getCode());
    }

    //логгирование ошибок. $message - сообщение, $file - в каком файле, $line - номер строки
    public function logErrors($message = '', $file = '', $line = '') {
        error_log("[" . date('Y-m-d H:m:s') . "] Текст ошибки: 
            {$message} | Файл: {$file} | Строка: {$line}\n===\n", 3, ROOT . '/tmp/errors.log');
    }

    //показ ошибок 
    protected function displayError($errNumber, $errorStr, $errFile, $errLine, $response = 404) {
            // http_response_code($response);
            if($response == 404 & !DEBUG) {
                require WWW . '/errors/404.php';
                die;
            }
            if(DEBUG) {
                require WWW . '/errors/dev.php';
            } else {
                require WWW . '/errors/prod.php';
            }
            die;
    }
}