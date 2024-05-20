<?php
include("manNav.php");
include("db.php");
?>
<div class="row about">
    <div class="col-lg-4 col-md-4 col-sm-12">
        <form method="post" action="" id="#form" style="left: 5%; top: 0%; width: 1wh;">
        <h4>Фильтрация данных</h4>
        <label for='rb1'>Выбор отчета:</label>
<div class='form-check'>
<input class='form-check-input' type='radio' name='rb1' value='1' id='rb1'>
<label class='form-check-label' for='rb1'>
Принятые
</label>
</div>
<div class='form-check'>
<input class='form-check-input' type='radio' name='rb1' value='2' id='rb1'>
<label class='form-check-label' for='rb1'>
Отклоненные
</label>
</div>
<div class='form-check'>
<input class='form-check-input' type='radio' name='rb1' value='0' id='rb1'>
<label class='form-check-label' for='rb1'>
Необработанные
</label>
</div>
<br>
<button type="submit" class="btn btn-primary">Search</button>
    </form>
</div>
    <div class="col-lg-8 col-md-8 col-sm-12 desc">
<?php
if (ISSET($_POST['submit']) or empty($j))
{
    $j=$_POST['rb1'];
    if (empty($j)){
        $j=0;
    }
    $kol=5;
    $page=1;
    $first=0;
    if(isset($_GET['page'])){
        $page = $_GET['page'];
    }
    else {
        $page=1;
    }
    $first=($page*$kol)-$kol;
    
    $sql="SELECT COUNT(*) FROM education where education.Status=$j";
    $result = mysqli_query($db,$sql);
    $row = mysqli_fetch_row($result);
    $total = $row[0];
    $str_pag = ceil($total/$kol);
    if ($j==0){
    echo "<h4>Необработанные заявки</h4>";
}
elseif ($j==1) {
    echo "<h4>Принятые заявки</h4>";
}
else{
    echo "<h4>Отклоненные заявки</h4>";
}
    echo "<table class='table table-bordered table-sm'>
    <tr class='table-primary'><th>Номер</th><th>ФИО студента</th><th>Название программы</th><th>Дата заявки</th><th>Статус</th><th></th>";
    for ($i = 1; $i<=$str_pag; $i++){
        echo "<a href=manOrders.php?page=".$i.">Страница ".$i."</a>"." | ";
    }
    $sql = "SELECT e.ID_Edu, e.Status, e.Data_of_z, tp.Name_of_Program,
                CONCAT(student.Lastname, ' ', student.Firstname) AS FIO
                        FROM Education e
                        INNER JOIN Training_Program tp ON e.ID_Program = tp.ID_Program
                        INNER JOIN student ON e.ID_Stud=student.ID_Stud
                        WHERE e.Status = 0";
                $result = mysqli_query($db, $sql);
                if($result === false) {
                    die("Ошибка выполнения запроса: " . mysqli_error($db));
                }
                while($myrow = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td>".$myrow['ID_Edu']."</td>";
        echo "<td>".$myrow['FIO']."</td>";
        echo "<td>".$myrow['Name_of_Program']."</td>";
        echo "<td>".$myrow['Data_of_z']."</td>";
        if ($myrow['Status']==1){
            echo "<td>Принята</td>";
        }
        elseif ($myrow['Status']==2){
            echo "<td>Отклонена</td>";
        }
        else{
            echo "<td>Рассматривается</td>";
        }
        echo "<td> <form method='post'>
        <input type='hidden' name='idEdu' value='".$myrow['ID_Edu']."'>";
        echo "<button type='button' name='submit' value=' ' class='btn btn-danger' data-toggle='modal' data-target='#myModal' data-order='".$myrow['ID_Edu']."'data-fio='".$myrow['FIO']."'data-name='".$myrow['Name_of_Program']."'>Обработать</button>
        </td>
        </form>
        </tr>";
    }
    echo "</table>"; 
?>
</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Вызов модального окна -->
<script>
$(document).ready(function(){
  $('#myModal').on('show.bs.modal', function (event) {
// кнопка, которая вызывает модаль
 var button = $(event.relatedTarget);
// получим  data-idEdu атрибут
  var idEdu = button.data('order');
// получим  data-fio атрибут
  var fio = button.data('fio');
  var name = button.data('name');
   // Здесь изменяем содержимое модали
  var modal = $(this);
modal.find('.modal-body #idEdu').val(idEdu);
 modal.find('.modal-title').text('Заявка на обучение № '+idEdu);
 modal.find('.modal-body #fio').val(fio);
 modal.find('.modal-body #name').val(name);
})
});
</script>
<div id="myModal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Заголовок модального окна -->
      <div class="modal-header">
        <h4 class="modal-title">Изменить статус заявки</h4>
      </div>
      <!-- Основное содержимое модального окна -->
       <div class="modal-body">  
         <form  method="post"  action="">
<?php
  echo '<div class="form-group"><label for="fio">Студент:</label><br><input type="text" id="fio" name="fio" readonly class="form-control"></div>';
  echo '<div class="form-group"><label for="name">Программа обучения:<input type="text" id="name" name="name" readonly class="form-control"></div>'; 
  echo '<div class="form-check">
  <input class="form-check-input" type="radio" name="rb1" value="1" id="rb1_0">
  <label class="form-check-label" for="rb1_0">
   Принять заявку
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="rb1" value="2" id="rb1_1">
  <label class="form-check-label" for="rb1_1">
  Отклонить заявку
  </label>
</div>';
//скрытое поле для хранения id заявки
echo '<br><input type="hidden" id="idEdu" name="idEdu">'; 
?>
</div>
<div class="modal-footer">
 <button type="button" class="close" data-dismiss="modal" 
aria-hidden="true"> Закрыть</button>
 <button type="submit" name="submit" class="btn btn-primary"> Изменить статус</button>
</div>
</form>
</div>
</div>
</div>
<?php
if(isset($_POST['submit'])){
    $status=$_POST['rb1'];
    $idEdu=$_POST['idEdu'];
    $sql="UPDATE education SET Status=$status WHERE ID_Edu=$idEdu";
    $result=mysqli_query($db,$sql);
    if($result==TRUE){
        echo "Данные успешно изменены!";
        echo "<script> document.location.href = 'manOrders.php'</script>";
    }
    else{
        echo "Ошибка";
    }
}
}
?>
</body>
</html>