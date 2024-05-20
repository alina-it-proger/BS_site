<?php
session_start();
?>
<?php
include("manNav.php");
include("db.php");
?>
<div class="row about">
        <div class="col-lg-4 col-md-4 col-sm-12">
            <form method="post" action="" id="#form" style="left: 5%; top:0%; width:1wh;">
        <h4>Новая запись</h4>
        <label>Название программы обучения:</label>
        <input type="text" name="addName" placeholder="Введите..." class="form-control">
       
        <label>Кол-во часов:</label>
        <input type="number" name="addHours" value="0" class="form-control">
        
        <label>Вид программы обучения:</label>
        <select name="typeProgram" value="Вид" class="form-control">
            <option value="Повышение квалификации">Повышение квалификации</option>
            <option value="Переподготовка">Переподготовка</option>
            </select>

            <label>Вид сертификации:</label>
        <select name="typeSertification" value="Вид" class="form-control">
            <option value="Тестирование">Тестирование</option>
            <option value="Экзамен">Экзамен</option>
            <option value="Зачет">Зачет</option>
            <option value="ВКР">ВКР</option>
            </select>   
            
            <label>Вид документа об оканчании:</label>
        <select name="typeDoc" value="Вид" class="form-control">
            <option value="Удостоверение">Удостоверение</option>
            <option value="Сертификат">Сертификат</option>
            <option value="Диплом">Диплом</option>
            <option value="Свидетельство">Свидетельство</option>
            </select>  

            <label>Стоимость:</label>
            <input type="number" name="addPrice" placeholder="1000" class="form-control">
            <button type="submit" name="submit" class='btn btn-primary'>Добавить</button>
        </form>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-12 desc">

        <?php
        $page=1;
        $kol=2;
        $first=0;

        if (isset($_GET['page'])){
            $page=$_GET['page'];
        }else $page=1;

        $first=($page*$kol)-$kol;

        $sql="SELECT COUNT(*) FROM training_program";
        $result = mysqli_query($db,$sql);
        $row= mysqli_fetch_row($result);
        $total=$row[0];

        $str_pag = ceil($total / $kol);

        for($i =1; $i <= $str_pag; $i++){
            echo "<a href=manager.php?page=".$i."> Страница ".$i."</a>"."|";
        }

     //выборка всех данных о программах обучения
    $sql="SELECT *FROM training_program LIMIT $first, $kol";
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
        <button type='submit' class='btn-primary' formaction='submitUpd.php'>Изменить</button>
        </td>";
        //скрытое поле для хранения значения ID_Program
        echo "<input type='hidden' name='idProgram' value='".$myrow['ID_Program']."'></form>";
        echo "</tr>";

    }
    echo "</table>";
        //конопка
        if (ISSET($_POST['submit']))
        {
            //получаем данные с формы
            $nameProgram=$_POST["addName"];
            $hours=$_POST["addHours"];
            $price=$_POST["addPrice"];
            $typeCertification=$_POST["typeSertification"];
            $typeDoc=$_POST["typeDoc"];
            $typeProgram=$_POST["typeProgram"];

            //sql запрос
            $sql="INSERT INTO training_program(Name_of_Program, Number_of_hours, Price, Type_of_Certification, Type_of_Doc, Type_of_program)
            VALUES ('$nameProgram', $hours, $price, '$typeCertification','$typeDoc', '$typeProgram')";
            $result=mysqli_query($db,$sql);
            if($result==TRUE)
            {
                echo "Данные сохранены!";
                echo "<script> document.location.href='manager.php'</script>";
            }
            else {
                echo "Ошибка";
                echo $sql;
            }
        }
    
        ?>


</body>
</html>