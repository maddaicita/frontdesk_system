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

echo "<hr/>\n\n<table width='100%' border=0><tr><td align=left width='33%' valign=top>\n";
echo "\n<font face=\"Arial,Helvetica\" size=1>".$leftfooter."</font>\n" ;

echo "</td><td align=center width='33%'>" ;
echo "<a href='http://www.calendarix.com' target='_BLANK' onmouseover=\"return overlib('Calendarix version ".$version."\\nCopyright © 2002-2008 Vincent Hor',FGCOLOR,'#FFFFFF',TEXTSIZE,'1',WIDTH,'225',VAUTO,HAUTO,CAPTION,'".translate("About Calendarix")." [Basic]');\" onmouseout=\"return nd();\">";
echo "<img src=\"images/calendarix.gif\" Alt=\"".translate("About Calendarix")." ".$version."\" border=0 width=88 height=31 ></a>";

echo "</td>\n<td align=right width='33%' valign=top>\n";
echo "\n<font face=\"Arial,Helvetica\" size=1><a href='mailto:".$contact."'>".$contact."</a></font>\n" ;
echo "</td></tr></table>\n";
echo "</body>\n";
echo "</html>\n";
?>
