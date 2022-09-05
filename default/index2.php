<?php

require 'header.php';
include 'config.php';

$_SESSION["id"] = $_GET['id'];
$_SESSION["ap"] = $_GET['ap'];
$_SESSION["user_type"] = "new";

# Checking DB to see if user exists or not.
$result = mysqli_query($con, "SELECT * FROM `$table_name` WHERE mac='$_SESSION[id]'");

if ($result->num_rows >= 1) {
  $row = mysqli_fetch_array($result);

  mysqli_close($con);

  $_SESSION["user_type"] = "repeat";
  header("Location: welcome.php");
} else {
  mysqli_close($con);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap"
          rel="stylesheet">
    <link rel="stylesheet" href="../assets/styles/styles.css">
    <title>Case Tegra</title>
</head>

<body>
<div class="main">
    <div class="wrapper">
        <div class="content">
            <div class="box grey-box">
                <div class="grey-box-content">
                    <div class="logo">
                        <img src="../assets/images/logo.png" alt="">
                    </div>
                    <form method="post" action="verify.php">
                        <div class="input">
                            <label for="">Nome:</label>
                            <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">
                                        <img src="../assets/images/user.svg" style="width: 25px;" alt="">
                                    </span>
                                <input type="text" name="fname" class="form-control" aria-label="Username"
                                       aria-describedby="basic-addon1" required>
                            </div>
                        </div>
                        <div class="input">
                            <label for="">Sobrenome:</label>
                            <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">
                                        <img src="../assets/images/user.svg" style="width: 25px;" alt="">
                                    </span>
                                <input type="text" name="lname" class="form-control" aria-label="Username"
                                       aria-describedby="basic-addon1" required>
                            </div>
                        </div>
                        <div class="input">
                            <label for="">E-mail:</label>
                            <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">
                                         <img src="../assets/images/mail.svg" style="width: 25px;" alt="">
                                    </span>
                                <input type="text" name="email" class="form-control" aria-label="Username"
                                       aria-describedby="basic-addon1" required>
                            </div>
                        </div>
                        <div class="input">
                            <label for="">Calular:</label>
                            <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">
                                        <img src="../assets/images/phone.svg" style="width: 25px;" alt="">
                                    </span>
                                <input type="text" name="phone" class="form-control" aria-label="Username"
                                       aria-describedby="basic-addon1" required>
                            </div>
                        </div>
                        <div class="checkbox text-center">
                            <input type="checkbox" id="html" required>
                            <label for="html">Concordo com <span>termos e condições de uso</span></label>
                        </div>
                        <div class="text-center">
                            <button class="voltar">Cadastrar</button>
                        </div>
                    </form>
                    <div class="text-center">
                        <p>Você receberá sua senha por SMS,<br>lembre-se de colocar um celular válido.</p>
                    </div>
                </div>
            </div>
            <div class="box img-box">
                <div class="wifi">
                    <img src="../assets/images/wifi-svgrepo-com.svg" alt="">
                </div>
                <div class="title">
                    <p>Asesso Wi-Fi</p>
                    <p>Casa Tegra</p>
                </div>
            </div>
        </div>
    </div>
</div>

</body>

</html>