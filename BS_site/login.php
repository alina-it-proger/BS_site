
<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="reg.css" rel="stylesheet">
</head>
<body>
   
<form ection="#" method="post">
    
    <input checked="" id="signin" name="action" type="radio" value="signin">
    <label for="signin">Вход</label>
    <input  id="signup" name="action" type="radio" value="signup">
    <label for="signup">Регистрация</label>
    <input id="reset" name="action" type="radio" value="reset">
    <label for="reset">Reset</label>

    <div id="wrapper">
        <div id="arrow"></div>
        <input id="email" placeholder="Email" type="text" name="email">
        <input id="pass" placeholder="Пароль" type="password" name="password">
        <input id="repass"  placeholder="Повтор пароля" type="password" onekeyup="valid(event)">
    </div>
    <button type="submit" name="submit">
        <span>
            Reset
            <br>
            Вход
            <br>
            Регистрация
        </span>
    </button>
    </form>

<div id="hint">Click on the tabs</div>

<script type="text/javascript">
function valid(){
    if (document.getElementByld('pass').value != document.getElementByld('repass').value) {
        alert('Пароли не совпадают');
        return false;
    }
}
</script>



<?php 
//var_dump($_POST['submit']);
//нажата кнопка "submit", данные переданы по POST_методу
if (ISSET($_POST['submit']))
{
    //получаем данные с формы 
    $email=$_POST['email'];
    $passw=$_POST['password'];
   
    //при незаполненных полях-сообщение об ошибке и прекращение работы скрипта 
    if(empty($email) or empty($passw))
    {
        exit("Вы ввели не всю информацию");
    }
    //включаем скрипт с подключением к БД
    echo("пррпр");
    include("db.php");
    //проверяем вид команды
    var_dump($_POST['action']);
    
    if($_POST['action']=="signup") //передана радиокнопка signup (регистрация)
    {
        //прверяем существование пользователя с таким логином или email
        $query="SELECT * FROM student WHERE User_name='$email' OR Email='$email'"; //скрипт sql-запроса
        var_dump($query);

        $result=mysqli_query($db, $query); //выполнение запроса

        $myrow=mysqli_fetch_array($result); //результат запишем в ассоциативный массив 

        if(!empty($myrow['ID_Stud']))
        {
            exit("Извините, пользователь с таким email уже существует");
        }
        //sql-запрос на добавление новой записи
        $query="INSERT INTO student(Email, User_name, Passw) VALUES ('$email', '$email', '$passw')";
        $result=mysqli_query($db,$query);

        if($result==TRUE)
        {
            echo "Вы успешно зарегистрированы. Теперь Вы можете авторизироваться и перейти в личный кабинет";
            $_SESSION['User_name']=$email; //запишем в сессию логин нового пользователя
            $query="SELECT max(ID_Stud) AS ID_Stud FROM student"; //найдем идентификатор добавленной записи
         $result=mysqli_query($db,$query); //выполнение запроса
         $myrow=mysqli_fetch_array($result); //ассоциативный массив записей 
         $_SESSION['ID_Stud']=$myrow['ID_Stud']; //запишем в сессию ID добавленного пользователя
         echo "<script> document.location.href = 'students.php' </script>"; //переход в личный кабинет
        }
        else{
            echo ("Ошибка регистрации");
        }
    }


if($_POST['action']=="signin") //передана радиокнопка signin (вход в систему)
{
    //проверяем существование пользователя с таким логином или email
    $query="SELECT * FROM student WHERE User_name='$email' OR Email='$email'"; //скрипт sql-запроса
    $result=mysqli_query($db,$query); //выполнение запроса 
    $myrow=mysqli_fetch_array($result); //ассоциативный массив записей
    //записей нет
    if(empty($myrow['User_name']))
    {
        exit("Извините, пользователь с таким логином/email не зарегистрирован");
        
    }
    //запись возвращается, пользователь найден
    else{
        //проверка пароля
        if($myrow['Passw']==$passw)
        {
            //пароль верный, записываем данные в сессию
            $_SESSION['User_name']=$myrow['User_name'];
            $_SESSION['ID_Stud']=$myrow['ID_Stud'];
            //переходим в личный кабинет
            if($_POST['User_name']=="manager"){
                echo "<script> document.location.href = 'manager.php'</script>"; //переход в личный кабинет менеджера
            }
            else{
                echo "<script> document.location.href = 'students.php'</script>"; //переход в личный кабинет студента
            }
        }
        else{
            exit("Пароль неверный");
        }
    }
}
}
?>
  
  </body>
</html>