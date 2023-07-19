<?php
	include('conf.php');
	$d=$_GET['dt'];
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Details de la date : <?php echo $d; ?></title>
</head>
<body>
<h1>Detail de la date : <?php echo $d; ?></h1>
<?php
	$conn = mysqli_connect($adr_base, $log_base, $pass_base, $base);
	if (!$conn) {
		die("Erreur de connexion à la base de données : " . mysqli_connect_error());
	}

	$sql = "SELECT * FROM agenda WHERE dt='$d'";
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) == 0) {
		echo "Aucune information pour cette date";
	} else {
		while ($data = mysqli_fetch_assoc($result)) {
?>
		<table>
			<tr height="50px"><td width="150px"><strong>Lieu</strong></td><td><?php echo $data['Lieu']; ?></td></tr>
			<tr height="50px"><td><strong>Evenement</strong></td><td><?php echo $data['Evenement']; ?></td></tr>
			<tr height="60px"><td><strong>Heure-debut</strong></td><td><?php echo $data['Heure_debut']; ?></td></tr>
			<tr height="70px"><td><strong>Heure-fin</strong></td><td><?php echo $data['Heure_fin']; ?></td></tr>
		</table>
<?php
		}
	}

	// Fermer la connexion à la base de données
	mysqli_close($conn);
?>
</body>
</html>
