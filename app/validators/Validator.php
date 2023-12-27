<?php 

namespace app\validators;

use app\database\DB;
use app\database\UserDataGateway;

class Validator {

    public $connect; 
    public array $errors = [];
    public array $attributes = [];

    public function __construct($attributes)
    {
        $this->attributes = $attributes;
        $this->connect = (new DB())->connect();
    }

    public function validateAllFields(): array
    {
        $validatedFields = [];

        $validatedFields['name'] = $this->validateName($this->attributes['name']);
        $validatedFields['lastname'] = $this->validateLastName($this->attributes['lastname']);
        $validatedFields['password'] = $this->validatePassword($this->attributes['password']);
        $validatedFields['email'] = $this->validateEmail($this->attributes['email']);
        $validatedFields['phone'] = $this->validatePhone($this->attributes['phone']);


        foreach($validatedFields as $k => $v) {
            if($v !== true) {
                $this->errors[$k] = $v; 
            }
        }

        return $this->errors;
    }

    public function validateName(string $name)
    {
        $errors = [];
        $pattern = "/^[А-ЯЁ]([\s\-\']?[а-яёА-ЯЁ][\s\-\']?)*$/u";
        $nameLength = mb_strlen($name);
        if(!$nameLength) {
            $errors [] = "Заполните поле Имя";
        } 
        
        if($nameLength > 50) {
            $errors [] = "Имя не должно содержать более 50 символов, Вы ввели {$nameLength}";
        } 
        
        if($nameLength && !preg_match($pattern, $name)) {
            $errors [] = "Имя должно состоять только из русских символов и начинаться с большой буквы";
        }

        if($errors) {
            return $errors;
        }

        return true;
    }

    public function validateLastName(string $lastname)
    {
        $errors = [];
        $pattern = "/^[А-ЯЁ]([\s\-\']?[а-яёА-ЯЁ][\s\-\']?)*$/u";
        $lastNameLength = mb_strlen($lastname);
        if(!$lastNameLength) {
            $errors [] = "Заполните поле Фамилия";
        } 
        
        if($lastNameLength > 100) {
            $errors [] = "Фамилия не должна содержать более 100 символов, Вы ввели {$lastNameLength}";
        } 
        
        if($lastNameLength && !preg_match($pattern, $lastname)) {
            $errors [] = "Фамилия должна состоять только из русских символов и начинаться с большой буквы";
        }

        if($errors) {
            return $errors;
        }

        return true;
    }

    public function validatePassword(string $password)
    {
        $errors = [];
        $passwordLength = mb_strlen($password);
        if(!$passwordLength) {
            $errors [] = "Заполните поле Пароль";
        }
        
        if ($passwordLength < 8) {
            $errors [] = "Пароль должен состоять из 8 и более символов";
        }  

        if($errors) {
            return $errors;
        }

        return true;
    }

    public function validateEmail(string $email) 
    {
        $errors = [];
        if(!mb_strlen($email)) {
            $errors [] = "Заполните поле Email";
        } 
        
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors [] = "Введите Email в правильном формате. Пример: example@mail.ru";
        }

        $connection = new UserDataGateway($this->connect);
        $emailExist = $connection->checkEmailExist($email);

        if($emailExist) {
            $errors [] = "Пользователь с таким Email уже зарегистрирован";
        }

        if($errors) {
            return $errors;
        }

        return true;   
    }

    public function validatePhone(string $phone) 
    {
            $errors = [];
            // Удаляем все не символы кроме цифр
            $phone = preg_replace('/\D/', '', $phone);

            $phoneLength = strlen($phone);
          
            // Номер должен начинается на цифру 7
            if (substr($phone, 0, 1) !== '7') {
                $errors [] = "Номер должен начинаться на 7";
            }
          
            // Длиной 10 символов
            if ($phoneLength !== 11) {
                $errors [] = "Номер должен состоять из 11 символов, Вы ввели {$phoneLength}";
            }

            if($errors) {
                return $errors;
            }
          
            return true;
    }

}