<?php
    #Henter andre filer og kobler sammen
    #Dette skjekker om brukeren faktisk er logget inn eller ikke og er en type security
    session_start();
    include("connection.php");
    include("functions.php");

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        //hvis denne if testen er sann, har noen skrevet informasjon i en form der metoden i formen var "POST"
        $user_name = $_POST['user_name'];
        $password = $_POST['password'];

        //sjekker om brukernavn feltet er skrevet, om passordfeltet er skrevet og om brukernavnet inneholder bokstaver
        if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
        {

            //skal lese fra databasen
            $query = "select * from users where user_name = '$user_name' limit 1";
            $result = mysqli_query($con, $query);

            //skjekker om result var vellykket
            if($result) {
                if($result && mysqli_num_rows($result) >0) {
                    $user_data = mysqli_fetch_assoc($result);
                    if($user_data['password'] == $password) {

                        $_SESSION['user_id'] = $user_data['user_id'];
                        header("Location: index.php");
                        die;
                    }
                }
            }
            echo "Wrong username or password";
        }
        else
        {
            echo "Please enter some valid information!";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="styles.css">

    <title>Login</title>
</head>
<body>
    <div class = "skrivefelt">
        <form method = "post" class = "form" >
            <label for="username">username</label> <br>
            <input type="text" name = "user_name"> <br> <br>
            <label for="password">password</label> <br>
            <input type="password" name = "password"> <br> <br>

            <input type="submit" value="Login"> <br> <br>

            <a href="signup.php"> Sign up</a> <br> <br>
            <a href="forgot.php"> Forgot your password?</a>
        </form>
    </div>
    
</body>
</html>