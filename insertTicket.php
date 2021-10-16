<?php
session_start();
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "tickets";
    $conn = new mysqli($servername, $username, $password, $dbname);
    $src1 = $_POST['seats'];
    $arraySrc1 = explode("|", $src1);
    $id = $_POST['movieid'];
    $selectMovie = $conn->query("SELECT title_of_movie,start_time FROM movies WHERE id='$id'");
    $data = mysqli_fetch_all( $selectMovie);
    $movie = $data[0][0];
    $time = $data[0][1];

    if (isset($arraySrc1) == true) {  
      $insertReservations = $conn->query("INSERT INTO reservations (`id`,`seat_id`, `movie_id`,`ticket_id`)VALUES (null,'$src1','$id','1')");   
    }

    $userId = $_SESSION["user"]["userid"];

    for ($j = 0; $j<count($arraySrc1)-1; $j++) {
      $insertTickets = $conn->query("INSERT INTO tickets (`id`,`ticket_owner`,`seat`,`movie`,`movie_time`)VALUES (null,'$userId','$arraySrc1[$j]','$movie','$time')");
    }

    echo $_SESSION["user"]["username"] . " " . $_SESSION["user"]["surname"] . " ,udało ci się zarejestrować miejsce " . $src1 . " na seans pod tytułem '". $movie. "' na godzine " .$data[0][1];
    set_time_limit(20);
?>