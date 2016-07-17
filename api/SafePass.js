function SafePassLogin(aid) 
{
 params  = 'width='+(screen.width-10);
 params += ', height='+screen.height;
 params += ', top=0, left=0'
 params += ', fullscreen=yes';
 url = "http://localhost/safepass/modules/api/welcome.php?aid="+aid;
 newwin=window.open(url,'windowname4', params);
 if (window.focus) {newwin.focus()}
 return false;
}