
function showWorking(){
    $("#working").fadeIn(200);
}

function hideWorking() {
    $("#working").fadeOut(200);
}

function showNotif (str,callback) {
	$("#notification").text(str);
	$("#notification").slideDown(600).delay(3000).slideUp(600,function(){
        callback();
    });
}

function showDialog(title,text,cancelButton)
{
    $("#overlay #dialog #workheader").html(title);
    $("#overlay #dialog #workspace").html(text);

    if(cancelButton==0)
    {
        $("#dialog #footer #dialognegbut").hide();
    }
    else
    {
        $("#dialog #footer #dialognegbut").show();
    }
    $("#overlay").fadeIn(200);
    $("#dialog").animate({"marginTop":"50px"},200);    
}

function hideDialog()
{
    $("#dialog").animate({"marginTop":"-300px"},200);
    $("#overlay").fadeOut(200);
}