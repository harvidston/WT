<?php
session_start();
$strout='';
$loginmin=2;
$passwordmin=5;
//isset определяет была ли установлена переменная значением отличным от null
if (isset($_GET['do'])&&!empty($_GET['do'])&&$_GET['do']=="LogOut"){
    unset($_SESSION['login']);
    echo '<meta http-equiv="refresh" content="0.1; URL=6 task.php">';
}
//Проверка наличия минимального количества символов в логине (2), пароле (5).
if (isset($_GET['do'])&&!empty($_GET['do'])&&$_GET['do']=="Reg"){
    if(isset($_POST['RegLogin'])&&!empty($_POST['RegLogin'])&&isset($_POST['RegPassword'])&&!empty($_POST['RegPassword'])){
        if(strlen($_POST['RegLogin'])>=$loginmin && strlen($_POST['RegPassword'])>=$passwordmin){
            $data=$_POST['RegLogin'].' '.md5($_POST['RegPassword']).PHP_EOL;
            file_put_contents("LoginsAndPasswords.txt", $data, FILE_APPEND);
        }else {echo "Логин или пароль недостаточной длинны.";}
    }else{echo "Не введены логин или пароль в поля регистрации.";}
}
if(isset($_SESSION['login'])&&!empty($_SESSION['login'])){
    $strout='<form action="6 task.php?do=LogOut	" method="POST">'.PHP_EOL;
    $strout.='<p>Приветствую, '.$_SESSION['login'].PHP_EOL;
    $strout.='<p><input type="submit" value="Выйти"/></p>'.PHP_EOL;
}else
{

    $strout.='<form action="6 task.php?do=LogIn" method="POST">'.PHP_EOL;
    $strout.='<p>Авторизация:</p>'.PHP_EOL;
    $strout.='<p>Логин: <input type="text" name="login" /></p>'.PHP_EOL;
    $strout.='<p>Пароль: <input type="text" name="password" /></p>'.PHP_EOL;
    $strout.='<p><input type="submit" value="Войти" /></p>'.PHP_EOL;
    $strout.='</form>';

    $strout.='<form action="6 task.php?do=Reg" method="POST">'.PHP_EOL;
    $strout.='<p>Регистрация:</p>'.PHP_EOL;
    $strout.='<p>Логин: <input type="text" name="RegLogin" /></p>'.PHP_EOL;
    $strout.='<p>Пароль: <input type="text" name="RegPassword" /></p>'.PHP_EOL;
    $strout.='<p><input type="submit" value="Регистрация"/></p>'.PHP_EOL;
}
$strout.='</form>';
echo $strout;

$loginandpass=array('1'=>'Harvi '.md5('123456789'),'2'=>'el '.md5('elluminaty'),'3'=>'harvidston '.md5('qwerty12345'));
$fd = fopen("LoginsAndPasswords.txt", 'r') or die("не удалось открыть файл");
while(!feof($fd))
{
    $str = fgets($fd);
    $loginandpass[] = $str;
    //array_push($loginandpass,
}
if(isset($_POST['login'])&&isset($_POST['password'])&&!empty($_POST['login'])&&!empty($_POST['password'])){
    if(checkpass($loginandpass)){
        $_SESSION['login'] = $_POST['login'];
        echo '<meta http-equiv="refresh" content="0.1; URL=6 task.php">';
    }else{echo "Вы не прошли проверку логина и пароля.";}
}else{echo "Заполните все поля.";}
//Функция проверки хеша пароля из файла
function checkpass($loginandpass)
{
    $loginmin=2;$passwordmin=5;
    $flag=false;
    if(strlen($_POST['login'])>=$loginmin && strlen($_POST['password'])>=$passwordmin){
        $i=1;
        while($i<=count($loginandpass)&&!$flag){
            if(is_int(strripos($loginandpass[$i],$_POST['login']))&&is_int(stripos($loginandpass[$i],md5($_POST['password']))))
            {
                $flag=true;
            }else{$flag=false;}
            $i++;
        }
    }else echo "Логин или пароль недостаточной длинны. 	";
    return $flag;
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <!--  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous"> -->
    <link href="style.css" rel="stylesheet" type="text/css">
    <title>WT | 6 task</title>
</head>
<body>
<!--<div class="container">-->
<!--    <form class="form-signin" method="POST">-->
<!--        <h2>Registration</h2>-->
<!--        <input type="text" name="username" class="form-control" placeholder="Username" required>-->
<!--        <input type="password" name="password" class="form-control" placeholder="Password" required>-->
<!--        <div class="button btn btn-lg btn-primary btn-block" type="submit">Register</div>-->
<!--    </form>-->
<!--</div>-->

</body>
</html>
