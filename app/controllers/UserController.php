<?php

namespace app\controllers;

use app\database\UserDataGateway;
use app\models\User;

class UserController extends BaseController {

    public function signUpAction() {
        if(!empty($_POST)) {
            $user = new User;
            $data = $_POST;
            $user->load($data);
            if(!$user->validate($data)) {
                $user->getErrors();
                $_SESSION['form_data'] = $data;
                redirect();
            } else {
                $connect = new UserDataGateway($this->connection);
                $attributes = $user->getAttributes();
                $attributes['password'] = password_hash($attributes['password'], PASSWORD_DEFAULT);
                $result = $connect->save($attributes);
                if($result) {
                    $_SESSION['success'] = "Вы успешно зарегистрировались";
                    redirect();
                }else{
                    $_SESSION['error'] = "Ошибка";
                }
            }
        }
    }

    public function loginAction() {
        
    }

    public function logoutAction() {
        
    }
}