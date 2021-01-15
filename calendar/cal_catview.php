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

require ('cal_config.inc.php');

$catview = $_GET['catview'];
// <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
?>

<html>
<head>
 <meta http-equiv="Content-Type" CONTENT="text/html; charset=<?php echo $charset; ?>">
 <title>Event Category View</title>
 <link href="themes/<?php echo $theme.'.css'?>" rel="stylesheet" type="text/css" >
</head>
<body>

<?php
if (!isset($_GET['catop']))
  $catop = "";
else
  $catop = $_GET['catop'];

if ($catop == "viewcat"){
  $catview = $_POST['gocat'];

  echo "<script language=\"JavaScript\" type=\"text/JavaScript\">\n" ;
  echo "var gotourl = top.opener.window.location.href ;\n" ;
  echo "if (top.opener.window.location.href.indexOf(\"#\")!=-1) gotourl = gotourl.substr(0,gotourl.length-1);\n" ;
  echo "if (gotourl.indexOf(\"?\")==-1) { \n" ;
  echo "  top.opener.window.location.href = gotourl + '?catview=".$catview."' ; } \n" ;
  echo "else if (gotourl.indexOf(\"catview\")!=-1) { \n" ;
  echo "  if (gotourl.substr(gotourl.indexOf(\"catview\")+9,1)!='&') {\n" ;
  echo "  gotourl = gotourl.substr(0,gotourl.indexOf(\"catview\")+7)+\"=$catview\"+gotourl.substr(gotourl.indexOf(\"catview\")+10,gotourl.length) ; }\n" ;
  echo "  else \n" ;
  echo "  gotourl = gotourl.substr(0,gotourl.indexOf(\"catview\")+7)+\"=$catview\"+gotourl.substr(gotourl.indexOf(\"catview\")+9,gotourl.length) ;\n" ;
  echo "top.opener.window.location.href = gotourl; }\n" ;
  echo "else { \n";
  echo "top.opener.window.location.href = gotourl + '&catview=".$catview."';";
  echo " }\n" ;    
  echo "window.close();\n" ;
  echo "</script>\n" ;

}

if ($eventcatfilter==1) {
  echo "<div class=normalfont>\n" ;
  echo "<form action=\"cal_catview.php?catop=viewcat\" method=post>\n";
  echo "<b>".translate("Please choose the category you only want to view events for").": </b>&nbsp;" ;
  $query = "select cat_id,cat_name from ".$CAT_TB." order by cat_name ASC";
  $result = mysql_query($query);

  // get the category names 
  echo "<select name=gocat>\n";
  echo "\t<option value=0" ;
  if ($catview==0) echo " selected " ;
  echo ">".translate("All categories")."\n";

  while ($row = mysql_fetch_object($result)){
    echo "\t<option value=$row->cat_id" ;
    if ($catview==$row->cat_id) echo " selected " ;
    echo ">".stripslashes($row->cat_name)."\n";
  }
  echo "</select>\n";

echo "<br/>\n";
echo "<div align=center><input type=submit value=\"".translate("View")."\">" ;
echo "&nbsp; &nbsp;<input type=button value=\"".translate("Close")."\" onClick=\"Javascript:window.close();\">\n" ;
echo "</div>\n" ;
echo "</form></div>" ;

}
else echo "<br/><div class=titlefont>".translate("disabled").".</div>" ;

?>

</body>
</html>
