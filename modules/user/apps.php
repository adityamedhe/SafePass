<!doctype HTML>
<html>
<head>
	<title>SafePass</title>
	<link href='http://fonts.googleapis.com/css?family=Roboto:300,400' rel='stylesheet' type='text/css'>
	<script src="../../lib/jquery.js"></script>
	<script src="../../js/ui.js"></script>
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
				<div id="usercircle" style="background-image:url('../../img/1.jpg');">					
				</div>
				<p>					
					<span class="tstyle2">adityamedhe</span>
					<br>
					<span class="tstyle3"><a href="logout.php">log out</a></span>
				</p>
			</div>
			<div class="link tstyle2" onclick="location.href='home.php';"><img src="../../img/homeicon.png" class="icon">Home</div>
			<div class="link tstyle2" onclick="location.href='profile.php';"><img src="../../img/profileicon.png" class="icon">Profile</div>
			<div class="link tstyle2" onclick="location.href='password.php';"><img src="../../img/lockicon.png" class="icon">Password</div>
			<div class="link tstyle2 pressed" onclick="location.href='apps.php';"><img src="../../img/appsicon.png" class="icon">Apps</div>
			<div class="link tstyle2" onclick="location.href='logs.php';"><img src="../../img/diaryicon.png" class="icon">Logs</div>
		</div>
		<div id="workarea">
			<div id="workheader" class="theader tstyle1">				
					Aditya Medhe
			</div>
			<div id="workspace">
				<p class="tstyle3">
					This page will contain user details, profile at a glance, as well as some basic instructions to use the system. The page can be changed from the sidebar provided.						
				</p>
			</div>
		</div>
	</div>
	<script>
		$(".link").click(function(event){
			$(".link").removeClass("pressed");
			$(this).addClass("pressed");
		});
	</script>
</body>