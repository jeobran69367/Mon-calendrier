<?php
	include('conf.php');
	$d=$_GET['dt'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Details de  la date : <?php echo $d;?></title>
</head>
<body>
<h1>Detail de la date : <?php echo $d;?></h1>
<?php
	$sql="select * from agenda where dt='$d'";
	$req=mysql_query($sql);
	if(mysql_num_rows($req)==0)
		echo "Aucune information pour cette date";
	else
		while($data=mysql_fetch_array($req))
		{
?>
        <table >
        <tr height="50px"><td width="150px"><strong>Lieu</strong></td><td><?php echo $data['Lieu'];?></td></tr>
        <tr height="50px"><td><strong>Evenement</strong></td><td><?php echo $data['Evenement'];?></td></tr>
        <tr height="60px"><td><strong>Heure-debut</strong></td><td><?php echo $data['Heure_debut'];?></td></tr>
        <tr height="70px"><td><strong>Heure-fin</strong></td><td><?php echo $data['Heure_fin'];?></td></tr>
        </table>
<?php
		}
?>
</body>
</html>