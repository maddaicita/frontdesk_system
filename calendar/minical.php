<?php
require_once "cal_config.inc.php";
include_once ($calpath."cal_utils.php");
$urlpathtocal = "http://localhost/calendarix/demo/";
//require_once $urlpathtocal."themes/".$theme.".css";

// Ensures overlib javascript lib only included once so IE can render
$included_files = get_included_files();
$gotHeader = false;
foreach ($included_files as $filename) {
    $pos = strpos($filename,'cal_header.inc.php');
    if ($pos===false) echo "";
    else $gotHeader = true;
}
if (!$gotHeader) {
	echo "<link href=\"themes/".$theme.".css\" rel=\"stylesheet\" type=\"text/css\" />\n";
	echo "\n<!-- overLIB (c) Erik Bosrup -->\n";
	echo "\n<div id=\"overDiv\" style=\"position:absolute; visibility:hidden; z-index:1000;\"></div>\n";
	echo "<script language=\"JavaScript\" src=\"".$urlpathtocal."overlib.js\"></script>\n";
	echo "\n<!-- overLIB (c) Erik Bosrup -->\n";
}
/*
<!-- overLIB (c) Erik Bosrup -->
<div id="overDiv" style="position:absolute; visibility:hidden; z-index:1000;"></div>
<script language="JavaScript" src="<?php echo $urlpathtocal.'overlib.js'?>" type="text/JavaScript"><!-- overLIB (c) Erik Bosrup --></script> 
*/

##########################################################################
#  Please refer to the README file for licensing and contact information.
# 
#  This file has been updated for version 0.8.20080808 
# 
#  If you like this application, do support me in its development 
#  by sending any contributions at www.calendarix.com.
#
#  This is file is identical to one in admin section of same name.
#
#  Copyright © 2004-2008 Vincent Hor
##########################################################################

if (!isset($_GET['date']))
  $date = date("Y-m-d",mktime(0,0,0,date("m"),date("d"),date("Y"))) ;
else
  $date = $_GET['date'];

if (!isset($uname))  
	if (($userview==1)&&($userlogin==1)) EXIT();  // user view user specific events only
	else $uname = "";  // for public view permitted.

$smyear = substr($date,0,4) ;
$smmonth = substr($date,5,2) ;
if (substr($smmonth,0,1) == "0")
  $smmonth = str_replace("0","",$smmonth);

$showeventcount = true;
$showyear = true;

// Set today's date corrected by timezone
$um = date("n");
$uy = date("Y");
$ud = date("j");

if ((date("G")+$timezone)>24) {
	$ud = date("j",mktime(0,0,0,$um,date("j")+1,$uy)) ;
	$um = date("n",mktime(0,0,0,$um,date("j")+1,$uy)) ;
	$uy = date("Y",mktime(0,0,0,$um,date("j")+1,$uy)) ;
	}

if ((date("G")+$timezone)<0) {
	$ud = date("j",mktime(0,0,0,$um,date("j")-1,$uy)) ;
	$um = date("n",mktime(0,0,0,$um,date("j")-1,$uy)) ;
	$uy = date("Y",mktime(0,0,0,$um,date("j")-1,$uy)) ;
}

  // number of days in month
  $firstday = date ("w", mktime(12,0,0,$smmonth,1,$smyear));
  $nr = date("t",mktime(12,0,0,$smmonth,1,$smyear));
  echo "\n\n<table class='smallcalmth' align='center' >";
  echo "<tr><td align='center' valign='middle' width='100%'><div class='smallcalmth'>";

  $pdate = date("Y-m-d",mktime(0,0,0,$smmonth-1,1,$smyear)) ;  
  if (date("Y",mktime(0,0,0,$smmonth-1,1,$smyear))>=$calstartyear)
    echo "<a class='smallcalmth' href='".$_SERVER['PHP_SELF']."?date=$pdate'>&lt;&lt;</a>";
    
  echo "&nbsp; &nbsp; &nbsp;";
  if ($viewcalok==1) {
    echo "<a class=\"smallcalmth\" href=\"".$urlpathtocal."calendar.php?op=cal&month=".$smmonth."&year=".$smyear."\" target=\"_BASE\" >" ;
    }
    echo $mth[$smmonth] ;
  if ($viewcalok==1) echo "</a> " ;
  if ($showyear) echo " ".$smyear;

  echo "&nbsp; &nbsp; &nbsp;";
  $pdate = date("Y-m-d",mktime(0,0,0,$smmonth+1,1,$smyear)) ; 
  if (date("Y",mktime(0,0,0,$smmonth+1,1,$smyear))<=date("Y")+$caladvanceyear)
  echo "<a class='smallcalmth' href='".$_SERVER['PHP_SELF']."?date=$pdate'>&gt;&gt;</a>";
  echo "</div></td></tr></table>\n\n";

  echo "<table align='center' class='smallcalmth'>";
  echo "<tr>";

  // make the header days of week
  for ($i=intval($weekstartday)+1;$i<=(intval($weekstartday) + 7);$i++){
    echo "<td align='center' ";
    if (($i<>1)&&($i<>7)) echo "width='14%'>" ;
    else echo "width='15%'>" ;
    if (dayinweek($i) == 1)
      echo "<div class='dayfont'>".substr($week[dayinweek($i)],0,3)."</div></td>"; // sunday
    else    
      echo "<div class='dayfont'>".substr($week[dayinweek($i)],0,3)."</div></td>"; // rest of week
    }
  echo "</tr>\n\n<tr>";

  // print initial blank squares
  for ($i=1;$i<=blankdays(intval($weekstartday),$firstday);$i++)  echo "<td>&nbsp;</td>";
  $a=0;
  for ($i=1;$i<=$nr;$i++){
    // now get eventual events on $i 
    $query = "select id,user,title,starttime,endtime from ".$EVENTS_TB." left join ".$CAT_TB." on ".$EVENTS_TB.".cat=".$CAT_TB.".cat_id where day='$i' and month='$smmonth' and year='$smyear' and approved='1' " ;

  $query = $query." order by day,month,year,starttime,title ASC";
  $result = mysql_query($query);
  $devtcnt = mysql_num_rows($result) ;

  echo "<td align=center ";
  if ($i == $ud && $smmonth == $um && $smyear == $uy) // highlight today's day
    echo "class=todayclr ";
  elseif ($devtcnt!=0)
    echo "class=smallcalmth ";
  echo "valign=top>\n\n";

  if ($devtcnt!=0) {
    // overlib line
    echo "<a href=\"javascript:void(0);\" onmouseover=\"return overlib('";
    echo "<table border=0 cellspacing=0 cellpadding=0 width=100%>" ;
    while ($row = mysql_fetch_object($result)){
	echo "<tr><td align=center valign=top>" ;
	echo "<table class=eventborder cellspacing=0 cellpadding=0 width=100%><tr>";
	if ($notimeentry==0) {
	  echo "<td align=center class=eventtimeborder valign=top>" ;
	  echo "<div class=smallcalevtime>";
	  if ($row->starttime=='') echo "&nbsp; &nbsp;" ;
	  else showtime($row->starttime,$row->endtime,1);
	  echo "</div>" ;
	  echo "</td>" ;
	}
	echo "<td align=left valign=top width=80% class=eventborder>" ;
	echo "<div class=smallcalev>";
      echo subquot(stripslashes($row->title));
	echo "</div>" ;

	echo "</td></tr>" ;
	echo "</table>" ;
    }
  echo "</table>" ;
  // overlib line
  echo "',FGCOLOR,'$overlibbgclr',TEXTSIZE,'1',WIDTH,'120',VAUTO,HAUTO);\" onmouseout=\"return nd();\">";
  }

  echo "<div class='datenumfont'>".$i."</div>" ;
  if ($devtcnt!=0) echo "</a>";
  echo "</td>\n\n";
  $a++;
  if (blankdays(intval($weekstartday),date("w",mktime(0,0,0,$smmonth,$i,$smyear))) == 6) {
    echo "</tr>\n\n<tr>";
    $a = 0;
    }
  }
  if ($a!=0) {
    for ($i=$a;$i<7;$i++) {
    echo "<td>&nbsp;</td>";
    }
  }
  echo "</tr>";
  if ($showeventcount) {
    echo "<tr><td align='center' valign='top' colspan='7'>" ;
    // get total number of events for month
    $tquery = "select id from ".$EVENTS_TB." where ".$EVENTS_TB.".month='".$smmonth."' and ".$EVENTS_TB.".year='".$smyear."' and ".$EVENTS_TB.".approved='1' " ;
    $normuser = false ;
    if (($userview==1)&&($userlogin==1)&&($uname!="")) {  // view user specific events only
      $uquery = "select group_id from ".$USER_TB." where ".$USER_TB.".user_id=".$userid ;
      $uresult = mysql_query($uquery) ;
      $urow = mysql_fetch_object($uresult);
      if ($urow->group_id!=0) {
        $normuser = true ;
        $tquery = "select * from ".$EVENTS_TB.",".$USER_TB." where ".$EVENTS_TB.".month='".$smmonth."' and ".$EVENTS_TB.".year='".$smyear."' and ".$EVENTS_TB.".approved='1' and ".$EVENTS_TB.".user=".$USER_TB.".username and ".$USER_TB.".user_id=".$userid ;
        }
      }
    $tresult = mysql_query($tquery);
    $trows = mysql_num_rows($tresult) ;
    echo "<table class='txtbox' cellspacing='0' cellpadding='0'><tr><td align='center'><div class='normalfont'> &nbsp;<b>";

echo "<a class='normalfont' href='#' onmouseover=\"return overlib('Calendarix version ".$version."\\nCopyright © 2002-2008 Vincent Hor',FGCOLOR,'#FFFFFF',TEXTSIZE,'1',WIDTH,'225',VAUTO,HAUTO,CAPTION,'".translate("About Calendarix")." [Basic] ');\" onmouseout=\"return nd();\">";

    echo $trows." ".translate("events")."</a></b>&nbsp; </div></td></tr></table>" ;
    echo "</td></tr>" ;
    }
  echo "</table>";


?>
