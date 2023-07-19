<?php
$adr_base = "localhost"; // adresse de la base de données
$log_base = "root"; // login de la base de données
$pass_base = ""; // mot de passe de la base de données
$base = "agenda"; // nom de la base de données

function connex($adr, $log, $pas, $base)
{
    $conn = mysqli_connect($adr, $log, $pas, $base);
    if (!$conn) {
        die("Erreur de connexion : " . mysqli_connect_error());
    }
    return $conn; // Assurez-vous de retourner la connexion mysqli
}
