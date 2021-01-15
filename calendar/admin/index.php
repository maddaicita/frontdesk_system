<?php
##########################################################################
#  Please refer to the README file for licensing and contact information.
# 
#  This file has been updated for version 0.6.20050215 
# 
#  If you like this application, do support me in its development 
#  by sending any contributions at www.calendarix.com.
#
#
#  Copyright © 2002-2005 Vincent Hor
##########################################################################

require ("../cal_config.inc.php");
header ("location: ".$protocol."://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/calendar.php");
?>
