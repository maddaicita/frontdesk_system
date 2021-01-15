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

ob_start();		// set output_buffering ON

require ("cal_config.inc.php");

if (!isset($_GET['op']))
  $op = '';
else
  $op = $_GET['op'];

error_reporting(E_ALL);	// for error reporting on login problems
$dname = dirname($_SERVER['PHP_SELF']);	// handle directory returns "\"
if ($dname=="\\") $dname = '' ;

if ($op == "loginok"){
  header("location: ".$protocol."://".$_SERVER['HTTP_HOST'].$dname."/"."calendar.php");
}

if ($op == "logout"){
  session_start(); 
  session_unset(); 
  session_destroy(); 
}


if ($op == "login"){
	$loginok = false ;
	$request_type = strtolower($_SERVER["REQUEST_METHOD"]);
	$login = $_POST['login'];
	$password = $_POST['password'];

	// Remove all white spaces
	//$login = preg_replace("/ +/i", "", $_POST['login']);
	//$password = preg_replace("/ +/i", "", $_POST['password']);

	if ((trim($password)!="")&&($request_type=="post")) {
	  // sanitize $login and $password to prevent sql-injection vulnerability
	  $login = preg_replace("/[';]/", "", $login);
	  //echo "<h1>LOGIN:".$login."</h1>";
	  // Check for login and password to be only alpha-numeric
	  // if ((preg_match("/^[a-z0-9]+$/i", $login))&&(preg_match("/^[a-z0-9]+$/i", $password))) 
	  $loginok = true ;
	}
	$crypt = "we6c21end2r4u" ;
	$cryptpas = crypt($password,$crypt);
	$query = "select username,password,group_id from ".$USER_TB." where username='".$login."' AND password='".$cryptpas."'";
	$result = mysql_query($query);
	$row = mysql_fetch_object($result);

	if ((!$row)||(!$loginok)){
	  if (file_exists("callogin_top.html")) include ("callogin_top.html");
	  else {
		echo "<html><head><meta http-equiv=\"Content-Type\" CONTENT=\"text/html; charset=$charset\"><title>".translate("Web Calendar User Login")."</title>\n";
	  	echo "<link href=\"themes/".$theme.".css\" rel=\"stylesheet\" type=\"text/css\" />\n";
		echo "</head><body><p>&nbsp;</p><div align=center class=titlefont>".translate("Web Calendar User Login")."</div>" ;
		}
	  echo "<div align=center class=menufont><p>&nbsp;</p><b><i>".translate("wronglogin")."!</i></b>";
	  echo "<br/><br/><a href=javascript:history.back()>".translate("Back")."</a><br/>";
	  echo "</div>" ;
	  if (file_exists("callogin_bottom.html")) include ("callogin_bottom.html");
	  }
	else {
 	  session_start(); 
	  $_SESSION["login"] = $row->username; 
	  $_SESSION["password"]= $row->password; 
	  header("location: ".$protocol."://".$_SERVER['HTTP_HOST'].$dname."/"."cal_login.php?op=loginok");
	  ob_end_flush();

	  // req'd when output_buffering = Off in php.ini
	  // echo "<meta http-equiv=\"refresh\" content=\"0;url=cal_login.php?op=loginok\">";		  
	}
}
else {
	if (file_exists("callogin_top.html")) include ("callogin_top.html");
	else {
	  echo "<html><head><meta http-equiv=\"Content-Type\" CONTENT=\"text/html; charset=$charset\"><title>".translate("Web Calendar User Login")."</title>\n";
	  echo "<link href=\"themes/".$theme.".css\" rel=\"stylesheet\" type=\"text/css\" />\n";
	  echo "</head><body><p>&nbsp;</p><div align=center class=titlefont>".translate("Web Calendar User Login")."</div>" ;
	}
	echo "<div align=center><form action=cal_login.php?op=login method=post><table align=center width=300 border=0><tr><td align=right><div class=menufont>";
	echo "<b>".ucfirst(translate("username")).":</b></div></td><td align=left><input type=text name=login></td></tr><tr><td align=right><div class=menufont>" ;
	echo "<b>".ucfirst(translate("password")).":</b></div></td><td align=left><input type=password name=password></td></tr><tr><td align=left>&nbsp;</td><td align=center>" ;
	echo "<input type=submit value='     ".translate("Login")."     '></td></tr>";
	echo "</table>" ;
	echo "</form>";
	if ($publicview==1) echo "\n<div class=menufont align=center><a href=\"calendar.php\">".translate("Calendar")."</a></div>\n" ;
	echo "</div>" ;

	// Remove this portion if mini-calendar is not to be seen
	echo "<br/>";
	echo "<table border=1 align=center width=300><tr><td>";
      include ("minical.php");
	echo "</td></tr></table>";
	echo "<br/>";

	if (file_exists("callogin_bottom.html")) include ("callogin_bottom.html");
}

?>

