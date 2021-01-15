<?php
##########################################################################
#  Please refer to the README file for licensing and contact information.
# 
#  This file has been updated for version 0.7.20060401 
# 
#  If you like this application, do support me in its development 
#  by sending any contributions at www.calendarix.com.
#
#  This is file is identical to one in admin section of same name.
#
#  Copyright © 2002-2006 Vincent Hor
##########################################################################

include ('cal_header.inc.php');
include ('cal_utils.php');

$scyear = substr($date,0,4) ;
$scmonth = substr($date,5,2) ;
if (substr($scmonth,0,1) == "0")
  $scmonth = str_replace("0","",$scmonth);

smallmonth($scmonth,$scyear,true,$d,$m,$y,true) ;

?>
<div align=center class=normalfont>
<?php
$pdate = date("Y-m-d",mktime(0,0,0,$scmonth-1,1,$scyear)) ;
if (date("Y",mktime(0,0,0,$scmonth-1,1,$scyear))>=$calstartyear)
  echo "<a class=normalfont href='smallcal.php?op=smallcal&amp;date=$pdate'>&lt;&lt;</a>";
echo "&nbsp; &nbsp; &nbsp; ";
?>

<a href="#" class=normalfont onClick="Javascript:self.window.close();"><?php echo translate("Close") ;?></a>

<?php
echo "&nbsp; &nbsp; &nbsp; ";
$pdate = date("Y-m-d",mktime(0,0,0,$scmonth+1,1,$scyear)) ;
if (date("Y",mktime(0,0,0,$scmonth+1,1,$scyear))<=$y+$caladvanceyear)
  echo "<a class=normalfont href='smallcal.php?op=smallcal&amp;date=$pdate'>&gt;&gt;</a>";
?>
</div>

</body>
</html>