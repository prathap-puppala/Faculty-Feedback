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
		if(strlen(strip_tags(trim(htmlspecialchars($_POST['que11']))))<=50)
		{
		$fac=str_replace("-"," ",$fac);
			//main action start
			$qns="INSERT INTO feedback(stuid,year,sub,facname";
for($i=1;$i<=12;$i++)
{
$qns=$qns.",que".$i."";
}
$qns=$qns.",ip";
$qns=$qns.") VALUES('".$_SESSION['userid']."','".$dm['year']."','".$sub."','".$fac."'";
for($i=1;$i<=12;$i++)
{
$qns=$qns.",'".$_POST['que'.$i]."'";
}
$qns=$qns.",'$ip')";
if(mysql_query($qns))
{
echo "sent";	
}
else{echo "fail";}
			?>
			
<?php
			
		}
		else
		{
		echo "Length of Question 11 or 12 is morethan 50.";	
		}
			//main action end
			
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
