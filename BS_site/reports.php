<?php
//включаем скрипт с Nav-gfytkm.
include("manNav.php");
session_start();
include("db.php");

echo "<dic class='row about'>
<div class='c0l-lg-4 col-md-4 col-sm-12'>
<form method='post' action=''>
<label for='rb1'>Выбор отчета:</label>
<div class='form-check'>
<input class='form-check-input' type='radio' name='rb1' value='1' id='rb1'>
<label class='form-check-label' for='rb1'>
Рейтинг программ обучения
</label>
</div>
<div class='form-check'>
<input class='form-check-input' type='radio' name='rb1' value='2' id='rb1'>
<label class='form-check-label' for='rb1'>
Рейтинг слушателей
</label>
</div>
<button type='submit' name='submit' class='btn btn-primary'> Просмотр</button>
</div>
<div class='col-lg-8 col-md-8 col-sm-12 desc'>";
?>
<?php
if (ISSET($_POST['submit'])){
  $n=$_POST['rb1'];
}
  if($n!=2){
    $sql="SELECT training_program.Name_of_Program,training_program.Type_of_Program,training_program.Price, COUNT(education.ID_EDU) AS kol,SUM(training_program.Price) AS sum FROM training_program INNER JOIN education ON training_program.ID_Program=education.ID_Program WHERE education.Status=1 GROUP by training_program.Name_of_Program,training_program.Type_of_Program,training_program.Price ORDER BY COUNT(education.ID_EDU) DESC";
    $result=mysqli_query($db,$sql);
    echo"<h4> Рейтинг программ обучения</h4>";
    echo "<table class='table table-bordered table-sm'>
    <tr class='table-primary'><th>Программа обучения</th><th>Вид программы</th><th>Стоимость за ед.</th><th>Кол-во слушателей</th><th>На сумму</th>";
    while ($myrow=mysqli_fetch_array($result))
    {
      $sum+=$myrow['sum'];
      $count+=$myrow['kol'];
        echo "<tr>";
        echo "<td>".$myrow['Name_of_Program']."</td>";
        echo "<td>".$myrow['Type_of_Program']."</td>";
        echo "<td>".$myrow['Price']."</td>";
        echo "<td>".$myrow['kol']."</td>";
        echo "<td>".$myrow['sum']."</td>";
        echo "<tr>";
    }
        echo "</tr>";
        echo "<td></td><td></td><td><b>Итого: </b></td><td><b>$count</b></td><td><b>$sum</b></td>";
        echo"</td></tr>";
        echo "</form>";
    echo "</table>"; 
  }
  else{
    $sql="SELECT CONCAT(student.Lastname, ' ',student.Firstname) AS FIO, COUNT(education.ID_Edu) AS kol, SUM(training_program.Price) AS sum FROM student 
INNER JOIN education ON student.ID_Stud=education.ID_Stud INNER JOIN training_program ON education.ID_Program=training_program.ID_Program WHERE education.Status=1 GROUP BY student.ID_Stud ORDER BY COUNT(education.ID_Edu) DESC";
    $result=mysqli_query($db,$sql);
    echo"<h4> Рейтинг слушателей программ обучения</h4>";
    echo "<table class='table table-bordered table-sm'>
    <tr class='table-primary'><th>ФИО слушателя</th><th>Кол-во программ</th><th>На сумму</th>";
    while ($myrow=mysqli_fetch_array($result))
    {
      $sum+=$myrow['sum'];
      $count+=$myrow['kol'];
        echo "<tr>";
        echo "<td>".$myrow['FIO']."</td>";
        echo "<td>".$myrow['kol']."</td>";
        echo "<td>".$myrow['sum']."</td>";
        echo "<tr>";
    }
        echo "</tr>";
        echo "<td><b>Итого: </b></td><td><b>$count</b></td><td><b>$sum</b></td>";
        echo"</td></tr>";
        echo "</form>";
    echo "</table>";
  }
?>
</div>
</body>
</html>