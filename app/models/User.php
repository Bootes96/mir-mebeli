<?php 

namespace app\models;

use app\validators\Validator;

class User extends BaseModel {
    public array $attributes = [
        'name' => '',
        'lastname' => '',
        'phone' => '',
        'email' => '',
        'password'=> ''
    ];

    public array $errors = [];

    public function load(array $data): void 
    {
        foreach($this->attributes as $name => $val) {
            if(isset($data[$name])) {
                $this->attributes[$name] = $data[$name];
            }
        }
    }

    public function validate($data): bool
    {
        $validator = new Validator($data);
        $this->errors = $validator->validateAllFields();
        if($this->errors) {
            return false;
        }
        return true;
    }

    public function getErrors(): void
    {
        $errors = "<ul>";
        foreach($this->errors as $error) {
            foreach($error as $item) {
                $errors .= "<li>$item</li>";
            }
        }
        $errors .= "</ul>";
        $_SESSION['error'] = $errors;
    }

    public function getAttributes(): array
    {
        return $this->attributes;
    }
}