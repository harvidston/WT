<html>
 <head>
	<meta charset="utf-8" />
	<meta name="author" content="Зайцев Алексей">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="style.css" rel="stylesheet" type="text/css">
  <title>ВТ3</title>
 </head>
 <body>
  <form action="links.php" method="POST">
 <p>Введите дату рождения (dd.mm.yy): <input type="text" name="datebirth" /></p>
 <p>Введите количество дней: <input type="text" name="amountdays" /></p>
 <p><input type="submit" /></p>
 <?php
 $Goroskop=[0=> "Крыса",
			1=> "Бык",
			2=> "Тигр",
			3=> "Кролик",
			4=> "Дракон",
			5=> "Змея",
			6=> "Лошадь",
			7=> "Коза",
			8=> "Обезьяна",
			9=> "Петух",
			10=> "Собака",
			11=> "Свинья",];
 if(isset($_POST['datebirth']))
 {
	 if(checkmydate()==true&&(is_numeric($_POST['amountdays'])||empty($_POST['amountdays']))){
		$y=date_create()->diff(date_create($_POST['datebirth']))->y;
		$m=date_create()->diff(date_create($_POST['datebirth']))->m;
		$d=date_create()->diff(date_create($_POST['datebirth']))->d;	
		echo '<p>Ваш возраст: Лет- '.$y.', Месяцев- '.$m.', Дней- '.$d.'</p>' ;
		echo date('d.m.Y', strtotime($_POST['datebirth']) + intval($_POST['amountdays']) * 24 * 3600);
		$goryear=explode('.',$_POST['datebirth']);
		echo '<p> Год по восточному календарю: '.$Goroskop[(intval($goryear[2])+8)%12].'</p>';
	 }else echo '<p style="color:red">Некорректные данные</p>';
 }
 function checkmydate(){
	$flag=true;
	 $masstr=explode('.',$_POST['datebirth']);
	 if(isset($masstr[0])&&isset($masstr[1])&&isset($masstr[2])){
		 if(checkdate($masstr[1],$masstr[0],$masstr[2])){
				'Это корректная дата';
		 }else $flag=false;
	 }else $flag=false;
	return $flag;	 
 }
 ?>
</form>
 </body>
</html>