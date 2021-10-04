<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <title>Rezerwacja biletów</title>
    <link rel="stylesheet" href="styles.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital@1&display=swap" rel="stylesheet">
</head>
<body>
 <h1>Jesteś na stronie rezerwacji miejsc</h1> 
 <?php 
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "tickets";
    $conn = new mysqli($servername, $username, $password, $dbname);
    $id=$_GET['movieid'];
    //  echo"<pre>";
    //  print_r($_GET);
    //  echo "</pre>";
    echo $id;
    $seatData= $conn->query("SELECT * FROM seats WHERE movie_id='$id'");
    $seatFetch=mysqli_fetch_all($seatData);
    echo "<div class='screenDiv'>Ekran</div>";
    echo "<div class='theatrePlan'>";
        for($j=0;$j<=299;$j++){
            
            echo("<div class='seatRow'>". $seatFetch[$j][1] . $seatFetch[$j][2] . "</div>");
           
        }
    
    echo "</div>";
        // echo"<pre>";
        // print_r($seatFetch);
        // echo "</pre>";   
    
    
    
    
    
     
 ?>

</body>
</html>