<?php
session_start();
@include_once("../config.php");

if(isset($_POST['val']))
{
$val=strip_tags(trim(htmlspecialchars($_POST['val'])));
?>

<select id="facname" onchange="shwdowbut()" style='width:30%;padding:7px;'>
	<option value="">Select Faculty</option><?php
$fa=mysql_query("SELECT * FROM faculty WHERE year='$val'");
while($fac=mysql_fetch_array($fa))
{
echo "<option value='".$fac['facname']."'>".$fac['facname']."</option>";	
}
 ?></select>
 <?php
}
?>
