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
global $SEARCHCFG ;

echo "<form action=";
echo "cal_search.php method=post>\n";
echo "<input type=text name=search>\n";
echo "<input type=submit value=\"".translate("search")."\"> &nbsp;";
echo "</form>" ;
}

?>
