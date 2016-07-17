<script src="../../lib/jquery.js"></script>
<script src="../../js/ui.js"></script>
<script src="../../js/forms.js"></script>
<link href='http://fonts.googleapis.com/css?family=Roboto:300,400' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="../../styles/commonui.css">
<link rel="stylesheet" href="../../styles/main.css">

<style>
body
{
	
	background-image: url('../../img/graysimplelight.jpg');
}

#appcircle
{
	//box-shadow: 1px 1px 2px;
	border-radius: 5px;
	//border: 2px white solid;
	display: inline-block;
	position: relative;
	top:25px;
	height:75px;
	width:75px;
	margin:auto;
	background-color: #c8c8c8;
	margin-bottom: 25px; 
	overflow: hidden;
	background-size:cover; 
	background-repeat:no-repeat;	

}

</style>

<?php
include("../../php/conn.php");
$query = "select * from apiclients where id='".$_GET['aid']."'";
$result = mysql_query($query);
$rows = mysql_fetch_array($result);
$appdata=array();
foreach ($rows as $key => $value) 
{
	$appdata[$key] = $value;	
}
$permissions = json_decode($appdata['permissions']);





?>

<body>

<div id="content" class="tstyle2">
	<div id="logo" style="width:500px;">
	<img src="../../img/logo.png" width="500">
	</div>


	<div id="login" style="display:block;">

		<div id="loginhead">
			<span class="tstyle1">Login with SafePass to use <b><?php echo $appdata['appname'];?></b></span>
		</div>

		<div id="logincont">
			<div id="userlogin" style="margin-top:-20px;">
				<p>
					<?php
					if($appdata['dp']=='Y')
					{
						echo<<<EOD
						<span id="appcircle" style="background-image:url('http://localhost/safepass/apidp/$_GET[aid].jpg');"></span>
EOD;
					}
					else
					{
						echo "<br><Br>";
					}
					?>
					
					<span class="tstyle1" style="vertical-align:30px;">
					<?php echo $appdata['appname'];?>
					</span>
					
				</p>

				<ul class="tstyle3" style="width: 90%; text-align:left;">
					<li>Will get access to your
						<?php
						$output="";
						foreach ($permissions as $key => $value) 
						{
							if($value == 1)
							{
								switch ($key) 
								{
									case 'bday':
										$output = 'birthday';
										break;
									case 'dp':
										$output = 'profile picture';
										break;
									default:
										$output = $key;
										break;
								}
								echo '<b>'.$output.'</b>, ';
							}
						}
						echo ' for a single time';

						?>
					<li>Providing your password implies you agree to the use of your information by <?php echo $appdata['appname'];?>
				</ul>
			
			</div>

			<div id="apilogin">
				<p class="tstyle1">Enter your username</p>	
				<input type="text" id="uid" class="tstyle2" placeholder="Username">
				<button class="posbutton" id="ulogin" onclick="user_validate();">Login</button><br><br><br>
				Don't have an account yet?<br>
				<button class="posbutton" onclick="location.href='modules/registerUser/enterDetails.php'">Create Account</button>
			</div>
		</div>

		<div id="loginfooter" style="padding:15px;">
			<button class="negbutton" style="float:left;" onclick="window.close();">Deny Access</button>
			
		</div>
	</div>	
</div>

<script>
	var delay=800;
	$(window).load(function(){        
		$("#logo").animate({opacity:1},delay+200);
		$("#logo").animate({opacity:1},delay);
		$("#logo").animate({marginTop:"0px"},800,function(){
					$("#login").animate({opacity:1},delay);
		});
	});
</script>

<div id="notification" class="tstyle2">
</div>
    
<div id="working">
   <span class="tstyle2">Working...</span>    
</div>
</body>

<script>
function user_validate()
{
	var uid = $("#uid").val();
	if(uid==""){uid=" ";}
	$.post("../../modules/login/userLoginCheck.php",{"uid":uid},function(data){
		if(data == 'P')
		{
			window.location="../../modules/api/getPicPassword.php?utype=U&id="  +  uid  +  "&aid=<?php echo $_GET['aid'];?>";
		}
		else if(data == 'M')
		{
			window.location="../../modules/api/getMapPassword.php?utype=U&id="+uid+"&aid=<?php echo $_GET['aid'];?>";
		}
		else
		{
			showNotif(data,function(){});
		}
	});
}

</script>