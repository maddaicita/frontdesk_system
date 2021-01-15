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

include ('cal_header.inc.php');
include ("cal_utils.php") ;

calHeaderFunc();

if ($allowsearch==1) {
include ('search_func.php');

# search title
echo "<table width=100% border=0><tr><td align=left valign=middle>" ;
echo "<div class=searchheaderfont>".ucfirst(translate("search"))."</div></td></tr></table><br/><div class=normalfont>\n";

if (!isset($_POST['search']))
  $search = '';
else
  $search = sanitize($_POST['search'],'');
if (!isset($_POST['fday']))
  $fday = 0;
else
  $fday = $_POST['fday'];
if (!isset($_POST['fmonth']))
  $fmonth = 0;
else
  $fmonth = $_POST['fmonth'];
if (!isset($_POST['fyear']))
  $fyear = 0;
else
  $fyear = $_POST['fyear'];
if (!isset($_POST['tday']))
  $tday = 0;
else
  $tday = $_POST['tday'];
if (!isset($_POST['tmonth']))
  $tmonth = 0;
else
  $tmonth = $_POST['tmonth'];
if (!isset($_POST['tyear']))
  $tyear = 0;
else
  $tyear = $_POST['tyear'];
if (!isset($_POST['catsearch']))
  $catsearch = 0;
else
  $catsearch = $_POST['catsearch'];

echo "<form action=";
if ($allowsearch==1) {
  echo "cal_search.php method=post>\n";
  }
else echo ">\n";
echo "<input type=text name=search size=20 value='".$search."' >\n";
echo "<input type=submit value=\"".translate("search")."\">";
echo " &nbsp; &nbsp; " ;

echo "<b>".translate("From").": </b>\n";
// get days
echo "<select name=fday>\n\t<option value=0>".translate("Day")."\n";
for ($i = 1;$i<=31;$i++){
  echo "\t<option value=$i" ;
  if ($fday==$i) echo " selected " ;
  echo ">$i\n";
}
echo "</select>&nbsp;&nbsp;\n";

// get months
echo "<select name=fmonth>\n\t<option value=0>".translate("Month")."\n";
for($i=1;$i<13;$i++){
 echo "\t<option value=".$i ;
 if ($fmonth==$i) echo " selected " ;
 echo ">".ucfirst($mth[$i])."\n";
}
echo "</select>&nbsp;&nbsp;\n";

// get year from "calstartyear" and give "caladvanceyear" years more to select
echo "<select name=fyear>\n\t<option value=0>".translate("Year")."\n";
$year = date("Y");
for ($i=$calstartyear;$i<=($year+$caladvanceyear);$i++){
  echo "\t<option value=$i" ;
  if ($fyear==$i) echo " selected " ;
  echo ">$i\n";
}
echo "</select> &nbsp; &nbsp; &nbsp; \n";

echo "<b>".translate("To").": </b>\n";
// get days
echo "<select name=tday>\n\t<option value=0>".translate("Day")."\n";
for ($i = 1;$i<=31;$i++){
  echo "\t<option value=$i" ;
  if ($tday==$i) echo " selected " ;
  echo ">$i\n";
}
echo "</select>&nbsp;&nbsp;\n";

// get months
echo "<select name=tmonth>\n\t<option value=0>".translate("Month")."\n";
for($i=1;$i<13;$i++){
 echo "\t<option value=".$i ;
 if ($tmonth==$i) echo " selected " ;
 echo ">".ucfirst($mth[$i])."\n";
}
echo "</select>&nbsp;&nbsp;\n";

// get year from "calstartyear" and give "caladvanceyear" years more to select
echo "<select name=tyear>\n\t<option value=0>".translate("Year")."\n";
$year = date("Y");
for ($i=$calstartyear;$i<=($year+$caladvanceyear);$i++){
  echo "\t<option value=$i" ;
  if ($tyear==$i) echo " selected " ;
  echo ">$i\n";
}
echo "</select>&nbsp;&nbsp;\n";

echo "<b>".translate("Category").": </b>\n";
$cquery = "select cat_id,cat_name from ".$CAT_TB." order by cat_name ASC";
$cresult = mysql_query($cquery);
echo "<select name=catsearch>\n";
echo "\t<option value=0" ;
if ($catsearch==0) echo " selected " ;
echo ">".translate("All categories")."\n";

while ($crow = mysql_fetch_object($cresult)){
  echo "\t<option value=$crow->cat_id" ;
  if ($catsearch==$crow->cat_id) echo " selected " ;
    echo ">".stripslashes($crow->cat_name)."\n";
  }
echo "</select><br/>\n";

echo "</form></div>" ;

if (!$search){
        echo "<div class=searchheaderfont>".translate("No results")."</div><br/>\n";
}
elseif (strlen($search) < 3){
        echo "<div class=searchheaderfont>".translate("No results")."</div><br/>\n";
}
else {

	$query = "select id,title,description,url,cat_name,day,month,year from ".$EVENTS_TB." left join ".$CAT_TB." on ".$EVENTS_TB.".cat=".$CAT_TB.".cat_id where (title like '%$search%' OR description like '%$search%') AND approved = '1' ";

	if (($userview==1)&&($userlogin==1)) {  // view user specific events only
	  if ($ugroup!=0) {
	    $query = "select id,title,description,url,cat_name,day,month,year from ".$EVENTS_TB." left join ".$CAT_TB." on ".$EVENTS_TB.".cat=".$CAT_TB.".cat_id where (title like '%$search%' OR description like '%$search%') AND approved = '1' and ".$EVENTS_TB.".user='".$uname."'";
				}
			  }

	// Search within category
	if ($catsearch<>0) $query .= " and ".$EVENTS_TB.".cat=".intval($catsearch,10) ;

	// To append the date range in search if given dates are set
	$fromclause = FALSE ;
	$toclause = FALSE ;

	if (($fday!=0)&&($fmonth!=0)&&($fyear!=0)) $fromclause = TRUE ;
	if (($tday!=0)&&($tmonth!=0)&&($tyear!=0)) $toclause = TRUE ;	

	if ($fromclause) {
	  $query .= " and " ;
	  $query .= " (" ;
	  if ($toclause) $query .= "((" ;
	  $query .= "(year>'$fyear')" ;
	  if ($toclause) $query .= "&&(year<'$tyear'))" ;
	  $query .= "||" ;
	  if ($toclause) $query .= "(" ;
	  $query .= "(month>'$fmonth' and year='$fyear')" ;
	  if (($toclause)&&($fyear>=$tyear)) $query .= "&&" ;
	  else if ($toclause) $query .= "||" ;
	  if ($toclause) $query .= "(month<'$tmonth' and year='$tyear'))" ;
	  $query .= "||" ;
	  if ($toclause) $query .= "(" ;
	  $query .= "(day>=$fday and month='$fmonth' and year='$fyear')" ;
	  if (($toclause)&&($tmonth==$fmonth)&&($fyear==$tyear)) $query .= "&&" ;
	  else if (($toclause)&&($fyear>$tyear)) $query .= "&&" ;
	  else if (($toclause)&&($fmonth>=$tmonth)&&($fyear==$tyear)) $query .= "&&" ;
	  else if ($toclause) $query .= "||" ;
	  if ($toclause) $query .= "(day<=$tday and month='$tmonth' and year='$tyear'))" ;
	  $query .= ")" ;
	  if ($toclause) $query .= ")" ;
	  }
	if (($toclause)&&(!$fromclause)) {
	  $query .= " and ((year<'$tyear')||(month<'$tmonth' and year='$tyear')||(day<=$tday and month='$tmonth' and year='$tyear')) " ;
	  }

    $query .= " order by year ASC, month ASC, day ASC" ;

    $result = mysql_query($query);
    $rows = mysql_num_rows($result);
  
   if ($rows == 0)
	echo "<div class=searchheaderfont>".translate("No results")."</div><br/>\n";
   else {
    echo "<div class=searchheaderfont>$rows ".translate("results")."</div><br/>\n";
    while ($row = mysql_fetch_object($result)){
      echo "<div class=searchtitlefont><li>".stripslashes($row->title)." (".$row->day ." ".$mth[$row->month]." ".$row->year.")</li></div>";
      echo "<div class=searchtextfont><b>".translate("Category")." : </b>".stripslashes($row->cat_name)."</div>";
      $de = $row->description;
      //$de = str_replace("<br />","",$row->description);
      echo "<div class=searchtextfont>".substr(stripslashes($de),0,100)." ...</div>\n" ;
      if ($popupevent == 1)
        echo "<div class=menufont><a href=\"Javascript:void(0);\" onclick=\"Javascript:popup(".$row->id.");\">";
      else
        echo "<div class=menufont><a href=cal_event.php?id=".$row->id." >";
      echo translate("Read more")."</a></div>" ;
      echo "<br/>";
    }
  }
}

}

include ('cal_functions.inc.php');
include ('cal_footer.inc.php');
?>
