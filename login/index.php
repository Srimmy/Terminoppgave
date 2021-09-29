<?php
//global variabel på alle sider, må bare skrive session start for at den skal fungere
// kan legge user Id inn i session for å gjøre if tester om du faktisk har logget inn
session_start();


include("connection.php");
include("functions.php");


$user_data = check_login($con);
$user_name = $user_data['user_name'];


if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $notes = $_POST['notes'];
        
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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Min nettside</title>
</head>

<body>

    <h1>Dette er index siden</h1>
    <a href="logout.php">logg ut</a>

    <br>
    <p>Hei, <?php echo $user_name; ?> </p>
    <form method="POST">


        <label for="notes">Hva skal jeg gjøre i dag?</label> <br>
        <textarea id="notes" name="notes" rows="10" cols="50"> Skriv dine notater her</textarea>
        <input type="submit">
    </form>

</body>

</html>