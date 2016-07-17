<!doctype HTML>
<html>
<?php session_start();
include("../../php/conn.php");
$query = "select * from users where id='".$_SESSION['uid']."'";
$result = mysql_query($query);
$rows=mysql_fetch_array($result);
$userdata=array();
foreach ($rows as $key => $value)
{
	$userdata[$key] = $value;
}
?>
<style>
tr td
{
	border-bottom:1px #c8c8c8 solid;
	padding: 5px;
}

tr:hover
{
	background-color: #ebebeb;
	border-bottom:1px #c8c8c8 solid;
	padding: 5px;
}

.ip
{
	width:30%;
}
.name
{
	width:30%;
}
.time
{
	width:40%;
}
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
				<div onmouseover="$('#changedp,#removedp').show()" onmouseout="$('#changedp,#removedp').hide()" id="usercircle" style="background-image:url('<?php if($userdata['dp']=='Y') echo "../../dp/".$_SESSION['uid'].".jpg"; else echo '../../dp/default.png';?>');">					
					
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
					<span class="tstyle2"><?php echo $_SESSION['uid'];?></span>
					<br>
					<span class="tstyle3"><a onclick="logout();">log out</a></span>
				</p>
			</div>
			<div class="link tstyle2" onclick="location.href='home.php';"><img src="../../img/homeicon.png" class="icon">Home</div>
			<div class="link tstyle2" onclick="location.href='profile.php';"><img src="../../img/profileicon.png" class="icon">Profile</div>
			<div class="link tstyle2" onclick="location.href='password.php';"><img src="../../img/lockicon.png" class="icon">Password</div>
			<div class="link tstyle2 pressed" onclick="location.href='logs.php';"><img src="../../img/diaryicon.png" class="icon">Logs</div>
		</div>
		<div id="workarea">
			<div id="workheader" class="theader tstyle1">				
					<?php echo $userdata['firstname']." ".$userdata['lastname']; ?>
			</div>
			<div id="workspace" align="center">				
					<?php
						$query = 'select count(uid) from logs where uid="'.$_SESSION['uid'].'"';
						$result = mysql_query($query);
						$rows = mysql_fetch_array($result);
						if(!$rows[0]== 0)
						{
							echo '<p class="tstyle3">The following apps accessed your data</p>';
							echo '<table class="table" style="margin-bottom:10px; width:500px" border="0"><tr><td class="name" style="background-color:#ebebeb;">App Name</td><td  class="time"style="background-color:#ebebeb;">Time</td><td class="ip" style="background-color:#ebebeb;">IP Address</td></tr>';

							$query = 'select * from logs where uid="'.$_SESSION['uid'].'"';
							$result = mysql_query($query);
							while($rows = mysql_fetch_array($result))
							{					
								echo '<tr class="tstyle3">';
								echo '<td class="name">';
								echo $rows['aid'];
								echo '</td>';


								echo '<td class="time">';
								echo $rows['time'];
								echo '</td>';



								echo '<td class="ip">';
								echo $rows['ip'];
								echo '</td>';
								echo '</tr>';
							}

							echo '</table>';
							echo '<button class=negbutton onclick=clearLog()>Clear Logs</button>';
						}
						else
						{
							echo '<p style="color:#c8c8c8" class="tstyle1">Nothing to show here</p>';
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



if(!isset($_SESSION['uid']))
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


	function clearLog()
	{
		$.post("snippets/clearLogs.php",{},function(data){
			location.reload();
		});
	}
	</script>
</body>