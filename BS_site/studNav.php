<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Личный кабинет студента</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style2.css">
    <link rel="stylesheet" href="style-reg.css">
</head>
<body>
    <!-- bootsrap for Nav -->
    <nav class="navbar navbar-expand-lg brown_panel">
        <a class="navbar-brand" href="#">Личный кабинет студента</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse"
            data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-4">
                <li class="nav-item">
                    <a class="nav-link" href="students.php">Профиль</a>
                </li>

                <li class="nav-item active">
                    <a class="nav-link" href="program.php">Программы обучения <span class="sr-only">(current)</span></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="orders.php">Мои звявки</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="index.php">Выход</a>
                </li>
            </ul>
        </div>
    </nav>

    <div>
        

<?php
        //ID and userName here
        $idUser=$_SESSION['ID_Stud'];
        $userName=$_SESSION['User_name'];
        echo "<h4 class='heading'>Добро пожаловать, пользователь $userName, ID=$idUser</h4>";
        ?>
    </div>
   
