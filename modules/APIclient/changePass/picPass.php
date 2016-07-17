<!doctype HTML>

<html>
<?php session_start(); 
include("../../../php/conn.php");
?>

<head>
	<title>SafePass</title>
	<script src="../../../lib/jquery.js"></script>
	<script src="../../../js/ui.js"></script>
	<script src="../../../js/forms.js"></script>
	<script src="../../../lib/jquery-ui.js"></script>
	<link rel="stylesheet" href="../../../styles/wizard.css">
	<link rel="stylesheet" href="../../../styles/commonui.css">

</head>

<body>
	<img src="../../../img/logo.png" width="300">
	<div id="content" style="width:55%;">
		<div id="workheader" class="theader tstyle1">	
			Upload a picture
			</div>


		<div id="workspace" class="tstyle3"  align="center">
			<p class="tstyle3" align="left">
				Guidelines for choosing a picture:
				<ol align="left" style="text-align:left;">
					<li>Picture should be at least 300x300 and at most 550x550 in size</li>
					<li>Picture should be densely populated by objects and not contain large amount of blank spaces</li>
					<li>For your convinience, choose a picture on which you will be able to create a familiar pattern, but will be hard for others to recognize</li>
				</ol>
			</p>	
			
			<form action="uploadPicPass.php" method="POST" enctype="multipart/form-data">
			<input type="file" name="fileToUpload" id="fileToUpload" class="tstyle3"><br><br>
			
			
					
		</div>
		
		<div id="footer">			
			
			<input type="submit" name="submit" value="Upload" class="posbutton" style="float:right">
			</form>
			<button class="negbutton" onclick="window.location='setPass.php';">Back</button>
		</div>
	</div>

	<div id="usercard">
		
			<?php
				$query = "select dp from apiclients where id='".$_SESSION['aid']."'";
				$result=mysql_query($query);
				$rows=mysql_fetch_array($result);

				if($rows[0] == 'Y')
				{
					echo <<< EOT
					<div id="usercircle" style="background-image:url('http://localhost/safepass/apidp/$_SESSION[aid].jpg');"></div>
EOT;
				}
				else
				{

					echo '<div id = usercircle></div>';
				}
			?>		
		<br>
		<span class="tstyle3">
			<a onclick="dispWarning();">log out</a>
		</span>
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
		window.location="../../../";
	});
	

	showDialog("Login error","There was an error logging you in. Please re-login",0);
	</script>
EOD;
}
?>

<script>
function dispWarning()
{
	$("#dialogposbut").click(function(){
		logout();
	});

	$("#dialognegbut").click(function(){
		hideDialog();
	});
	showDialog("Are you sure?","Logging out at this point will delete your account as the password has not been yet set up!",1);
}
</script>
</body>
