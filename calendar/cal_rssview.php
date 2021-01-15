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
#  Copyright © 2007-2008 Vincent Hor
##########################################################################

require ('cal_config.inc.php');

?>

<html>
<head>
 <meta http-equiv="Content-Type" CONTENT="text/html; charset=<?php echo $charset; ?>">
 <title>RSS Channels</title>
 <link href="themes/<?php echo $theme.'.css'?>" rel="stylesheet" type="text/css" >
</head>
<body>

<?php
if (!isset($_GET['rssview']))
  $rssview = 0;
else
  $rssview = $_GET['rssview'];
if (!isset($_GET['rssop']))
  $rssop = "";
else
  $rssop = $_GET['rssop'];

if ($rssactive == 1){
  if (isset($_POST['gorss']))	{
	  $rssview = $_POST['gorss'];
	  
  echo "<script language=\"JavaScript\" type=\"text/JavaScript\">\n" ;
  echo "var gotourl = top.opener.window.location.href ;\n" ;
  echo "if (top.opener.window.location.href.indexOf(\"#\")!=-1) gotourl = gotourl.substr(0,gotourl.length-1);\n" ;
  echo "if (gotourl.indexOf(\"?\")==-1) { \n" ;
  echo "  top.opener.window.location.href = gotourl + '?rssview=".$rssview."' ; } \n" ;
  echo "else if (gotourl.indexOf(\"rssview\")!=-1) { \n" ;
  echo "  if (gotourl.substr(gotourl.indexOf(\"rssview\")+9,1)!='&') {\n" ;
  echo "  gotourl = gotourl.substr(0,gotourl.indexOf(\"rssview\")+7)+\"=$rssview\"+gotourl.substr(gotourl.indexOf(\"rssview\")+10,gotourl.length) ;}\n" ;
  echo "  else {\n" ;
  echo "  gotourl = gotourl.substr(0,gotourl.indexOf(\"rssview\")+7)+\"=$rssview\"+gotourl.substr(gotourl.indexOf(\"rssview\")+9,gotourl.length) ;}\n" ;
  echo "top.opener.window.location.href = gotourl; }\n" ;
  echo "else { \n";
  echo "top.opener.window.location.href = gotourl + '&rssview=".$rssview."';";
  echo " }\n" ;  
  echo "self.window.close();\n" ;
  echo "</script>\n" ;
  }

  echo "<div class=normalfont>\n" ;
  echo "<form action=\"cal_rssview.php?rssop=viewrss\" method=post>\n";
  echo "<b>".translate("Please choose the RSS channel you want to view").": </b>&nbsp;" ;
  // get the rss names 
  echo "<select name=gorss>\n";
  for ($i=0;$i<count($rssfeeds);$i++) {
  echo "\t<option value=$i" ;
  if ($rssview==$i) echo " selected " ;
    echo ">".$rssfeeds[$i][0]."\n";

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
