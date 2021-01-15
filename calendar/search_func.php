<?php
##########################################################################
#  Please refer to the README file for licensing and contact information.
# 
#  This file has been updated for version 0.5.20031130 
# 
#  If you like this application, do support me in its development 
#  by sending any contributions at www.calendarix.com.
#
#
#  Copyright © 2002,2003 Vincent Hor
##########################################################################

/*******************/
/* search function */
/*******************/

function search(){
global $allowsearch ;

echo "<form action=";
if ($allowsearch==1) {
  echo "cal_search.php method=post>\n";
  }
else echo ">\n";
echo "<input type=text name=search size=20>\n";
echo "<input type=submit value=\"".translate("search")."\">";
echo "</form>" ;
}

?>
