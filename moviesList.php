<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <title>Kino Baranów</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital@1&display=swap" rel="stylesheet">
</head>
<body>
<h1 id="header">Jesteś na stronie kina</h1>    
<div id="container">
<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "tickets";
    $conn = new mysqli($servername, $username, $password, $dbname);
    session_start();
    echo "Witaj"." ". $_SESSION["user"]["username"] ." ".$_SESSION["user"]["surname"];
    if($_SESSION["user"]["email"]=="admin@gmail.com"){
        header('Location:adminSite.php');
    }
    $d2 = date('c', strtotime('-30 days'));
    $movieData= $conn->query("SELECT * FROM movies WHERE DATE(start_time) >= DATE(NOW()) - INTERVAL 30 DAY");
    // var_dump($movieData);
    $fetchMovieData=mysqli_fetch_all($movieData);
    // echo "<pre>";
    // print_r($fetchMovieData);
    // echo "</pre>";

    for($i=0;$i<$movieData->num_rows;$i++){
        echo "<div class='movieDiv'>Tytuł filmu: " . $fetchMovieData[$i][1] . "<br>" . "Godzina rozpoczęcia: " . $fetchMovieData[$i][2] . "<br>" . "Godzina zakończenia: " . $fetchMovieData[$i][3] . "<br>"  . "<br>" . "Cena: " . $fetchMovieData[$i][4] ." ". "zł" .   "</div>";
        echo "<a href='seatReservation.php?movieid=" . $fetchMovieData[$i][0] ."'>Zarezerwuj miejsce</a>";
    }


?>
</div>
</body>
</html>