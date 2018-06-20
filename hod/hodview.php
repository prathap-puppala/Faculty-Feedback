<?php
session_start();
@include_once("../config.php");
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Feedback on CSE Faculty</title>
<link rel="stylesheet" href="../css/style.css" type="text/css" />
<link rel="stylesheet" href="../css/message_default.css" type="text/css" />
<script src="../js/Jquery.js"></script>
<script>
function shwfac(val)
{
if(val!="")
{
$("#fac").html("<img src='../ajax-loading.gif'>");	
$.post("shwfacnames.php",{val:val},function(data){$("#fac").html(data)});
}
else
{
$("#fac").html("");

$("#conte").html("");
}	
}

function shwdowbut()
{
if($("#year").val()!="" && $("#facname").val()!="")
{

$("#conte").html("<img src='../ajax-loading.gif'>");	
$.post("showallgrade.php",{year:$("#year").val(),fac:$("#facname").val()},function(data){$("#conte").html(data)});		
}
else
{
$("#conte").html("");
}	
}
</script>
</head>

<body class="login">
<!-- header starts here -->
<div id="cse-Bar">
  <div id="cse-Frame">
    <div id="logo"> <a href="">CSIIITN</a> </div>
    
         
        <div id="header-main-right">
          <div id="header-main-nav" style="margin-top:20px;">
 <h4 style="color:#fff;">    Admin View</h4>
              </div>
          </div>
      </div>
</div>
</div>
<center>
<div style="width:100%;height:100%;background:#fff;">

<table id="customers">
<tr><th colspan="2">Faculty Feedback Report</th></tr>
<tr><td>Year</td><td style="text-align:center;"><select id="year" onchange="shwfac(this.value)" style='width:30%;padding:7px;'><option value="">Select</option><?php
$fa=mysql_query("SELECT DISTINCT year FROM faculty ORDER BY year ASC");
while($fac=mysql_fetch_array($fa))
{
echo "<option value='".$fac['year']."'>".$fac['year']."</option>";	
}
 ?></select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span id='fac'></span><span id="but"></span></td></tr>
 <tr><td colspan="2" id="conte"></td></tr>
</table>
</div>
</center>
</body>
</html>
