<?php
include("studNav.php");
include("db.php");
?>
<div class="row about">
  <div class="col-lg-4 col-md-4 col-sm-12">
    <form method="post" action="" id="#form" style="left: 5%; top: 0%; width: 1wh;">
    <h4>Фильтрация данных</h4>
    <input type="checkbox" name="chb1" value="1">По названию
    <input type="text" name="searchName" placeholder="Название программы" class="form-control">
    <br>
    <input type="checkbox" name="chb2" value="2">Вид
    <select name="typeProgram" value="Вид" class="form-control">
      <option value="Повышение квалификации">Повышение квалификации</option>
      <option value="Переподготовка">Переподготовка</option>
    </select>
    <br>
    <button type="submit" class="btn btn-primary">Search</button>
  </form>
</div>
<div class="col-lg-8 col-md-8 col-sm-12 desc">
<?php
$n1=0;
$n2=0;
if (ISSET($_POST['submit']) or empty($n1))
{
    $n1=$_POST['chb1'];
    $n2=$_POST['chb2'];
    if (empty($n1)){
        $n1=0;
    }
    if (empty($n2)){
        $n2=0;
    }
  
  $sql = "SELECT education.*, training_program.Name_of_Program 
            FROM education
            JOIN training_program ON education.ID_Program = training_program.ID_Program WHERE education.ID_STUD=$idUser";



  $result=mysqli_query($db,$sql);
  echo "<h4>Мои заявки</h4>";
  echo "<table class='table table-bordered table-sm'>
  <tr class='table-primary'><th>ID</th><th>Название</th><th>Дата заявки</th><th>Статус заявки</th><th>Начало обучения</th><th>Дата окончания</th><th>№ документа</th>";
  while ($myrow=mysqli_fetch_array($result))
  {
    echo "<tr>";
    echo "<td>".$myrow['ID_Stud']."</td>";
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
    echo "<td>".$myrow['Date_of_begining']."</td>";
    echo "<td>".$myrow['Date_of_Closing']."</td>";
    echo "<td>".$myrow['N_Doc']."</td>";
    echo"</tr>";
  }
  echo "</table>";
}
  ?>
</div>
</div>
</body>
</html>