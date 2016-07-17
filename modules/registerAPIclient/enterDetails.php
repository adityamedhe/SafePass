<!doctype HTML>
<html>
<head>
	<title>SafePass</title>
	<link href='http://fonts.googleapis.com/css?family=Roboto:300,400' rel='stylesheet' type='text/css'>
	<script src="../../lib/jquery.js"></script>
	<script src="../../js/ui.js"></script>
	<script src="../../js/forms.js"></script>
	<script src="../../lib/jquery-ui.js"></script>
	<link rel="stylesheet" href="../../styles/wizard.css">
	<link rel="stylesheet" href="../../styles/commonui.css">
</head>

<style>
.per
{
	vertical-align: top;
	text-align: center;
	width:50%;
	border: 1px #c8c8c8 solid;
	background-color: #ebebeb;
}
.dummy
{
	border: none;
	width:0px;
}
</style>
<body>
	<img src="../../img/logo.png" width="300">
	<div id="content" style="width:55%;">
			<div id="workheader" class="theader tstyle1">	
				Create a SafePass API client account
			</div>

			<div id="workspace" align="center">
				<table class="tstyle2 table" border="0" cellpadding="10" style=" margin-top:15px; margin-bottom:15px;">
					
					<tr>
						<td class="badgetd">
							<div class="badge">1</div>
						</td>

						<td class="infotd">							
							Select a username*
						</td>

						<td class="inptd">	
							<input type="text" id="inputname" class="tstyle2">
							
							<ul class="tstyle3"	>
								<li>6-20 characters</li>
								<li>Letters, numbers, and underscores allowed</li>
								<li>Special characters not allowed</li>
							</ul>						
						</td>
					</tr>

					<tr>
						<td class="badgetd">
							<div class="badge">2</div>
						</td>
						<td class="infotd">							
							Enter your web app's name*
						</td>
						<td class="inptd">	
							<input type="text" id="inputappname" class="tstyle2"><br>	
							<span class="tstyle3">
								Please note that you will not be able to change this name after you create the account					
							</span>
							
						</td>
					</tr>

					<tr class="">
						<td class="badgetd">
							<div class="badge">3</div>
						</td>
						<td class="infotd">							
							Redirect URL*
						</td>
						<td class="inptd">	
							<span class="tstyle3">Enter your app's OAuth redirect URL</span><br>
							<input type="text" id="inputredirect" class="tstyle2">
						</td>
					</tr>
					
					<tr class="">
						<td class="badgetd" style="border:none;">
							<div class="badge">4</div>
						</td>
						<td class="infotd">							
							App permissions*
						</td>
						<td class="inptd">	
							<span class="tstyle3">Select what user data you would like to access. You cannot change this after account is created</span>
						</td>
					</tr>

					<tr class="tstyle3">
						<td class="dummy"></td>
						
						<td class="per">
							<span class="tstyle2">Personal information</span>	
							<p style="text-align:left">
								<input id="checkname" type="checkbox" > Name<span class="tstyle4">(First and last)</span><br>
								<input id="checkemail" type="checkbox"> E-mail address<br>
								<input id="checkgender" type="checkbox"> Gender<br>
								<input id="checkbday" type="checkbox"> Birthday<br>
								<input id="checkdp" type="checkbox"> Profile picture<br>					
							</p>						
						</td>
						<td class="per">							
							<span class="tstyle2">Contact information</span>
							<p style="text-align:left">
								<input id="checkphone" type="checkbox"> Phone number<br>
								<input id="checkaddress" type="checkbox"> Street address<br>
								<input id="checkpincode" type="checkbox"> Pincode<br>
								<input id="checkcountry" type="checkbox"> Country<br>		
							</p>
						</td>
					</tr>					
				</table>
			</div>
		
		<div id="footer">			
			<button class="negbutton" id="but_uname_cancel" style="float:left;" onclick="window.location='../../'">Cancel</button>
			<button class="posbutton" id="but_uname_done" style="float:right;" onclick='validate();'>Done</button>
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
				<button class="posbutton" style="float:right;" onclick='hideDialog();'>Okay</button>
			</div>
		</div>

	</div>

	<script>

	function validate()
		{
			showWorking();			
			
			var uname=$("#inputname").val();
			var appname=$("#inputappname").val();	
			var redirect=$("#inputredirect").val();		
			
			var checkname = $("#checkname:checked").length == 1? 1 : 0;
			var checkemail = $("#checkemail:checked").length == 1? 1 : 0;
			var checkgender = $("#checkgender:checked").length == 1? 1 : 0;
			var checkbday = $("#checkbday:checked").length == 1? 1 : 0;
			var checkdp= $("#checkdp:checked").length == 1? 1 : 0;

			var checkphone = $("#checkphone:checked").length == 1? 1 : 0;
			var checkaddress = $("#checkaddress:checked").length == 1? 1 : 0;
			var checkpincode = $("#checkpincode:checked").length == 1? 1 : 0;
			var checkcountry = $("#checkcountry:checked").length == 1? 1 : 0;

			var dataToSend=
			{
				"appname" : appname,				
				"uname" : uname,
				"redirect" : redirect,

				"checkname" : checkname,
				"checkemail" : checkemail,
				"checkgender" : checkgender,
				"checkbday" : checkbday,
				"checkdp" : checkdp,

				"checkphone" : checkphone,
				"checkaddress" : checkaddress,
				"checkpincode" : checkpincode,
				"checkcountry" : checkcountry
			}			

			$.post("validate.php",dataToSend,function(data){
				if(data=='1')
				{
					showNotif("Your account has been created successfully! Please wait...",function(){
						window.location="uploadPhoto.php";
					});
				}
				else
				{
					showDialog("Something went wrong there!",data,1);
				}
			});
			hideWorking();			
		}
	</script>
</body>
