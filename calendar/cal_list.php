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

include_once ('cal_header.inc.php');
include_once ("search_func.php");
include_once ("cal_utils.php") ;

calHeaderFunc();

if (!isset($_GET['sort']))
  $sort = '';
else
  $sort = $_GET['sort'];

/************************/
/* view events listing  */
/************************/

function evlist($date,$catcolor,$secondcatcolor,$sort){
global $EVENTS_TB,$CAT_TB,$USER_TB,$mth,$week,$m,$d,$y,$searchweekok,$popupevent,$popupeventwidth,$popupeventheight,$weekstartday,$calstartyear,$caladvanceyear,$allowsearch,$addeventok,$userid,$userview,$userlogin,$shortdesclen,$catview,$uname,$ugroup,$showuserentry,$publicview,$dayview_w,$notimeentry,$viewevlistok,$limitrow,$eventcatfilter;

if ($viewevlistok==1){

if (!$date){
$year = $y;
$month = $m;
$day = $d;
}
else{
$year = substr($date,0,4);
$month = substr($date,5,2);
$day = substr($date,8,2);
}


if (!isset($_GET['catmonth']))
  $catmonth = '';
else
  $catmonth = $_GET['catmonth'];
if (!isset($_GET['limit']))
  $limit = 0 ;
else
  $limit = $_GET['limit'] ;

$qstr = " id,description,title,cat,day,month,year,starttime,endtime,cat_name " ;
$query = " from ".$EVENTS_TB." left join ".$CAT_TB." on ".$EVENTS_TB.".cat=".$CAT_TB.".cat_id where approved='1' ";
$query .= " and ((year>'$y')||(month>'$m' and year='$y')||(day>=$d and month='$m' and year='$y'))" ;

if (($userview==1)&&($userlogin==1)&&($uname!="")) {
  if ($ugroup!=0) {
	// Generate the query
	$qstr = " $EVENTS_TB.id, $EVENTS_TB.description, $EVENTS_TB.title, $EVENTS_TB.cat, $EVENTS_TB.starttime, $EVENTS_TB.endtime, $EVENTS_TB.user, $EVENTS_TB.day, $EVENTS_TB.month, $EVENTS_TB.year, $CAT_TB.cat_name, $USER_TB.username, $USER_TB.user_id " ;
	$query = " from ".$EVENTS_TB.", ".$USER_TB." left join ".$CAT_TB." on ".$EVENTS_TB.".cat=".$CAT_TB.".cat_id where approved='1' ";
	$query .= " and ((year>'$y')||(month>'$m' and year='$y')||(day>=$d and month='$m' and year='$y'))" ;
	$query .= " and ".$EVENTS_TB.".user=".$USER_TB.".username and ".$USER_TB.".user_id=".$userid ;
    }
}

if (($eventcatfilter==1)&&($catview!=0)) $query .= " and cat_id=$catview";

if (($sort)&&($sort==1))
  $query = $query . " order by title ASC, year ASC, month ASC, day ASC";
else
  $query = $query . " order by year ASC, month ASC, day ASC, title ASC";

$tquery = "select count(*) ".$query ;
$tresult = mysql_query($tquery);
$trow = mysql_fetch_array($tresult);
$totalrows = $trow[0] ;

if ($limit>$totalrows) $limit = 0 ;
$query .= " LIMIT ".$limit.",".$limitrow ;

$query = "select ".$qstr.$query ;
$result = mysql_query($query);
$rowname = mysql_fetch_object($result);
$rows = mysql_num_rows($result);

// this is for the category sort order redirection javascript
echo "<script language=\"JavaScript\" type=\"text/JavaScript\">\n" ;
echo "\tfunction sortev(order) {\n" ;
echo "\t\tswitch (order) { \n" ;
echo "case 1 : { window.location.href='cal_list.php?op=evlist&sort=1&catview=$catview&limit=$limit' ; break ;} \n" ;
echo "case 2 : { window.location.href='cal_list.php?op=evlist&sort=2&catview=$catview&limit=$limit' ; break ;} \n" ;
echo "default : { window.location.href='cal_list.php?op=evlist&sort=2&catview=$catview&limit=$limit' ; break;} \n" ;
echo "\t\t}\n" ;
echo "\t}\n" ;
echo "</script>" ;

echo "<form action=POST>\n";
echo "<table class=titlefont width=$dayview_w border=0 cellspacing=0><tr><td align=left valign=top width='40%'>" ;
echo "<div class=titlefont>".translate("Events from ").$d." ".ucfirst($mth[$m])." ".$y."</div>" ;
echo "</td><td valign=top width='30%' align=left>" ;

// previous and next row set
echo "<div class=menufont><input type='button' value='&nbsp;&lt;&nbsp;' title='".translate("Previous")."' onclick=\"Javascript:window.location.href='cal_list.php?op=evlist&sort=$sort&catview=$catview&limit=".($limit-$limitrow)."' ;\" " ;
if ($limit==0)  echo " disabled " ;
echo "> &nbsp; \n" ;
echo "<b> &nbsp; ".($limit+1)." - ";
if (($limit+$limitrow)<$totalrows) echo ($limit+$limitrow) ;
else echo $totalrows ;
echo "/".$totalrows ;
echo " ".translate("events")." &nbsp; " ;
echo "</b> &nbsp; \n" ;
echo "<input type='button' value='&nbsp;&gt;&nbsp;' title='".translate('Next')."' onclick=\"Javascript:window.location.href='cal_list.php?op=evlist&sort=$sort&catview=$catview&limit=".($limit+$limitrow)."' ;\" " ;
if (($limit+$limitrow)>=$totalrows) echo " disabled " ;
echo "></div>\n" ;
echo "</td><td align=right valign=top width='30%'><div class=menufont><b>".translate("Sort by").": </b>" ;
echo " &nbsp; &nbsp; <a href='#' onclick=\"Javascript:sortev(1);\"><img src='images/sort1.gif' border=0 alt='".translate("Sort by events")."'/></a>" ;
echo " &nbsp;<a href='#' onclick=\"Javascript:sortev(2);\"><img src='images/sort2.gif' border=0 alt='".translate("Sort by date")."'/></a>" ;
echo " &nbsp;</div></td></tr></table>\n";

if (!$rows)
	echo "<br/><div class=titlefont>".translate("No events").".</div><br/>\n";
else
{
	$result = mysql_query($query);
	$foo = '';
	while ($row = mysql_fetch_object($result))
	{
	  $foo++ % 2 ? $color=$catcolor : $color=$secondcatcolor;
	  echo "<table class=normalfont border=0 bgcolor=$color cellspacing=0 cellpadding=4 width=$dayview_w>\n";
	  echo "<tr><td>" ;
	    
      echo "<div class=searchtitlefont><li>";
	$weekday = date ("w", mktime(12,0,0,$row->month,$row->day,$row->year));
	echo stripslashes($row->title)." (".ucfirst($week[++$weekday]).", ".$row->day." ".$mth[$row->month]." ".$row->year.")</li></div>";
      echo "<div class=searchtextfont>";
	  echo "<b>".translate("Category")." : </b>".stripslashes($row->cat_name);
      if ($notimeentry==0) showtime($row->starttime,$row->endtime,2);
	  echo "</div>";
      $de = $row->description;

      echo "<div class=searchtextfont>".substr(stripslashes($de),0,$shortdesclen)." ...</div>\n" ;
      if ($popupevent == 1)
        echo "<div class=menufont><a href=\"Javascript:void(0);\" onclick=\"Javascript:popup(".$row->id.");\">";
      else
        echo "<div class=menufont><a href='cal_event.php?id=".$row->id."' >";
      echo translate("Read more")."</a></div>" ;
	  echo "</td></tr>\n";
	  echo "</table>\n";
	  }
}
echo "</form>\n";

// display form functions
echo "<table border=0 width=$dayview_w><tr>" ;
echo "<td align=left valign=top width='50%'>\n" ;
echo "&nbsp;</td>" ;
echo "<td align=right valign=middle width='50%'>" ;
if ($allowsearch==1) search();
echo "</td></tr></table>" ;

  }
else
  echo "<br/><div class=titlefont>".translate("disabled").".</div>" ;
}

switch ($op){
    
    // view per week 
    case "evlist":{
		if (!isset($_GET['sort']))
	  		$sort = 2;
		else
	  		$sort = $_GET['sort'];
        evlist($date,$catcolor,$secondcatcolor,$sort);
    break;
    }
    
    // default: 
    default:{
  		$sort = 2;
		evlist($date,$catcolor,$secondcatcolor,$sort);
    break;
    }
}

include ('cal_functions.inc.php');
include ('cal_footer.inc.php');

?>
