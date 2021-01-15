<?php
##########################################################################
#  Please refer to the README file for licensing and contact information.
# 
#  This file has been updated for version 0.7.20060401 
# 
#  If you like this application, do support me in its development 
#  by sending any contributions at www.calendarix.com.
#
#  This is file is identical to one in admin section of same name.
#
#  Copyright © 2002-2006 Vincent Hor
##########################################################################

include ('cal_header.inc.php');
include ('../cal_utils.php');

if (!isset($_GET['frmname']))
  $frmname = 'someform';
else
  $frmname = $_GET['frmname'];
if (!isset($_GET['frmday']))
  $frmday = 'formelement';
else
  $frmday = $_GET['frmday'];
if (!isset($_GET['frmmth']))
  $frmmth = 'formelement';
else
  $frmmth = $_GET['frmmth'];
if (!isset($_GET['frmyear']))
  $frmyear = 'formelement';
else
  $frmyear = $_GET['frmyear'];
if (!isset($_GET['browse']))
  $browse = 'no';
else
  $browse = $_GET['browse'];

$smyear = substr($date,0,4) ;
$smmonth = substr($date,5,2) ;

?>
<script language="JavaScript" type="text/javascript">
<!-- Begin
function getDate(day,month,year) {
  // alert(month) ;
  top.opener.document.<?php echo$frmname?>.<?php echo$frmday?>.value = day ;
  top.opener.document.<?php echo$frmname?>.<?php echo$frmmth?>.value = month ;
  top.opener.document.<?php echo$frmname?>.<?php echo$frmyear?>.value = year ;
  window.close() ;
}

<?php
  if ($browse!='yes') {
    echo "if ((top.opener.document.".$frmname.".".$frmmth.".value!=".$smmonth.")||(top.opener.document.".$frmname.".".$frmyear.".value!=".$smyear.")) \n";
    echo "{\n";
    echo "  var jmth = top.opener.document.".$frmname.".".$frmmth.".value;\n";
    echo "  if (jmth<10) jmth = '0'+jmth;\n";
    echo "  var pdate = top.opener.document.".$frmname.".".$frmyear.".value+'-'+jmth+'-'+'01';\n";
    echo "  window.location.href='cal_date.php?op=smallcal&date='+pdate+'&frmname=".$frmname."&frmday=".$frmday."&frmmth=".$frmmth."&frmyear=".$frmyear."';\n";
    echo "    alert(document.window.location.href);\n";
    echo "}\n";
    }
?>
// -->
</script>

<?php

if (substr($smmonth,0,1) == "0")
  $smmonth = str_replace("0","",$smmonth);
  // number of days in month
  $firstday = date ("w", mktime(12,0,0,$smmonth,1,$smyear));
  $nr = date("t",mktime(12,0,0,$smmonth,1,$smyear));
  echo "<table class=smallcalmth align=center >";
  echo "<tr>";
  echo "<td align=center valign=middle width='100%'><div class=smallcalmth>";

// scroll left year
$pdate = date("Y-m-d",mktime(0,0,0,$smmonth,1,$smyear-1)) ;
if (date("Y",mktime(0,0,0,$smmonth-1,1,$smyear))>=$calstartyear)
  echo "<a class=normalfont href=cal_date.php?op=smallcal&date=$pdate&frmname=evfrm&frmday=bday&frmmth=bmonth&frmyear=byear&browse=yes>&lt;&lt;</a>";
echo "&nbsp; &nbsp;";

// scroll left month
$pdate = date("Y-m-d",mktime(0,0,0,$smmonth-1,1,$smyear)) ;
if (date("Y",mktime(0,0,0,$smmonth-1,1,$smyear))>=$calstartyear)
  echo "<a class=normalfont href=cal_date.php?op=smallcal&date=$pdate&frmname=evfrm&frmday=bday&frmmth=bmonth&frmyear=byear&browse=yes>&lt;</a>";
echo "&nbsp; &nbsp;";

    echo $mth[$smmonth]."&nbsp; ".$smyear;

// scroll right month
echo "&nbsp; &nbsp;";
$pdate = date("Y-m-d",mktime(0,0,0,$smmonth+1,1,$smyear)) ;
if (date("Y",mktime(0,0,0,$smmonth+1,1,$smyear))<=$y+$caladvanceyear)
  echo "<a class=normalfont href=cal_date.php?op=smallcal&date=$pdate&frmname=evfrm&frmday=bday&frmmth=bmonth&frmyear=byear&browse=yes>&gt;</a>";

// scroll right month
echo "&nbsp; &nbsp;";
$pdate = date("Y-m-d",mktime(0,0,0,$smmonth,1,$smyear+1)) ;
if (date("Y",mktime(0,0,0,$smmonth+1,1,$smyear))<=$y+$caladvanceyear)
  echo "<a class=normalfont href=cal_date.php?op=smallcal&date=$pdate&frmname=evfrm&frmday=bday&frmmth=bmonth&frmyear=byear&browse=yes>&gt;&gt;</a>";

  echo "</div></td></tr></table>\n\n";

  echo "<table align=center class=smallcalmth >";
  echo "<tr>";

  // make the header days of week
  for ($i=intval($weekstartday)+1;$i<=(intval($weekstartday) + 7);$i++){
    echo "<td align=center >";
    if (dayinweek($i) == 1)
      echo "<div class=dayfont>".substr($week[dayinweek($i)],0,3)."</div></td>"; // sunday
    else    
      echo "<div class=dayfont>".substr($week[dayinweek($i)],0,3)."</div></td>"; // rest of week
    }
  echo "</tr>\n\n<tr>";

  // print initial blank squares
  for ($i=1;$i<=blankdays(intval($weekstartday),$firstday);$i++)  echo "<td>&nbsp;</td>";
  $a=0;
  for ($i=1;$i<=$nr;$i++){

	echo "<td align=center ";
	if ($i == $d && $smmonth == $m && $smyear == $y) // highlight today's day
	  echo "class=todayclr ";
	echo "valign=top>\n";

	echo "<a href=\"javascript:void(0);\" onclick=\"Javascript:getDate($i,$smmonth,$smyear);\">"; 

	echo "<div class=datenumfont>".$i."</div>" ;
	echo "</a>";
	echo "</td>\n";
	$a++;
	if (blankdays(intval($weekstartday),date("w",mktime(0,0,0,$smmonth,$i,$smyear))) == 6) {
	  echo "</tr>\n\n";
	  if (($a!=0)&&($i!=$nr)) echo "<tr>";
	  $a = 0;
	  }
	}
  if ($a!=0) {
    for ($i=$a;$i<7;$i++) echo "<td>&nbsp;</td>";
    echo "</tr>";
    }

  echo "</table>";

?>
<div align=center class=normalfont>
<br/><a href="#" class=normalfont onClick="Javascript:self.window.close();"><?php echo translate("Close") ;?></a>
</div>

</BODY>
</HTML>