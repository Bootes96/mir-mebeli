<?php

namespace app\models;

abstract class BaseModel {
    public array $attributes = [];
    public array $errors = [];
    public array $rules = [];
}