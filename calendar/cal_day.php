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


/***********************/
/* view events per day */
/***********************/

function day($ask,$date){
global $EVENTS_TB,$CAT_TB,$USER_TB,$mth,$week,$m,$d,$y,$viewweekok,$viewcalok,$viewdayok,$allowsearch,$searchdayok,$popupevent,$popupeventwidth,$popupeventheight,$calstartyear,$caladvanceyear,$addeventok,$userview,$userlogin,$userid,$addeventwin_w,$addeventwin_h,$shortdesclen,$catview,$ugroup,$uname,$showuserentry,$publicview,$dayview_w,$notimeentry ;

if (!isset($yda))
  $yda = '';

if ($viewdayok==1){

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

echo "<table border=0 width=$dayview_w cellspacing=0 align=center class=headerfont><tr><td align=left>".translate("Events for day");
echo ": ".$week[$we]." ".$day." " ;
if (($year<=($y+$caladvanceyear))&&($year>=($calstartyear))) {
	if ($viewcalok==1) echo "<a class=headerfont href='calendar.php?op=cal&month=".$vdm."&year=".$year."&catview=$catview'>" ;
	}
echo $mth[$vdm];
if (($year<=($y+$caladvanceyear))&&($year>=($calstartyear))) { 
	if ($viewcalok==1) echo "</a>" ; 
	}
echo " ".$year." &nbsp; &nbsp; " ;
if ($viewweekok==1) echo "<a href='cal_week.php?op=week&date=".date("Y-m-d", mktime(0,0,0,$month,$day,$year))."&catview=$catview'><img src=\"images/week.gif\" border=0 alt='".translate("View week")." $weeknumber"."' width=16 height=16/></a>" ;

	$weekday = date ("w", mktime(12,0,0,$vdm,$vda,$year));
	$weekday++;

if ((($publicview==1)&&($uname!=""))||($publicview==0)) {
  if ($addeventok==1){
    echo " &nbsp; <a href='#$week[$weekday]' onclick=\"Javascript:wopen('cal_addevent.php?op=eventform&add_day=$day&add_month=$month&add_year=$year&catview=$catview','popupwin',".$addeventwin_w.",".$addeventwin_h.",'yes');\"><img src='images/plus.gif' border=0 valign=middle alt='".translate("Add Event")."' width=11 height=11/></a>" ;
  }
}

echo "</td>" ;
echo "<td align=right><div class=menufont>" ;

// display previous day and next day navigation
if (($year > $calstartyear) || (($vdm > 1)&&($year == $calstartyear)) || (($vdm == 1)&&($year == $calstartyear)&&($vda>1))) {
  echo "<a href=\"cal_day.php?op=day&date=".date("Y-m-d", mktime(0,0,0,$month,$day-1,$year))."&catview=$catview
\"><< ".translate("Previous day")."</a> &nbsp; " ;
}
else echo "&nbsp;" ;
$calendyear = $y + $caladvanceyear ;
if (($year < $calendyear) || (($vdm < 12)&&($year == $calendyear)) || (($vdm == 12)&&($year == $calendyear)&&($vda<31))) {
    echo "<a href=\"cal_day.php?op=day&date=".date("Y-m-d", mktime(0,0,0,$month,$day+1,$year))."&catview=$catview\">".translate("Next day")." >></a> &nbsp; <br/>";
}
else echo "&nbsp;" ;
echo "</div></td></tr></table>";

$query = "select id,user,title,description,url,email,cat_name,starttime,endtime,day,month,year from ".$EVENTS_TB." left join ".$CAT_TB." on ".$EVENTS_TB.".cat=".$CAT_TB.".cat_id where day='$vda' and month='$vdm' and year='$year' and approved='1'";

if ($catview!=0)  $query = $query." and ".$EVENTS_TB.".cat=$catview";

if (($userview==1)&&($userlogin==1)) {  // user view user specific events only
  if ($ugroup!=0) {
	$query = $query. " and user='".$uname."'" ;
    }
  }

$query = $query." order by starttime,title ASC" ;
$result = mysql_query($query);
echo "<table width=$dayview_w class=dayevent cellspacing=0 align=center><tr><td align=left>" ;
if (mysql_num_rows($result)!=0) {
  while ($row = mysql_fetch_object($result)){
    if ($notimeentry==0) {
	  if ($row->starttime=='') echo "<li>" ;
	  else showtime($row->starttime,$row->endtime,0);
	}
	else echo "<li>";
	echo "<b>" ;
	echo stripslashes($row->title) ;
	if (($showuserentry==1)&&($uname!="")) echo " &nbsp;&lt;".$row->user."&gt;" ;
	echo "</b>";
	if (($notimeentry==1)||($row->starttime=='')) echo "</li>";
	else echo "<br/>";
    echo translate("Category")." : ".stripslashes($row->cat_name)."<br/>";
	$de = $row->description;
//    $de = str_replace("<br />","",$row->description);
    echo substr(stripslashes($de),0,$shortdesclen) ;
    if (($row->email!="")||($row->url!="")||(strlen($de)>$shortdesclen)) echo " ...\n";
    else echo "\n" ;
    echo "<br/>";
    if ($popupevent == 1)
      echo "<div class=menufont><a href=\"Javascript:void(0);\" onclick=\"Javascript:popup(".$row->id.");\">" ;
    else
      echo "<div class=menufont><a href=cal_event.php?id=".$row->id.">";
    echo translate("Read more")."</a></div>";
    echo "<hr/>";
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
  echo "case \"".$i."\" : { window.location.href='cal_day.php?op=day&date=" ;
  echo date("Y-m-d", mktime(0,0,0,$month,$i,$year)) ;
  echo "&catview=$catview' ; break ;} \n" ;
}
echo "default : { window.location.href='cal_day.php?op=day&date=".date("Y-m-d", mktime(0,0,0,$month,$day,$year))."&catview=$catview' ; break;} \n" ;
echo "\t\t}\n" ;
echo "\t}\n" ;
echo "</script>" ;


// display form functions
echo "<table border=0 width=$dayview_w align=center><tr><td align=left width=34%>&nbsp;</td>" ;
echo "<td align=center valign=middle width=33%>" ;
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

if ($viewweekok==1) {
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
echo "</select>&nbsp;&nbsp;\n";
}
echo "</div></form>" ;
echo "</td>" ;
echo "<td align=right valign=middle width=33%>" ;
if (($allowsearch==1)&&($searchdayok == 1)) search();
echo "</td></tr></table>" ;

}
else  {
  echo "<br/><div class=titlefont>".translate("disabled").".</div>" ;
  }
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

include ('cal_functions.inc.php');
include ('cal_footer.inc.php');

?>
