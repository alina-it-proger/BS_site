<?php
include("studNav.php");
include("db.php");
?>
<?php
//выборка всех данных о пользователе
$sql="SELECT * FROM student WHERE ID_Stud=$idUser";
$result=mysqli_query($db,$sql); //выполнение запроса
$myrow=mysqli_fetch_array($result);
//полученные из БД значения полей запишем в переменные
$userName=$myrow["User_name"];
$passw=$myrow["Passw"];
$lastName=$myrow["Lastname"];
$firstName=$myrow["Firstname"];
$fatherName=$myrow["Fathername"];
$birthDate=$myrow["Birth_Date"];
$edu=$myrow["Education" ];
$tel=$myrow["Tel"];
$email=$myrow["Email"];
// вывод данных в поля формы
echo"
<div class='row about'>
<div class='col-1g-4 col-md-4 col-sm-12'>
<img align='center' src='Img/stud1.png' class='img-fluid'>
</div>
<div class='col-1g-8 col-md-8 col-sm-12 desc'>
<form action='#' method='POST' class='form-group' style='margin-bottom: 1%;'>
<h4> Редактирование профиля </h4>
<input type='text' name='userName' placeholder='Логин/E-mail' class='form-control' value='$userName' required>
<br> 
<input type='password' name='passw' placeholder='' class='form-control' value='$passw' required>
<br> 
<input type='text' name='lastName' placeholder='Фамилия' class='form-control' value='$lastName'>
<br>
<input type='text' name='firstName' placeholder='Имя' class='form-control' value='$firstName'>
<br>
<input type='text' name='fatherName' placeholder='Отчество' class='form-control' value='$fatherName'>
<br>
<input type='date' name='birthDate' class='form-control' value='$birthDate'>
<br>
<input type='text' name='tel' placeholder='Телефон' class='form-control' value='$tel'>
<br>
<input type='email' name='email' placeholder='email' class='form-control' value='$email' required>
<br> 
<button type='submit' name='submit' class='btn' style='background-color: blue; color:#fff;'>Сохранить изменения</button> 
</form>
</div>";
?>
<?php
if (ISSET($_POST['submit']))
{
$userName=$_POST["userName"];
$passw=$_POST["passw"];
$lastName=$_POST["lastName"];
$firstName=$_POST["firstName"]; 
$fatherName=$_POST["fatherName"];
$birthDate=$_POST["birthDate"];
$tel=$_POST["tel"];
$email=$_POST["email"];
$sql="UPDATE student SET User_name='$userName', Passw='$passw', Lastname='$lastName',
Firstname='$firstName', Fathername='$fatherName' ,Birth_Date='$birthDate', Tel='$tel' ,Email='$email'
 WHERE ID_Stud='$idUser'";
$result=mysqli_query($db,$sql);
if($result==TRUE){
echo "Данные успешно сохранены!";
echo "<script> document.location.href = 'students.php'</script>";//обновляем страницу
}
else{
echo "Ошибка" . mysqli_error($db);
}
}
?>
</body>
</html>