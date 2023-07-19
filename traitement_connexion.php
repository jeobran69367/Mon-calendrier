<?php
session_start();

// Récupération des données du formulaire de connexion
$email = $_POST['email'];
$mot_de_passe = $_POST['mot_de_passe'];

// Connexion à la base de données
include('conf.php');
$conn = connex($adr_base, $log_base, $pass_base, $base);

// Vérification des informations d'identification
$sql = "SELECT id, mot_de_passe FROM utilisateurs WHERE email = '$email'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    if (password_verify($mot_de_passe, $row['mot_de_passe'])) {
        // Authentification réussie, création de la session
        $_SESSION['utilisateur_id'] = $row['id'];
        header("Location: agenda.php");
        exit();
    } else {
        // Mot de passe incorrect
        echo "Mot de passe incorrect.";
    }
} else {
    // L'utilisateur n'existe pas
    echo "L'utilisateur n'existe pas.";
}

// Fermeture de la connexion à la base de données
mysqli_close($conn);
?>
