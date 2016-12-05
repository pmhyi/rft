<?php
	require_once("ifloggedin.php");
	require_once("adatok.php");
	$admin_id = GetOwnData($_SESSION["userid"]);
	
	?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="styles/indexstil.css">
<link rel="stylesheet" type="text/css" href="styles/ismikstil.css">
		<title>EsemÃ©ny hozzÃ¡adÃ¡sa</title><meta charset="utf-8">
		<meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
		<title>Snapface</title>
	</head>
	<body>
	<div id="headermenu">
			<div id="nevjegy"><?php /*print_r($_SESSION["admin_id"]);*/echo "".$admin_id["knev"]; ?></div>
			<div id="minden">
				<a href="index.php" class="headerbutton"><center>Kezdőlap</center></a>
				<a href="adatlap.php" class="headerbutton"><center>Adatlap</center></a>
				<a href="fotok.php" class="headerbutton"><center>Fényképek</center></a>
				<a href="ismik.php" class="headerbutton"><center>Ismerősök</center></a>
				<a href="events.php" class="headerbutton"><center>Események</center></a>
				<a href="login.php?logout=true" class="headerbutton">Kilépés</a>
			</div>
			</div>
		<center><div id="content">
     <div id="friendlist">   
<h1 style="color: white;">Esemény hozzáadása</h1>
</div>
<fieldset>
    <legend>Új esemény</legend>
    <form action="events.php" method="post" />
<table>
<tr>
<td>Cím:</td><td><input type="text" name="name" /><br /></td>
</tr>
<tr>
<td>Leírás:</td><td><input type="text" name="lead" /><br /></td>
</tr>
<tr>
<td>Helyszín:</td><td><input type="text" name="local" /><br /></td>
</tr>
<tr>
<td>Kezdés ideje:</td><td><input type="date" name="start_time" /><br /></td>
</tr>
<tr>
<td>Tartama:</td><td><input type="time" name="duration" /><br /></td>
</tr>
<tr>
//<td>Borító feltöltése:</td><td><input type="file" name="leadpic" /><br /></td>
</tr>
</table>
<input type="submit" value="Új esemény hozzáadása" name="submit">
    </form>

<?php
if(isset($_POST['submit'])){
	$con = connect('root', "");
	
 if (!$con)
  {
  die('Could not connect: ' . mysqli_error());
  }
mysqli_select_db($con, "sfpm");			
$myid = $admin_id["id"];
$sql="INSERT INTO event (id, admin_id, name, start_time, duration, local, lead) VALUES ('', '{$myid}', '{$_POST['name']}', '{$_POST['start_time']}', '{$_POST['duration']}', '{$_POST['local']}', '{$_POST['lead']}')";
mysqli_query($con, $sql);
mysqli_close($con);
	}
?>
</fieldset>
</div>
<div id="profil">
			<?php 
				include("profilpic.php"); 
				$image = getProfile($_SESSION["userid"]); 
				echo "<img id=\"profile\" src=\"{$image}\"></img>"; 
			?>
		</div></body></html>
