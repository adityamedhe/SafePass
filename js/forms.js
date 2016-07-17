
function removeDp()
{
	$.post("snippets/removeDp.php",{},function(data){
		if(data=='1')
		{
			location.reload();
		}
		else
		{
			showNotif("Error while removing your profile picture",function(){});	
		}
	});
}
function logout()
{
	$.get("http://localhost/safepass/php/logout.php",function(){
			window.location = "http://localhost/safepass/index.html";

	});
}

