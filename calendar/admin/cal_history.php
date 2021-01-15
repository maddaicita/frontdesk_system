<?php
##########################################################################
#  Please refer to the README file for licensing and contact information.
# 
#  This file has been updated for version 0.7.20060401 
# 
#  If you like this application, do support me in its development 
#  by sending any contributions at www.calendarix.com.
#
#
#  Copyright © 2002-2005 Vincent Hor
##########################################################################

include ("cal_admintop.php");

if (!isset($_GET['dhday']))
  $dhday = '';
else
  $dhday = $_GET['dhday'];
if (!isset($_GET['dhmonth']))
  $dhmonth = '';
else
  $dhmonth = $_GET['dhmonth'];
if (!isset($_GET['dhyear']))
  $dhyear = '';
else
  $dhyear = $_GET['dhyear'];

if (!isset($_POST['hday']))
  $hday = '';
else
  $hday = $_POST['hday'];	
if (!isset($_POST['hmonth']))
  $hmonth = '';
else
  $hmonth = $_POST['hmonth'];	
if (!isset($_POST['hyear']))
  $hyear = '';
else
  $hyear = $_POST['hyear'];

if (!isset($_POST['huser']))
  if (!isset($_GET['huser'])) $huser = '';
  else $huser = $_GET['huser'];
else 
  $huser = $_POST['huser'];

if (!isset($_POST['limit']))
  $limit = 0;
else
  $limit = $_POST['limit'];

/***************************/
/* show historical records */
/***************************/

function hist($sort,$hday,$hmonth,$hyear,$huser,$limit){
global $USER_TB,$EVENTS_TB,$CAT_TB,$language,$mth,$unapprovedclr,$catcolor,$secondcatcolor,$caladvanceyear, $calstartyear, $op, $timezone, $limitrow ;

// this is for the events sort order redirection javascript
echo "<script language=\"JavaScript\" type=\"text/JavaScript\">\n" ;
echo "\tfunction sortev(order) {\n" ;
echo "\t\tswitch (order) { \n" ;
echo "case 1 : { document.histform.action = 'cal_history.php?op=hist&sort=1" ;
echo "' ; document.histform.submit() ; break ;} \n" ;
echo "case 2 : { document.histform.action ='cal_history.php?op=hist&sort=2" ;
echo "' ; document.histform.submit(); break ;} \n" ;
echo "default : { document.histform.action ='cal_history.php?op=hist&sort=2" ;
echo "' ; document.histform.submit(); break;} \n" ;
echo "\t\t}\n" ;
echo "\t}\n" ;
echo "</script>" ;

$month = date("n");
$year = date("Y");
$day = date("j");

if ((date("G")+$timezone)>24) {
	$day = date("j",mktime(0,0,0,date("n"),date("j")+1,date("Y"))) ;
	$month = date("n",mktime(0,0,0,date("n"),date("j")+1,date("Y"))) ;
	$year = date("Y",mktime(0,0,0,date("n"),date("j")+1,date("Y"))) ;
	}
if ((date("G")+$timezone)<0) {
	$day = date("j",mktime(0,0,0,date("n"),date("j")-1,date("Y"))) ;
	$month = date("n",mktime(0,0,0,date("n"),date("j")-1,date("Y"))) ;
	$year = date("Y",mktime(0,0,0,date("n"),date("j")-1,date("Y"))) ;
	}

if (($hday)&&($hday!='')) $day = $hday ;
if (($hmonth)&&($hmonth!='')) $month = $hmonth ;
if (($hyear)&&($hyear!='')) $year = $hyear ;

echo "<table width=100% border=0 class=headerfont><tr><td align=left>".translate("Historical Items"). "&nbsp; (".translate("Events before")." ".$day." ".ucfirst($mth[$month])." ".$year.") </td>" ;
echo "<td align=right valign=middle><div class=menufont><b>".translate("Sort by").": </b>" ;
	echo " &nbsp; &nbsp; <a href='#' onclick=\"Javascript:sortev(1);\"><img src='../images/sort1.gif' border=0 alt='".translate("Sort by events")."'/></a>" ;
	echo " &nbsp;<a href='#' onclick=\"Javascript:sortev(2);\"><img src='../images/sort2.gif' border=0 alt='".translate("Sort by date")."'/></a>" ;
	echo " &nbsp;</div></td></tr></table>\n";

$qstr = "id,title,cat_name,approved,day,month,year" ;
$query = " from ".$EVENTS_TB." left join ".$CAT_TB." on ".$EVENTS_TB.".cat=".$CAT_TB.".cat_id ";

if (($huser!="-")&&($huser!="")) {  // view user specific events only
  $query .= "where ((year<'$year') || (month<'$month' and year='$year') || (day<$day and month='$month' and year='$year')) and ".$EVENTS_TB.".user='".$huser."' ";
}
else
  $query .= "where ((year<'$year') || (month<'$month' and year='$year') || (day<$day and month='$month' and year='$year')) ";


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
$rows = mysql_num_rows($result);

$m0 = $month ;
$d0 = $day ;
if (strlen($month)<2) $m0 = "0".$month ;
if (strlen($day)<2) $d0 = "0".$day ;

echo "<div class=menufont><b>".translate("Total")." ".($limit+1)." - " ;
if (($limit+$limitrow)<$totalrows) echo ($limit+$limitrow) ;
else echo $totalrows ;
echo "/".$totalrows." ".translate("events")." &nbsp; &nbsp; " ;
echo "<a href=\"cal_history.php?op=delhistev&date=$year-$m0-$d0&huser=$huser\">".translate("Delete all historical events listed");
echo " (".$totalrows." ".translate("events").") ?</a></b><br/></div>\n" ;

$foo = '';
while ($row = mysql_fetch_object($result)){
  $foo++ % 2 ? $color="$secondcatcolor" : $color="$catcolor";
    echo "<table border=0 bgcolor='" ;
    if ($row->approved==0) echo $unapprovedclr ;
    else echo $color ;
    echo "' cellspacing=0 cellpadding=4 width=\"100%\">\n";
    echo "<tr><td><div class=normalfont>\n<b>".stripslashes($row->title)."</b> ".translate("on")." ".$row->day." ".$mth[$row->month]." ".$row->year."\n";
    echo " - ".translate("Category")." : <b>".stripslashes($row->cat_name)."</b>\n";
    echo " - <a href=cal_event.php?op=view&id=".$row->id.">".translate("View event")."</a>\n";
    echo " - <a href=cal_event.php?op=edit&id=".$row->id.">".translate("Edit event")."</a>\n";
    echo " - <a href=cal_event.php?op=delev&id=".$row->id.">".translate("Delete event")."</a>\n";
    if ($row->approved==0)
      echo " - <a href=calendar.php?op=approve&id=".$row->id.">".translate("Approve")."</a>\n";
    echo "</div></td></tr>\n";
    echo "</table>\n";
  }


echo "<table width=100% border=0><tr><td align=left width=50% valign=top>
<table width=100 cellspacing=0 cellpadding=2 align=left class=txtbox><tr><td bgcolor='$unapprovedclr' align=center><div class=normalfont>".translate("Unapproved events")."</div></td></tr></table>\n";

echo "<form name='histform' method=post action='cal_history.php?op=hist&sort=$sort";
echo "'>\n" ;

// previous and next rows
echo "<input type='hidden' name='limit' value='".$limit."'>\n" ;
if ($limit!=0) {
  echo "<input type='button' value='&nbsp;&lt;&nbsp;' title='".translate("Previous")."' onclick=\"Javascript:document.histform.limit.value=".($limit-$limitrow)."; document.histform.action = 'cal_history.php?op=hist&sort=$sort";
  echo "' ; document.histform.submit() ;\"> &nbsp; &nbsp; \n" ;
  }
if (($limit+$limitrow)<$totalrows) {
  echo "<input type='button' value='&nbsp;&gt;&nbsp;' title='".translate('Next')."' onclick=\"Javascript:document.histform.limit.value=".($limit+$limitrow)."; document.histform.action = 'cal_history.php?op=hist&sort=$sort";
  echo "' ; document.histform.submit() ;\">\n<br/>" ;
  }
else
  echo "<br/>" ;
echo "&nbsp;" ;
echo "</td>\n" ;
echo "<td align=right width=50% valign=top><div class=menufont><b>".translate("View historical events before").": </b>" ;

// get days
echo "<select name=hday>\n";
for ($i = 1;$i<=31;$i++){
echo "\t<option value=$i" ;

if ($day==$i) echo " selected " ;
echo ">$i\n";
}
echo "</select>&nbsp;&nbsp;\n";

// get months
echo "<select name=hmonth>\n";
for($i=1;$i<13;$i++){
 echo "\t<option value=".$i ;
 if ($month==$i) echo " selected " ;
 echo ">".ucfirst($mth[$i])."\n";
}
echo "</select>&nbsp;&nbsp;\n";

// get year from "calstartyear" and give "caladvanceyear" years more to select
echo "<select name=hyear>\n";
for ($i=$calstartyear;$i<=($year+$caladvanceyear);$i++){
  echo "\t<option value=$i" ;
  if ($year==$i) echo " selected " ;
  echo ">$i\n";
}
echo "</select> &nbsp; &nbsp;\n";
echo "<input type=submit name='View' value='".translate("View")."'>" ;

// get users
echo "<br/><b>".translate("View events of user").": </b> " ;
$uquery = "select username,user_id from ".$USER_TB ;
$uresult = mysql_query($uquery) ;
echo "<select name=huser onchange=\"Javascript:document.histform.action = 'cal_history.php?op=hist&sort=$sort" ;
echo "'; document.histform.submit() ;\">\n";
echo "\t<option value='-'" ;
if (($huser=="-")||($huser=="")) echo " selected " ;
echo ">--\n";
while ($urow = mysql_fetch_object($uresult)){
  echo "\t<option value='$urow->username'" ;
  if ($huser=="$urow->username") echo " selected " ;
  echo ">".$urow->username."\n";
  }
echo "</select>\n";
echo "</div></td></tr></table>\n" ;
echo "</form>" ;

}

/*******************************************/
/* delete all historical events: question */
/*******************************************/

function delhistev($date,$huser){
global $USER_TB,$EVENTS_TB,$CAT_TB,$language,$m,$d,$y,$mth;

$day = $d;
$month = $m;
$year = $y;

if (($date)&&($date!='')) {
  $year = substr($date,0,4);
  $month = substr($date,5,2);
  $day = substr($date,8,2);

  if (substr($day,0,1) == "0")
    $day = substr_replace ($day,'', 0, 1);
  if (substr($month,0,1) == "0")
    $month = substr_replace ($month,'', 0, 1);
}

$id = '';

$query = "select id,day,month,year from ".$EVENTS_TB." left join ".$CAT_TB." on ".$EVENTS_TB.".cat=".$CAT_TB.".cat_id ";

// get users
if (($huser!="-")&&($huser!="")) {  // view user specific events only
  $query .= "where ((year<'$year') || (month<'$month' and year='$year') || (day<'$day' and month='$month' and year='$year')) and ".$EVENTS_TB.".user='".$huser."' order by day,month,year ASC";
}
else
  $query .= "where ((year<'$year') || (month<'$month' and year='$year') || (day<'$day' and month='$month' and year='$year')) order by day,month,year ASC";

$result = mysql_query($query);
$rows = mysql_num_rows($result) ;
echo "<div class=titlefont><a href=cal_history.php?op=delhist&huser=$huser&dhday=$day&dhmonth=$month&dhyear=$year>".translate("Confirm delete all historical events before")." <i>".$day." ".ucfirst($mth[$month])." ".$year."</i> (".translate("Total")." ".$rows." ".translate("events").") ?</a></div><br/>";
back();

}

/*************************************/
/* delete all historical events: ok */
/*************************************/

function delhist($huser,$dhday,$dhmonth,$dhyear){
global $USER_TB,$EVENTS_TB;

echo "<h4>".translate("Deleting event")." ...</h4>" ;
$query = "DELETE from ".$EVENTS_TB." where ";

if (($huser!="-")&&($huser!="")) {  // view user specific events only
	$query .= " ((year<'$dhyear') || (month<'$dhmonth' and year='$dhyear') || (day<'$dhday' and month='$dhmonth' and year='$dhyear')) and ".$EVENTS_TB.".user='".$huser."' ";
  }
  else {
    $query .= " ((year<'$dhyear') || (month<'$dhmonth' and year='$dhyear') || (day<'$dhday' and month='$dhmonth' and year='$dhyear')) ";
  }
  $result = mysql_query($query);

echo "<meta http-equiv=\"refresh\" content=\"0; url=cal_history.php?op=hist&sort=2\">";
}


switch ($op){

    // historical events 
    case"hist":{
	if (!isset($_GET['sort']))
	  $sort = '2';
	else
	  $sort = $_GET['sort'];
        hist($sort,$hday,$hmonth,$hyear,$huser,$limit);
    break;
    }

    // delete all historical events: question
    case"delhistev":{
	if (!isset($_GET['huser']))
	  $huser = '';
	else
	  $huser = $_GET['huser'];
        delhistev($date,$huser);
    break;
    }
    
    // delete all historical events: ok
    case"delhist":{
        delhist($huser,$dhday,$dhmonth,$dhyear);
    break;
    }

    // default
    default:{
        hist($sort,$hday,$hmonth,$hyear,$huser,$limit);
    break;
    }
}

include ('cal_footer.inc.php');

?>