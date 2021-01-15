<?php
##########################################################################
#  Please refer to the README file for licensing and contact information.
# 
#  This file has been updated for version 0.6.20050131
# 
#  If you like this application, do support me in its development 
#  by sending any contributions at www.calendarix.com.
#
#
#  Copyright © 2002-2005 Vincent Hor
##########################################################################

include ('cal_header.inc.php');
include ("search_func.php");
include ("../cal_utils.php");

#today's date and search
echo "<table class=todaytop align=center width=100% border=0><tr><td align=left valign=top>" ;
$weekday = date ("w", mktime(12,0,0,$m,$d,$y));
$weekday++;
echo $week[$weekday]." ".$d." ".ucfirst($mth[$m])." ".$y;
echo "</td><td align=right>" ;
search() ;
echo "</td></tr></table>" ;

?>
