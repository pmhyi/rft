<?php
	$person = "NO_ONE";
	if(isset($_POST['email']))
	{
		require_once "mydbms.php";
		$dbname = "snapface";
		$con = connect("root", "");
		mysqli_select_db($con, $dbname) or die ("Unsuccesful");
		$query = "SELECT * FROM user WHERE ( email='".$_POST['email']."' AND passwdhash='".md5($_POST["passwd"])."' )";
		$result = mysqli_query($con, $query) or die ("Unsuccesful ".$query);
		
		while($sor = mysqli_fetch_assoc($result)){
			//print_r($sor);
			$person= $sor;
		}
		$noresult = $person == NULL;
		if($person != "NO_ONE") {
			session_start();
			$_SESSION["person"] = $person;
			$_SESSION["userid"] = $person["id"];
			$_SESSION["belepett"] = true;
			
			header("Location: index.php");
		} else { 
			$logerror = "Hibás e-mail cím vagy jelszó!";
		}
	}
	if(isset($_GET["logout"])){
		session_start();
		unset($_SESSION["belepett"]);

		session_destroy(); //az összes session változót megszűnteti, csutkára kipucolja a $_SESSION tömböt
		header("Location: index.php");
	}

?>
<!Docptye html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="styles/loginstil.css">
		<meta charset="utf-8">
		<title>Üdvüzöljük a Snapface oldalon!</title>
	</head>
	<body>
		<?php

		?>
		<div id="header">
			<img style="float: left;" src="images/icon.png" width="200">
			<center><font class="titletext">Üdvüzöljük a Snapface oldalon!</font></center>
		</div>
		<div id="logger">
			<?php
				function goToReg() {
					header("Location: regiszt.php");
				}
				function logSnapIn(){
					header("Location: index.php");
				}
			?>
			<button  id="reg" class="rlbutton" onclick="location.href='regiszt.php'">Regisztráció</button>

			<form action="" method="post">
				<label>E-mail:</label><input type="text" name="email" id="email"><br>
				<label>Jelszó:  </label><input type="password" name="passwd" id="passwd"><br>
				<input type="submit" class="rlbutton" id="log" value="Belépés">
				<?php if(isset($logerror)){ echo "<font style=\" font-size: 14pt; color: white;\">${logerror}</font>"; } ?>
			</form>
		</div>
	</body>
</html>
