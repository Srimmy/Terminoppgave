<?php

//ganske sikker på at $varaibel = new mysqli ("localhost", "root", "", "srimondb") basically er det samme
#Dette er bare login på myphp admin
$dbhost = "localhost";
$dbuser = "root";
$dbpassword = "";
$dbname = "srimondb";

#if test som sjekker om det ikke fungerte

if(!$con = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname)) {
    die("faile to connect!");
}
