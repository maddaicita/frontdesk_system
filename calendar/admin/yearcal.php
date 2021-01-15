<?php
##########################################################################
#  Please refer to the README file for licensing and contact information.
# 
#  This file has been updated for version 0.8.20071118 
# 
#  If you like this application, do support me in its development 
#  by sending any contributions at www.calendarix.com.
#
#
#  Copyright © 2002-2007 Vincent Hor
##########################################################################

require "cal_header.inc.php" ;
include ('../cal_utils.php');

if (!isset($_GET['ycyear']))
  $ycyear = $y ;
else
  $ycyear = sanitize($_GET['ycyear'],$y);

echo "<div align=center class=calfontasked><u>".translate("Year")." &nbsp;".$ycyear."</u></div>" ;

echo "<table width='100%' border=0 cellspacing=1><tr>" ;
for ($ycm=1; $ycm<13; $ycm++) {
  echo "<td valign='top' align='center' class=txtbox>" ;
  smallmonth($ycm,$ycyear,false,$d,$m,$y,true) ;
  echo "</td>";
  if ($ycm%3 == 0) echo "</tr><tr>";
  }
echo "</table>" ;

echo "<hr/>" ;

// get total number of events under year
$tquery = "select id from ".$EVENTS_TB." where ".$EVENTS_TB.".year='".$ycyear."' and ".$EVENTS_TB.".approved='1' " ;
$normuser = false ;
if (($userview==1)&&($userlogin==1)) {  // view user specific events only
  $uquery = "select group_id from ".$USER_TB." where ".$USER_TB.".user_id=".$userid ;
  $uresult = mysql_query($uquery) ;
  $urow = mysql_fetch_object($uresult);
  if ($urow->group_id!=0) {
    $normuser = true ;
    $tquery = "select * from ".$EVENTS_TB.",".$USER_TB." where ".$EVENTS_TB.".year='".$ycyear."' and ".$EVENTS_TB.".approved='1' and ".$EVENTS_TB.".user=".$USER_TB.".username and ".$USER_TB.".user_id=".$userid ;
    }
  }
$tresult = mysql_query($tquery);
$trows = mysql_num_rows($tresult) ;
echo "<table class=normalfont width='100%' border=0><tr><td align=center>" ;
echo "<b>".translate("Total")." ".$trows." ".translate("events for year")." ".$ycyear.".</b>" ;
echo "</td></tr></table><br/>" ;

?>
<div align=center class=normalfont>
<?php
$prevyear = date("Y",mktime(0,0,0,1,1,$ycyear-1)) ;
if (date("Y",mktime(0,0,0,1,1,$ycyear-1))>=$calstartyear)
  echo "<a class=normalfont href='yearcal.php?op=yearcal&amp;ycyear=$prevyear'>&lt;&lt;</a>";
echo "&nbsp; &nbsp; &nbsp; ";
?>

<a href="#" class=normalfont onClick="Javascript:self.window.close();"><?php echo translate("Close");?></a>

<?php
echo "&nbsp; &nbsp; &nbsp; ";
$nextyear = date("Y",mktime(0,0,0,1,1,$ycyear+1)) ;
if (date("Y",mktime(0,0,0,1,1,$ycyear+1))<=$y+$caladvanceyear)
  echo "<a class=normalfont href='yearcal.php?op=yearcal&amp;ycyear=$nextyear'>&gt;&gt;</a>";
?>
</div>
</body>
</html>