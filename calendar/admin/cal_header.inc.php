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

require "../cal_config.inc.php";

if (!isset($_GET['op']))
  $op = '';
else
  $op = $_GET['op'];

// if ($op == "eventform")  session_cache_limiter('public');
session_start();

$userid = "" ;

  if (isset($_SESSION["login"])){
    $callogin = $_SESSION["login"];
    $calpass = $_SESSION["password"];
    $row = 1;

    $query = "select user_id,username,password from ".$USER_TB." where username='".$callogin."' AND password='".$calpass."' AND group_id='0'";
    $result = mysql_query($query);
    $row = mysql_fetch_object($result);
    if (!$row) {
      header ("location: ".$protocol."://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/cal_login.php");
	exit();
	}
    else $userid = $row->user_id ;

  }
  else 
	{
      header ("location: ".$protocol."://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/cal_login.php");
	exit();
	}

$m = date("n");
$y = date("Y");
$d = date("j");

# some settings of vars
if (!isset($_GET['day']))
  $day = '';
else
  $day = date("j",mktime(0,0,0,$m,intval($_GET['day']),$y));
if (!isset($_GET['month']))
  $month = '';
else
  $month = date("n",mktime(0,0,0,intval($_GET['month']),1,$y));
if (!isset($_GET['year']))
  $year = '';
else
  $year = date("Y",mktime(0,0,0,$m,$d,intval($_GET['year'])));
if (!isset($_GET['date']))
  $date = '';
else
  $date = $_GET['date'];
if (!isset($_GET['ask']))
  $ask = '';
else
  $ask = $_GET['ask'];
if (!isset($_GET['id']))
  $id = '';
else
  $id = $_GET['id'];
if (!isset($_GET['uname']))
  $uname = '';
else
  $uname = $_GET['uname'];

if (isset($_GET['userid']))
  $userid = $_GET['userid'];
if (!isset($_GET['timeout']))
  $timeout = 3600 ;

if ((date("G")+$timezone)>24) {
	$d = date("j",mktime(0,0,0,$m,date("j")+1,$y)) ;
	$m = date("n",mktime(0,0,0,$m,date("j")+1,$y)) ;
	$y = date("Y",mktime(0,0,0,$m,date("j")+1,$y)) ;
	}
if ((date("G")+$timezone)<0) {
	$d = date("j",mktime(0,0,0,$m,date("j")-1,$y)) ;
	$m = date("n",mktime(0,0,0,$m,date("j")-1,$y)) ;
	$y = date("Y",mktime(0,0,0,$m,date("j")-1,$y)) ;
	}

// check if there is a week 53 to display based on weekstartday
function showWeek53($cyear) {
	$ShowWeek53 = false ;
	$weeknum = weekNumber(31,12,$cyear) ;
	if ($weeknum>52) $ShowWeek53 = $weeknum ;
	settype($ShowWeek53,"integer");
	return $ShowWeek53 ;
}

/***************************/
/* get weeknumber function */
/***************************/

// weeknumber according to standard ISO 8601
function weekNumber($wday,$wmonth,$wyear) {
global $weekstartday ;
	if (substr($wmonth,0,1) == "0"){ $wmonth = str_replace("0","",$wmonth);}
	if (substr($wday,0,1) == "0"){ $wday = str_replace("0","",$wday);}
	$WeekNumber = 1;
	$firstdayofyear = date("w", mktime(0,0,0,1,1,$wyear)) ;
	$dayoffset = $firstdayofyear + 6; 
    $WeekNumber = floor(((date("z", mktime(0,0,0,$wmonth,$wday,$wyear)))+$dayoffset) / 7) ;
	settype($WeekNumber,"integer");
	if ($firstdayofyear>5) $WeekNumber = $WeekNumber - 1;
	if (($firstdayofyear<5)&&($WeekNumber==53)) {
		if (date("w", mktime(0,0,0,12,31,$wyear))>4) $WeekNumber=53;
		else $WeekNumber = 1;
	}
	return $WeekNumber;
}

/*****************/
/* back function */
/*****************/

function back(){
echo "<div class=menufont align=center><a href='Javascript:history.back();'>".translate("Back")."</a></div>\n";
}

// variables used for dynamically generating javascript redirects
if ($day!='') $hd = $day;
else $hd = $d ;
if ($month!='') $hm = $month;
else $hm = $m ;
if ($year!='') $hy = $year;
else $hy = $y ;

if ($date){
  if ($day=='') $hd = substr($date,8,2) ;
  else $hd = $day ;
  if ($month=='') $hm = substr($date,5,2) ;
  else $hm = $month ;
  if ($year=='') $hy = substr($date,0,4) ;
  else $hy = $year ;
}
if ($op=="cal") { $hm = ($month!='') ? $month : $m ; $hy = $year ; } 	// to handle monthly views
// ensure it does not exceed the max or min year set so scripts cannot jump beyond the restricted dates
if ($hy>($y+$caladvanceyear)) { $hy = $y+$caladvanceyear ; $hm = 12 ; $hd = 31 ; }
if ($hy<$calstartyear) { $hy = $calstartyear ; $hm = 1 ; $hd = 1 ; }
?>
<html>
<head>
<meta http-equiv="Content-Type" CONTENT="text/html; charset=<?php echo $charset; ?>">
<meta http-equiv="refresh" content="60">
<title>Calendarix : Admin</title>
<?php

if (($op!="eventform")&&($op!="addevent")&&($op!="hist")&&($op!="users")&&($op!="adduser")&&($op!="userdel")&&($op!="smallcal")&&($op!="yearcal")&&($op!="changepass")&&($op!="updateuser")) {
  include ("cal_adminscript.php") ;
}

echo "<script language=\"JavaScript\" type=\"text/JavaScript\">\n" ;
echo "<!--\n";
echo "function wopen(url, name, w, h, scroll)\n";
echo "{\n";
// Fudge factors for window decoration space.
// In my tests these work well on all platforms & browsers.
echo "  w += 0;\n";
echo "  h += 56;\n";
echo "  wleft = (screen.width - w) / 2;\n";
echo "  wtop = (screen.height - h) / 2;\n";
echo "  var win = window.open(url,name,'width=' + w + ', height=' + h + ', ' + 'left=' + wleft + ', top=' + wtop + ', ' + 'location=no, menubar=no, ' + 'status=no, toolbar=no, scrollbars=' + scroll + ', resizable=no');\n";
// Just in case width and height are ignored
echo "  win.resizeTo(w, h);\n";
// Just in case left and top are ignored
echo "  win.moveTo(wleft, wtop);\n";
echo "  win.focus();\n";
echo "}\n";
echo "// -->\n";
echo "</script>\n";

if (($op!="addevent")&&($op!="userdel")&&($op!="smallcal")&&($op!="yearcal")&&($op!="updateuser")) {
  echo "<script language=\"JavaScript\" src=\"menu.js\" ></script>\n";
  $menusrc = $language."_menu_items.js";
  if (!file_exists($menusrc)) $menusrc = "menu_items.js";	  
  echo "<script language=\"JavaScript\" src=\"".$menusrc."\" ></script>\n";
  echo "<script language=\"JavaScript\" src=\"menu_cal.js\" ></script>\n";
  echo "<link rel=\"stylesheet\" href=\"../themes/".$theme.".menu.css\" type=\"text/css\" >\n";	
}
?>

<link href="<?php echo "../themes/".$theme.'.css'?>" rel="stylesheet" type="text/css" />
</head>
<body>
<!-- overLIB (c) Erik Bosrup -->
<div id="overDiv" style="position:absolute; visibility:hidden; z-index:1000;"></div>
<script language="JavaScript" src="overlib.js" type="text/JavaScript"><!-- overLIB (c) Erik Bosrup --></script> 

<script language="JavaScript" type="text/JavaScript">
		new menu (MENU_ITEMS, MENU_POS);
</script>
<?php

function urlvar($uname) {
  if (($uname!="")&&($uname!="-")) echo "&uname=$uname" ;
}

if (($op!="smallcal")&&($op!="yearcal")) {
echo "<br/><br/>";
echo "<hr/>\n";
}

?>
