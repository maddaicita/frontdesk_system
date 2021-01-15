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

include ('cal_header.inc.php');
include ("search_func.php");
include ("cal_utils.php") ;


calHeaderFunc();


/**************************/
/* overview of categories */
/**************************/

function cats($catcolor,$year){
global $EVENTS_TB,$CAT_TB,$USER_TB,$viewcatsok,$searchcatsok,$allowsearch,$mth,$secondcatcolor,$calstartyear,$caladvanceyear,$y,$userview,$userlogin,$userid,$catview,$eventcatfilter,$uname,$ugroup,$catview_w;

if ($viewcatsok==1){
  $query = "select cat_id,cat_name from ".$CAT_TB." order by cat_name ASC" ;
  $result = mysql_query($query);
  $rows = mysql_num_rows($result);

  if (($eventcatfilter==1)&&($catview!=0)) { 
	$query = "select cat_id,cat_name from ".$CAT_TB." where cat_id=$catview";
	}
  $result = mysql_query($query);

    // if no rows
    if ($rows == "0"){
        echo "<br/><div class=headerfont>".translate("No categories yet").".</div><br/>\n";
    }
    // show categories
    else {
        echo "<table border=0 width='$catview_w' cellspacing=0 class=headerfont><tr><td align=left>".translate("Categories")."&nbsp; (".$rows.")</td></tr></table>\n";
        echo "<table border=0 cellspacing=0 cellpadding=0 width='$catview_w'>\n";
  	  $foo = '';
        while ($row = mysql_fetch_object($result)){
            $foo++ % 2 ? $color=$catcolor : $color=$catcolor;
            echo "<tr bgcolor=$color><td>" ;
		echo "<table class=titlefont width='$catview_w' border=0 cellspacing=0 cellpadding=4><tr><td align=left><div class=titlefont><a href=cal_cat.php?op=cat&amp;id=".$row->cat_id."&amp;catview=$catview>".stripslashes($row->cat_name)."</a>" ;

		// get total number of events under category
		$tquery = "select id from ".$EVENTS_TB." where ".$EVENTS_TB.".cat='".$row->cat_id."' and ".$EVENTS_TB.".approved='1' " ;

		$normuser = false ;

		if (($userview==1)&&($userlogin==1)&&($uname!="")) {  // view user specific events only
		  if ($ugroup!=0) {
		    $normuser = true ;
		    $tquery = "select * from ".$EVENTS_TB.",".$USER_TB." where ".$EVENTS_TB.".cat='".$row->cat_id."' and ".$EVENTS_TB.".approved='1' and ".$EVENTS_TB.".user=".$USER_TB.".username and ".$USER_TB.".user_id=".$userid ;
		    }
              }

		$tresult = mysql_query($tquery);
		$trows = mysql_num_rows($tresult);
		echo " &nbsp; &nbsp; (".$trows." ".translate("events for whole calendar").")</div></td></tr></table>" ;
		echo "<table class=normalfont border=0 width='$catview_w' cellspacing=0 cellpadding=3 align=left>" ;
		$totalyearevents = 0 ;
		for ($i=1;$i<13;$i++) {
			if ($normuser) 
			  $mquery = "select * from ".$EVENTS_TB.", ".$USER_TB." where ".$EVENTS_TB.".cat='$row->cat_id' and ".$EVENTS_TB.".year='$year' and ".$EVENTS_TB.".month='$i' and ".$EVENTS_TB.".approved='1' and ".$EVENTS_TB.".user=".$USER_TB.".username and ".$USER_TB.".user_id=".$userid ;
			else
			  $mquery = "select id from ".$EVENTS_TB." where ".$EVENTS_TB.".cat='$row->cat_id' and ".$EVENTS_TB.".year='$year' and ".$EVENTS_TB.".month='$i' and ".$EVENTS_TB.".approved='1'";	  
			$mresult = mysql_query($mquery);
			$mrows = mysql_num_rows($mresult);
			echo "<tr><td align=right >" ;
			$totalyearevents = $totalyearevents + $mrows ;
			if ($mrows!=0) echo " $mrows " ;
			else echo " 0 " ;
			echo "</td><td align=left width='100%'>" ;
			echo translate("events for")." ";
			if ($mrows!=0) echo "<a href=cal_cat.php?op=cat&amp;id=".$row->cat_id."&amp;year=".$year."&amp;catmonth=$i&catview=$catview >" ;
			echo $mth[$i] ;
			if ($mrows!=0) echo "</a>" ;
			echo " ".$year.". " ;
			echo "</td></tr>" ;
			}
		echo "<tr bgcolor='$secondcatcolor'><td align=right><b>".$totalyearevents."</b></td><td align=left width='100%'>" ;
		echo "<b>".translate("events for year")." ".$year.". "."</b></td></tr>";
		echo "</table></td></tr>\n";
        }
        echo "</table>\n";
    }


// this is for the goto year under categories redirection javascript
echo "<script language=\"JavaScript\" type=\"text/JavaScript\">\n" ;
echo "\tfunction gotocatyear(selectopt) {\n" ;
echo "var geti = '1' ;\n" ;
echo "for (i=0;i<selectopt.options.length;i++) {\n" ;
echo "\tif (selectopt.options[i].selected) {\n" ;
echo "\t\tgeti = selectopt.options[i].value ;\n" ;
echo "\t\tbreak ;\n" ;
echo "\t}\n" ;
echo "}\n\n" ;
echo "\t\tswitch (geti) { \n" ;

for ($i=$calstartyear;$i<=($y+$caladvanceyear);++$i) {
  echo "case \"$i\" : { window.location.href='cal_cat.php?op=cats&year=".$i."&catview=$catview' ; break ;} \n" ;
}

echo "default : { window.location.href='cal_cat.php?op=cats&year=".$y."&catview=$catview' ; break;} \n" ;
echo "\t\t}\n" ;
echo "\t}\n" ;
echo "</script>" ;

// display form functions
echo "<table border=0 width='$catview_w'><tr><td align=left width='34%'>&nbsp;</td>" ;
echo "<td align=center valign=middle width='33%'>" ;
echo "<form><div class=menufont>\n";
// get year from "calstartyear" and give "caladvanceyear" years more to select
echo "<b>".translate("View categories in year")." :</b> &nbsp;" ;
echo "<select name=gocatyear onchange=\"javascript:gotocatyear(this);\">\n";
for ($i=$calstartyear;$i<=($y+$caladvanceyear);$i++){
  echo "\t<option value=$i" ;
  if ($year==$i) echo " selected " ;
  echo ">$i\n";
}
echo "</select>\n";
echo "</div></form>" ;
echo "</td>" ;
echo "<td align=right valign=middle width='33%'>" ;
if (($allowsearch==1)&&($searchcatsok == 1)) search();
echo "</td></tr></table>" ;

}
else {
  echo "<br/><div class=titlefont>".translate("disabled").".</div>" ;
  }
}

/*******************************/
/* view events of one category */
/*******************************/

function cat($id,$catcolor,$secondcatcolor,$year,$sort){
global $EVENTS_TB,$USER_TB,$CAT_TB,$language,$mth,$popupevent,$popupeventheight,$popupeventwidth,$catview_w,$allowsearch,$y,$searchcatsok,$calstartyear,$caladvanceyear,$userid,$userview,$userlogin,$ugroup,$uname,$catview,$limitrow;

if (!isset($_GET['catmonth']))
  $catmonth = '';
else
  $catmonth = $_GET['catmonth'];
if (!isset($_GET['limit']))
  $limit = 0 ;
else
  $limit = $_GET['limit'] ;

if ($catview!=0) $id = $catview ;

$qstr = " * " ;
$query = " from ".$EVENTS_TB." left join ".$CAT_TB." on ".$EVENTS_TB.".cat=".$CAT_TB.".cat_id where approved='1' and ".$EVENTS_TB.".cat='$id' and ".$EVENTS_TB.".year='$year' ";

if ($catmonth!='') $query = $query . " and month='$catmonth' " ;

if (($userview==1)&&($userlogin==1)&&($uname!="")) {
  if ($ugroup!=0) {
    $query = " from ".$EVENTS_TB.", ".$USER_TB." where ".$EVENTS_TB.".approved='1' and ".$EVENTS_TB.".cat='$id' and ".$EVENTS_TB.".year='$year' and ".$EVENTS_TB.".user=".$USER_TB.".username and ".$USER_TB.".user_id=".$userid ;
    if ($catmonth!='') $query = $query . " and month='$catmonth' " ;
    }
}

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
// echo "<h4>".$query."</h4>";
$result = mysql_query($query);
$rowname = mysql_fetch_object($result);
$rows = mysql_num_rows($result);


// this is for the category sort order redirection javascript
echo "<script language=\"JavaScript\" type=\"text/JavaScript\">\n" ;
echo "\tfunction sortev(order) {\n" ;
echo "\t\tswitch (order) { \n" ;
echo "case 1 : { window.location.href='cal_cat.php?op=cat&id=".$id."&year=".$year."&sort=1&catmonth=".$catmonth."&catview=$catview&limit=$limit' ; break ;} \n" ;
echo "case 2 : { window.location.href='cal_cat.php?op=cat&id=".$id."&year=".$year."&sort=2&catmonth=".$catmonth."&catview=$catview&limit=$limit' ; break ;} \n" ;
echo "default : { window.location.href='cal_cat.php?op=cat&id=".$id."&year=".$y."&sort=2&catmonth=".$catmonth."&catview=$catview&limit=$limit' ; break;} \n" ;
echo "\t\t}\n" ;
echo "\t}\n" ;
echo "</script>" ;

$cquery = "select cat_name from ".$CAT_TB." where cat_id='$id' " ;
$cresult = mysql_query($cquery) ;
$crow = mysql_fetch_object($cresult) ;

echo "<form>\n";
echo "<table class=titlefont width='$catview_w' border=0 cellspacing=0><tr><td align=left valign=top width='40%'>" ;
echo "<div class=titlefont>".translate("Events in category").": &nbsp; ".stripslashes($crow->cat_name)."</div>" ; 
echo "</td><td valign=top width='30%' align=left>" ;

// previous and next row set
echo "<div class=menufont><input type='button' value='&nbsp;&lt;&nbsp;' title='".translate("Previous")."' onclick=\"Javascript:window.location.href='cal_cat.php?op=cat&id=".$id."&year=".$year."&sort=$sort&catmonth=".$catmonth."&catview=$catview&limit=".($limit-$limitrow)."' ;\" " ;
if ($limit==0)  echo " disabled " ;
echo "> &nbsp; \n" ;
echo "<b> &nbsp; ".($limit+1)." - ";
if (($limit+$limitrow)<$totalrows) echo ($limit+$limitrow) ;
else echo $totalrows ;
echo "/".$totalrows ;
echo " ".translate("events")." &nbsp; " ;
echo "</b> &nbsp; \n" ;
echo "<input type='button' value='&nbsp;&gt;&nbsp;' title='".translate('Next')."' onclick=\"Javascript:window.location.href='cal_cat.php?op=cat&id=".$id."&year=".$year."&sort=$sort&catmonth=".$catmonth."&catview=$catview&limit=".($limit+$limitrow)."' ;\" " ;
if (($limit+$limitrow)>=$totalrows) echo " disabled " ;
echo "> </b></div>\n" ;
echo "</td><td align=right valign=top width='30%'><div class=menufont><b>".translate("Sort by").": </b>" ;
echo " &nbsp; &nbsp; <a href='#' onclick=\"Javascript:sortev(1);\"><img src='images/sort1.gif' border=0 alt='".translate("Sort by events")."'/></a>" ;
echo " &nbsp;<a href='#' onclick=\"Javascript:sortev(2);\"><img src='images/sort2.gif' border=0 alt='".translate("Sort by date")."'/></a>" ;
echo " &nbsp;</div></td></tr></table>\n";

if (!$rows) {
	echo "<br/><div class=titlefont>".translate("No events").".</div><br/>\n";
	}
else {

	$result = mysql_query($query);
	$foo = '';
	while ($row = mysql_fetch_object($result)){

	  $foo++ % 2 ? $color=$catcolor : $color=$secondcatcolor;

	  echo "<table class=normalfont border=0 bgcolor=$color cellspacing=0 cellpadding=4 width='$catview_w'>\n";
	  echo "<tr><td>\n<li>" ;
	  if ($popupevent == 1)
	    echo "<a href=\"Javascript:void(0);\" onclick=\"Javascript:popup(".$row->id.");\">";
	  else
	    echo "<a href=cal_event.php?id=".$row->id.">";
	  echo stripslashes($row->title)."</a> ".translate("on")." ".$row->day." ".$mth[$row->month]." ".$row->year."\n";
	  echo "</li></td></tr>\n";
	  echo "</table>\n";
	  }
}


// this is for the goto year under categories redirection javascript
echo "<script language=\"JavaScript\" type=\"text/JavaScript\">\n" ;
echo "\tfunction gotocatevyear(selectopt) {\n" ;
echo "var geti = '1' ;\n" ;
echo "for (i=0;i<selectopt.options.length;i++) {\n" ;
echo "\tif (selectopt.options[i].selected) {\n" ;
echo "\t\tgeti = selectopt.options[i].value ;\n" ;
echo "\t\tbreak ;\n" ;
echo "\t}\n" ;
echo "}\n\n" ;
echo "\t\tswitch (geti) { \n" ;
for ($i=$calstartyear;$i<=($y+$caladvanceyear);++$i) {
  echo "case \"$i\" : { window.location.href='cal_cat.php?op=cat&id=".$id."&year=".$i."&sort=".$sort."&catmonth=".$catmonth."&catview=$catview&limit=$limit' ; break ;} \n" ;
}
echo "default : { window.location.href='cal_cat.php?op=cat&id=".$id."&year=".$y."&catmonth=".$catmonth."&catview=$catview&limit=$limit' ; break;} \n" ;
echo "\t\t}\n" ;
echo "\t}\n" ;
echo "</script>" ;

// this is the goto month under categories redirection javascript
echo "<script language=\"JavaScript\" type=\"text/JavaScript\">\n" ;
echo "\tfunction gotocatevmonth(selectopt) {\n" ;
echo "var geti = '1' ;\n" ;
echo "for (i=0;i<selectopt.options.length;i++) {\n" ;
echo "\tif (selectopt.options[i].selected) {\n" ;
echo "\t\tgeti = selectopt.options[i].value ;\n" ;
echo "\t\tbreak ;\n" ;
echo "\t}\n" ;
echo "}\n\n" ;
echo "\t\tswitch (geti) { \n" ;
for ($i=1;$i<=12;++$i) {
  echo "case \"$i\" : { window.location.href='cal_cat.php?op=cat&id=".$id."&year=".$year."&sort=".$sort."&catmonth=".$i."&catview=$catview&limit=$limit' ; break ;} \n" ;
}
echo "default : { window.location.href='cal_cat.php?op=cat&id=".$id."&year=".$year."&catview=$catview&limit=$limit' ; break;} \n" ;
echo "\t\t}\n" ;
echo "\t}\n" ;
echo "</script>" ;


// display form functions
echo "<table border=0 width='$catview_w'><tr>" ;
echo "<td align=left valign=top width='50%'>\n" ;
echo "<div class=menufont>\n" ;
// get year from "calstartyear" and give "caladvanceyear" years more to select
echo "<b>".translate("View events under this category in year").": </b> &nbsp;" ;
echo "<select name=gocatevyear onchange=\"javascript:gotocatevyear(this);\">\n";
for ($i=$calstartyear;$i<=($y+$caladvanceyear);$i++){
  echo "\t<option value=$i" ;
  if ($year==$i) echo " selected " ;
  echo ">$i\n";
}
echo "</select>\n";
echo "&nbsp; <b>".strtolower(translate("Month")).": </b> &nbsp;" ;
echo "<select name=gocatevmonth onchange=\"javascript:gotocatevmonth(this);\">\n";
echo "\t<option value=''>--\n" ;
for ($i=1;$i<=12;$i++){
  echo "\t<option value=$i" ;
  if ($catmonth==$i) echo " selected " ;
  echo ">".$mth[$i]."\n";
}
echo "</select>\n";
echo "</div></td>" ;
echo "<td align=right valign=middle width='50%'>" ;
if (($allowsearch==1)&&($searchcatsok == 1)) search();
echo "</td></tr></table>" ;
echo "</form>\n";
}

switch ($op){
    
    // overview of category
    case "cats":{
	 if ($year) cats($catcolor,$year);
	 else cats($catcolor,$y);
    break;
    }

    // overview of one cat
    case "cat":{
	if (!isset($_GET['sort']))
	  $sort = '';
	else
	  $sort = $_GET['sort'];

        if ($year) cat($id,$catcolor,$secondcatcolor,$year,$sort);
	  else cat($id,$catcolor,$secondcatcolor,$y,$sort);
    break;
    }

    // default: 
    default:{
	cats($catcolor,$y);
      break;
	}
}

include ('cal_functions.inc.php');
include ('cal_footer.inc.php');

?>
