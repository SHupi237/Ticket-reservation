<!DOCTYPE html>
    <html lang="pl-PL">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Strona Rejestracji</title>
            <link rel="stylesheet" href="styles.css">
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital@1&display=swap" rel="stylesheet">
        </head>
        <body>
            <h1 id="header">Rejestracja</h1> 
            <div  id="container">
            <div class="headerInContainer">Zarejestruj się</div>
                <form method="POST">
                    <input type="text" class='inputForm' placeholder="Wpisz imię" name="name">
                    <input type="text" class='inputForm' placeholder="Wpisz nazwisko" name="surname">
                    <input type="text" class='inputForm' placeholder="Wpisz email" name="email">
                    <input type="text" class='inputForm' placeholder="Wpisz hasło" name="password">
                    <input type="text" class='inputForm' placeholder="Wpisz ponownie hasło" name="repeatedPassword"><br>
                    <input type="submit" class="submitButtons" name="form" value="Zarejestruj się"><br>
                    <a class="links"  href="index.php">Wróć do logowania</a>
                </form>
            </div>
        </body>
</html>
<?php

    function insertingToDataBase($name,$surname,$email,$passwordUser,$date,$conn) {
        $hashPassword = sha1($passwordUser);
        $insertRegistrer = $conn->query("INSERT INTO users (`id`,`name`, `surname`,`creation_date`, `email`, `password`)VALUES (null,'$name', '$surname','$date', '$email','$hashPassword')"); 
    }

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "tickets";
    $conn = new mysqli($servername, $username, $password, $dbname);

    if (isset($_POST['form'])) {
        $name = $_POST["name"];
        $surname = $_POST["surname"];
        $email = $_POST["email"];
        $passwordUser = $_POST["password"];
        $date = date('Y-m-d H:i:s');
        $repeatedPassword = $_POST["repeatedPassword"];
        $conditionIsCorrect = 0;

        if (strlen($name) > 2) {
            $conditionIsCorrect += 1;
        } else {
            echo '<div class="warningDiv">Imie powinno mieć co najmniej 3 znaki!</div>';
        }
        if (strlen($surname) > 3) {
            $conditionIsCorrect += 1;
        } else {
            echo '<div class="warningDiv">Nazwisko powinno mieć co najmniej 4 znaki!</div>';
        }
        if (strlen($email) > 4 && strpos($email,"@")) {
            $conditionIsCorrect += 1;
        } else {
            echo '<div class="warningDiv">Email powinnien posiadać @ i mieć więcej niż 4 znaki!</div>';
        }
        if ($passwordUser == $repeatedPassword && strlen($passwordUser) > 8) {
            $conditionIsCorrect += 1;
        } else {
            echo '<div class="warningDiv">Hasła powinny być takie samo i hasło powinno mieć więcej niż 8 znaków!</div>';
        }
        if ($conditionIsCorrect == 4) {
            insertingToDataBase($name, $surname, $email, $passwordUser, $date, $conn);
        } else {
            echo '<div class="warningDiv">Wpisano błędne dane</div>';
        }
    } 
?>