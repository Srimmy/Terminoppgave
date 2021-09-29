<?php

//Henter informasjon gjennom "_SESSION" siden informasjonen kan endres fra hver enste side der det står session start og bruker variabelen _session

session_start();
//Skjekker om user_id er satt inn, hvis den er satt inn, så blir den fjernet slik at man ikke blir logget inn automatisk lenger

if(isset($_SESSION['user_id']))
{
    unset($_SESSION['user_id']);
}
//flytter deg tilbake til login.php
header("Location: login.php");