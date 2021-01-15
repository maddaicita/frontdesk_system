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

require ('../cal_config.inc.php');

if (!isset($_GET['usertype']))
  $usertype = '';
else
  $usertype = $_GET['usertype'];

if (!isset($_GET['userid']))
  $userid = '';
else
  $userid = $_GET['userid'];


?>
<html>
<head>
 <meta http-equiv="Content-Type" CONTENT="text/html; charset=<?php echo $charset; ?>">
 <title>User Description</title>
 <link href="<?php echo "../themes/".$theme.'.css'?>" rel="stylesheet" type="text/css" />
</head>
<body>

<?php
echo "<div class=normalfont>\n" ;
if ($usertype=='0') {
  echo "<b><u>".translate("Administrator")."</u></b><br/><br/>Allowed access to all functions of the calendar." ;
  echo "<br/><br/>Only administrators are allowed to login to the calendar administration." ;
  echo "<br/><br/>Only administrators view all events of all users in user calendar." ;
}
else if ($usertype=='1') {
  echo "<b><u>".translate("User")."</u></b><br/><br/>Allowed access to user calendar but not administration." ;
  echo "<br/><br/>Allowed to use functions in the user calendar as configured in the <b><i>cal_config.inc.php</i></b> file." ;
  echo "<br/><br/>Allowed to view only user own events in the user calendar if \$userview = 1 is set in the <b><i>cal_config.inc.php</i></b> file." ;
}
else if (isset($userid)) {
  $query = "select username, description from ".$USER_TB. " where user_id='".$userid."'" ;
  $result = mysql_query($query);
  $row = mysql_fetch_object($result) ;
  echo "<b>".translate("User").":</b>&nbsp;&nbsp;".$row->username."<p>" ;
  $userdescription = stripslashes($row->description) ;
  echo "<b>".translate("User description").":</b><br/>" ;
  echo $userdescription ;
  echo "<br/><br/>" ;
}

echo "</div>\n";
echo "<br/><br/><hr/><div class=normalfont align=center><br/>" ;
echo "<a class=normalfont href=\"#\" onclick='Javascript:window.close()'>".translate("Close")."</a></div>";
?>

</body>
</html>
