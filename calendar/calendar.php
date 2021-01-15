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
#  Copyright © 2002-2006 Vincent Hor
##########################################################################

include_once ('cal_header.inc.php');
include_once ("search_func.php");
include_once ("cal_utils.php") ;
include_once ("cal_rss.php") ;

calHeaderFunc();

/*****************/
/* view calendar */
/*****************/

function cal($month,$year){
global $CAT_TB,$EVENTS_TB,$USER_TB,$mth,$week,$language,$m,$d,$y,$viewcalok,$viewweekok,$viewdayok,$searchmonthok,$popupevent,$popupeventwidth,$popupeventheight,$calstartyear,$caladvanceyear,$allowsearch,$weekstartday,$addeventok,$userview,$userlogin,$userid,$addeventwin_w,$addeventwin_h,$catview,$uname,$ugroup,$showuserentry,$publicview,$limitmthevt,$notimeentry,$overlibbgclr,$rssfeeds,$rssactive,$rssview;

if (isset($rssview))
	$rsschannel = $rssfeeds[$rssview][0];
else
	$rsschannel = "None";

if ($viewcalok==1){

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

// Check RSS Feed
if ($rssactive==1)	$RSSData = RSS(1,1,2007);

// number of days in askedmonth
$nr = date("t",mktime(12,0,0,$month,1,$year));
echo "\n\n<table class=monthview align=center>";
    echo "<tr>";
        echo "<td align=left colspan=2 class=monthview width='28%' valign=middle>&nbsp;&nbsp;";

        if (($year > $calstartyear) || (($month > 1)&&($year == $calstartyear))) {
          echo "<a href=calendar.php?op=cal&amp;month=".$pm."&amp;year=".$py."&amp;catview=$catview class=calfontnav>".$mth[$pm]." &nbsp; ".$py."</a>"; 
	    $pdate = date("Y-m-d",mktime(0,0,0,$month-1,1,$year)) ;
	    echo " &nbsp; <a href='Javascript:void(0);' onclick=\"Javascript:wopen('smallcal.php?op=smallcal&date=$pdate','popupmonth',350,220,'no');\">" ;
	    echo "<img src='images/smallcal.gif' border=0 alt='".translate("Popup Month")."' valign=middle width=16 height=16/></a>" ;
	  }
	  else echo "&nbsp;" ;

        echo "</td>";
        echo "<td align=center colspan=3 class=monthview width='44%' >";
        echo "<div class=calfontasked>".$askedmonth." " ;
        echo " &nbsp; <a href='Javascript:void(0);' onclick=\"Javascript:wopen('yearcal.php?op=yearcal&ycyear=$askedyear','popupyear',610,600,'yes');\" class=calfontasked>" ;
	  echo $askedyear."</a></div>\n";
        echo "<td align=right colspan=2 class=monthview width='28%'>" ;
	  $calendyear = $y + $caladvanceyear ;
	  if ($ny <= $calendyear) {
	      $ndate = date("Y-m-d",mktime(0,0,0,$month+1,1,$year)) ;
	      echo " &nbsp; <a href='Javascript:void(0);' onclick=\"Javascript:wopen('smallcal.php?op=smallcal&date=$ndate','popupmonth',350,220,'no');\">" ;
		echo "<img src='images/smallcal.gif' border=0 alt='".translate("Popup Month")."' valign=middle width=16 height=16/></a> &nbsp; " ;
		echo "<a href=calendar.php?op=cal&amp;month=".$nm."&amp;year=".$ny."&amp;catview=$catview class=calfontnav>".$mth[$nm]." &nbsp; ".$ny."</a>" ; 	
		echo "&nbsp;&nbsp;";
	  }
	  else echo "&nbsp;" ;
    echo "</td></tr></table>\n\n";

    echo "<table align=center class=monthview cellspacing=1>";
    echo "<tr>";

        // make the header days of week
        for ($i=intval($weekstartday)+1;$i<=(intval($weekstartday) + 7);$i++){
            echo "<td align=center ";
            if (dayinweek($i) == 1)
                echo "class=sundaytopcolor><div class=dayfont>".$week[dayinweek($i)]."</div></td>\n"; // sunday
            else    
                echo "class=weekdaytopcolor><div class=dayfont>".$week[dayinweek($i)]."</div></td>\n"; // rest of week
            }

    echo "</tr>\n\n<tr>\n";

        // begin the days
	  // print initial blank squares
        for ($i=1;$i<=blankdays(intval($weekstartday),$firstday);$i++){
	    	echo "<td ";
            if (dayinweek($i) == 1)
            	echo "class=sundayemptyclr ";
            else 
                echo "class=weekdayemptyclr ";
          	echo ">&nbsp;</td>";
        }

        $a=0;
        for ($i=1;$i<=$nr;$i++){
            echo "<td ";
            if ($i == $d && $month == $m && $year == $y){ // highlight today's day
                echo "class=todayclr ";
            }
	  		else if (date("w",mktime(0,0,0,$month,$i,$year))==0) echo "class=sundayclr ";
        	else echo "class=weekdayclr ";

// click on date number to view events for the date
            echo " valign=top><table width='100%' border=0 cellspacing=1 cellpadding=1><tr><td align=left>" ;
			echo "<b>" ;
			if ($viewdayok==1) echo "<a class=datenumfont href='cal_day.php?op=day&amp;date=".date("Y-m-d", mktime(0,0,0,$month,$i,$year))."&catview=$catview'>" ;
			echo $i ;
			if ($viewdayok==1) echo "</a>" ;
			echo "</b></td>" ;
			echo "<td align=right> &nbsp; " ;
			if (date("w",mktime(0,0,0,$month,$i,$year))==$weekstartday) {
		  		if ($viewweekok==1)
					echo "<a href='cal_week.php?op=week&amp;date=".date("Y-m-d", mktime(0,0,0,$month,$i,$year))."&amp;catview=$catview'><img src='images/week.gif' alt='".translate("View week")." ".weekNumber($i,$month,$year)."' border=0 valign=middle width=11 height=11/></a> " ;
		  	}

			if ((($publicview==1)&&($uname!=""))||($publicview==0)) {
		  		if ($addeventok==1){
		    		echo "<a href='Javascript:void(0);' onclick=\"Javascript:wopen('cal_addevent.php?op=eventform&add_day=$i&add_month=$month&add_year=$year&catview=$catview','popupwin',".$addeventwin_w.",".$addeventwin_h.",'yes');\"><img src='images/plus.gif' alt='".translate("Add Event")."' border=0 valign=middle width=11 height=11/></a>" ;
		    	}
		  	}
			echo "</td></tr></table>" ;
			// now get RSS events
			if ($rssactive==1)
			{
				if (isset($RSSData[$i][$month][$year]))
				{

				  	echo "\n<table class=eventborder border=1 cellspacing=0 cellpadding=0 width=100%><tr><td align=center class=eventtimeborder valign=top>" ;				
					echo "\n<div class=smallcalev><b>" ;
										
				    // overlib line
		  			echo "<a href='Javascript:void(0);' onmouseover=\"return overlib('";
		  			echo "<table border=0 cellspacing=0 cellpadding=0 width=100%>" ;
              		for ($j=0; $j<=$RSSData[$i][$month][$year]['count']; $j++){
				    	echo "<tr><td align=center valign=top>" ;              			
				    	echo "<table class=eventborder border=1 cellspacing=0 cellpadding=0 width=100%><tr>";
		    			if ($notimeentry==0) 
						{
							echo "<td align=center class=eventtimeborder valign=top>" ;
			      			echo "<div class=smallcalevtime>";
			      			if (isset($RSSData[$i][$month][$year][$j]['starttime']))
			      			{
			      				if ($RSSData[$i][$month][$year][$j]['starttime']=='') echo "&nbsp; &nbsp;" ;
			      				else showtime($RSSData[$i][$month][$year][$j]['starttime'],$RSSData[$i][$month][$year][$j]['endtime'],1);
			      				echo "</div>" ;
			      				echo "</td>" ;
			      			}
		    			}
			    		echo "<td align=left valign=top width=80% class=eventborder>" ;
		      			echo "<div class=smallcalevtime>";              			
						echo "<a class=smallcalev href=\'".$RSSData[$i][$month][$year][$j]['link']."\' target=_BLANK>";
            			echo subquot(stripslashes($RSSData[$i][$month][$year][$j]['title']));
						echo "</a>";
		    			echo "</td></tr></table>" ;
		    			echo "</td></tr>" ;		    			
                	}
		  			echo "</table>" ;
		  			// overlib line
		  			echo "',FGCOLOR,'$overlibbgclr',TEXTSIZE,'1',WIDTH,'125',VAUTO,HAUTO,STICKY,CAPTION,'";
		  			echo $i." ".$askedmonth." ');\" onmouseout=\"return nd();\">";
					echo "[".$rsschannel."]";					  		
					echo "</a>";	
					echo "</b></div>\n" ;					
					echo "</td></tr></table>";								
				}
			}
            // now get eventual events on $i 
                $query = "select id,user,title,starttime,endtime from ".$EVENTS_TB." left join ".$CAT_TB." on ".$EVENTS_TB.".cat=".$CAT_TB.".cat_id where day='$i' and month='$month' and year='$year' and approved='1' " ;
		    if ($catview!=0) $query = $query." and ".$EVENTS_TB.".cat=$catview " ;
		    if (($userview==1)&&($userlogin==1)) {  // user view user specific events only
			if ($ugroup!=0) {
			  $query = $query." and ".$EVENTS_TB.".user='".$uname."' ";
			  }
			}

		    $query = $query." order by day,month,year,starttime,title ASC";
                $result = mysql_query($query);
		    $devtcnt = mysql_num_rows($result) ;		    
		    if (($limitmthevt!=0)&&($devtcnt!=0)&&($devtcnt>=$limitmthevt)) {
			echo "\n<div class=smallcalev><b>&nbsp; ## &nbsp;" ;

		  // overlib line
		  echo "<a href='cal_day.php?op=day&date=".date("Y-m-d", mktime(0,0,0,$month,$i,$year))."&catview=$catview' onmouseover=\"return overlib('";
		  echo "<table border=0 cellspacing=0 cellpadding=0 width=100%>" ;
              while ($row = mysql_fetch_object($result)){
		    	echo "<tr><td align=center valign=top>" ;
		    	echo "<table class=eventborder border=1 cellspacing=0 cellpadding=0 width=100%><tr>";
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
			// bug in overlib when putting hyperlink
		    	if ($popupevent == 1)
				echo "<a class=smallcalev href=\\'Javascript:void(0);\\' onclick=\\'Javascript:popup(".$row->id.");\\'>";
	   		else
				echo "<a class=smallcalev href=\\'cal_event.php?id=".$row->id."\\' >";

            	echo subquot(stripslashes($row->title));
				echo "</a>";
		    	echo "</div>" ;
		    	echo "</td></tr>" ;
		    	echo "</table>" ;
		    	echo "</td></tr>" ;
                }
		  echo "</table>" ;
		  // overlib line
		  echo "',FGCOLOR,'$overlibbgclr',TEXTSIZE,'1',WIDTH,'125',VAUTO,HAUTO,STICKY,CAPTION,'";
		  echo $i." ".$askedmonth." ');\" onmouseout=\"return nd();\">";

			echo $devtcnt." ".translate("events") ;
			echo "</a>";

			echo "&nbsp; ## &nbsp;</b></div>\n" ;
   			}
		    else if ($devtcnt!=0) {
		    echo "\n<table border=0 cellspacing=0 cellpadding=0 width='100%'>" ;
                while ($row = mysql_fetch_object($result)){
			echo "<tr><td align=center valign=top>\n" ;
			echo "<table class=eventborder border=1 cellspacing=0 cellpadding=0 width='100%'><tr>";
			if ($notimeentry==0) {
			  echo "<td align=center class=eventtimeborder valign=top>" ;
			  echo "<div class=smallcalevtime>" ;
			  if ($row->starttime=='') echo "&nbsp; &nbsp;" ;
			  else showtime($row->starttime,$row->endtime,1);
			  echo "</td>" ;
			}
			echo "<td align=left valign=top width='80%' class=eventborder>" ;
			if (($showuserentry==1)&&($uname!="")) echo "&lt;".$row->user."&gt; " ;
			if ($popupevent == 1)
			  echo "<a class=smallcalev href=\"Javascript:void(0);\" onclick=\"Javascript:popup(".$row->id.");\">";
			else
			  echo "<a class=smallcalev href=cal_event.php?id=".$row->id.">";
                  echo stripslashes($row->title)."</a>" ;
			echo "</td></tr>" ;
			echo "</table>" ;
                  }
		    echo "</table>\n" ;
		    }
            echo "</td>";
            $a++;
		if (blankdays(intval($weekstartday),date("w",mktime(0,0,0,$month,$i,$year))) == 6) 
		{
              echo "</tr>\n\n<tr>";
              $a = 0;
        }
    }
    // ending stuff (making 'white' td's to fill table
    if ($a != 0){
          $last = 7-$a;
          for ($i=1;$i<=$last;$i++) echo "<td class=weekdayemptyclr>&nbsp;</td>";
    }
echo "</tr>";
echo "</table>";

echo "<table width='100%' align=center border=0 cellspacing=1 cellpadding=0>";
echo "<tr><td align=center width='30%' valign=top>" ;
echo "<table class=txtbox width=70 align=left cellpadding=2 cellspacing=0><tr><td align=center class=todayclr><i><div class=normalfont>".translate("Today")."</div></i></td></tr></table>\n</td>" ;
echo "<td align=right valign=top width='30%'>";
echo "<form action=POST><div class=menufont>\n";
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
echo "</div></form>" ;
echo "</td>" ;
// display search
echo "<td align=right valign=bottom width='40%'>" ;
if (($allowsearch==1)&&($searchmonthok==1)) { search(); }
else echo "&nbsp;" ;
echo "</td></tr>";
echo "</table>";

}
else {
  echo "<br/><div class=titlefont>".translate("disabled").".</div>" ;
  }
}


switch ($op){
    
    // view cal per month
    case "cal":{
	  if (!$month) $month = $m ;
	  if (!$year) $year = $y ;
        cal($month,$year);
    break;
    }
    
    // default: 
    default:{
	if ($caldefault == 0)
     	  echo "<meta http-equiv=\"refresh\" content=\"0;url=cal_day.php\">";
	if ($caldefault == 1)
     	  echo "<meta http-equiv=\"refresh\" content=\"0;url=cal_week.php\">";
	if ($caldefault == 3)
     	  echo "<meta http-equiv=\"refresh\" content=\"0;url=cal_list.php\">";	
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

include ('cal_functions.inc.php');
include ('cal_footer.inc.php');

?>
