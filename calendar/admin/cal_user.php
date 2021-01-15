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

/*******************/
/* user management */
/*******************/

function users($timeout){
global $USER_TB,$PARAM_TB,$op,$userid,$id ;

  // Check if deleting user
  if (isset($_GET['isdelete']))
    $isdelete = $_GET['isdelete'];
  else
    $isdelete = "n" ;

   $query = "select * from ".$USER_TB." order by username ASC";
   $result = mysql_query($query);

   // this is for the delete user javascript
   echo "<script language=\"JavaScript\" type=\"text/JavaScript\">\n" ;
   echo "function deluser(rid,uid) {\n" ;
   echo "if (rid!=uid) {\n" ;
   echo "  window.location.href='cal_user.php?isdelete=y&op=users&id='+rid ; }\n" ;
   echo "else { alert(\"".translate("Cannot delete current login user")."!\")} " ;
   echo "}\n" ;
   echo "</script>\n\n" ;

   echo "<table border=0 width=100% class=headerfont><tr><td align=left>".translate("User Management")."</td></tr></table>\n";

   echo "<table border=0>";
   $i = 1;
   while ($row = mysql_fetch_object($result)){
	echo "<tr><td align=right width=20><div class=titlefont>".$i."</div></td><td align=left><div class=normalfont>" ;
	echo "<a href='#' onclick=\"Javascript:wopen('usertype.php?userid=$row->user_id','usertype',300,300,'no');\">".$row->username."</a>\n" ;
	if ($row->group_id=='0') { 
	  echo " &nbsp; (" ;

	  echo "<!-- <a href='#' onclick=\"Javascript:wopen('usertype.php?usertype=0','usertype',300,300,'no');\"> -->".
translate("Administrator")."<!--</a>-->) &nbsp; " ;
	  }
	else if ($row->group_id=='1') {
	  echo " &nbsp; (" ;
	  echo "<!--<a href='#' onclick=\"Javascript:wopen('usertype.php?usertype=1','usertype',300,300,'no');\"> -->".
translate("User")."<!--</a>-->) &nbsp; " ;
	  }

	echo "</div></td><td align=left><div class=menufont> - <a href=\"#\" onclick=\"Javascript:deluser(".$row->user_id.",".$userid.");\">".translate("Delete user")."</a>" ;
	echo " - <a href=\"cal_adduser.php?op=changepass&userid=".$row->user_id."\">".translate("Change password/group")."</a>" ;
	echo "</div></td></tr>\n\n";
   $i++;
   }
   echo "</table><br/>";
	
   if ($isdelete!="y")
     echo "<div class=titlefont>"."<a href='cal_adduser.php?op=adduser'>".translate("Add new user")."</a></div><br/>";
   else if ($userid!=$id)
     echo "<div class=titlefont>".translate("userdelok")." <a href='cal_user.php?op=userdel&userid=".$id."'>".translate("Yes")."</a>"." / "."<a href='Javascript:history.go(-1);'>".translate("No.")."</a></div><br/>";
  
}

if ($op == "adduser"){
  $logn = $_POST['logn'];
  $passwd = $_POST['passwd'];
  $usertype = $_POST['usertype'];
  $userdesc = $_POST['userdesc'];
}

function adduser($logn,$passwd,$usertype,$userdesc){
global $USER_TB;

  // Check for login and password to be only alpha-numeric

  if ((!preg_match("/^[a-z0-9]+$/i", $logn))||(!preg_match("/^[a-z0-9]+$/i", $passwd))) {
    echo "<script language=\"JavaScript\">\n" ;
    echo "  alert(\"".translate("Username and passwords must be alpha-numeric and without spaces.")."\"); \n" ;
    echo "  document.location.href = \"cal_adduser.php?op=adduser\" \n";
    echo "</script>\n" ;
    echo "<meta http-equiv=\"refresh\" content=\"0; url=cal_adduser.php?op=adduser\">";
  }
  else {
    $crypt = "we6c21end2r4u";
    $cryptpas = crypt($passwd,$crypt);
    $userdescription = addslashes(nl2br($userdesc)) ;
    $query = "insert into ".$USER_TB." values (null,'".$logn."','".$cryptpas."','".$userdescription."','".$usertype."')";
    echo "<h4>".translate("Adding user")." ...</h4>" ;
    mysql_query($query);
    echo "<meta http-equiv=\"refresh\" content=\"0; url=cal_user.php?op=users\">";
    }
}

function deluser($userid){
global $USER_TB;
  $query = "delete from ".$USER_TB." where user_id='".$userid."'";
  echo "<h4>".translate("Deleting user")." ...</h4>" ;
  mysql_query($query);
  echo "<meta http-equiv=\"refresh\" content=\"0; url=cal_user.php?op=users\">";
}

switch ($op){

    // overview of admin-users

    case"users":{
	users($timeout);
    break;
    }


    // add new user
    case"adduser":{
	adduser($logn,$passwd,$usertype,$userdesc);
    break;
    }

    //
    case"userdel":{
	deluser($userid);
    break;
    }


    // default: bar, and show new submissions
    default:{
	users($timeout);
    break;
    }
}

include ('cal_footer.inc.php');

?>