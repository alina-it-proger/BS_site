<?php
include("manNav.php");
include("db.php");

if(isset($_POST['idProgram'])){
    $idProgram = $_POST['idProgram'];
    // Запрос на выборку всех полей программы обучения с переданным ID_Program
    $sql = "SELECT * FROM training_program WHERE ID_Program='$idProgram'";
    $result = mysqli_query($db, $sql);
    $myrow = mysqli_fetch_array($result);
?>
    <div class="row about">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <form method="post" action="" id="#form" style="left: 5%; top: 0%;width: 1wh; padding-left: 30%;padding-right: 30%;">
                <input type="hidden" name="idProgram" value="<?php echo $idProgram; ?>">
                <h4>Название программы обучения</h4>
                <input type="text" name="editName" placeholder="" class="form-control" value="<?php echo $myrow['Name_of_the_Program']; ?>">
                <br>
                <label>Кол-во часов</label>
                <input type="number" name="editHours" value="<?php echo $myrow['Number_of_the_hours']; ?>" class="form-control">
                <br>
                <label>Вид программы обучения:</label>
                <select name="editTypeProgram" class="form-control">
                    <option value="Повышение квалификации" <?php if($myrow['Type_of_Program']=="Повышение квалификации") echo "selected"; ?>>Повышение квалификации</option>
                    <option value="Переподготовка" <?php if($myrow['Type_of_Program']=="Переподготовка") echo "selected"; ?>>Переподготовка</option>
                </select>
                <br>
                <label>Вид сертификации:</label>
                <select name="editTypeSertification" class="form-control">
                    <option value="Тестирование" <?php if($myrow['Type_of_certificate']=="Тестирование") echo "selected"; ?>>Итоговое тестирование</option>
                    <option value="Экзамен" <?php if($myrow['Type_of_certificate']=="Экзамен") echo "selected"; ?>>Экзамен</option>
                    <option value="Зачет" <?php if($myrow['Type_of_certificate']=="Зачет") echo "selected"; ?>>Зачет</option>
                    <option value="ВКР" <?php if($myrow['Type_of_certificate']=="ВКР") echo "selected"; ?>>ВКР</option>
                </select>
                <br>
                <label>Вид документа об окончании:</label>
                <select name="editTypeDoc" class="form-control">
                    <option value="Удостоверение" <?php if($myrow['Type_of_Doc']=="Удостоверение") echo "selected"; ?>>Удостоверение</option>
                    <option value="Сертификат" <?php if($myrow['Type_of_Doc']=="Сертификат") echo "selected"; ?>>Сертификат</option>
                    <option value="Диплом" <?php if($myrow['Type_of_Doc']=="Диплом") echo "selected"; ?>>Диплом</option>
                    <option value="Свидетельство" <?php if($myrow['Type_of_Doc']=="Свидетельство") echo "selected"; ?>>Свидетельство</option>
                </select>
                <br>
                <label>Стоимость:</label>
                <input type="number" name="editPrice" placeholder="1000" class="form-control" value="<?php echo $myrow['Price']; ?>">
                <br>
                <button type="submit" name="editSubmit" class="btn btn-primary">Сохранить</button>
                <a href="manager.php" class="btn btn-secondary">Отмена</a>
            </form>
        </div>
    </div>
<?php
}

if(isset($_POST['editSubmit'])){
    $idProgram = $_POST['idProgram'];
    $nameProgram = $_POST['editName'];
    $hours = $_POST['editHours'];
    $price = $_POST['editPrice'];
    $typeSertification = $_POST['editTypeSertification'];
    $typeDoc=$_POST['editTypeDoc'];
  $typeProgram=$_POST['editTypeProgram'];
  $sql="UPDATE training_program SET Name_of_Program='$nameProgram', Number_of_the_hours='$hours', Price='$price',
Type_of_certificate='$typeSertification', Type_of_Doc='$typeDoc' ,Type_of_Program='$typeProgram' WHERE ID_Program='$idProgram'";
  $result=mysqli_query($db,$sql);
  if($result==TRUE)
  {
    echo "Данные успешно изменены!";
    echo "<script> document.location.href = 'manager.php'</script>";
  }
  else{
    echo "Ошибка";
  }
}
?>
</div>
</body>
</html>