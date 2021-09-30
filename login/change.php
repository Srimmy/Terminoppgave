<?php
#Henter andre filer og kobler sammen
#Dette skjekker om brukeren faktisk er logget inn eller ikke og er en type security
session_start();
include("connection.php");
include("functions.php");

$user_data = check_login($con);
$user_name = $user_data['user_name'];

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $password = $_POST['password'];
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];



    //sjekker om brukernavn feltet er skrevet, om passordfeltet er skrevet og om brukernavnet inneholder bokstaver
    if (!empty($newPassword) && !empty($password) && !empty($confirmPassword)) {
          
        if ($_POST['newPassword'] === $_POST['confirmPassword']) {
            echo $_POST['newPassword'];
        }
        // UPDATE employees 
        // SET 
        //     last_name = 'Lopez'
        // WHERE
        //     employee_id = 192;

        //skal lese fra databasen
        $query = "update srimondb, set password = '$newPassword' where user_name = '$user_name' limit 1";
        $result = mysqli_query($con, $query);
        //skjekker om result var vellykket
        if ($result) {
            if ($result && mysqli_num_rows($result) > 0) {
                $user_data = mysqli_fetch_assoc($result);
                if ($user_data['password'] == $password) {

                    $_SESSION['user_id'] = $user_data['user_id'];
                    header("Location: index.php");
                    die;
                }
            }
        }
        echo "Wrong username or password";
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
    <div class="skrivefelt">
        <form method="post" class="form">
            <label for="password">Password</label> <br>
            <input type="password" name="password"> <br> <br>
            <label for="newPassword">New password</label> <br>
            <input type="password" name="newPassword"> <br> <br>
            <label for="confirm password">Confirm password</label> <br>
            <input type="password" name="confirmPassword">
            <input type="submit" value="Change"> <br> <br>
        </form>
    </div>

</body>

</html>