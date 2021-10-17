<!DOCTYPE html>
<html lang="pl-PL">
    <head>
        <meta charset="UTF-8">
        <title>Rezerwacja biletów</title>
        <link rel="stylesheet" href="styles.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital@1&display=swap" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="script.js"></script>   
    </head>
    <body>
        <h1 id="header">Rejestracja</h1> 
        <div class="headerStyles">
            <h1>Jesteś na stronie rezerwacji miejsc</h1> 
        </div>
        <?php 
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "tickets";
            $conn = new mysqli($servername, $username, $password, $dbname);
            
            if (isset($_GET['movieid'])) {
                $id = $_GET['movieid'];
                echo "<input id='movieId' value='" . $id . "' type='hidden'>";
                $seatData = $conn->query("SELECT * FROM seats WHERE movie_id='$id'");
                $seatFetch = mysqli_fetch_all($seatData);
                echo "<div class='theatrePlan'>";
                for ($j = 0; $j <= 299; $j++) {
                    echo("<div class='seatRow' id='seat" . $j . "'>". $seatFetch[$j][1] . $seatFetch[$j][2] . "</div>");
                }
            }
                echo "</div>";
                echo("<button class='submitButtons' id='submitButton'>Zarezerwuj miejsce</button>");
        ?>
        <div class="backToMovies">
            <a class="links" href="moviesList.php">Wróć do wyboru filmu</a>   
        </div>
    </body>
</html>