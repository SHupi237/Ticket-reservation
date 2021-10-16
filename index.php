 <!DOCTYPE html>
    <html lang="pl-PL">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Logowanie do serwisu biletowego</title>
            <link rel="stylesheet" href="styles.css">
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital@1&display=swap" rel="stylesheet">
            <script src="script.js"></script>
        </head>
        <body>
            <div id="container">
                <h1>Zaloguj się</h1>
                <form>
                    <input type="text" placeholder="Wpisz email" name="email">
                    <input type="password" placeholder="Wpisz hasło" name="password">
                    <input type="submit" name="form" value="Zaloguj się" ><br>
                        <a href="registration.php">Nie masz jeszcze konta? Zarejestruj się</a>
                </form>
            </div>
        </body>
    </html>
<?php
session_start();

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "tickets";
    $conn = new mysqli($servername, $username, $password, $dbname);

    if (isset($_POST['form'])) {
        if (isset($_POST["email"])) {
            $email = $_POST["email"];
        } else {
            echo "<div class='errorComment'>Nie podano emaila</div>";
        }
        if (isset($_POST['password'])) {
            $passwordUser = $_POST["password"];
        } else {
            echo "<div class='errorComment'>Nie podano hasła</div>";
        }
        $encodedPasswordUser = sha1($passwordUser);
        $comparingData= $conn->query("SELECT * FROM users WHERE email='$email' AND password='$encodedPasswordUser'");
        if ($comparingData->num_rows>0) {
            $data=mysqli_fetch_all( $comparingData);
            $id=$data[0][0];
            $name=$data[0][1];
            $surname=$data[0][2];

            $_SESSION["user"] = [
                'userid'=>$id,
                'username'=>$name,
                'surname'=>$surname,
                'email'=>$email
            ];
            header('Location: moviesList.php');
        } else {
            echo "<div class='warningDiv'>Login lub hasło jest niepoprawne.Spróbuj ponownie</div>";
        }
}

?>