<!DOCTYPE html>
<html>
<head>
    <title>Connexion</title>
    <link rel="stylesheet" href="connexion.css">
</head>
<body>
    <h1>Connexion</h1>
    <form method="post" action="traitement_connexion.php">
        <label for="email">Adresse e-mail:</label>
        <input type="email" id="email" name="email" required><br>
        <label for="mot_de_passe">Mot de passe:</label>
        <input type="password" id="mot_de_passe" name="mot_de_passe" required><br>
        <input type="submit" value="Se connecter">
    </form>
</body>
</html>
