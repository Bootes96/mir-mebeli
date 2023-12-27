<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <h3>Регистрация</h3>
        <div class="row">
            <div class="col-md-6">
                <form method="post" action="user/signup" id="signup" role="form" data-toggle="validator">
                    <div class="form-group has-feedback">
                        <label for="name">Имя</label>
                        <input type="text" class="form-control" name="name" id="name" value="<?=isset($_SESSION['form_data']['name']) ? 
                            htmlspecialchars($_SESSION['form_data']['name']) : ''?>" 
                        required>
                    </div>
                    <div class="form-group has-feedback">
                        <label for="lastname">Фамилия</label>
                        <input type="text" class="form-control" name="lastname" id="lastname" value="<?=isset($_SESSION['form_data']['lastname']) ? 
                            htmlspecialchars($_SESSION['form_data']['lastname']) : ''?>" required>
                    </div>
                    <div class="form-group has-feedback">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?=isset($_SESSION['form_data']['email']) ? 
                            htmlspecialchars($_SESSION['form_data']['email']) : ''?>" required>
                        <small id="emailHelp" class="form-text text-muted">Мы никому не передаем Ваши данные</small>
                    </div>
                    <div class="form-group has-feedback">
                        <label for="phone">Номер телефона</label>
                        <input type="text" class="form-control" name="phone" id="phone" id="name" value="<?=isset($_SESSION['form_data']['phone']) ? 
                            htmlspecialchars($_SESSION['form_data']['phone']) : ''?>" required>
                        <small id="phoneHelp" class="form-text text-muted">Введите номер телефона в формате: 77766655544 (11 цифр)</small>
                    </div>
                    <div class="form-group has-feedback">
                        <label for="password">Пароль</label>
                        <input type="password" class="form-control" name="password" id="exampleInputPassword1" data-error="Пароль должен содержать не меньше 8 символов" data-minlength="8" required>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
                        <label class="form-check-label" for="exampleCheck1">Я подтверждаю, что ознакомлен и согласен с условия Политики конфиденциальности</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
                </form>
                <?php if(isset($_SESSION['form_data'])) unset($_SESSION['form_data']);?>
            </div>
        </div>
    </div>
</body>

</html>