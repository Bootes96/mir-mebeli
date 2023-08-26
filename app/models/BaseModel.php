<?php

namespace app\models;

class BaseModel {
    public array $attributes = [];
    public array $errors = [];
    public array $rules = [];

    public function __construct()
    {   
    }
}