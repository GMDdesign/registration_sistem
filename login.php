<?php
require "inc/db.php";

$data = $_POST;
if(isset($data['login-user']))
{
    $user = R::findOne('users', 'login = ?', array($data['login']));
    if($user)
    {
        session_regenerate_id(true);
        if( password_verify($data['password'], $user->password)){
            $_SESSION['logged_user'] = $user;
            header('Location: ./gmdprofile.php');
        } 
        else
        {
            $errors[] = 'Неверный логин или пароль';
        }
    }
        else
        {
            $errors[] = 'Неверный логин или пароль';
        }
        if(!empty($errors)){
            echo '<div style="color: red;">' .array_shift($errors). '</div><hr>';
        }
}
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['token_response'])){

    $url='https://www.google.com/recaptcha/api/siteverify';
    $secret='???';
    $recaptcha_response=$POST['token_response'];

    $request=file_get_contents($url.'?secret='.$secret.'&response='.$recaptcha_response);
    $response=json_encode($request, true);

    if ($response["success"]  && $response["score"] >= 0.5){
        echo '<script language="javascript">';
        echo'alert("Thank")';
        echo '</script>';
        echo "<script>setTimeOut(\"Location.href='./gmdprofile.php';\",00);</script>";
    }else{
        echo '<script language="javascript">';
        echo'alert("Error")';
        echo '</script>';
        echo "<script>setTimeOut(\"Location.href='./gmdprofile.php';\",00);</script>";
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
    <link rel="stylesheet" href="css/other.css?v001"/>
    <link rel="stylesheet" href="media/registr-login.css?v001">
    <link rel="icon" href="img/favicon.png" type="image/png" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://www.google.com/recaptcha/api.js?render=???"></script>
    <script>
    grecaptcha.ready(function() {
    grecaptcha.execute('???', {action: 'submit'}).then(function(token) {
        var response = document.getElementById('token_response');
        response.value = token;
        });
    });
    </script>
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
            <h3 class="center-text">Авторизация</h3>
            <form action="./gmdlogin.php" method="post">
                <ul class="registr">
                    <li class="li-registr">
                        <input type="text" name="login" placeholder="Логин" maxlength="40" value="<?php echo @$data['login']; ?>">
                        <div class="shadow-1"></div>
                    </li>
                    <li class="li-registr">
                        <input id="pin" type="password" name="password" placeholder="Пароль" minlength="4" maxlength="32" size="8" value="<?php echo @$data['password']; ?>">
                        <div class="shadow-2"></div>
                    </li>
                    <button type="submit" name="login-user" class="my-profile g-recaptcha">
                        Войти
                    </button>
                    <p class="have-account" style="font-size: 0.8em;">
                        У Вас нет аккаунта? -<a href="./gmdregistr.php">Зарегистрируйтесь</a>
                    </p>
                    <li class="li-registr">
                        <h4 claas="registration-with">Войти с помощью:</h4>
                        <div class="shadow-4"></div>
                    </li>
                    <li class="li-registr-2">
                        <a href="./forgot.php" style="z-index: 200; color: red;">Забыли пароль?</a>
                    </li>
                </ul>
                <input type="hidden" id="token_response" name="token_response">
            </form>
        </div>
        
    </section>
    <footer>
        <div class="footer">

        </div>
    </footer>

</body>

</html>
