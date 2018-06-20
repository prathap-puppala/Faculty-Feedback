<?php
session_start();
require_once("config.php");
if(isset($_SESSION['userid']) && !empty($_SESSION['userid']))
{
$user=strip_tags(trim($_SESSION['userid']));
if(isset($_POST['year']) && !empty($_POST['year']) && isset($_POST['sub']) && !empty($_POST['sub']) && isset($_POST['fac']) && !empty($_POST['fac']))
{
$year=strip_tags(trim(htmlspecialchars(mysql_real_escape_string($_POST['year']))));
$sub=strip_tags(trim(htmlspecialchars(mysql_real_escape_string($_POST['sub']))));
$fac=strip_tags(trim(htmlspecialchars(mysql_real_escape_string($_POST['fac']))));
if($year!="" && $sub!="" && $fac!="")
{
$dm=mysql_fetch_array(mysql_query("SELECT * FROM data WHERE id='".mysql_real_escape_string($_SESSION['userid'])."'"));
			
$que=mysql_query("SELECT * FROM faculty WHERE subject='$sub' && year='".mysql_real_escape_string($year)."'");
if(mysql_num_rows($que)<1){echo "No such subject found";}
else
{
if(1)
{
	$ff=mysql_query("SELECT * FROM feedback WHERE stuid='".$_SESSION['userid']."' && sub='".mysql_real_escape_string($sub)."'");
			if(mysql_num_rows($ff)>=1)
			{
		echo "Already Submitted!!";
		}
		else
		{
			//main form display
			
			?>
			<input type='hidden' type='text' id='facname' value='<?php echo $fac;?>'?>
			    <center>
				<table width="90%" onload="points()" style="background:#fff;" id="customers">
					<tr><th colspan="2">Feedback Form <?php //echo "<span style='color:yellow;'>".$fac."</span>";?></th></tr>
                   <tr class="alt"><td>Name : <b><?php echo str_replace("-"," ",$fac);?></b></td><td>Subject : <b><?php echo $year." - ".$sub;?></b></td></tr>
                   <tr><td colspan="2" style='color:maroon;'><center><p style="text-align:center;"><span style='border:1px solid green;padding:5px;'><b>1</b> = Rarely</span>&nbsp;&nbsp;&nbsp; <span style='border:1px solid green;padding:5px;'> <b>2</b> = Once in a while</span> &nbsp;&nbsp;&nbsp;<span style='border:1px solid green;padding:5px;'> <b>3</b> = Sometimes</span> &nbsp;&nbsp;&nbsp;<span style='border:1px solid green;padding:5px;'> <b>4</b> = Most of the time</span> &nbsp;&nbsp;&nbsp;<span style='border:1px solid green;padding:5px;'> <b>5</b> = Almost always</span></p></center></td></tr>
                <tr id="points" style=""><td style='text-align:left;'>1. Teacher is prepared for class.  </td><td><input type='radio' name='que1' value='1'>1 &nbsp;&nbsp;<input type='radio' name='que1' value='2'>2  &nbsp;&nbsp;<input type='radio' name='que1' value='3'>3 &nbsp;&nbsp;<input type='radio' name='que1' value='4'>4 &nbsp;&nbsp;<input type='radio' name='que1' value='5'>5</td></tr>
                <tr><td style='text-align:left;'>2. Teacher knows his/her subject. </td><td><input type='radio' name='que2' value='1'>1 &nbsp;&nbsp;<input type='radio' name='que2' value='2'>2  &nbsp;&nbsp;<input type='radio' name='que2' value='3'>3 &nbsp;&nbsp;<input type='radio' name='que2' value='4'>4 &nbsp;&nbsp;<input type='radio' name='que2' value='5'>5</td></tr>
                <tr><td style='text-align:left;'>3. Teacher provides example that make subject matter meaningful. </td><td><input type='radio' name='que3' value='1'>1 &nbsp;&nbsp;<input type='radio' name='que3' value='2'>2  &nbsp;&nbsp;<input type='radio' name='que3' value='3'>3 &nbsp;&nbsp;<input type='radio' name='que3' value='4'>4 &nbsp;&nbsp;<input type='radio' name='que3' value='5'>5</td></tr>
                <tr><td style='text-align:left;'>4. Teacher allows you to be active in the classroom learning environment. </td><td><input type='radio' name='que4' value='1'>1 &nbsp;&nbsp;<input type='radio' name='que4' value='2'>2  &nbsp;&nbsp;<input type='radio' name='que4' value='3'>3 &nbsp;&nbsp;<input type='radio' name='que4' value='4'>4 &nbsp;&nbsp;<input type='radio' name='que4' value='5'>5</td></tr>
                <tr><td style='text-align:left;'>5.	Teacher encourages students to speak up and be active in the class. </td><td><input type='radio' name='que5' value='1'>1 &nbsp;&nbsp;<input type='radio' name='que5' value='2'>2  &nbsp;&nbsp;<input type='radio' name='que5' value='3'>3 &nbsp;&nbsp;<input type='radio' name='que5' value='4'>4 &nbsp;&nbsp;<input type='radio' name='que5' value='5'>5</td></tr>
                <tr><td style='text-align:left;'>6.	Teacher listens and understands students’ point of view. </td><td><input type='radio' name='que6' value='1'>1 &nbsp;&nbsp;<input type='radio' name='que6' value='2'>2  &nbsp;&nbsp;<input type='radio' name='que6' value='3'>3 &nbsp;&nbsp;<input type='radio' name='que6' value='4'>4 &nbsp;&nbsp;<input type='radio' name='que6' value='5'>5</td></tr>
                <tr><td style='text-align:left;'>7.	Teacher is willing to accept responsibility for his/her own mistakes. </td><td><input type='radio' name='que7' value='1'>1 &nbsp;&nbsp;<input type='radio' name='que7' value='2'>2  &nbsp;&nbsp;<input type='radio' name='que7' value='3'>3 &nbsp;&nbsp;<input type='radio' name='que7' value='4'>4 &nbsp;&nbsp;<input type='radio' name='que7' value='5'>5</td></tr>
                <tr><td style='text-align:left;'>8.	Teacher is sensitive to the needs of students. </td><td><input type='radio' name='que8' value='1'>1 &nbsp;&nbsp;<input type='radio' name='que8' value='2'>2  &nbsp;&nbsp;<input type='radio' name='que8' value='3'>3 &nbsp;&nbsp;<input type='radio' name='que8' value='4'>4 &nbsp;&nbsp;<input type='radio' name='que8' value='5'>5</td></tr>
                <tr><td style='text-align:left;'>9.	I trust this teacher.  </td><td><input type='radio' name='que9' value='1'>1 &nbsp;&nbsp;<input type='radio' name='que9' value='2'>2  &nbsp;&nbsp;<input type='radio' name='que9' value='3'>3 &nbsp;&nbsp;<input type='radio' name='que9' value='4'>4 &nbsp;&nbsp;<input type='radio' name='que9' value='5'>5</td></tr>
                <tr><td style='text-align:left;'>10. Teacher is fair and firm in discipline without being too strict </td><td><input type='radio' name='que10' value='1'>1 &nbsp;&nbsp;<input type='radio' name='que10' value='2'>2  &nbsp;&nbsp;<input type='radio' name='que10' value='3'>3 &nbsp;&nbsp;<input type='radio' name='que10' value='4'>4 &nbsp;&nbsp;<input type='radio' name='que10' value='5'>5</td></tr>
                <tr><td style='text-align:left;'>11. What is one thing that you can suggest to help this teacher improve? <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<small><small><font color='maroon'>Not morethan 50 Letters</font></small></small></td><td><textarea maxlength="50"  id='que11' rows='6' cols='40'></textarea></td></tr>
                <tr><td style='text-align:left;'>12. What is one thing that your teacher does well?  <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<small><small><font color='maroon'>Not morethan 50 Letters</font></small></small> </td><td><textarea maxlength="50" id='que12' rows='6' cols='40'></textarea></td></tr>
                <tr><td colspan="2"><span  id='subm'><a class='my-button medium green' style='cursor:pointer;text-decoration:none;' onclick=postfed('<?php echo $year;?>','<?php echo $sub;?>','<?php echo $fac;?>')>Submit</a></span><span id='load' style='display:none;'><img src='ajax-loading.gif'></span></td></td></tr>
                </table></center>
<?php
			
			//main form end
			
		}
}
else
{
echo "Mismatch in Faculty Names";	
}
}	
}
else{echo "Empty Fac Name or Sno";}
}
else
{
echo "Error Occured in Values passing";	
}	
}	
else
{
header("location:index.php");	
}

?>
