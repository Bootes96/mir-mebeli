<?php

namespace app\models;
use app\database\Connection;

class BaseModel {
    public array $attributes = [];
    public array $errors = [];
    public array $rules = [];

    public function __construct()
    { 
        Connection::getInstance();   
    }
}