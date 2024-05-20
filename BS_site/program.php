<?php
//включаем скрипт с Nav-панелью
include("studNav.php");
include("db.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!-- создание полей для фильтрации данных -->
    <div class="row about">
        <div class="col-lg-4 col-md-4 col-sm-12">
            <form method="post" action="" id="#form" style="left: 5%; top:0%; width:1wh;">
        <h4>Фильтрация данных</h4>
        <input type="checkbox" name="chb1" value="1">По названию
        <input type="text" name="searchName" placeholder="Название программы" class="form-control">
        <input type="checkbox"  name="chb2" value="2">Вид
        <select name="typeProgram" value="Вид" class="form-control">
            <option value="Повышение квалификации">Повышение квалификации</option>
            <option value="Переподготовка">Переподготовка</option>
            </select>
            <input type="checkbox" name="chB3" value="3">Макс.стоимость
            <input type="number" name="searchPrice" placeholder="1000" class="form-control">
            <button type="submit" class='btn btn-primary'>Search</button>
        </form>
        </div>
    <div class="col-lg-8 col-md-8 col-sm-12 desc">

    <?php 
    //выборка всех данных о программах обучения
    $sql="SELECT *FROM training_program";
    $result=mysqli_query($db, $sql); //выполнение запроса
    echo "<h4> Выбор программы обучения</h4>";
    //создаем html-таблицы 
    echo "<table class='table table-bordered table-sm'>
    <tr class='table-primary'><th>Номер</th><th>Навазвание</th><th>Кол-во час</th><th>Вид программы</th><th>Цена</th></tr>";
    //вывод записей из массива $data в таблицу
    while ($myrow=mysqli_fetch_array($result))
    {
        echo "<tr>";
        echo "<td>".$myrow['ID_Program']."</td>";
        echo "<td>".$myrow['Name_of_Program']."</td>";
        echo "<td>".$myrow['Number_of_hours']."</td>";
        echo "<td>".$myrow['Type_of_program']."</td>";
        echo "<td>".$myrow['Price']."</td>";
        //кнопка для отправки заявки на программу
        echo "<td> <form method='post'>
        <button type='submit' class='btn-primary' formaction='submitOrders.php'>Записаться</button>
        </td>";
        //скрытое поле для хранения значения ID_Program
        echo "<input type='hidden' name='idProgram' value='".$myrow['ID_Program']."'></form>";
        echo "</tr>";

    }
    echo "</table>";
    ?>
    </div>
    </div>
</body>
</html>