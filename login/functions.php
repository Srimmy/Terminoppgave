<?php

function check_login($con) {
    //denne if testen sjekker user id i databasen vår er satt inn 
    if(isset($_SESSION['user_id']))
    {
        $id = $_SESSION['user_id'];
        #Spør databasen om det er en bruker som har samme user id som den user id'en vi har, men hvorfor er dette en kode?
        #Skjekker også om informasjonen vi tidligere hentet ut fra user id er ekte eller falsk
        $query = "select * from users where user_id = '$id' limit 1";

        $result = mysqli_query($con,$query);


        //sjekker om result kom tilbake positivt og at det er mer enn 0 rader i databasen og returnerer oss bruker informasjonen fra databasen
        if($result && mysqli_num_rows($result) >0) {
            $user_data = mysqli_fetch_assoc($result);
            return $user_data;
        }
    }

    //redirect to login
    header("Location: login.php");
    die;
}


#Denen funksjonenen henter et tall fra der funksjonen blir benevnt,
#for loopen lager et random tal ved å bruke 1+1 = 11 logikk og lager et tilfeldig tall som er basert har 4 til $lenght siffer.
function random_num($length){
    $text = "";
    if ($length < 5) {
        $length = 5;
    }
    $len = rand(4,$length);

    for($i=0; $i < $len; $i++) {
       
        $text .= rand(0,9);
    }
    return $text;
}