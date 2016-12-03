<?php
	require_once("ifloggedin.php");
	require_once("adatok.php");
?>
<!Docptye html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="styles/indexstil.css">
		<meta charset="utf-8">
		<title>Snapface</title>
	</head>
	<body>

			
		<div id="headermenu">

			<!--<?php echo "<img width=\"44\" height=\"44\" id=\"profil\" scr=\"".$_SESSION["person"]["profilepic"]."\"></img>" ?>-->
			<div id="nevjegy"><?php /*print_r($_SESSION["person"]);*/echo "".$_SESSION["person"]["knev"];?></div>
			<div id="minden">
				<a href="index.php" class="headerbutton"><center>Kezdőlap</center></a>
				<a href="adatlap.php" class="headerbutton"><center>Adatlap</center></a>
				<a href="fotok.php" class="headerbutton"><center>Fényképek</center></a>
				<a href="ismik.php" class="headerbutton"><center>Ismerősök</center></a>
				<a href="events.php" class="headerbutton"><center>Események</center></a>
				<a href="login.php?logout=true" class="headerbutton">Kilépés</a>
			</div>
			<div>
				
			</div>
		</div>
<h1 style="color: white;">Események</h1>
				 <?php
while($rows=mysql_fetch_assoc($records))
{
 $name=$rows['name'];
$start_time=$rows['start_time'];
$duration=$rows['duration'];
$local=$rows['local'];
$lead=$rows['lead'];
$leadpic=$rows['leadpic'];
 
echo "<article class=\"eventblock\"><table><tr><td><p>Esemény megnevezése:</td><td><p>".$name."</td></tr><tr><td><p>Dátum:</td><td><p>".$start_time." </td></tr><tr><td><p>Tartama:</td><td><p>".$duration."</td></tr><tr><td><p>Helye:</td><td><p>".$local."</td></tr><tr><td><p>Leírás:</td><td><p>".$lead."</td></tr><tr><td><p>".$leadpic."</p></td></tr></table></article>";
 
}
 
?>
		<div id="profil">
			<?php 
				include("profilpic.php"); 
				$image = getProfile($_SESSION["userid"]); 
				echo "<img id=\"profile\" src=\"{$image}\"></img>"; 
			?>
		</div>
	</body>
</html>
