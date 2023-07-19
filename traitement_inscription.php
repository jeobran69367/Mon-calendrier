<?php
// Récupération des données du formulaire d'inscription
$nom = $_POST['nom'];
$email = $_POST['email'];
$mot_de_passe = password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT); // Hachage du mot de passe pour des raisons de sécurité

// Connexion à la base de données
include('conf.php');
$conn = connex($adr_base, $log_base, $pass_base, $base);

// Vérification si l'adresse e-mail est déjà utilisée
$sql = "SELECT id FROM utilisateurs WHERE email = '$email'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    die("L'adresse e-mail est déjà utilisée. Veuillez en choisir une autre.");
}

// Insertion des données dans la table utilisateurs
$sql = "INSERT INTO utilisateurs (nom, email, mot_de_passe) VALUES ('$nom', '$email', '$mot_de_passe')";
if (mysqli_query($conn, $sql)) {
    echo "Inscription réussie !";
} else {
    echo "Erreur lors de l'inscription : " . mysqli_error($conn);
}

// Fermeture de la connexion à la base de données
mysqli_close($conn);
?>
