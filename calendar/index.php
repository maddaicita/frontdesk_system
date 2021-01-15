<?php
##########################################################################
#  Please refer to the README file for licensing and contact information.
# 
#  This file has been updated for version 0.7.20070307 
# 
#  If you like this application, do support me in its development 
#  by sending any contributions at www.calendarix.com.
#
#
#  Copyright © 2002-2007 Vincent Hor
##########################################################################

require ("cal_config.inc.php");
$dname = dirname($_SERVER['PHP_SELF']);
if ($dname=="\\") $dname = '' ;	// fix windows based root hosting returning just "\"
header("location: http://".$_SERVER['HTTP_HOST'].$dname."/calendar.php");
?>
