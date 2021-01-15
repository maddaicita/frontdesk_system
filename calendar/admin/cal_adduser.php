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
/* add user form   */
/*******************/

function adduserform(){
global $USER_TB,$op ;

  $query = "select * from ".$USER_TB." order by username ASC";
  $result = mysql_query($query);

// this is the validation javascript in adding new users
echo "<script language=\"JavaScript\" type=\"text/JavaScript\">\n" ;
echo "\tfunction valuser(form) {\n" ;
echo "if ((form.logn.value!=\"\")&&" ;
   while ($row = mysql_fetch_object($result)){
	echo "(form.logn.value!=\"".$row->username."\")&&\n";
   }
echo "(form.logn.value!=\" \")) {" ;

echo "if (form.passwd.value==form.confirm.value) { \n" ;
echo "form.action = 'cal_user.php?op=adduser' ;\n" ;
echo "form.method = \"post\" ;\n" ; 
echo "form.submit();\n" ;
echo "}\n" ;
echo "else { alert(\"".translate("Both passwords entered do not match")."\"); }\n" ;
echo "}\n" ;
echo "else { alert(\"".translate("Username entered already exists. Please use another username.")."\"); }\n" ;
echo "}\n" ;
echo "</script>" ;

   echo "<table border=0 width=100% class=headerfont><tr><td align=left><a href='cal_user.php?op=users'>".translate("User Management")."</a>"." - ".translate("Add new user")."</td></tr></table>\n";

   echo "<form name='userfrm' action=''><div class=normalfont>";
   echo "<b>".ucfirst(translate("username"))."</b><br/><input type=text name=logn size=30><br/>"; 
   echo "<b>".ucfirst(translate("password"))."</b><br/><input type=password name=passwd size=30><br/>";
   echo "<b>".translate("Confirm password")."</b><br/><input type=password name=confirm size=30><br/>";
   echo "<br/><b>".translate("User group")."</b><br/>";
   echo "<input type=radio name=usertype value='0'>"."
<a href='#' onclick=\"Javascript:wopen('usertype.php?usertype=0','usertype',300,300,'no');\">".
translate("Administrator")."</a> &nbsp; &nbsp; " ;
   echo "<input type=radio name=usertype value='1' checked>"."
<a href='#' onclick=\"Javascript:wopen('usertype.php?usertype=1','usertype',300,300,'no');\">".
translate("User")."</a><br/><br/>" ;

echo "<b>".translate("User description")."</b><br/>" ;
echo "<textarea name=userdesc cols=40 rows=5>" ;
echo "</textarea><br/><br/>\n";
echo "<input type=button value=\"".translate("Add new user")."\" onclick='Javascript:valuser(this.form);'>";
echo "&nbsp;&nbsp;<input type=button value=\"".translate("Cancel")."\" onclick='Javascript:window.history.go(-1);'>\n<br/>\n";
echo "</div></form>";
}

/*******************/
/* change password */
/*******************/

function changepass($userid){
global $USER_TB,$op ;

  $query = "select * from ".$USER_TB." where user_id='".$userid."'" ;
  $result = mysql_query($query);
  $row = mysql_fetch_object($result) ;

// this is the validation javascript in adding new users
echo "<script language=\"JavaScript\" type=\"text/JavaScript\">\n" ;
echo "\tfunction valupuser(form) {\n" ;
echo "if ((form.passwd.value!=\"\")&&(form.passwd.value==form.confirm.value)) { \n" ;
echo "form.action = 'cal_adduser.php?op=updateuser&id=".$userid."' ;\n" ;
echo "form.method = \"post\" ;\n" ; 
echo "form.submit();\n" ;
echo "}\n" ;
echo "else { alert(\"".translate("Both passwords entered do not match")."\"); }\n" ;
echo "}\n" ;
echo "</script>" ;

   echo "<table border=0 width=100% class=headerfont><tr><td align=left><a href='cal_user.php?op=users'>".translate("User Management")."</a>"." - ".translate("Change password/group")."</td></tr></table>\n";

   echo "<form name='changefrm' action=''><div class=normalfont>";
   echo "<b>".ucfirst(translate("username"))."</b>: &nbsp; <b><i>".$row->username."</i></b><br/><br/>"; 
   echo "<b>".ucfirst(translate("password"))."</b> <br/><input type=password name=passwd size=30><br/>";
   echo "<b>".translate("Confirm password")."</b> <br/><input type=password name=confirm size=30><br/>";
   echo "<br/><b>".translate("User group")."</b><br/>" ;
   echo "<input type=radio name=usertype value='0'" ;
   if ($row->group_id==0) echo " checked" ;
   echo ">".translate("Administrator")." &nbsp; &nbsp; " ;
   echo "<input type=radio name=usertype value='1' " ;
   if ($row->group_id==1) echo " checked" ;
   echo ">".translate("User")."<br/><br/>" ;
   echo "<textarea name=userdesc cols=40 rows=5>" ;
   echo stripslashes(str_replace("<br />","",$row->description));
   echo "</textarea><br/><br/>\n";
   echo "<input type=button value=\"".translate("Change")."\" onclick='Javascript:valupuser(this.form);'>";
   echo "&nbsp;&nbsp;<input type=button value=\"".translate("Cancel")."\" onclick='Javascript:window.history.go(-1);'>\n<br/>\n";
   echo "</div></form>";

}

if ($op == "updateuser"){
  $passwd = $_POST['passwd'];
  $usertype = $_POST['usertype'];
  $userdesc = $_POST['userdesc'];
}

function updateuser($id,$usertype,$password,$userdesc) {
  global $USER_TB, $userid;
  $crypt = "we6c21end2r4u" ;
  $cryptpass = crypt($password,$crypt);
  echo "<h4>".translate("Updating user")." ...</h4>" ;
  $userdescription = addslashes(nl2br($userdesc));
  $query = "update ".$USER_TB." set password='$cryptpass',group_id='$usertype',description='$userdescription' where user_id='".$id."'" ;
  $result = mysql_query($query);
  if ($userid==$id)
    $_SESSION["password"] = $cryptpass ;
  echo "<meta http-equiv=\"refresh\" content=\"0; url=cal_user.php?op=users\">";
}


switch ($op){

    // add new user
    case"adduser":{
	adduserform();
    break;
    }

    // change user password/group form
    case"changepass":{
	changepass($userid);
    break;
    }

    // change user password/group
    case"updateuser":{
	updateuser($id,$usertype,$passwd,$userdesc);
    break;
    }


    // default: bar, and show new submissions
    default:{
	adduserform();
    break;
    }
}

include ('cal_footer.inc.php');

?>