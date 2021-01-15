<?php
##########################################################################
#  Please refer to the README file for licensing and contact information.
# 
#  This file has been updated for version 0.7.20060401
# 
#  If you like this application, do support me in its development 
#  by sending any contributions at www.calendarix.com.
#
#
#  Copyright © 2002,2003 Vincent Hor
##########################################################################

// Javascript for changing user view in calendar
echo "<script language=\"JavaScript\" type=\"text/JavaScript\">\n" ;
echo "function seeuser(selectopt) {\n" ;
echo "var geti = '-' ;\n" ;
echo "for (i=0;i<selectopt.options.length;i++) {\n" ;
echo "\tif (selectopt.options[i].selected) {\n" ;
echo "\t\tgeti = selectopt.options[i].value ;\n" ;
echo "\t\tbreak ;\n" ;
echo "\t}\n" ;
echo "}\n\n" ;
echo "var gotourl = window.location.href ;\n" ;
echo "if (window.location.href.indexOf(\"#\")!=-1) gotourl = gotourl.substr(0,gotourl.indexOf(\"#\"));\n" ;
echo "if (gotourl.indexOf(\"?\")==-1) { \n" ;
echo "  window.location.href = gotourl + '?uname=' + geti ; } \n" ;
echo "else if (gotourl.indexOf(\"uname\")!=-1) { \n" ;
echo "\tvar unamepart = gotourl.substr(gotourl.indexOf(\"uname\")+5,gotourl.length) ; \n" ;
echo "\tif (unamepart.indexOf(\"&\")!=-1) { \n" ;
echo "\t\tunamepart = unamepart.substr(unamepart.indexOf(\"&\"),unamepart.length); \n" ;
echo "\t\t}\n" ;
echo "\telse unamepart = \"\" ;\n" ;
echo "if (geti=='-') gotourl = gotourl.substr(0,gotourl.indexOf(\"uname\")-1)+ unamepart ;\n" ;
echo "else gotourl = gotourl.substr(0,gotourl.indexOf(\"uname\")+5)+\"=\" + geti + unamepart ;\n" ;
echo "window.location.href = gotourl; }\n" ;
echo "else window.location.href = gotourl +'&uname=' + geti ; \n" ;
echo "}\n" ;
echo "</script>\n" ;

// this is for the goto month redirection javascript
echo "<!-- javascript redirect -->\n" ;
echo "<script language=\"JavaScript\" type=\"text/JavaScript\">\n" ;
echo "// this script must be defined after variables hd,hm and hy is defined!\n" ;
echo "function gotomonth(selectopt) {\n" ;
echo "var geti = '1' ;\n" ;
echo "for (i=0;i<selectopt.options.length;i++) {\n" ;
echo "\tif (selectopt.options[i].selected) {\n" ;
echo "\t\tgeti = selectopt.options[i].value ;\n" ;
echo "\t\tbreak ;\n" ;
echo "\t}\n" ;
echo "}\n\n" ;
echo "switch (geti) {\n" ;
for ($i=1;$i<13;$i++) {
  $jstr = "calendar.php?op=cal&month=".$i."&year=".$hy ; 
  if (($uname!="")&&($uname!="-")) $jstr = $jstr."&uname=$uname" ;
echo "  case \"".$i."\" : { window.location.href='".$jstr."' ; break ;}\n" ;
}
echo "  default : { window.location.href='calendar.php?op=cal&month=".$hm."&year=".$hy."' ; break;}\n" ;
echo "  }\n" ;
echo "}\n" ;
echo "</script>\n\n" ;


// this is for the goto year redirection javascript
echo "<script language=\"JavaScript\" type=\"text/JavaScript\">\n" ;
echo "// this script must be defined after hd,hm and hy is defined!\n" ;
echo "\tfunction gotoyear(selectopt) {\n" ;
echo "var geti = '1' ;\n" ;
echo "for (i=0;i<selectopt.options.length;i++) {\n" ;
echo "\tif (selectopt.options[i].selected) {\n" ;
echo "\t\tgeti = selectopt.options[i].value ;\n" ;
echo "\t\tbreak ;\n" ;
echo "\t}\n" ;
echo "}\n\n" ;
echo "\t\tswitch (geti) { \n" ;
for ($i=$calstartyear;$i<=($y+$caladvanceyear);++$i) {
  $jstr = "calendar.php?op=cal&month=".$hm."&year=".$i ;
  if (($uname!="")&&($uname!="-")) $jstr = $jstr."&uname=$uname" ;
  echo "case \"$i\" : { window.location.href='".$jstr."' ; break ;} \n" ;
}
echo "default : { window.location.href='calendar.php?op=cal&month=$hm&year=$hy' ; break;} \n" ;
echo "\t\t}\n" ;
echo "\t}\n" ;
echo "</script>" ;

// this is for the goto week redirection javascript
$weeknumber = weekNumber($hd,$hm,$hy) ;
echo "<script language=\"JavaScript\" type=\"text/JavaScript\">\n" ;
echo "\tfunction gotoweek(selectopt) {\n" ;
echo "var geti = '1' ;\n" ;
echo "for (i=0;i<selectopt.options.length;i++) {\n" ;
echo "\tif (selectopt.options[i].selected) {\n" ;
echo "\t\tgeti = selectopt.options[i].value ;\n" ;
echo "\t\tbreak ;\n" ;
echo "\t}\n" ;
echo "}\n\n" ;
echo "\t\tswitch (geti) { \n" ;
for ($i=1;$i<=54;++$i) {				// maximum ever number of weeks is 54!
  $jstr = "cal_adminweek.php?op=week&date=" ;
  $totaldays = ($i - $weeknumber) * 7 + $hd;
  $jstr = $jstr.date("Y-m-d", mktime(0,0,0,$hm,$totaldays,$hy)) ;
  if (($uname!="")&&($uname!="-")) $jstr = $jstr."&uname=$uname" ;
  echo "case \"".$i."\" : { window.location.href='".$jstr."' ; break ;} \n" ;
}
echo "default : { window.location.href='cal_adminweek.php?op=week&date=".date("Y-m-d", mktime(0,0,0,$hm,$hd,$hy))."' ; break;} \n" ;
echo "\t\t}\n" ;
echo "\t}\n" ;
echo "</script>" ;

?>