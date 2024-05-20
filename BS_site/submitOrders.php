<?php
session_start();
include("db.php");
//получаем данные с формы
$idProgram=$_POST['idProgram']; //ID программы
$idStud=$_SESSION['ID_Stud']; //ID студента
$ordersDate=date("Y-m-d"); //текущая системаная дата в формате mySQL
$status=0; //статус заявки, по умолчанию 0(в рассиотрении)
//sql-запрс на добавление новой заявки в таблтцу Education
$query="INSERT INTO education(ID_Stud, ID_Program, Data_of_z, Status)
VALUES ($idStud, $idProgram, '$ordersDate', $status)";
$result=mysqli_query($db,$query);

if($result==TRUE)
{
    echo "Ваша заявка добавлена";
    echo "<script> document.location.href='orders.php'</script>"; //переход к заявкам
}
else{
    echo ("Ошибка!");
    echo $query;
}
?>