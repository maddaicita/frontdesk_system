<?php
##########################################################################
#  Please refer to the README file for licensing and contact information.
# 
#  This file has been updated for version 0.8.20080808 
# 
#  If you like this application, do support me in its development 
#  by sending any contributions at www.calendarix.com.
#
#
#  Copyright © 2002-2008 Vincent Hor
##########################################################################

include ("cal_admintop.php");

/************************/
/* view events per week */
/************************/

function week($week,$date){
global $EVENTS_TB,$CAT_TB,$USER_TB,$mth,$week,$m,$d,$y,$ld,$fd,$weekstartday,$calstartyear,$caladvanceyear,$unapprovedclr,$shortdesclen,$showuserentry,$uname,$notimeentry; 

// View events for specific user
if (!isset($_POST['huser']))
  $huser = '';
else
  $huser = $_POST['huser'];

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

// offset to get correct day calculation when "date" is sent
$day_offset = date("w", mktime(0,0,0,$month,$day,$year));
$dayoff = 0 ;		// use to get back original url "date"
while ($day_offset>date("w")) { 
	$day-- ; 
	$day_offset = date("w", mktime(0,0,0,$month,$day,$year));
	$dayoff++ ;
}
while ($day_offset<date("w")) { 
	$day++ ; 
	$day_offset = date("w", mktime(0,0,0,$month,$day,$year));
	$dayoff-- ;
}


// get first day of the week based on "$weekstartday"
function firstDayOfWeek($year,$month,$day){
 global $fd,$weekstartday;
 $dayOfWeek=date("w");
 $sunday_offset = ($dayOfWeek) * 60 * 60 * 24 ;
 $startday_offset = ($weekstartday-1) * 60 * 60 * 24;
 $fd = date("Y-m-d", mktime(0,0,0,$month,$day+1,$year) - $sunday_offset + $startday_offset);
 return $fd;
}
firstDayOfWeek($year,$month,$day);

// get last day of the week based on "$weekstartday"
function lastDayOfWeek($year,$month,$day){
 global $ld,$weekstartday;
 $dayOfWeek=date("w");
 $saturday_offset= (6-$dayOfWeek) * 60 * 60 * 24 ;
 $startday_offset = ($weekstartday-1) * 60 * 60 * 24;
 $ld  = date("Y-m-d", mktime(0,0,0,$month,$day+1,$year) + $saturday_offset + $startday_offset);
 return $ld;
}
lastDayOfWeek($year,$month,$day);


// display header with week number
echo "<table class=headerfont border=0 width=100% cellspacing=0><tr><td>".translate("Events from ");

$fdy = substr($fd,0,4);
$fdm = substr($fd,5,2);
if (substr($fdm,0,1) == "0"){
 $fdm = str_replace("0","",$fdm);}
$fdd = substr($fd,8,2);
echo $fdd." ".$mth[$fdm]." ".$fdy;

echo " ".translate("till")." ";
$ldy = substr($ld,0,4);
$ldm = substr($ld,5,2);
if (substr($ldm,0,1) == "0"){
 $ldm = str_replace("0","",$ldm);}
$ldd = substr($ld,8,2);
echo $ldd." ".$mth[$ldm]." ".$ldy;

$weeknumber = weekNumber($day+$dayoff,$month,$year);

if ($ldy>($y+$caladvanceyear)) $weeknumber = 53 ;	// to ensure weeks cannot go beyond restricted dates
if ($fdy<($calstartyear)) $weeknumber = 1 ;	// to ensure weeks cannot go beyond restricted dates
echo " (".translate("week number")." : ".$weeknumber.")\n";

$gdy = $ldy ;
$gdm = $ldm ;
if ($gdy>($y+$caladvanceyear)) { $gdy = $fdy ; $gdm = $fdm ; }
echo " &nbsp; &nbsp; <a href=calendar.php?op=cal&month=$gdm&year=$gdy" ;
urlvar($uname) ;
echo " ><img src=\"../images/month.gif\" border=0 alt='".translate("View month")." ".$mth[$gdm]."'/></a>";
echo "<br/>(".translate("Week starts")." ".$week[$weekstartday+1].")\n" ;
echo "</td></tr></table>" ;

// display hyperlinks to previous and next week
$calendyear = $y + $caladvanceyear ;
echo "<table width=100% border=0><tr><td align=left><div class=menufont>" ;
if (($year > $calstartyear) || (($fdm >= 1)&&($fdy == $calstartyear))) 
	{
	echo "<a href=cal_adminweek.php?op=week&date=".date("Y-m-d", mktime(0,0,0,$month,$day-7,$year));
      urlvar($uname);
	echo " ><< ".translate("Previous week")."</a> &nbsp; ";
	}
if ($ldy <= $calendyear) {
	echo "<a href=cal_adminweek.php?op=week&date=".date("Y-m-d", mktime(0,0,0,$month,$day+7,$year));
      urlvar($uname);
	echo " >".translate("Next week")." >> </a>\n";
}

// display the hyperlinks to each day
echo "</div></td><td align=right><div class=menufont><b>".translate("Go to").": </b>  &nbsp; ";
$afd = $fd ;
$ald = date("Y-m-d", mktime(0,0,0,$ldm,$ldd+1,$ldy));
while ($afd != $ald){
$fdy = substr($afd,0,4);

$fdm = substr($afd,5,2);
if (substr($fdm,0,1) == "0"){
 $fdm = str_replace("0","",$fdm);}
$fdd = substr($afd,8,2);
$weekday = date ("w", mktime(12,0,0,$fdm,$fdd,$fdy));
$weekday++;
echo "<a href='#$week[$weekday]' >" ;
echo ucfirst($week[$weekday])." - ".$fdd ;
echo "</a> &nbsp; " ;
$afd = date("Y-m-d", mktime(0,0,0,$fdm,$fdd+1,$fdy));
}
echo "</div></td></tr></table>" ;


$ld = date("Y-m-d", mktime(0,0,0,$ldm,$ldd+1,$ldy));
while ($fd != $ld){
	$fdy = substr($fd,0,4);
	$fdm = substr($fd,5,2);
	if (substr($fdm,0,1) == "0"){
	  $fdm = str_replace("0","",$fdm);
	  }
	$fdd = substr($fd,8,2);

	// display the day header
	echo "<table class=titlefont width=100% border=0 cellspacing=0><tr><td valign=middle align=left><div class=titlefont>" ;
	$weekday = date ("w", mktime(12,0,0,$fdm,$fdd,$fdy));
	$weekday++;
	echo "<a class=none name='$week[$weekday]'>" ;
	echo ucfirst($week[$weekday])." " ;
      echo "<a class=titlefont href='cal_adminday.php?op=day&date=".date("Y-m-d", mktime(0,0,0,$fdm,$fdd,$fdy)); 
	urlvar($uname) ;
	echo "'>".$fdd."</a>"." ".ucfirst($mth[$fdm])." ".$fdy ;
	echo "</a> &nbsp; <a href='cal_event.php?op=eventform&add_day=$fdd&add_month=$fdm&add_year=$fdy'><img src='../images/plus.gif' alt='".translate("Add Event")."' border=0 valign=middle width=11 height=11/></a>" ;
	echo "</div></td></tr></table>";

	// query and display events
	echo "<table class=weekevent width=100% border=0 cellspacing=0><tr><td>" ;

	$query = "select id,user,title,description,url,email,cat_name,starttime,endtime,day,month,year,approved from ".$EVENTS_TB." left join ".$CAT_TB." on ".$EVENTS_TB.".cat=".$CAT_TB.".cat_id where day='$fdd' and month='$fdm' and year='$fdy' ";

	if (($uname!="")&&($uname!="-")) {
		$query = $query." and ".$EVENTS_TB.".user='".$uname."' " ;
	      }
	$query = $query." order by starttime,title ASC";

	$result = mysql_query($query);
   	if (mysql_num_rows($result)==0) echo "<br/>" ;

   	while ($row = mysql_fetch_object($result)){
	if ($row->approved=='0') echo "<table class=weekevent width=100% border=0><tr><td bgcolor='$unapprovedclr'>" ;
	if ($notimeentry==0) {
	  if ($row->starttime=='') echo "<div><li>" ;
	  else showtime($row->starttime,$row->endtime,0);
	}
	else echo "<div><li>";
	echo "<b>".stripslashes($row->title) ;
	if ($showuserentry==1) echo " &nbsp;&lt;".$row->user."&gt;" ;
	echo "</b>";
	if (($notimeentry==1)||($row->starttime=='')) echo "</li></div>";
	else echo "<br/>\n";
	echo "<b>".translate("Category")." : "."</b>".stripslashes($row->cat_name)."<br/>";
	$de = $row->description ;
	//$de = str_replace("<br />","",$row->description);
	echo substr(stripslashes($de),0,$shortdesclen) ;
	if (($row->email!="")||($row->url!="")||(strlen($de)>$shortdesclen)) echo " ...\n";
	else echo "\n" ;
	echo "<br/>";
      echo "<div class=menufont><a href=cal_event.php?op=view&id=".$row->id.">".translate("View event")."</a>\n";
      echo " - <a href=cal_event.php?op=edit&id=".$row->id.">".translate("Edit event")."</a>\n";
      echo " - <a href=cal_event.php?op=delev&id=".$row->id.">".translate("Delete event")."</a>\n";
      if ($row->approved=='0')
        echo " - <a href=calendar.php?op=approve&id=".$row->id.">".translate("Approve")."</a>\n";
      echo "</div>\n" ;
	echo "<hr/>";
	if ($row->approved=='0') echo "</td></tr></table>\n" ;
	}
$fd = date("Y-m-d", mktime(0,0,0,$fdm,$fdd+1,$fdy));
echo "</td></tr></table>" ;
}


// display form functions
echo "<table border=0 width=100%><tr><td align=left width=50%>" ;
echo "<table width=100 cellspacing=0 cellpadding=2 align=left class=txtbox><tr><td bgcolor='$unapprovedclr' align=center><div class=normalfont>".translate("Unapproved events")."</div></td></tr></table>\n</td>" ;
echo "<td align=right valign=middle width=50%>" ;
echo "<form><div class=menufont>\n";
echo "<b>".translate("Go to week")." </b>" ;
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
echo "</select>\n";
echo "<b>".translate("or month")." </b>" ;
// get months
echo "<select name=gomonth onchange=\"javascript:gotomonth(this);\">\n";
for($i=1;$i<13;$i++){
 echo "\t<option value=".$i ;
 if ($ldm==$i) echo " selected " ;
 echo ">".ucfirst($mth[$i])."\n";
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
echo "</td></tr></table>" ;

}

switch ($op){
    
    // view per week 
    case"week":{
        week($week,$date);
    break;
    }
    
    // default: 
    default:{
	week($week,$date);
    break;
    }
}

include ('cal_footer.inc.php');

?>