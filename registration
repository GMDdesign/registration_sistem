<?php
require "inc/db.php";

$data = $_POST;
if(isset($data['save']))
{
    $errors = array();
    if(trim($data['login']) == '')
    {
        $errors[] = 'Введите логин';
    }
    if(trim($data['email']) == '')
    {
        $errors[] = 'Введите email';
    }
    if($data['password'] == '')
    {
        $errors[] = 'Введите пароль';
    }
    if($data['checkbox'] != '')
    {
        $errors[] = 'Примите пользовательское соглашение';
    }
    if($data['password_2'] != $data['password'])
    {
        $errors[] = 'Повторный пароль введен не верно';
    }

    if( R::count('users', 'login = ?', array($data['login'])) > 0)
    {
        $errors[] = 'Пользователь с таким именем уже существует';
    }
    if( R::count('users', 'email = ?', array($data['email'])) > 0)
    {
        $errors[] = 'Пользователь с таким Email уже существует';
    }

    if(empty($errors))
    {
        $user = R::dispense('users');
        $user->login = $data['login'];
        $user->email = $data['email'];
        $user->status = 0;
        if($data['login'] === 'admin'){
            $user->status = '???';
        }
        $user->password = password_hash($data['password'], PASSWORD_DEFAULT);
        $user->checkbox = $data['checkbox'];
        $user->registration_time = R::isoDateTime();
        $user->balance = 0;
        $user->avatar = 'noavatar.png';
        R::store($user);
        header('Location: ./gmdlogin.php');
    } else
    {
        echo '<div style="color: red;">' .array_shift($errors). '</div><hr>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GMD Hub</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/other.css?v001">
    <link rel="stylesheet" href="media/registr-login.css?v001">
    <link rel="icon" href="img/favicon.png" type="image/png" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <header>
        <div class="header-top">
            <a href="/">
                <span class="material-icons">
                keyboard_backspace
                </span>
            </a>
            <a class="back-link" href="/">На главную</a>
            <p class="GMD">GMD Hub</p>
        </div>
    </header>
    <section class="bg-body">
        <div class="registration-form" style="text-align: center" id="popupWin">
            <div class="background-image"></div>
            <h3 class="center-text"> Регистрация</h3>
            <form action="./gmdregistr.php" method="post">
                <ul class="registr">
                    <li class="li-registr">
                        <input type="text" name="login" placeholder="Логин" maxlength="40" value="<?php echo @$data['login']; ?>">
                        <div class="shadow-1"></div>
                    </li>
                    <li class="li-registr">
                        <input id="pin" name="password" type="password" placeholder="Пароль" minlength="4" maxlength="32" size="8" value="<?php echo @$data['password']; ?>">
                        <div class="shadow-2"></div>
                    </li>
                    <li class="li-registr">
                    <input id="pin" name="password_2" type="password" inputmode="numeric" placeholder="Подтвердите пароль" minlength="4" maxlength="32" size="8" value="<?php echo @$data['password_2']; ?>">
                        <div class="shadow-3"></div>
                    </li>
                    <li class="li-registr">
                        <input type="email" name="email" placeholder="Адрес электронной почты" maxlength="40" value="<?php echo @$data['email']; ?>">
                        <div class="shadow-4"></div>
                    </li>
                    <button type="submit" name='save' class="my-profile-2">
                        Регистрация
                    </button>
                    <p class="have-account-2" style="font-size: 0.8em;">
                        Уже есть аккаунт? -<a href="./gmdlogin.php">Авторизируйтесь</a>
                    </p>

                    <li class="li-registr">
                        <label class="switch">
                            <input name="checkbox" type="checkbox" checked="checked">
                            <span class="slider round"></span>
                        </label>
                        <h6>Принимаю</h6> <a href="./privacypolicy.html" style="position: absolute; bottom: 30px; left: 50px; z-index: 300; font-size: 0.6em;">условия политики конфиденциальности</a>
                        <h6> и </h6> <!-- Нужно подвинуть-->
                        <a href="./publictermsofservice.html" style="position: absolute; bottom: 10px; left: 50px; z-index: 300; font-size: 0.6em;">условия обслуживания</a>
                    </li>
                </ul>
        </div>
        </form>
    </section>
    <footer>
        <div class="footer">
        </div>
    </footer>
</body>

</html>
