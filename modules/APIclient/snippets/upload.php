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
				Upload a profile photo
		</div>


		<div id="workspace" align="center" class="tstyle3">			
			<?php
			
			
			$target_dir = "../../../apidp/";
			$target_file = $target_dir . $_SESSION['aid'].".jpg";
			$uploadOk = 1;
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			// Check if image file is a actual image or fake image
			if(isset($_POST["submit"])) {
			    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
			    if($check !== false) {
			        //echo "File is an image - " . $check["mime"] . ".";
			        $uploadOk = 1;
			    } else {
			        echo "File is not an image.";
			        $uploadOk = 0;

			    }
			}
			// Check if file already exists
			
			// Check file size
			if ($_FILES["fileToUpload"]["size"] > 500000) {
			    echo "Sorry, your file is too large.";
			    $uploadOk = 0;
			}
			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" ) {
			    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			    $uploadOk = 0;
			}
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
			    echo "";
			// if everything is ok, try to upload file
			} else {

				if (file_exists($target_file)) {
					unlink($target_file);
				}
			    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
			        echo "Your profile photo has been changed";

			        $query="update apiclients set dp='Y' where id='".$_SESSION['aid']."'";
			        mysql_query($query);


			    } else {
			        echo "Sorry, there was an error uploading your file.";
			    }
			}
			?>					
		</div>
		
		<div id="footer">		
			<?php
			if($uploadOk==1)
			{
				echo <<< EOT
				<button class="posbutton" id="but_uname_done" style="float:right;" onclick=window.location='../home.php'>Done</button>
EOT;

				echo <<< EOT
				<button class="negbutton" id="but_uname_cancel" style="float:left;" onclick=window.location='uploadPhoto.php'>Change</button>
EOT;
			}	
			else
			{
				echo <<< EOT
				<button class="negbutton" id="but_uname_done" style="float:right;" onclick=window.location='uploadPhoto.php';>Try Again</button>
EOT;
			}
			?>
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
					<div id="usercircle" style="background-image:url('http://localhost/safepass/dp/$_SESSION[aid].jpg');"></div>
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
		window.location="../../";
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
