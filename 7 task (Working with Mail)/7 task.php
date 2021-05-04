<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>WT | 7 task</title>
</head>
<body>
<form action="7 task.php" method="POST">
    <p>Введите заголовок:<input type="text" name="subject" /></p>
    <p><textarea rows="20" cols="70" name="text"></textarea></p>

    <p><input type="submit" value="Отправить" /></p>
    <?php
    //Проверяем заполнены ли поля форм
    if(isset($_POST['subject'])&&isset($_POST['text'])&&!empty($_POST['subject'])&&!empty($_POST['text']))
    {
        $Link = mysqli_connect('localhost', 'root', 'root','test');

        mysqli_select_db($Link,'test');
        $Link->set_charset("utf8");
        $query ="SELECT * FROM emails";
        $res_db = $Link->query($query);

        $a = mysqli_fetch_row($res_db);
        //Определяем кому адресовано письмо(переменная $to содержит email адрес из строчкек в таблиуе emails)
        $to=$a[1];
        while ($a = mysqli_fetch_row($res_db))
        {
            $to.=", ".$a[1];
        }
        echo $to;
        $subject = $_POST['subject'] ;
        $subject = '=?utf-8?B?'.base64_encode($subject).'?=';
        $message = $_POST['text'];

        $headers  = "Content-type: text/html; charset=utf-8 \r\n";
        $headers .= "From: From my syte <> \r\n";
        $headers .= "Reply-To: noreply-to@example.com\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        if (mail($to, $subject, $message,$headers))
        {
            echo '<meta http-equiv="refresh" content="1; URL=7 task.php">';
            echo 'Успешно отправлено.';
        } else
        {
            echo 'Не отправлено.';
        }
    }else echo "Заполните все поля.";
    ?>
</body>
</html>
