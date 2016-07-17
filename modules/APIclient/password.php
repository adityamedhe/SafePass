<!doctype HTML>
<html>
<?php session_start();
include("../../php/conn.php");
$query = "select * from apiclients where id='".$_SESSION['aid']."'";
$result = mysql_query($query);
$rows=mysql_fetch_array($result);
$userdata=array();
foreach ($rows as $key => $value)
{
	$userdata[$key] = $value;
}
?>
</style>
<head>
	<link href='http://fonts.googleapis.com/css?family=Roboto:300,400' rel='stylesheet' type='text/css'>
	<title>SafePass</title>
	<script src="../../lib/jquery.js"></script>
	<script src="../../js/ui.js"></script>
	<script src="../../js/forms.js"></script>
	<link rel="stylesheet" href="../../styles/default.css">
	<link rel="stylesheet" href="../../styles/commonui.css">
</head>
<body class="tstyle3">
	<script>
	 var ua = window.navigator.userAgent;
     var msie = ua.indexOf("MSIE ");
     if (msie > 0)  
            alert("This site is not optimized for Internet Explorer. Please consider using Chrome or Firefox.");   
    </script>
	<img src="../../img/logo.png" width="300">
	<div id="content">
		<div id="sidebar">
			<div id="userdetails">
				<div onmouseover="$('#changedp,#removedp').show()" onmouseout="$('#changedp,#removedp').hide()" id="usercircle" style="background-image:url('<?php if($userdata['dp']=='Y') echo "../../apidp/".$_SESSION['aid'].".jpg"; else echo '../../apidp/default.png';?>');">					
					
					<div id="changedp" onmousemove="$('#changedp,#removedp').show();">
						<a  class="tstyle3" style="text-decoration:none;" onclick=location.href='snippets/uploadPhoto.php'>change</a>
					</div>

					<?php
					if ($userdata['dp']!='N')
					{
						echo <<< EOD
						<div id="removedp"  onmousemove="$('#changedp,#removedp').show();">
						<a  class="tstyle3" style="text-decoration:none;" onclick="removeDp();">remove</a>
						</div>
EOD;
					}
					?>
					
				</div>
			
				<p>					
					<span class="tstyle2"><?php echo $_SESSION['aid'];?></span>
					<br>
					<span class="tstyle3"><a onclick="logout();">log out</a></span>
				</p>
			</div>
			<div class="link tstyle2" onclick="location.href='home.php';"><img src="../../img/homeicon.png" class="icon">Home</div>
			<div class="link tstyle2 pressed" onclick="location.href='password.php';"><img src="../../img/lockicon.png" class="icon">Password</div>
			<div class="link tstyle2" onclick="location.href='logs.php';"><img src="../../img/diaryicon.png" class="icon">Logs</div>
		</div>
		<div id="workarea">
			<div id="workheader" class="theader tstyle1">				
					<?php echo $userdata['appname']; ?>
			</div>
			<div id="workspace" align="center">				
					<?php 
						$query = "select password_type from apipasswords where id = '".$_SESSION['aid']."'";
						$result = mysql_query($query);
						$rows = mysql_fetch_array($result);

						if($rows['password_type'] == 'P')
						{
							echo 'You have set a picture password<br>Your current password image is<br>';
							echo '<img style="border:5px #c8c8c8 solid" height=400 src=../../apiimgpasswords/'.$_SESSION['aid'].'.jpg><br>';
							echo '<button class=posbutton onclick=location.href="changePass/setPass.php">Change Password</button>';
						}
						elseif($rows['password_type'] == 'M')
						{
							echo 'You have set a map password<br>';
							echo '<button class=posbutton onclick=location.href="changePass/setPass.php">Change Password</button>';

						}
						else
						{
							echo '<p class=tstyle1 style="color:#c8c8c8">Error retrieving password info</p>';
						}
					?>
			</div>
		</div>
	</div>

	<div id="notification" class="tstyle2"></div>
	<div id="working" class="tstyle2">Working...</div>

	<div id="overlay" style="display:none;">
		<div id="dialog">
			<div id="workheader" class="tstyle1">
				
			</div>
			<div id="workspace" class="tstyle3"  style="text-align:left;">
				
			</div>
			<div id="footer">
				<button class="negbutton" id="dialognegbut" style="float:left;" onclick='hideDialog();'>Return</button>

				<button class="posbutton" id="dialogposbut" style="float:right;" onclick='hideDialog();'>Okay</button>
			</div>
		</div>

	</div>
	

<?php



if(!isset($_SESSION['aid']))
{
	echo <<< EOD
	<script>
	$("#dialogposbut").click(function(){
		window.location="../../";
	});
	showDialog("Login error","There was an error logging you in. Please re-login",0);
	</script>
EOD;
}
?>
	<script>
		$(".link").click(function(event){
			$(".link").removeClass("pressed");
			$(this).addClass("pressed");
		});

	</script>
</body>