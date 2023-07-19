<!DOCTYPE html>
<html>
<head>
    <title>Inscription</title>
    <link rel="stylesheet" href="inscription.css">
</head>
<body>
    <h1>Inscription</h1>
    <form method="post" action="traitement_inscription.php">
        <label for="nom">Nom:</label>
        <input type="text" id="nom" name="nom" required><br>
        <label for="email">Adresse e-mail:</label>
        <input type="email" id="email" name="email" required><br>
        <label for="mot_de_passe">Mot de passe:</label>
        <input type="password" id="mot_de_passe" name="mot_de_passe" required><br>
        <input type="submit" value="S'inscrire">
    </form>
</body>
</html>
