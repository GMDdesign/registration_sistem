<?php
require "inc/db.php";

$data = $_POST;

if(isset($data['forgot'])){
    $user = R::findOne('users','email = ?', array($data['email']));
    if($user){
        $key = md5($user->login.rand(1000, 9999));
        $user->change_key = $key;
        R::store($user);

        $url = $site_url.'/newpass.php?key='.$key;
        $message = $user->login.", был выполнен запрос на изменение Вашего пароля. \n\n Для изменения перейдите по ссылке:".$url."\n\n Если это были не Вы, то советуем Вам изменить Ваш пароль!";

        mail($data['email'], 'Подтвердите действие', $message);
        header('Location: ./');
    } else{
        echo "Данный Email не зарегистрирован!";
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
</head>

<body>
<header>
        <div class="header-top">
            <p class="GMD">GMD Hub</p>
        </div>
    </header>
    <section class="bg-body">
        <div class="registration-form" style="text-align: center" id="popupWin">
            <div class="background-image"></div>
            <h3 class="center-text">Восстановление пароля</h3>
            <form action="./forgot.php" method="post">
                <ul class="registr">
                    <li class="li-registr">
                        <input type="email" name="email" placeholder="Адрес электронной почты" maxlength="40">
                        <div class="shadow-1"></div>
                    </li>
                    <li class="li-registr">
                    <input type="hidden" id="token_response" name="token_response">
                        <div class="shadow-2"></div>
                    </li>
                    <button type="submit" name="forgot" class="my-profile g-recaptcha">
                        Восстановить по Email
                    </button>
                    <li class="li-registr">
                        <h4 claas="registration-with">Войти с помощью:</h4>
                        <div class="shadow-4"></div>
                    </li>
                </ul>
            </form>
        </div>
    </section>
    <footer>
        <div class="footer">

        </div>
    </footer>
</body>

</html>
