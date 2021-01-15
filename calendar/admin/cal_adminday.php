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

/***********************/
/* view events per day */
/***********************/

function day($ask,$date){
global $EVENTS_TB,$CAT_TB,$USER_TB,$uname,$mth,$week,$language,$m,$d,$y,$calstartyear,$caladvanceyear,$unapprovedclr,$shortdesclen,$showuserentry,$notimeentry;

// View events for specific user
if (!isset($_POST['huser']))
  $huser = '';
else
  $huser = $_POST['huser'];

if (!isset($yda))
  $yda = '';

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

$we = mktime(0,0,0,$month,$day,$year);
$we = strftime("%w",$we);
$we++;

// variables with exact digit without the leading 0 used for query and accessing array
$vdm = $month;
if (substr($vdm,0,1) == "0"){
  $vdm = str_replace("0","",$vdm);
  }
$vda = $day;
if (substr($vda,0,1) == "0"){
  $vda = str_replace("0","",$vda);
  }

$weeknumber = weekNumber($day,$month,$year);
if ($year>($y+$caladvanceyear)) $weeknumber = 53 ;	// to ensure weeks cannot go beyond restricted dates
if ($year<($calstartyear)) $weeknumber = 1 ;	// to ensure weeks cannot go beyond restricted dates


echo "<table class=headerfont border=0 width=100% cellspacing=0><tr><td align=left>".translate("Events for day");
echo ": ".$week[$we]." ".$day ;
if (($year<=($y+$caladvanceyear))&&($year>=($calstartyear))) {
  echo " <a class=headerfont href=calendar.php?op=cal&month=".$vdm."&year=".$year ;
  urlvar($uname);
  echo " >" ;
  }
else echo " " ;
echo $mth[$vdm] ;
if (($year<=($y+$caladvanceyear))&&($year>=($calstartyear))) echo "</a> " ;
else echo " " ;
echo $year." &nbsp; &nbsp; <a href=cal_adminweek.php?op=week&date=".date("Y-m-d", mktime(0,0,0,$month,$day,$year));
urlvar($uname);
echo " ><img src=\"../images/week.gif\" border=0 alt='".translate("View week")." $weeknumber"."' width=16 height=16/></a>" ;
echo " &nbsp; <a href='cal_event.php?op=eventform&add_day=$day&add_month=$month&add_year=$year'><img src='../images/plus.gif' border=0 valign=middle alt='".translate("Add Event")."' width=11 height=11/></a>" ;
echo "</td>" ;
echo "<td align=right><div class=menufont>" ;

// display previous day and next day navigation
if (($year > $calstartyear) || (($vdm > 1)&&($year == $calstartyear)) || (($vdm == 1)&&($year == $calstartyear)&&($vda>1))) {
  echo "<a href=\"cal_adminday.php?op=day&date=".date("Y-m-d", mktime(0,0,0,$month,$day-1,$year));
  urlvar($uname);
  echo "\"><< ".translate("Previous day")."</a> &nbsp; " ;
}
else echo "&nbsp;" ;
$calendyear = $y + $caladvanceyear ;
if (($year < $calendyear) || (($vdm < 12)&&($year == $calendyear)) || (($vdm == 12)&&($year == $calendyear)&&($vda<31))) {
    echo "<a href=\"cal_adminday.php?op=day&date=".date("Y-m-d", mktime(0,0,0,$month,$day+1,$year));
    urlvar($uname);
    echo "\">".translate("Next day")." >></a> &nbsp; &nbsp;<br/>";
}
else echo "&nbsp;" ;
echo "</div></td></tr></table>";

$query = "select id,user,title,description,url,email,cat_name,starttime,endtime,day,month,year,approved from ".$EVENTS_TB." left join ".$CAT_TB." on ".$EVENTS_TB.".cat=".$CAT_TB.".cat_id where day='$vda' and month='$vdm' and year='$year' " ;
if (($uname!="")&&($uname!="-")) {
	$query = $query." and ".$EVENTS_TB.".user='".$uname."' " ;
      }
$query = $query. " order by starttime,title ASC";
$result = mysql_query($query);
echo "<table class=dayevent width=100% border=0 class=dayevent cellspacing=0><tr><td align=left>" ;
if (mysql_num_rows($result)!=0) {
  while ($row = mysql_fetch_object($result)){
    if ($row->approved=='0') echo "<table class=dayevent width=100% border=0 ><tr><td bgcolor='$unapprovedclr'>" ;
	if ($notimeentry==0) {
	  if ($row->starttime=='') echo "<li>" ;
	  else showtime($row->starttime,$row->endtime,0);
	}
	else echo "<li>";
	echo "<b>".stripslashes($row->title) ;
	if ($showuserentry==1) echo " &nbsp;&lt;".$row->user."&gt;" ;
	echo "</b>";
	if (($notimeentry==1)||($row->starttime=='')) echo "</li>";
	else echo "<br/>";
    echo translate("Category")." : ".stripslashes($row->cat_name)."<br/>";
    $de = $row->description;
    //$de = str_replace("<br />","",$row->description);
    echo substr(stripslashes($de),0,$shortdesclen) ;
    if (($row->email!="")||($row->url!="")||(strlen($de)>$shortdesclen)) echo " ...\n";
    else echo "\n" ;
    echo "<div class=menufont><a href=cal_event.php?op=view&id=".$row->id.">".translate("View event")."</a>\n";
    echo " - <a href=cal_event.php?op=edit&id=".$row->id.">".translate("Edit event")."</a>\n";
    echo " - <a href=cal_event.php?op=delev&id=".$row->id.">".translate("Delete event")."</a>\n";
    if ($row->approved=='0')
      echo " - <a href=calendar.php?op=approve&id=".$row->id.">".translate("Approve")."</a>\n";
    echo "</div>\n" ;
    echo "<hr/>";
    if ($row->approved=='0') echo "</td></tr></table>" ;
  }
}
else echo "&nbsp;<br/>" ;
echo "</td></tr></table>" ;


// this is for the goto day redirection javascript
echo "<script language=\"JavaScript\" type=\"text/JavaScript\">\n" ;
echo "\tfunction gotoday(selectopt) {\n" ;
echo "var geti = '1' ;\n" ;
echo "for (i=0;i<selectopt.options.length;i++) {\n" ;
echo "\tif (selectopt.options[i].selected) {\n" ;
echo "\t\tgeti = selectopt.options[i].value ;\n" ;
echo "\t\tbreak ;\n" ;
echo "\t}\n" ;
echo "}\n\n" ;
echo "\t\tswitch (geti) { \n" ;
$dateinmonth = date("t", mktime(0,0,0,$month,$day,$year)) ;
for ($i=1;$i<=$dateinmonth;++$i) {
  $jstr = "cal_adminday.php?op=day&date=" ;
  $jstr = $jstr.date("Y-m-d", mktime(0,0,0,$month,$i,$year)) ;
  if (($uname!="")&&($uname!="-")) $jstr = $jstr."&uname=$uname" ;
  echo "case \"".$i."\" : { window.location.href='".$jstr."' ; break ;} \n" ;
}
echo "default : { window.location.href='cal_adminday.php?op=day&date=".date("Y-m-d", mktime(0,0,0,$month,$day,$year))."' ; break;} \n" ;
echo "\t\t}\n" ;
echo "\t}\n" ;
echo "</script>" ;


// display form functions
echo "<table border=0 width=100%><tr><td align=left width=50%>" ;
echo "<table width=100 cellspacing=0 cellpadding=2 align=left class=txtbox><tr><td bgcolor='$unapprovedclr' align=center><div class=normalfont>".translate("Unapproved events")."</div></td></tr></table>\n</td>" ;
echo "<td align=right valign=middle width=50%>" ;
echo "<form><div class=menufont>\n";
echo "<b>".translate("Go to day")." </b>" ;
// get week number
echo "<select name=goday onchange=\"javascript:gotoday(this);\"" ;
if (($year>($y+$caladvanceyear))||($year<($calstartyear))) echo " disabled" ;
echo ">\n";
for($i=1;$i<=$dateinmonth;$i++){
 echo "\t<option value=".$i ;
 if ($day==$i) echo " selected " ;
 echo ">".$i."\n";
}
echo "</select>\n";

echo "<b>".translate("or week")." </b>" ;
// get week number
echo "<select name=goweek onchange=\"javascript:gotoweek(this);\">\n";
for($i=1;$i<53;$i++){
 echo "\t<option value=".$i ;
 if ($weeknumber==$i) echo " selected " ;
 echo ">".$i."\n";
}

if (showWeek53($year)>52)
 {
 for($i=53;$i<=showWeek53($year);$i++){
   echo "\t<option value=".$i ;
   if ($weeknumber==$i) echo " selected " ;
   echo ">".$i."\n";
   }
 }
echo "</select>&nbsp;&nbsp;<br/>\n";

// Display the users to be selected
echo "<b>".translate("View events of user").": </b> &nbsp;" ;
// get users
$uquery = "select username,user_id from ".$USER_TB ;
$uresult = mysql_query($uquery) ;
echo "<select name=huser onchange=\"Javascript:seeuser(this);\">\n";
echo "\t<option value='-'" ;
if (($uname=="-")||($uname=="")) echo " selected " ;
echo ">--\n";
while ($urow = mysql_fetch_object($uresult)){
  echo "\t<option value='$urow->username'" ;
  if ($uname=="$urow->username") echo " selected " ;
  echo ">".$urow->username."\n";
  }
echo "</select>&nbsp;&nbsp;\n";

echo "</div></form>" ;
echo "</td>" ;
echo "<td align=right valign=middle width=33%>" ;
echo "</td></tr></table>" ;

}


switch ($op){
    
    // view per day 
    case"day":{
        day($ask,$date);
    break;
    }
    
    // default: 
    default:{
        day($ask,$date);
    break;
    }
}

include ('cal_footer.inc.php');
?>
