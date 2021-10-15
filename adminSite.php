<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Strona Administracyjna</title>
    <link rel="stylesheet" href="styles.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital@1&display=swap" rel="stylesheet">
</head>
<body>
<div id="container">
        <h1>Strona Administracyjna </h1>
        <form action="adminSite.php" method="POST">
        <input type="text" placeholder = "Wpisz tytuł filmu" name="title">
        <input type="datetime-local" placeholder="Wpisz godzinę rozpoczęcia" name="startingTime">
        <input type="datetime-local" placeholder="Wpisz godzine zakończenia filmu" name="endingTime">
        <input type="text" placeholder="Wpisz cenę biletu na film" name="ticketPrice">
        <input type="submit" name="form" value="Dodaj film" ><br>
        </form>
        </div>
        
<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "tickets";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if (isset($_POST['form'])) {
        if (isset($_POST["title"])){
            $title = $_POST["title"];
        } else {
            echo "<div class='errorComment'>Nie podano tytułu filmu</div>";
        }
        if (isset($_POST["startingTime"])){
            $startingTime = $_POST["startingTime"];
        } else {
            echo "<div class='errorComment'>Nie podano godziny rozpoczęcia filmu</div>";
        }
        if (isset($_POST["endingTime"])){
            $endingTime = $_POST["endingTime"];
        } else {
            echo "<div class='errorComment'>Nie podano godziny zakończenia filmu</div>";
        }
        if (isset($_POST["ticketPrice"])){
            $ticketPrice = $_POST["ticketPrice"];
        } else {
            echo "<div class='errorComment'>Nie podano ceny biletu na film</div>";
        }
        $insertMovie = $conn->query("INSERT INTO movies (`id`,`title_of_movie`, `start_time`,`end_time`, `price`)VALUES (null,' $title', '$startingTime','$endingTime','$ticketPrice')");
        $movieData = $conn->query("SELECT id FROM movies WHERE start_time='$startingTime'");
        $fetchMovieData = mysqli_fetch_all($movieData);
        $fetchMovieID = $fetchMovieData[0][0];
        if($insertMovie == true){
            $tab = ['A','B','C','D','E','F','G','H','I','J','K','M','N','O','P'];

            
          
                for($j = 0; $j <= 14; $j++){
                    for($i = 1; $i <= 20; $i++){
                    $insertSeats = $conn -> query("INSERT INTO seats (`id`,`seat_row`, `seat_place`,`movie_id`)VALUES (null,'$tab[$j]', '$i','$fetchMovieID')");
                }
            }
        }
        die;
    }
?>
</body>
</html>
