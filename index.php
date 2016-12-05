<?php
	require_once("ifloggedin.php");
	require_once("adatok.php");
	include("profilpic.php");
?>
<!Docptye html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="styles/indexstil.css">
		<meta charset="utf-8">
		<title>Snapface</title>
	</head>
	<body>
		<script type="text/javascript">
			function AcceptOrRefuse(accepted, reqid, thierId){
				var xmhttp = new XMLHttpRequest();
					xmhttp.onreadystatechange = function() {
						if(this.readyState == 4 && this.status == 200) {
							document.getElementById("freq").innerHTML = this.responseText;
						}
					}
					xmhttp.open("GET", "handlerequest.php?yesorno="+(accepted?1:0)+"&ri="+reqid+"&myId="+<?php echo $_SESSION["userid"];?>+"$theirId="+thierId, true);
					xmhttp.send();
			}
		</script>
		<div id="headermenu" style="overflow-y: scroll; max-height: 800px;">

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
		<div id="maincontent">

			<h1 style="color: white;">Események</h1>
			<div id="friendlist" style="overflow-y: scroll; max-height: 450px;">
				 <?php
				 $dbname = "sfpm";
				 	$connDB = connect("root","");
					mysqli_select_db($connDB, $dbname);
					$sql="SELECT * FROM event";
					$records=mysqli_query($connDB, $sql);
					while($rows=mysqli_fetch_assoc($records))
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
		</div>
			<p id="jelol">Jelölések</p>
			<div id="freq">
				<?php
					$ids = array();
					$requestors = array();
					$dbname = "snapface";
					$connDB = connect("root","");
					mysqli_select_db($connDB, $dbname);
					$query = "SELECT id, active FROM friendrequest WHERE passive=".$_SESSION["userid"];
					$result = mysqli_query($connDB, $query) or die ("Unsuccesful".$query);
					while($sor = mysqli_fetch_assoc($result)){
						print_r($sor);
						//array_push($requestors, $sor["active"]);
						$requestors[] = $sor["active"];
						//array_push($ids, $sor["id"]);
						$ids[] = $sor["active"];
					}
					$amount = count($requestors);
					echo $amount;
					for($i=0;$i<$amount;$i++) {
						$query = "SELECT vnev, knev, profilepic FROM user where id=".$requestors[$i];
						$result = mysqli_query($connDB, $query) or die ("Unsuccesful ".mysqli_error($connDB));
						while($sor = mysqli_fetch_assoc($result)){
							$requestor = $requestors[$i];
							$image = getProfile($requestor);
							echo "<article class=\"freqblock\"><img src=\"{$image}\"><strong>{$sor["vnev"]} {$sor["knev"]}</strong><button onclick=\"AcceptOrRefuse(true, ".$ids[$i].", {$requestor})\">Ismerem</button><button onclick=\"AcceptOrRefuse(false, ".$ids[$i].", {$requestor})\">Nem ismerem</button></article>";
						}
					}
				?>
			</div>
		</div>
		<div id="profil">
			<?php 
				$image = getProfile($_SESSION["userid"]); 
				echo "<img id=\"profile\" src=\"{$image}\"></img>"; 
			?>
		</div>
	</body>
</html>
