<!doctype HTML>

<html>
<?php 
$uid = $_GET['id'];
$utype = $_GET['utype'];
include("../../php/conn.php");
?>
<head>
	<link href='http://fonts.googleapis.com/css?family=Roboto:300,400' rel='stylesheet' type='text/css'>
	<title>SafePass</title>
	<script src="../../lib/jquery.js"></script>
	<script src="../../js/ui.js"></script>
	<script src="../../js/forms.js"></script>
	
	<link rel="stylesheet" href="../../styles/wizard.css">
	<link rel="stylesheet" href="../../styles/commonui.css">
</head>

<body>
	<img src="../../img/logo.png" width="300">
	<div id="content" style="width:55%; min-width:650px;">
		<div id="workheader" class="theader tstyle1">	
				Enter your picture password
		</div>
		<div id="workspace" align="center" class="tstyle3">	
			<p class="tstyle3" align="left" style="text-align:left;">
				<ul align="left" style="text-align:left;">
					<li>Your password is based on the following:</li>
					<ol>
						<li>The location of the points</li>
						<li>The order in which points are drawn</li>
						<li>The duration of click (short/long) between each click</li>
					</ol>
				</ul>
			</p>

			<div id="picpattinfo">
			<div id="noofpoints">
				<span class="tstyle4">NO. OF POINTS</span><br>
				<span class="tstyle1" id="pttext">0</span>
			</div>
			<div id="picpatttext">
				<span class="tstyle4">INSTRUCTIONS</span><br>
				<span class="tstyle2" id="helptext">Start by clicking your first point</span>
			</div>
			</div>
			

			<?php
			$file="";
				if($utype=='U') 
					$file= '../../imgpasswords/'.$uid.'.jpg'; 
				else 
					$file= '../../apiimgpasswords/'.$uid.'.jpg';
				$imageinfo=getimagesize($file);
				$width = $imageinfo[0];
				$height = $imageinfo[1];
			?>

			<canvas id="cnv" style="margin-top: 25px;background-image: url(<?php if($utype=='U') echo '../../imgpasswords/'.$uid.'.jpg'; else echo '../../apiimgpasswords/'.$uid.'.jpg';?> );" height="<?php echo $height; ?>" width="<?php echo $width; ?>"> 
			</canvas>
		</div>
		
		<div id="footer">		
			<button class="negbutton" id="resetbutton" onclick="canvasReset()">Reset</button>
			<button class="posbutton" id="viewbutton" onmousedown="viewPattern()" onmouseup="hidePattern()">View pattern</button>
			<button class="posbutton" id="donebutton" onclick="submitPattern()" style="float:right">Done</button>
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
	





<script>
 	i=0;
	var n=0;
	var points=new Array();
	var presses=new Array();
	var isLong=0;
	var tm,animate;
	var canvas = document.getElementById('cnv');
    var context = canvas.getContext('2d');
    var prevpt;

	function getMousePos(canvas, evt) 
	{
        var rect = canvas.getBoundingClientRect();
        var x=Math.floor(evt.clientX - rect.left);
        var y=Math.floor(evt.clientY - rect.top);
        var toRet={"x":x,"y":y};
        return toRet;
    }
   
    function canvasReset()
    {
    	$("#dialogposbut").click(function(){
    		n=0;
    		points=[];
    		presses=[];
    		isLong=0;
    		$("#pttext").text("0");
    		$("#helptext").text("Start by clicking your first point");
    		showNotif("Please enter the password again",function(){});
    	});
    	showDialog("Are you sure?","You will have to enter the password again.",1);
    }

   	function registerLongPress()
	{
		isLong=1;
		context.beginPath();

      	context.fillStyle="#000000";      	
      	context.arc(prevpt.x,prevpt.y,5,0,Math.PI*2,true);
       	context.fill();

       	context.closePath();
       	clearInterval(animate);
	}

	function doAnimation()
	{
		canvas.width=canvas.width;
		context.beginPath();
		
		i=i+0.05;
      	context.lineWidth=i;
       	context.strokeStyle='rgba(0,0,0,0.5)';
       	context.arc(prevpt.x,prevpt.y,5,0,Math.PI*2,true);
       	context.stroke();

       	context.fillStyle="#72b8dc";      	
      	context.arc(prevpt.x,prevpt.y,5,0,Math.PI*2,true);
       	context.fill();

       	context.closePath();
	}

	canvas.addEventListener('mousedown', function(evt)
    {

        var mousePos = getMousePos(canvas, evt);
        prevpt={x:mousePos.x,y:mousePos.y};
        var message = 'Mouse position: ' + mousePos.x + ',' + mousePos.y;
        
      	canvas.width=canvas.width;
      	i=0;
      	animate = setInterval("doAnimation()", 5);
       
        
        isLong=0;
        tm = setTimeout("registerLongPress()", 3000);
        
        $("#helptext").html("You've selected the point. <br> Keep it pressed for 3 seconds for a long press")
        
	}, false);

	canvas.addEventListener('mouseup', function(evt)
    {
    	canvas.width=canvas.width;
    	
        var mousePos = getMousePos(canvas, evt);
        var pt={x:mousePos.x,y:mousePos.y};
        var message = 'Mouse position: ' + mousePos.x + ',' + mousePos.y;
        
        clearTimeout(animate);
        clearTimeout(tm);
      	
      	if(n<10)
      	{
	        if(pt.x==prevpt.x && pt.y==prevpt.y)
	        {
	        	if(isLong==1)
	      		{
	        		presses[n]=1;
	        		$("#helptext").text("That was a long press");
	       		}
	        	else
	       		{
	        		presses[n]=0;
	        		$("#helptext").text("That was a short press");
	       		}
	        
	        	points[n]=pt;
	       		n++;
	       		$("#pttext").text(n);
	        }
	        else
	        {
	        	$("#helptext").html("Don't move the mouse while clicking! <br>Enter the point again");
	        }
	    }
	    else
	    {
	    	showNotif("You can enter a maximum of 10 points",function(){});
	    }
        
	}, false);


	function viewPattern()
	{
		if(n==0)
		{
			showNotif("No pattern created!",function(){});
			return;
		}
		var pts="";
		for(i=0;i<n;i++)
		{
			context.beginPath();
			context.arc(points[i].x,points[i].y,15,0,Math.PI*2);
			if(presses[i]==0)
			{
				context.fillStyle="#72b8dc";
			}
			else
			{
				context.fillStyle="#000000";
			}
			context.fill();
			context.closePath();

			context.font="20pt roboto";
			context.fillStyle='white';
			context.fillText(i+1, points[i].x-7, points[i].y+8);
		}
		
		$("#viewbutton").text("Release to hide");
		showNotif("Points are being shown approximately, to prevent shoulder surfing",function(){})
	}

	function hidePattern()
	{
		canvas.width=canvas.width;
		$("#viewbutton").text("View Pattern");		
	}
	
	function submitPattern()
	{
		showWorking();
		var dataToSend=
		{	
			"uid":"<?php echo $uid;?>",
			"n":n,
			"presses":presses,
			"points":points
		}
		
		$.post("<?php if($utype=='U') echo 'userP'; else echo 'APIp';?>asswordMatch/picPassword.php",dataToSend,function(data){
			if(data=='1')
			{
				//PASSWORD MATCHED
				showNotif("Logging you in...",function(){
					
					window.location="../<?php if($utype=='U') echo 'user'; else echo 'APIclient';?>/home.php";
				});							
			}
			else
			{
				//PASSWORD NOT MATCHED
				showDialog("Something went wrong there!",data,0);
			}
		});

		hideWorking();
	}
</script>
</body>
