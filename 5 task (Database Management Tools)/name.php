<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>WT | 5 task</title>
</head>
<body>
<?php
$Months=array('1'=>"Январь",'2'=>"Февраль",'3'=>"Март",'4'=>"Апрель",'5'=>"Май",'6'=>"Июнь",'7'=>"Июль",'8'=>"Август",'9'=>"Сентябрь",'10'=>"Октябрь",'11'=>"Ноябрь",'12'=>"Декабрь");
//Для подключения к серверу применяем функцию mysqli_connect().
//Для подключения к MySQL нам надо указать настройки подключения: адрес сервера, логин, пароль и название базы данных.
$db = mysqli_connect('localhost', 'root', 'root','test') ;
mysqli_select_db($db,'test');
$db->set_charset("utf8");

//Проверяем, пришел ли запрос на конкретную дату. Если нет, берем текущую дату.
if (isset($_GET['ID'])&&!empty($_GET['ID']))
{
    $query = "SELECT * FROM holidays WHERE ID=".$_GET['ID'];
    $res_db = $db->query($query);
    while ($a = mysqli_fetch_row($res_db))
    {
        echo "Дата: ".$a[4].'.'.$a[3].'.'.$a[2].'('.intval($a[4]).' '.$Months[intval($a[3])].')'."</br>";
        echo "В данную дату произошло следующее событие:"."</br>".$a[1]."</br>";
        if (!empty($a[5])){
            echo "Картинка для данного события:"."</br>";
            ?><img  src="<?php echo $a[5]?>"/>.</br><?php
        }
    }
}
//Готовим запрос к БД
//Запрос к базе данных (функция query содержит два параметра: объект подключения ($db) и строку запроса на языке SQL($query).
$query = "SELECT * FROM holidays";
$res_db = $db->query($query);
echo "<table>";
echo "Календарь праздников:";
//mysqli_fetch_row Возвращает массив, соответствующий выбранной строке в БД, или NULL, если в наборе результатов больше нет строк.
while ($a = mysqli_fetch_row($res_db))
{
    echo "<tr><td>";
    echo "<a class='font' href=\"name.php?ID=$a[0]\">$a[4].$a[3].$a[2]".'('.intval($a[4]).' '.$Months[intval($a[3])].')'."</a>";
    echo "</td></tr>";
}
echo  "</table>";
?>
</body>
</html>
