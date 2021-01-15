<?php
$version = "0.8.20080808" ;
##########################################################################
#  Please refer to the README file for licensing and contact information.
# 
#  This file has been updated for version 0.8.20080808
# 
#  If you like this application, do support me in its development 
#  by sending any contributions at www.calendarix.com.
# 
# 
#  Copyright © 2002 - 2008 Vincent Hor 
############################################################################
#
# base dir (include ending slash !), on win use two '\', on linux/unix just '/'
# eg. on linux - "/home/myname/calendarix/" 
#
# adjust the '$calpath'.
# hardcode it if detection does not work and comment out the remaining code.
#
# $calpath = "C:\\PHP\\calendarix\\demo\\" ; 

$calpath = dirname(__FILE__) ; 
$pos = strpos($calpath, "/");
if (!is_integer($pos)) $calpath = $calpath.'\\' ;
else $calpath = $calpath."/" ;

# your database-connection should be configured in cal_db.inc.php.
# more configuration for text display is available in default.css.

##########################################################################

// Check file exist for admin call to this script
require $calpath."cal_db.inc.php";

############################################################################
#
# Calendar login for users (Administration pages always require login)
# 1 = yes, 0 = no 

$userlogin = 1 ;	// note that if $userlogin = 0, $userview must be 0 but if $userlogin = 1, $userview can be anything.
$userview = 0 ;		// each user views user's events only 
			// requires login and not applicable to administrators; 1 = yes, 0 = no 
$publicview = 1 ;	// allow public to view calendar without login but not allowed to add events; 1 = yes, 0 = no
			// note that $userview = '0' if you want public to view events when $publicview = 1. 

############################################################################
#
# language 
#
# a  -> arabic	// in header file replace <html> with <html dir=rtl> so it would look right
# ba -> basque
# c  -> chinese
# ca -> catalan	
# cz -> czech
# dk -> danish
# n  -> dutch
# e  -> english
# es -> español  (Argentina "es.ar", Mexican "es.mx", Spain "es.sp" in spanish directory)
# f  -> finnish
# fr -> french
# g  -> german
# gl -> galician
# gr -> greek
# hu -> hungarian
# id -> indonesian malay
# i  -> italian
# nor-> norwegian
# pl -> polish
# p  -> portuguese
# r  -> russian
# ro -> romanian
# sl -> slovenian
# se -> swedish
# tc -> traditional chinese
# tr -> turk
# val-> valencian 

# j  -> japanese	// no translation yet, like to help?
# k  -> korean		// no translation yet, like to help?

$language = 'e';			// language selection
$charset = 'ISO-8859-1';	// charset for calendar pages

# don't change next 3 lines !
require $calpath."cal_languages/".$language.".inc.php"; 
require $calpath."cal_languages/".$language.".months.php"; 
require $calpath."cal_languages/".$language.".week.php"; 

############################################################################
# 
# default view 
# 
# this is the default view type when first viewing index.php
#
# 0 = todayview
# 1 = weekview
# 2 = monthview
# 3 = listview

$caldefault = 2;


############################################################################
#
# (non) views
#
# set several things (url, search) on/off on the site

$popupevent = 1; 			// is event in popup-screen(1) or just url(0)
$popupeventheight = '400'; 	// height of the popup-screen 
$popupeventwidth = '400';  	// width of the popup-screen 
$addeventwin_w = '500' ;  	// add event window width size for displaying event information. 
$addeventwin_h = '550' ;  	// popup window height size for displaying event information. 

$caleventapprove = 1; 		// automatically approve events (approved by admin) entered in user calendar; 1 = yes, 0 = no
$caleventadminapprove = 1; 	// automatically approve events entered in admin calendar; 1 = yes, 0 = no

$administrationok = 1; 	// allow administration url

$addeventok = 1; 		// allow add event 
$viewcatsok = 1; 		// allow view categories
$viewdayok = 1;  		// allow view by day 
$viewweekok = 1; 		// allow view by week
$viewcalok = 1;  		// allow view month
$viewevlistok = 1;	// allow view of events listing forward
$eventcatfilter = 1;	// allow events to be viewed filtered by categories

$allowsearch = 1;		// allow search 
$vieweventok = 1;     	// search on view individual view 
$searchcatsok = 1;    	// search on view of categories 
$searchdayok = 1;     	// search on view events by day 
$searchweekok = 1;    	// search on view events by week 
$searchmonthok = 1;   	// search on view events by month 

$allowuserdel = 1 ;	// allow user to delete own events in user calendar; 1 = yes, 0 = no 
$showuserentry = 0 ;    // show username of event entered in user calendar, shown within "< >"; 1 = yes, 0 = no

$viewtodaydate = 1;   	// view today date at the top 
$notimeentry = 0;		// not have time entry in creating/displaying events.; 1 = yes, 0 = no 
$time12hour = 0	;	// show the time as 12-hour format; 1 = yes, 0 = no

$showeventstats = 1 ;   // whether to show event statistics at top; 1 = yes, 0 = no 
$showcompanyname = 0 ;  // whether to show company name at top; 1 = yes, 0 = no 
$showcalendarname = 1 ; // whether to show calendar name at top; 1 = yes, 0 = no 
$weekstartday = 0 ;     // define day the week starts; 0=sunday, 1=monday ... 6=saturday 
$calstartyear = 2014 ;  // year for which calendar is valid
$caladvanceyear = 2 ;   // number of years more from current year for which calendar is valid, from 0 or more 

$timezone = 0 ;		// difference in timezone hours with respect to host server time from user's client time. 

$defaultcat = 'General';	// default category for adding event

$mailevent = 0 ;	// whether to email every event added to calendar by user to $emailrcpt; 0=no, 1=yes 
$emailrcpt = 'support@websoftec.net' ;	// receipient's email address for events posted if $mailevent is active 

$limitmthevt = 4 ;	// Display sum of events for month view for events >= $limitmthevt in a day; 0=off, 1=always 
$shortdesclen = 650 ;	// text length to display for short description in week and day calendar views. 
$limitrow = 10 ;		// Limit the number of rows displayed per page in historical items.

$dayview_w = '100%' ; 	// width for day view 
$weekview_w = '100%' ;	// width for week view 
$catview_w = '100%' ;	// width for category view

$protocol = 'http' ;	// defines the protocol for calendar url, use 'https' if on a secure site
$theme = 'default'; 	// defines the theme/file to use for styling the calendar; has to be a CSS file

############################################################################
#  Defines if FCKEditor should be used instead of standard text

$FCKEditorBasePath = '/Calendarix/demo/FCKeditor/';  // base path to FCKeditor files
$useFCKEditor = 0;	

############################################################################
#
# include the colors for the theme that cannot be set in style sheets
# don't change this !

include_once $calpath."themes/".$theme.".color.php" ;

############################################################################
#
# text for the calendar

$companyname = 'Scriptrix Enterprise' ;  // Company name
$calendarname = 'ALL AMERICAN SECURITY SERVICES' ; // Calendar name
$leftfooter = '<a href="http://www.allamericanfl.com/">www.allamericanfl.com</a>' ;
$contact = 'luisleon@allamericanfl.com' ;

$rssactive = 0;		// whether to have RSS integrated into Calendar

// RSS Feeds configured as array of ("Channel Name","RSS Domain","URL to RSS feed")
$rssfeeds = array ( 
	0 => array("Calendarix Advanced","www.calendarix.com","http://www.calendarix.com/advanced/rss.php"),
	1 => array("Calendarix Forum","www.calendarix.com","http://www.calendarix.com/phorum5/rss.php?3"),
	2 => array("CNet","www.news.com","http://www.news.com/2547-1_3-0-5.xml"),
	3 => array("Google News","www.google.com","http://www.google.com/news?topic=w&output=rss"),
	4 => array("Scripting News","www.scripting.com","http://www.scripting.com/rss.xml"),
	5 => array("Wired","www.wired.com","http://www.wired.com/rss/index.xml"),
	6 => array("World Vision","media.worldvision.org","http://media.worldvision.org/rss/wvus_news.xml"),
	7 => array("Yahoo Technology News","rss.news.yahoo.com","http://rss.news.yahoo.com/rss/tech")
);

session_name("wcal4ulogin");	// change to unique name for your particular calendar
?>
