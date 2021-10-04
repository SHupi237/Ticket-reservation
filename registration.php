<!DOCTYPE html>
    <html lang="pl-PL">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <div  id="container">
            <h1>Zarejestruj się</h1>
            <form method="GET">
            <input type="text" placeholder="Wpisz imię" name="name">
            <input type="text" placeholder="Wpisz nazwisko" name="surname">
            <input type="text" placeholder="Wpisz email" name="email">
            <input type="text" placeholder="Wpisz hasło" name="password">
            <input type="text" placeholder="Wpisz ponownie hasło" name="repeatedPassword">
            <input type="submit" name="form" value="Zarejestruj się"><br>
            <a href="index.php">Wróć do logowania</a>
        </div>
        </form>
    </body>
</html>
<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "tickets";
    $conn = new mysqli($servername, $username, $password, $dbname);
    function insertingToDataBase($name,$surname,$email,$passwordUser,$date,$conn) {
        $hashPassword = sha1($passwordUser);
        $insertRegistrer = $conn->query("INSERT INTO users (`id`,`name`, `surname`,`creation_date`, `email`, `password`)VALUES (null,'$name', '$surname','$date', '$email','$hashPassword')");
        
    }
    if (isset($_GET['form'])) {
        $name = $_GET["name"];
        $surname = $_GET["surname"];
        $email = $_GET["email"];
        $passwordUser = $_GET["password"];
        $date = date('Y-m-d H:i:s');
        $repeatedPassword = $_GET["repeatedPassword"];
        $conditionIsCorrect = 0;

        if (strlen($name) > 2) {
            $conditionIsCorrect += 1;
        }else {
            echo '<div class="errorComment">Imie powinno mieć co najmniej 3 znaki!</div>';
        }
        if (strlen($surname) > 3) {
            $conditionIsCorrect += 1;
        }else {
            echo '<div class="errorComment">Nazwisko powinno mieć co najmniej 4 znaki!</div>';
        }
        if (strlen($email) > 4 && strpos($email,"@")) {
            $conditionIsCorrect += 1;
        }else {
            echo '<div class="errorComment">Email powinnien posiadać @ i mieć więcej niż 4 znaki!</div>';
        }
        if($passwordUser == $repeatedPassword && strlen($passwordUser) > 8){
            $conditionIsCorrect += 1;
        } else {
            echo '<div class="errorComment">Hasła powinny być takie samo i hasło powinno mieć więcej niż 8 znaków!</div>';
        }
        if ($conditionIsCorrect == 4) {
            insertingToDataBase($name,$surname,$email,$passwordUser,$date,$conn);
        }else {
            echo '<div class="errorComment">Wpisano błędne dane</div>';
        }
    } 
   
?>