<?php
##########################################################################
#  Please refer to the README file for licensing and contact information.
# 
#  This file has been updated for version 0.7.20061227 
# 
#  If you like this application, do support me in its development 
#  by sending any contributions at www.calendarix.com.
#
#
#  Copyright © 2002-2006 Vincent Hor
##########################################################################

include ('cal_header.inc.php');
include ("search_func.php");
include ("cal_utils.php") ;

calHeaderFunc();

if (isset($_GET['isdelete']))
  $isdelete = $_GET['isdelete'];
else
  $isdelete = "n" ;

/**************/
/* view event */
/**************/

// used in delete event call
if (!isset($_GET['delev']))  $delev = 0 ;
else $delev = $_GET['delev'] ;

if ($allowuserdel==1) {
  // Delete event portion
  if ($delev==1) {
    $dquery = "delete from ".$EVENTS_TB." where id='$id'";
    mysql_query($dquery);
    echo "<h4>".translate("Deleting event")." ...</h4>" ;
    echo "<!-- javascript redirect -->\n" ;
    echo "<script language=\"JavaScript\" type=\"text/JavaScript\">\n" ;
    echo "self.window.location.href = 'calendar.php';\n" ;
    echo "</script>\n\n" ;
    exit() ;
    }
}

echo "<hr/>\n" ;
$query = "select id,user,title,cat_name,description,starttime,endtime,day,month,year,approved,url,email from ".$EVENTS_TB." left join ".$CAT_TB." on ".$EVENTS_TB.".cat=".$CAT_TB.".cat_id where id='$id'";
$result = mysql_query($query);
$row = mysql_fetch_object($result);
echo "<div class=popupeventtitlefont>".stripslashes($row->title)."</div>\n";
echo "\n<div class=popupeventfont>" ;
echo "<br/><b>".translate("Date")." : </b>".$row->day ." ".$mth[$row->month]." ".$row->year."\n";
if ($notimeentry==0) showtime($row->starttime,$row->endtime,2);
echo "<br/><b>".translate("Category")." : </b>".stripslashes($row->cat_name)."\n";
echo "<br/><br/><b>".translate("Event Description")." : </b><br/>\n";
echo "<blockquote>".stripslashes($row->description)."</blockquote>";
echo "<br/>\n";

if ($row->email)
	echo "<br/><b>".translate("Email")." : </b><a href=mailto:".$row->email.">".$row->email."</a>\n";

if ($row->url){
	echo "<br/><b>".translate("More info")." : </b><a href=";
	// for compatibility with up to 0.5 version
	if (strtolower(substr($row->url,0,4))<>"http") echo "http://".$row->url." target=_blank>http://".$row->url."</a>\n";
	else echo $row->url." target=_blank>".$row->url."</a>\n";
}
if (($showuserentry==1)&&($uname!=""))
  echo "<br/><br/><b>".translate("User")." : </b>".$row->user;
echo "</div><br/>\n" ;
echo "<div align=center class=menufont>\n" ;

if ((($publicview==1)&&($uname!=""))||($publicview==0)) {
  if (($addeventok==1)&&($isdelete!="y")){
    echo "<a href='#' onclick=\"Javascript:wopen('cal_addevent.php?op=eventform&id=$id','popupwin',".$addeventwin_w.",".$addeventwin_h.",'yes');\">".translate("Copy Event")."</a>" ;
  }

  if (($allowuserdel==1)&&($uname==$row->user)) {
    if (($addeventok==1)&&($isdelete!="y")) echo " - " ;
    if ($isdelete!="y") {
      echo "<a class=menufont href='Javascript:void(0);' onclick=\"Javascript:wopen('cal_addevent.php?op=upeventform&id=$id','popupwin',".$addeventwin_w.",".$addeventwin_h.",'yes');\">".ucwords(translate("Edit event"))."</a>";
      echo " - <a href='cal_event.php?isdelete=y&amp;uname=$uname&amp;id=".$id."' >".ucwords(translate("Delete event"))."</a> ";
	}
    else
      echo "<a href='cal_event.php?id=".$id."&amp;delev=1' >".ucwords(translate("Confirm delete?"))."</a> ";
  }
}

echo "</div>\n" ;
echo "<br/><div align=center class=menufont><a href='#' onclick='Javascript:window.history.go(-1);'>".translate("Back")."</a></div>" ;
echo "<br/>" ;
if (($allowsearch==1)&&($vieweventok==1))	{
  echo "<div align=right>" ;
  search();
  echo "<div>" ;
}

include ('cal_functions.inc.php');
include ('cal_footer.inc.php');

?>
