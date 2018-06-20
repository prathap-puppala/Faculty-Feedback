<?php
session_start();
@include_once("config.php");
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Feedback on CSE Faculty</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<link rel="stylesheet" href="css/message_default.css" type="text/css" />
<script src="js/Jquery.js"></script>
<script src="js/plus950.js"></script>
<script src="js/message.js"></script>
</head>

<body class="login">
<!-- header starts here -->
<div id="cse-Bar">
  <div id="cse-Frame">
    <div id="logo"> <a href="">CSIIITN</a> </div>
    
         
        <div id="header-main-right">
          <div id="header-main-nav" style="margin-top:20px;">
 <h4 style="color:#fff;">     <?php 
      if(isset($_SESSION["userid"])){echo "Welcome ".$_SESSION['userid']. ", <a style='text-decoration:none;color:yellow;' href='logout.php'>Logout</a>";}else{echo "Welcome Guest";} 
      ?></h4>
              </div>
          </div>
      </div>
</div>
<!-- header ends here -->
<div id="loadi">
<div class="loginbox radius">
<h2 style="color:#141823; text-align:center;">Welcome to CSIIITN Feedback</h2>
	<div class="loginboxinner radius">
    	<div class="loginheader">
    		<h4 class="title">Give your valuable feedback on CSE Faculty</h4>
    		
    	</div><!--loginheader-->
        
        <div class="loginform">
			
                	<?php if(!isset($_SESSION["userid"])){ ?>
                	<br>
                <h4 class="title" style="color:red;">Please Login to Continue</h5>
        	<form id="login" method="post">
				<table border="0">
			<tr><td style="padding-left:50px;">
                 <p style="font-size:14px;" class="title">University ID</p></td><td>&nbsp;</td><td> <input type="text" id="uid" maxlength="7" class="radius mini" />
            </td></tr>
        	<tr><td  style="padding-left:50px;">
                 <p style="font-size:14px;" class="title">Password</p></td><td>&nbsp;</td><td> <input type="password" id="passwd"   class="radius mini" />
            </td></tr>
        <tr><td>&nbsp;</td><td colspan="3"><p>
                	<a class="button" class="radius title" onclick="login()" name="client_login" style="width:180px;padding:7px;">Sign in</a>
                </p>
                </td></tr>
                
                </table>
            </form>
            <?php } 
            else
            {
			?>
			<table id="customers">
			<tr><th>Subject</th><th>Name</th><th>Status</th></tr>
			<?php
			$sno=0;
			$dm=mysql_fetch_array(mysql_query("SELECT * FROM data WHERE id='".mysql_real_escape_string($_SESSION['userid'])."'"));
			$d=mysql_query("SELECT DISTINCT subject FROM faculty WHERE year='".mysql_real_escape_string($dm['year'])."'");
			while($fac=mysql_fetch_array($d))
			{
				
			$sno++;
			echo "<tr><td>".$fac['subject']."</td>";
			$qu=mysql_query("SELECT * FROM faculty WHERE year='".$dm['year']."' && subject='".$fac['subject']."'");
			$fed=mysql_query("SELECT * FROM feedback WHERE stuid='".$_SESSION['userid']."' && sub='".$fac['subject']."'");
			if(mysql_num_rows($fed)>=1)
			{
			$fg=mysql_fetch_array($fed);
			echo "<td>".$fg['facname']."</td>";
		    }
		    else
		    {
			echo "<td><select id='".$sno."facname' style='width:100%;padding:7px;'><option value=''>Select</option>";
			while($quu=mysql_fetch_array($qu))
			{
			echo "<option value='".$quu['facname']."'>".$quu['facname']."</option>";	
			}
			echo "</select></td>";
		}
			if(mysql_num_rows(mysql_query("SELECT * FROM feedback WHERE stuid='".$_SESSION['userid']."' && sub='".$fac['subject']."'"))>=1)
			{
				?>
			<td><a class='my-button medium orange' style='cursor:pointer;text-decoration:none;' onclick='dhtmlx.alert({type:"alert-error", title:"CSE FEEDBACK", text:"Already Submitted"})'>Submitted</a></td></tr>	
		    <?php
		    }
		    else{
			echo "<td  id='".$sno."but' ><a class='my-button medium green' style='cursor:pointer;text-decoration:none;' onclick=givefeed('".$sno."','".$dm['year']."','".$fac['subject']."')>Start</a></td></tr>";	
		}	
			
			}
			?>
			</table>
			<?php	
			}
            ?>
            
        </div><!--loginform-->
    </div><!--loginboxinner-->
</div><!--loginbox-->



</div>


<p style="font-size:12px;">
  <center><br>
    <a href="javascript:void(0);" style="text-decoration:none;">Prathap Puppala,N130950</a>
  </center>
</p>

</body>

</html>
