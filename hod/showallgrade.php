<?php
session_start();
@include_once("../config.php");

if(isset($_POST['year']) && isset($_POST['fac']))
{
$year=strip_tags(trim(htmlspecialchars($_POST['year'])));
$fac=strip_tags(trim(htmlspecialchars($_POST['fac'])));
?>
<style>
table{border:1px solid #ddd;text-align:center;} 
table th{background:#006666;color:#fff;}
table tr{background:#eee;border:0px;}
table tr td.fild{background:#FFF0F5;font-size:13px;}
table tr td.fildval{background:#FFFFE0;font-size:13px;}
table tr td.subopt{font-size:13px;background:#B0E0E6;color:#ee6666;}
</style>
<center>
<center>
<table width="98%" style="margin-top:-13px;margin-left:-32px;">
<th colspan="4" style="background:#006666;color:#fff;font-style:normal;font-size:14px;"><?php echo $fac;?>'s <small>Feedback Report By</small> <?php echo $year;?></th>
<tr>
<td class="fild">Faculty Name</td><td class="fild">:</td><td class="fild"><?php echo $fac;?></td></tr>
<tr><td class="fildval">Teaching Year</td><td class="fildval">:</td><td class="fildval"><?php echo $year;?></td></tr>
<tr><td class="fild">Submits</td><td class="fild">:</td><td class="fild"><?php echo mysql_num_rows(mysql_query("SELECT * FROM feedback WHERE year='$year' && facname='$fac'"));?></td></tr>
<tr><td colspan="4" class="subopt">Statistics</td></tr>

<tr><td colspan="4" class="fild">
<table WIDTH="100%" border="0" style="border:1px solid black;">
<tr style="background:#FFF0F5;">
<td>Type</td>
<?php
for($i=1;$i<=10;$i++)
{
echo "<td>Que$i</td>";	
}
?>	
</tr>	
<tr style="background:#FFFFE0;">
<td style="background:khaki;">Rarely</td>
<?php
for($i=1;$i<=10;$i++)
{
echo "<td>";
echo mysql_num_rows(mysql_query("SELECT * FROM feedback WHERE year='$year' && facname='$fac' && que$i='1'"));
echo "</td>";	
}
?>	
</tr>


<tr style="background:#FFFFE0;">
<td style="background:khaki;">Once in a while</td>
<?php
for($i=1;$i<=10;$i++)
{
echo "<td>";
echo mysql_num_rows(mysql_query("SELECT * FROM feedback WHERE year='$year' && facname='$fac' && que$i='2'"));
echo "</td>";	
}
?>	
</tr>
	
	
<tr style="background:#FFFFE0;">
<td style="background:khaki;">Sometimes</td>
<?php
for($i=1;$i<=10;$i++)
{
echo "<td>";
echo mysql_num_rows(mysql_query("SELECT * FROM feedback WHERE year='$year' && facname='$fac' && que$i='3'"));
echo "</td>";	
}
?>	
</tr>
	
	
<tr style="background:#FFFFE0;">
<td style="background:khaki;">Most of the Time</td>
<?php
for($i=1;$i<=10;$i++)
{
echo "<td>";
echo mysql_num_rows(mysql_query("SELECT * FROM feedback WHERE year='$year' && facname='$fac' && que$i='4'"));
echo "</td>";	
}
?>	
</tr>
	
<tr style="background:#FFFFE0;">
<td style="background:khaki;">Almost Always</td>
<?php
for($i=1;$i<=10;$i++)
{
echo "<td>";
echo mysql_num_rows(mysql_query("SELECT * FROM feedback WHERE year='$year' && facname='$fac' && que$i='5'"));
echo "</td>";	
}
?>	
</tr>
	
</table>

</td></tr>
<tr><td colspan='4'><a class='my-button medium blue' style='cursor:pointer;text-decoration:none;' href="excelmode.php?year=<?php echo $year;?>&facname=<?php echo $fac;?>" target="_blank">Download Full Report in Excel</a></td></tr>
						</table>
</center>
 <?php
}
?>
