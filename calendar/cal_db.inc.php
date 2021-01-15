<?php
##########################################################################
#  Please refer to the README file for licensing and contact information.
# 
#  This file has been updated for version 0.8.20071118 
# 
#  If you like this application, do support me in its development 
#  by sending any contributions at www.calendarix.com.
#
#
#  Copyright © 2002-2007 Vincent Hor
##########################################################################

############################################################################
#
# database connection 

$db = 'events';
$dbuser = 'root';
$dbpass = 'targus25';
$dbhost = 'localhost';

mysql_connect($dbhost,$dbuser,$dbpass) or die("could not connect");
mysql_select_db("$db") or die("could not open database");

############################################################################
#
# Table definitions

$EVENTS_TB = 'calendar_events' ;
$USER_TB = 'calendar_users' ;
$CAT_TB = 'calendar_cat' ;
$PARAM_TB = 'calendar_param' ;


function sanitize($urlvar,$dval)
{
	if (is_array($urlvar)) 
	{
		$urlvar = $dval;		// prevent "[]" to cause variable to be taken as array	
	}
	if (preg_match("/[\-'*<>;+@]/",$urlvar)) $urlvar = $dval;	// check to prevent sql injection
	if (preg_match("/and/",$urlvar)) $urlvar = $dval;	// check to prevent sql injection
	if (preg_match("/or/",$urlvar)) $urlvar = $dval;	// check to prevent sql injection
	return $urlvar;
}

?>