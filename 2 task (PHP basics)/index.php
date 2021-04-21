<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Зайцев Алексей">s
    <title>ВТ2</title>
</head>
<body>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $number = isset($_POST['number']) ? $_POST['number'] : false;
    if (is_numeric($number)) {
        // String -> array
        $digits = str_split($number);
        $sum = array_sum($digits);
        $result = "<p>Сумма цифр числа {$number} равняется {$sum}</p>\n";
    } else {
        $result = "<p>Неверный ввод</p>\n";
    }
}
?>
<?= isset($result) ? $result : '' ?>
<form action="" method="post">
    <p>
        <label for="number">Введите число</label><br>
        <input type="text" name="number" id="number">
    </p>
    <p>
        <button>Вперед!</button>
    </p>
</form>

</body>
</html>