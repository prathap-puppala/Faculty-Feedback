<?php
session_start();
error_reporting(0);
if(isset($_GET["year"]) && isset($_GET["facname"]))
{
$year=strip_tags(htmlspecialchars($_GET['year']));
$facname=strip_tags(htmlspecialchars($_GET['facname']));
define ("DB_HOST", "localhost");
define ("DB_USER", "root");
define ("DB_PASS","sf1prathap");
define ("DB_NAME","feedback");

$link = mysql_connect(DB_HOST, DB_USER, DB_PASS) or die("Couldn't make connection.");
$db = mysql_select_db(DB_NAME, $link) or die("Couldn't select database");

if(mysql_num_rows(mysql_query("SELECT * FROM faculty WHERE year='$year' &&  facname='$facname'"))>=1)
{
$setCounter = 0;
$date=date("d-m-Y");
$setExcelName = $facname."_".$year;

$setSql = "SELECT que1,que2,que3,que4,que5,que6,que7,que8,que9,que10,que11,que12 FROM feedback WHERE year='".mysql_real_escape_string($_GET['year'])."' && facname='".mysql_real_escape_string($_GET['facname'])."'";


$setRec = mysql_query($setSql);

$setCounter = mysql_num_fields($setRec);
//$setMainHeader.="\t 1=Rarely\t\t\t 2=Once in a while \t\t\t 3=Sometimes\t\t\t  4=Most of the time\t\t\t  5=Almost Always\t\t\n\n";
$setMainHeader.="";
for ($i = 0; $i < $setCounter; $i++) {
    $setMainHeader .= mysql_field_name($setRec, $i)."\t";
}
$setMainHeader .="\t\t\t";
while($rec = mysql_fetch_row($setRec))  {
  $rowLine = '';
  foreach($rec as $value)       {
    if(!isset($value) || $value == "")  {
      $value = "\t";
    }   else  {
//It escape all the special charactor, quotes from the data.
      $value = strip_tags(str_replace('"', '""', $value));
      $value = '"' . $value . '"' . "\t";
    }
    $rowLine .= $value;
  }
  $setData .= trim($rowLine)."\n";
}
  $setData = str_replace("\r", "", $setData);

if ($setData == "") {
  $setData = "\n\n";
}



$setCounter = mysql_num_fields($setRec);


//This Header is used to make data download instead of display the data
 header("Content-type: application/octet-stream");

header("Content-Disposition: attachment; filename=".$setExcelName."_Report.xls");

header("Pragma: no-cache");
header("Expires: 0");

//It will print all the Table row as Excel file row with selected column name as header.
echo ucwords($setMainHeader)."\n".$setData."\n";
}
}
?>
