<?php
session_start();

if (!isset($_SESSION['utilisateur_id'])) {
    header("Location: connexion.php");
    exit();
}

// Reste du code de la page admin
// ...
?>
<?php
include('conf.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Agenda en PHP</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="style.css" rel="stylesheet" type="text/css" />
</head>
<?php
$list_fer = array(7); // Liste pour les jours fériés ; EX: $list_fer = array(7, 1) ==> tous les dimanches et les Lundis seront des jours fériés

$conn = connex($adr_base, $log_base, $pass_base, $base); // Obtenez la connexion mysqli en utilisant la fonction connex()
$sql = "SELECT dt FROM agenda";
$req = mysqli_query($conn, $sql); // Utilisez la connexion mysqli ici
$k = 0;
while ($data = mysqli_fetch_array($req)) {
    $list_spe[$k] = $data[0];
    $k++;
}
if($k==0)
	$list_spe[0]="";
//$list_spe=array('1986-10-31','2009-4-12','2009-9-23');//Mettez vos dates des Evenementements ; NB format(annee-m-j)
if(isset($_GET['admin']))
	$lien_redir="gestion.php";
else
	$lien_redir="date_info.php";//Lien de redirection apres un clic sur une date, NB la date selectionner va etre ajouter à ce lien afin de la récuperer ultérieurement 
if(isset($_GET['admin']))
	$clic=1;//1==>Activer les clic sur tous les dates; 2==>Activer les clic uniquement sur les dates speciaux; 3==>Désactiver les clics sur tous les dates
else
	$clic=2;
$col1="#d6f21a";//couleur au passage du souris pour les dates normales

$col2="#8af5b5";//couleur au passage du souris pour les dates speciaux

$col3="#6a92db";//couleur au passage du souris pour les dates férié

$mois_fr = Array("", "Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août","Septembre", "Octobre", "Novembre", "Décembre");


if(isset($_GET['mois']) && isset($_GET['annee']))
{
	$mois=$_GET['mois'];
	$annee=$_GET['annee'];
}
else
{
	$mois=date("n");
	$annee=date("Y");
}
$s=strlen($mois)-1;
if($mois<10)
	$mois=$mois[$s];
$ccl2=array($col1,$col2,$col3);
$l_day=date("t",mktime(0,0,0,$mois,1,$annee));
$x=date("N", mktime(0, 0, 0, $mois,1 , $annee));
$y=date("N", mktime(0, 0, 0, $mois,$l_day , $annee));
$titre=$mois_fr[$mois]." : ".$annee;
//echo $l_day;
?>
<body>
<center>
<div id="lien">
<?php
if(isset($_GET['admin']))
	echo '<a href="agenda.php">Passer en mode User</a>';
else
	echo'<a href="?admin">Passer en mode Admin</a>';
?>
</div>
<form name="dt" method="get" action="">
<?php
if(isset($_GET['admin']))
	echo '<input type="hidden" name="admin" />';
?>
<select name="mois" id="mois" onChange="change()" class="liste">
<?php
	for($i=1;$i<13;$i++)
	{
		echo '<option value="'.$i.'"';
		if($i==$mois)
			echo ' selected ';
		echo '>'.$mois_fr[$i].'</option>';
	}
?>
</select>
<select name="annee" id="annee" onChange="change()" class="liste">
<?php
	for($i=1950;$i<2035;$i++)
	{
		echo '<option value="'.$i.'"';
		if($i==$annee)
			echo ' selected ';
		echo '>'.$i.'</option>';
	}
?>
</select>
</form>
<table class="tableau"><caption><?php echo $titre ;?></caption>
<tr><th>Lun</th><th>Mar</th><th>Mer</th><th>Jeu</th><th>Ven</th><th>Sam</th><th>Dim</th></tr>
<tr>
<?php
//echo $y;
$case=0;
if($x>1)
	for($i=1;$i<$x;$i++)
	{
		echo '<td class="desactive">&nbsp;</td>';
		$case++;
	}
for($i=1;$i<($l_day+1);$i++)
{
	$f=$y=date("N", mktime(0, 0, 0, $mois,$i , $annee));
	if($i<10)
		$jj="0".$i;
	else
		$jj=$i;
	if($mois<10)
		$mm="0".$mois;
	else
		$mm=$mois;
	$da=$annee."-".$mm."-".$jj;
	$lien=$lien_redir;
	$lien.="?dt=".$da;
	echo "<td";
	if(in_array($da, $list_spe))
	{
		echo " class='special' onmouseover='over(this,1,2)'";
		if($clic==1||$clic==2)
			echo " onclick='go_lien(\"$lien\",this)' ";
	}
	else if(in_array($f, $list_fer))
	{
		echo " class='ferier' onmouseover='over(this,2,2)'";
		if($clic==1)
			echo " onclick='go_lien(\"$lien\",this)' ";
	}
	else 
	{
		echo" onmouseover='over(this,0,2)' ";
		if($clic==1)
			echo " onclick='go_lien(\"$lien\",this)' ";
	}
	echo" onmouseout='over(this,0,1)'>$i</td>";
	$case++;
	if($case%7==0)
		echo "</tr><tr>";
	
}
if($y!=7)
	for($i=$y;$i<7;$i++)
	{
		echo '<td class="desactive">&nbsp;</td>';
	}
?></tr>
</table>
<?php
	if(isset($_GET['mod']))
		echo "<div id='notif'>Calendrier modifié</div>";
	elseif(isset($_GET['add']))
		echo "<div id='notif'>Evénement ajouté</div>";
?>
</center>
</body></html>

<script type="text/javascript">
function change()
{
	document.dt.submit();
}
	function over(this_,a,t)
{
	<?php 
	echo "var c2=['$ccl2[0]','$ccl2[1]','$ccl2[2]'];";
	?>
	var col;
	if(t==2)
		this_.style.backgroundColor=c2[a];
	else
		this_.style.backgroundColor="";
}
function go_lien(a,this_)
{
	over(this_,0,1);
	top.document.location=a;
}
merci
</script>