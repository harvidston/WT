<html>
 <head>
	<meta charset="utf-8" />
	<meta name="author" content="Зайцев Алексей">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="style.css" rel="stylesheet" type="text/css">
  <title>ВТ4</title>
 </head>
 <body>
 <p><textarea rows="10" cols="60"  name="corrmess"> 
 <?php echo file_get_contents('./file.txt');?>
 </textarea></p>
  <form action="index.php" method="POST">
 <p>Имя: <input type="text" name="name"<?php if(isset($_POST['name'])&&!empty($_POST['name'])) echo 'value='.$_POST['name'] ?> /></p>
 <p><b>Введите сообщение:</b></p>
 <p><textarea rows="10" cols="60" name="message"><?php if(isset($_POST['message'])&&!empty($_POST['message'])) echo $_POST['message'] ?></textarea></p>

 <p><input type="submit" /></p>
 <?php
 if(isset($_POST['name'])&&!empty($_POST['name'])){
 if(isset($_POST['message'])&&!empty($_POST['message'])){
 $regexp = "/\b([a-z0-9._-]+@(?!bsuir)[a-z0-9.]+)\b/ui";
 $correctmessage = preg_replace($regexp,'#Cтоп e-mail#',$_POST['message']);
 $fp = fopen('file.txt', 'a');
fwrite($fp, $correctmessage . PHP_EOL);
fclose($fp);
echo '<meta http-equiv="refresh" content="1; URL=index.php">'; 
 }else{echo 'Сообщение не введено.';}
 }else{echo 'Имя не введено.';}
 ?>
 
</form>
 </body>
</html>