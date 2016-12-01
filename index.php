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
		<div id="profil">
			<?php 
				include("profilpic.php"); 
				$image = getProfile($_SESSION["userid"]); 
				echo "<img id=\"profile\" src=\"{$image}\"></img>"; 
			?>
		</div>
	</body>
</html>
