
<html>
<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital@1&display=swap" rel="stylesheet">
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
    <h2>Email ma zawierać małpe.Hasło ma mieć więcej niż 8 znaków.Hasło w ,,Wpisz ponownie hasło" powinno się zgadzać z hasłem podanym za pierwszym razem"</h2>
    </form>
</body>

</html>

<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tickets";
$conn = new mysqli($servername, $username, $password, $dbname);



// if ($conn->connect_error) {
//   die("Connection failed: " . $conn->connect_error);
// }
// echo "Connected successfully";
if(isset($_POST['form'])){
    echo("Fromularz został wysłany");
}
$name=$_GET["name"];
$surname=$_GET["surname"];
$email=$_GET["email"];
$passwordUser=$_GET["password"];
$date = date('Y-m-d H:i:s');


$repeatedPassword=$_GET["repeatedPassword"];
if(strlen($email)>4 && strpos($email,"@") && $passwordUser == $repeatedPassword && strlen($passwordUser)>8){
    insertingToDataBase($name,$surname,$email,$passwordUser,$date,$conn);
}else{
    echo "Dane nie spełniają wymagań.Sprawdź je jeszcze raz i wypełnij dane według nich.";
    die;
}
// echo $date;
// echo "INSERT INTO users (`id`,`name`, `surname`,`creation_date`, `email`, `password`)VALUES (null,'$name', '$surname','$date', '$email', '$password')";
// die;

function insertingToDataBase($name,$surname,$email,$passwordUser,$date,$conn){
    $insertRegistrer="INSERT INTO users (`id`,`name`, `surname`,`creation_date`, `email`, `password`)VALUES (null,'$name', '$surname','$date', '$email', sha1('$passwordUser'))";
    echo($passwordUser);
    if ($conn->query($insertRegistrer) === TRUE) {
        echo "Zarejestrowano użytkownika";
      } else {
        echo "Error: " . $insertRegistrer . "<br>" . $conn->error;
      }
      
      $conn->close();
}
?>
?>