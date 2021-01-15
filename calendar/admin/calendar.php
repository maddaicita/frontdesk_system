<?php
##########################################################################
#  Please refer to the README file for licensing and contact information.
# 
#  This file has been updated for version 0.7.20060501 
# 
#  If you like this application, do support me in its development 
#  by sending any contributions at www.calendarix.com.
#
#
#  Copyright © 2002-2006 Vincent Hor
##########################################################################

include ("cal_admintop.php");

/************************************/
/* show nonapproved on default page */
/************************************/

function nonapproved(){
global $EVENTS_TB,$CAT_TB,$mth,$caleventapprove,$caleventadminapprove,$catcolor,$secondcatcolor;

$query = "select id,title,cat_name,day,month,year from ".$EVENTS_TB." left join ".$CAT_TB." on ".$EVENTS_TB.".cat=".$CAT_TB.".cat_id where approved='0' order by year,month,day,cat_name ASC";
$result = mysql_query($query);
$rows = mysql_num_rows($result);

echo "<table width=100% border=0 class=headerfont><tr><td align=left>".translate("Approvals")."</td></tr></table>\n";
echo "<div class=normalfont>";
if ($caleventapprove==1) { echo "<li><b>".translate("noapprove").".</b></li><br/>\n"; }
if ($caleventadminapprove==1) { echo "<li><b>".translate("noadminapprove").".</b></li><br/>\n"; }

if (!$rows){ echo "<b>".translate("nononapproved").".</b>\n"; }
else {
  echo "<table width=100% border=0 class=titlefont cellspacing=0><tr><td align=left>".translate("nonapproved").$rows."</td></tr></table>\n";
  $foo = '';
  while ($row = mysql_fetch_object($result)){
    $foo++ % 2 ? $color=$secondcatcolor : $color=$catcolor;
    echo "<table class=normalfont border=0 bgcolor=$color cellspacing=0 cellpadding=4 width=\"100%\">\n";
    echo "<tr><td>\n<b>".stripslashes($row->title)."</b> ".translate("on")." ".$row->day." ".$mth[$row->month]." ".$row->year."\n";
    echo " - ".translate("Category")." : <b>".stripslashes($row->cat_name)."</b>\n";
    echo " - <a href='cal_event.php?op=view&amp;id=".$row->id."'>".translate("View event")."</a>\n";
    echo " - <a href=cal_event.php?op=edit&amp;id=".$row->id.">".translate("Edit event")."</a>\n";
    echo " - <a href=cal_event.php?op=delev&amp;id=".$row->id.">".translate("Delete event")."</a>\n";
    echo " - <a href=calendar.php?op=approve&amp;id=".$row->id.">".translate("Approve")."</a>\n";
    echo "</td></tr>\n";
    echo "</table>\n";
    }
  }
echo "</div>\n";
}

/*****************/
/* approve event */
/*****************/

function approve($id){
global $EVENTS_TB;
  $result = mysql_query("update ".$EVENTS_TB." set approved='1' where id='$id'");
  echo "<h4>".translate("Approving event")." ...</h4>" ;
  echo "<meta http-equiv=\"refresh\" content=\"0; url=calendar.php\">";
}

/**************************/
/* view calender by month */
/**************************/

function cal($month,$year){
global $EVENTS_TB,$CAT_TB,$USER_TB,$mth,$week,$m,$d,$y,$unapprovedclr,$uname,$calstartyear,$caladvanceyear,$weekstartday,$showuserentry,$notimeentry;

// previous month
$pm = $month;
if ($month == "1")
    $pm = "12";
else
    $pm--;
// previous year
$py = $year;
if ($pm == "12")
    $py--;

// next month
$nm = $month;
if ($month == "12")
    $nm = "1";
else
    $nm++;
// next year
$ny = $year;
if ($nm == 1)
    $ny++;    

// get month we want to see
$askedmonth = $mth[$month];
$askedyear = $year;
$firstday = date ("w", mktime(12,0,0,$month,1,$year));
$firstday;

// used to count total number of events and unapproved events in the month
$countev = 0 ;
$countunev = 0 ;

// number of days in askedmonth
$nr = date("t",mktime(12,0,0,$month,1,$year));
echo "\n\n<table align=center class=monthview>";
    echo "<tr>";

        echo "<td align=left colspan=2 class=monthview width='28%'>&nbsp;&nbsp;";

        if (($year > $calstartyear) || (($month > 1)&&($year == $calstartyear))) {
          echo "<a href=calendar.php?op=cal&amp;month=".$pm."&amp;year=".$py ;
	    urlvar($uname);
	    echo " class=calfontnav>".$mth[$pm]." &nbsp; ".$py."</a>" ; 
	    $pdate = date("Y-m-d",mktime(0,0,0,$month-1,1,$year)) ;
	    echo " &nbsp; <a href='#' onclick=\"Javascript:wopen('smallcal.php?op=smallcal&date=$pdate','popupmonth',250,220,'no');\">" ;
	    echo "<img src='../images/smallcal.gif' border=0 alt='".translate("Popup Month")."' valign=middle width=16 height=16/></a>" ;
	    }

	  else echo "&nbsp;" ;

        echo "</td>";
        echo "<td align=center colspan=3 class=monthview width='44%'>";
        echo "<div class=calfontasked>".$askedmonth." " ;
        echo " &nbsp; <a href='#' onclick=\"Javascript:wopen('yearcal.php?op=yearcal&ycyear=$askedyear','popupyear',610,600,'yes');\" class=calfontasked>" ;
	  echo $askedyear."</a></div>" ;
        echo "<td align=right colspan=2 class=monthview width='28%'>" ;
	  $calendyear = $y + $caladvanceyear ;
	  if ($ny <= $calendyear) {
	      $ndate = date("Y-m-d",mktime(0,0,0,$month+1,1,$year)) ;
	      echo " &nbsp; <a href='#' onclick=\"Javascript:wopen('smallcal.php?op=smallcal&date=$ndate','popupmonth',250,220,'no');\">" ;
		echo "<img src='../images/smallcal.gif' border=0 alt='".translate("Popup Month")."' valign=middle width=16 height=16/></a> &nbsp; " ;
		echo "<a href=calendar.php?op=cal&amp;month=".$nm."&amp;year=".$ny ;
		urlvar($uname);
		echo " class=calfontnav>".$mth[$nm]." &nbsp; ".$ny."</a>"; 	
		echo "&nbsp;&nbsp;";
	  }
	  else echo "&nbsp;" ;
    echo "</td></tr></table>\n\n";


echo "<table align=center class=monthview cellspacing=1>";
    echo "<tr>";

        // make the header days of week
        for ($i=intval($weekstartday)+1;$i<=(intval($weekstartday) + 7);$i++){
            echo "<td align=center width=14% ";
            if (dayinweek($i) == 1)
                echo "class=sundaytopcolor><div class=dayfont>".$week[dayinweek($i)]."</div></td>\n"; // sunday
            else    
                echo "class=weekdaytopcolor><div class=dayfont>".$week[dayinweek($i)]."</div></td>\n"; // rest of week
            }

    echo "</tr>\n\n<tr>\n";

        // begin the days
	  // print initial blank squares
        for ($i=1;$i<=blankdays(intval($weekstartday),$firstday);$i++){
	    echo "<td width=14% class=";
                if (dayinweek($i) == 1)
                    echo "sundayemptyclr ";
                else 
                    echo "weekdayemptyclr ";
          echo ">&nbsp;</td>";
        }

        $a=0;
        for ($i=1;$i<=$nr;$i++){
            echo "<td width=14% ";
            if ($i == $d && $month == $m && $year == $y){ // highlight today's day
                echo "class=todayclr ";
            }
	  else if (date("w",mktime(0,0,0,$month,$i,$year))==0) echo "class=sundayclr ";
        else echo "class=weekdayclr ";

// click on date number to view events for the date
            echo " valign=top><table width=100% border=0 cellspacing=1 cellpadding=1><tr><td align=left>" ;
		echo "<b><a class=datenumfont href='cal_adminday.php?op=day&amp;date=".date("Y-m-d", mktime(0,0,0,$month,$i,$year));
		urlvar($uname);
		echo "'>".$i."</a></b></td>" ;
		echo "<td align=right> &nbsp; " ;
		if (date("w",mktime(0,0,0,$month,$i,$year))==$weekstartday) {
			echo "<a href='cal_adminweek.php?op=week&amp;date=".date("Y-m-d", mktime(0,0,0,$month,$i,$year)) ;
		      urlvar($uname);
			echo "'><img src='../images/week.gif' alt='".translate("View week")." ".weekNumber($i,$month,$year)."' border=0 valign=middle width=11 height=11/></a> " ;
			}
		echo "<a href='cal_event.php?op=eventform&amp;add_day=$i&amp;add_month=$month&amp;add_year=$year'><img src='../images/plus.gif' alt='".translate("Add Event")."' border=0 valign=middle width=11 height=11/></a>" ;

		echo "</td></tr></table>" ;

            // now get eventual events on $i 
                $query = "select id,user,title,starttime,endtime,approved from ".$EVENTS_TB." left join ".$CAT_TB." on ".$EVENTS_TB.".cat=".$CAT_TB.".cat_id where day='$i' and month='$month' and year='$year'" ;
		    if (($uname!="")&&($uname!="-")) {
			$query = $query." and ".$EVENTS_TB.".user='".$uname."' " ;
		      }
		    $query = $query." order by day,month,year,starttime,title ASC";
                $result = mysql_query($query);
		    if (mysql_num_rows($result)!=0) {
		    $countev = $countev + mysql_num_rows($result) ;
		    echo "\n<table border=0 cellspacing=0 cellpadding=0 width=100%>" ;
                while ($row = mysql_fetch_object($result)){
			echo "<tr><td align=center valign=top " ;
			if ($row->approved=='0') { echo "bgcolor='$unapprovedclr'" ; $countunev++ ;}
			echo ">" ; 
			echo "<table class=eventborder cellspacing=0 cellpadding=0 width='100%'><tr>";
			if ($notimeentry==0) {
			  echo "<td align=center class=eventtimeborder valign=top>" ;
			  echo "<div class=smallcalevtime>" ;
			  if ($row->starttime=='') echo "&nbsp; &nbsp;" ;
			  else showtime($row->starttime,$row->endtime,1);
			  echo "</div></td>" ;
			}
			echo "<td align=left valign=top ";
			if ($row->approved=='0') echo "bgcolor='$unapprovedclr'" ;
			echo " width='80%' class=eventborder>" ;
			if ($showuserentry==1) echo "&lt;".$row->user."&gt; " ;
			echo "<a class=smallcalev href=cal_event.php?op=view&amp;id=".$row->id.">";
                  echo stripslashes($row->title)."</a>" ;
			echo "</td></tr>" ;
			echo "</table>" ;
                  }
		    echo "</table>\n" ;
		    }
            echo "</td>";
            $a++;
		if (blankdays(intval($weekstartday),date("w",mktime(0,0,0,$month,$i,$year))) == 6) {
              echo "</tr>\n\n<tr>";
              $a = 0;
              }

        }
        // ending stuff (making 'white' td's to fill table
        if ($a != 0){
        $last = 7-$a;
            for ($i=1;$i<=$last;$i++){
                echo "<td class=weekdayemptyclr>&nbsp;</td>";
            }
        }
    echo "</tr>";
echo "</table>";

echo "<table align=center width=100% border=0 cellspacing=1 cellpadding=0>";
echo "<tr><td width=60% align=left valign=top><div class=normalfont>";
echo "<table width=70 cellspacing=0 cellpadding=2 class=txtbox align=left><tr><td class=todayclr align=center><div class=normalfont>".translate("Today")."</div></td></tr></table>" ;
echo "<table width=100 cellspacing=0 cellpadding=2 class=txtbox align=left><tr><td bgcolor='$unapprovedclr' align=center><div class=normalfont>".translate("Unapproved events")."</div></td></tr></table>" ;
echo " &nbsp; <b>".translate("Total number of events for the month").": ".$countev."</b><br/> " ;
echo " &nbsp; <b>".translate("Total unapproved events for the month").": ".$countunev."</b><br/> " ;
echo "</div>";
echo "</td>" ;
echo "<td width=40% align=right valign=top>";
echo "<form action='#'><div class=menufont>\n";
echo "<b>".translate("Go to").": </b>" ;
// get months
echo "<select name=gomonth onchange=\"javascript:gotomonth(this);\">\n";
for($i=1;$i<13;$i++){
 echo "\t<option value=".$i ;
 if ($month==$i) echo " selected " ;
 echo ">".ucfirst($mth[$i])."\n";
 }
echo "</select>&nbsp;&nbsp;\n";
// get year from "calstartyear" and give "caladvanceyear" years more to select
echo "<select name=goyear onchange=\"javascript:gotoyear(this);\">\n";
for ($i=$calstartyear;$i<=($y+$caladvanceyear);$i++){
  echo "\t<option value=$i" ;
  if ($year==$i) echo " selected " ;
  echo ">$i\n";
}
echo "</select><br/>\n";

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
echo "</select>\n";
echo "</div></form>" ;
echo "</td></tr>";
echo "</table>";

}

switch ($op){

    // approve event
    case "approve":{
        approve($id);
    break;
    }

    // view cal per month
    case"cal":{
	  if (!$month) $month = $m ;
	  if (!$year) $year = $y ;
        cal($month,$year);
    break;
    }
    
    // approval page
    case"approval":{
        nonapproved();
    break;
    }
 
    // default: 
    default:{
	if ($caldefault == 0)
     	  echo "<meta http-equiv=\"refresh\" content=\"0;url=cal_adminday.php\">";
	if ($caldefault == 1)
     	  echo "<meta http-equiv=\"refresh\" content=\"0;url=cal_adminweek.php\">";
	if ($caldefault == 2){
		if (!$month)
			$month = $m;
		if (!$year)
			$year = $y;
        	cal($month,$year);
	}
    break;
    }
}

include ('cal_footer.inc.php');
?>
