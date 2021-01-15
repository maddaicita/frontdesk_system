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

include_once ("cal_header.inc.php");
include_once ("cal_utils.php") ;

if (file_exists("FCKeditor/fckeditor.php")) include("FCKeditor/fckeditor.php") ;
else $useFCKEditor = 0;	

if (!isset($_GET['add_day']))
  $add_day = '';
else
  $add_day = $_GET['add_day'];
if (!isset($_GET['add_month']))
  $add_month = '';
else
  $add_month = $_GET['add_month'];
if (!isset($_GET['add_year']))
  $add_year = '';
else
  $add_year = $_GET['add_year'];
if (!isset($_GET['id']))
  $id = '';
else
  $id = $_GET['id'];
if (!isset($_GET['catview']))
  $catview = 0;
else
  $catview = $_GET['catview'];
if (!isset($_GET['copyevent']))
  $copyevent = 0;
else
  $copyevent = $_GET['copyevent'];

if ($op == "eventform"){
	eventform($add_day,$add_month,$add_year,$id) ;
}
else if ($op == "upeventform"){
	edit($id) ;
}

// Set max length for text area
echo "<script language='javascript' type='text/javascript'>\n";
echo "<!--\n";
echo "function imposeMaxLength(Object, MaxLen)\n";
echo "{\n";
echo "  if (Object.value.length >= MaxLen) Object.value = Object.value.substring(0, MaxLen-1); \n";
echo "   return (Object.value.length <= MaxLen) ;\n";
echo "}\n";
echo "-->\n";
echo "</script>\n";

/*****************/
/* back function */
/*****************/

function back(){
  echo "<div class=normalfont align=center><a class=normalfont href=javascript:history.back()>".translate("Back")."</a></div>\n";
}

/*********************************/
/* single quote replace function */
/*********************************/
function quote145($str) {
	return str_replace("'", "&#145;", $str);
}

/**********************/
/* add event: the form */
/**********************/

function eventform($add_day,$add_month,$add_year,$id){
global $EVENTS_TB,$CAT_TB,$language,$addeventok,$mth,$d,$m,$y,$calstartyear,$caladvanceyear,$week,$notimeentry,$time12hour,$catview,$useFCKEditor,
$FCKEditorBasePath,$defaultcat;

if ($addeventok==1){
if ($add_day=="") $add_day=$d;
if ($add_month=="") $add_month=$m;
if ($add_year=="") $add_year=$y;
// Check if it is a copy event
$copyevent = false ;
if ($id!='') {
	$copyevent = true ;
	$query = "select id,title,cat_name,description,starttime,endtime,day,month,year,approved,url,email from ".$EVENTS_TB." left join ".$CAT_TB." on ".$EVENTS_TB.".cat=".$CAT_TB.".cat_id where id='$id'";
	$result = mysql_query($query);
	$copyrow = mysql_fetch_object($result);
	}

echo "<div class=titlefont>".translate("Add event")."</div><br/>";
echo "<form name=evfrm action=cal_addevent.php?op=addevent" ;
if ($copyevent) echo "&copyevent=1 method=post><div class=normalfont>\n";
else echo "&copyevent=0 method=post><div class=normalfont>\n";
echo translate("Event Title")."<br/>\n";

echo "<input type=text name=title size=70 value='";
if ($copyevent) echo stripslashes(quote145($copyrow->title)) ;
echo "' >";
echo "<br/>\n";

echo translate("Event Description")."<br/>\n";
if ($useFCKEditor) {
	$oFCKeditor = new FCKeditor('description') ;
	$oFCKeditor->BasePath = $FCKEditorBasePath;
	$oFCKeditor->Value = '';
	if ($copyevent) $oFCKeditor->Value = stripslashes($copyrow->description);
	$oFCKeditor->Create() ;
} else {
	echo "<textarea name=description cols=70 rows=7>" ;
	if ($copyevent) echo stripslashes(str_replace("<br />","",$copyrow->description));
	echo "</textarea><br/>\n";
}

echo translate("Email")." (".translate("Optional").") <br/>\n";
echo "<input type=text name=email" ;
if ($copyevent) echo " value='".$copyrow->email."' " ;
echo " size=40><br/>\n";
echo "URL"." (".translate("Optional").") "."<br/>\n" ;
echo "<input type=text name=url" ;
if ($copyevent) {
	// for compatibility with up to 0.5 version
  if ((trim($copyrow->url)<>"")&&(strtolower(substr($copyrow->url,0,4))<>"http")) 
	echo " value='http://".$copyrow->url."' ";
  else echo " value='".$copyrow->url."' ";
}
echo " size=40><br/>\n";
// get the categories
echo translate("Event Category")."<br/>\n";
echo "<select name=cat>\n\t<option value=0>".translate("Choose Category")."\n";
$query = "select cat_id,cat_name from ".$CAT_TB." order by cat_name" ;
$result = mysql_query($query);
    while ($row = mysql_fetch_object($result)){
        echo "\t<option value=".$row->cat_id ; 
	  if ($copyevent) { if (stripslashes($copyrow->cat_name)==stripslashes($row->cat_name)) echo " selected " ; } 
	  else if (($catview>0)&&($row->cat_id==$catview)) echo " selected " ;
	  else if ($row->cat_name==$defaultcat) echo " selected " ;
	  echo ">".stripslashes($row->cat_name)."\n";
    }

echo "</select>\n<br/>\n";

if ($notimeentry==0) {

// get start time
echo translate("Start Time")." (hh:mm) <br/>\n";
echo "&nbsp;<select name=starttimehr>\n\t<option value='--'>--\n";
$thour = 24 ;
$sthour = 0 ;
$midnight=false;
if ($time12hour==1) { $thour = 13 ; $sthour = 1 ; }
if (($copyevent)&&($time12hour==1)&&(substr($copyrow->starttime,0,2)=="00")) $midnight=true ;
for ($i = $sthour;$i<$thour;$i++){

if ($i<10) {
	echo "\t<option value='0$i'" ;
	if ($copyevent) { 
	  if (substr($copyrow->starttime,0,2)=="0$i") echo " selected " ; 
	  if ($time12hour==1) {
		if ((intval(substr($copyrow->starttime,0,2)) - 12) == $i) echo " selected " ;
		}
	  }
	echo ">0$i\n" ;
	}
else {
	echo "\t<option value=$i" ;
	if ($copyevent) { 
	  if (substr($copyrow->starttime,0,2)=="$i") echo " selected " ; 
	  if (($midnight)&&($i==12)) echo " selected " ;
	  if ($time12hour==1) {
		if ((intval(substr($copyrow->starttime,0,2)) - 12) == $i) echo " selected " ;
		}
	  }
	echo ">$i\n";
	}
}
echo "</select>&nbsp;<b>:</b>&nbsp;\n";
echo "<select name=starttimemin>\n";
for ($i=0;$i<60;$i=$i+5){
if ($i<10) {
	echo "\t<option value='0$i'" ;
	if ($copyevent) { if (substr($copyrow->starttime,3,2)=="0$i") echo " selected " ; }
	echo ">0$i\n" ;
	}
else {
	echo "\t<option value=$i" ;
	if ($copyevent) { if (substr($copyrow->starttime,3,2)=="$i") echo " selected " ; }
	echo ">$i\n";
	}
}
echo "</select>\n";

if ($time12hour==1) {
  echo " &nbsp; <select name='startperiod'>\n";
  echo "\t<option value='am'" ;
  if ($copyevent) { if (intval(substr($copyrow->starttime,0,2)) < 12) echo " selected " ; }
  echo ">am" ;
  echo "\t<option value='pm'" ;
  if ($copyevent) { if (intval(substr($copyrow->starttime,0,2)) >= 12) echo " selected " ; }
  echo ">pm" ;
  echo "</select><br/>\n";
}
else echo "<input type='hidden' name='startperiod' value=''><br/>\n" ;

// get end time
echo translate("End Time")." (hh:mm) <br/>\n";
echo "&nbsp;<select name=endtimehr>\n\t<option value='--'>--\n";
$thour = 24 ;
$sthour = 0 ;
$midnight=false;
if ($time12hour==1) { $thour = 13 ; $sthour = 1 ; }
if (($copyevent)&&($time12hour==1)&&(substr($copyrow->endtime,0,2)=="00")) $midnight=true ;
for ($i = $sthour;$i<$thour;$i++){
if ($i<10) {
	echo "\t<option value='0$i'" ;
	if ($copyevent) { 
	  if (substr($copyrow->endtime,0,2)=="0$i") echo " selected " ; 
	  if ($time12hour==1) {
		if ((intval(substr($copyrow->endtime,0,2)) - 12) == $i) echo " selected " ;
		}
	  }
	echo ">0$i\n" ;
	}
else {
	echo "\t<option value=$i" ;
	if ($copyevent) { 
	  if (substr($copyrow->endtime,0,2)=="$i") echo " selected " ; 
	  if (($midnight)&&($i==12)) echo " selected " ;
	  if ($time12hour==1) {
		if ((intval(substr($copyrow->endtime,0,2)) - 12) == $i) echo " selected " ;
		}
	  }
	echo ">$i\n";
	}
}
echo "</select>&nbsp;<b>:</b>&nbsp;\n";
echo "<select name=endtimemin>\n";
for ($i=0;$i<60;$i=$i+5){
if ($i<10) {
	echo "\t<option value='0$i'" ;
	if ($copyevent) { if (substr($copyrow->endtime,3,2)=="0$i") echo " selected " ; }
	echo ">0$i\n" ;
	}
else {
	echo "\t<option value=$i" ;
	if ($copyevent) { if (substr($copyrow->endtime,3,2)=="$i") echo " selected " ; }
	echo ">$i\n";
	}
}
echo "</select>\n";

if ($time12hour==1) {
  echo " &nbsp; <select name='endperiod'>\n";
  echo "\t<option value='am'" ;
  if ($copyevent) { if (intval(substr($copyrow->endtime,0,2)) < 12) echo " selected " ; }
  echo ">am" ;
  echo "\t<option value='pm'" ;
  if ($copyevent) { if (intval(substr($copyrow->endtime,0,2)) >= 12) echo " selected " ; }
  echo ">pm" ;
  echo "</select><br/>\n";
}
else echo "<input type='hidden' name='endperiod' value=''><br/>\n" ;

}

// get days
echo translate("Date")."<br/>\n";
echo "<select name=bday>\n\t<option value=0>".translate("Day")."\n";
for ($i = 1;$i<=31;$i++){
	echo "\t<option value=".$i ;
	if ($copyevent) { 
		$tday = $copyrow->day ;
	      if (substr("$tday",0,1) == "0") $tday = str_replace("0","",$tday);
		if ($i==$tday) echo " selected " ; 
		}
	else if ($add_day==$i) echo " selected " ;
	echo ">$i\n";
}
echo "</select>&nbsp;&nbsp;\n";

// get months
echo "<select name=bmonth>\n\t<option value=0>".translate("Month")."\n";
for($i=1;$i<13;$i++){
 echo "\t<option value=".$i ;
 if ($copyevent) { 
	$tmonth = $copyrow->month ;
      if (substr("$tmonth",0,1) == "0") $tmonth = str_replace("0","",$tmonth);
	if ($i==$tmonth) echo " selected " ; 
	}
 else if ($add_month==$i) echo " selected " ;
 echo ">".ucfirst($mth[$i])."\n";
}
echo "</select>&nbsp;&nbsp;\n";

// get year from "calstartyear" and give "caladvanceyear" years more to select
echo "<select name=byear>\n\t<option value=0>".translate("Year")."\n";
$year = date("Y");
for ($i=$calstartyear;$i<=($year+$caladvanceyear);$i++){
  echo "\t<option value=$i" ;
  if ($copyevent) { 
	if ($i==$copyrow->year) echo " selected " ; 
	}
  else if ($add_year==$i) echo " selected " ;
  echo ">$i\n";
}
echo "</select>\n";
$pdate = date("Y-m-d",mktime(0,0,0,$add_month,$add_day,$add_year));
echo "&nbsp;<input type=button value=\"".translate("Select")."\" onclick=\"Javascript:wopen('cal_date.php?op=smallcal&date=$pdate&frmname=evfrm&frmday=bday&frmmth=bmonth&frmyear=byear','pickdate',350,220,'no');\">";
echo "<br/>\n";

echo "<input type=radio value=one name=repeat checked> ".translate("No Repeat")." &nbsp; <input type=radio value=more name=repeat>".translate("Repeat")."\n";
echo " &nbsp; <select name=rtimes>\n";
for ($i = 1;$i<=30;$i++){
echo "\t<option value=$i" ;
if ($i==1) echo " selected " ;
echo ">$i\n";
}
echo "</select>&nbsp;&nbsp;" ;
echo translate("times every");
echo " &nbsp; <select name=rday>\n\t<option value=0 selected>".translate("Day")."\n";
for ($i = 1;$i<=7;$i++){
  echo "\t<option value=$i" ;
  echo ">$week[$i]\n";
  }
echo "\t<option value=8>" ;
echo ucfirst(translate("Two weeks"))."\n";
echo "\t<option value=9>" ;
echo translate("Month")."\n";
echo "\t<option value=10>" ;
echo translate("Year")."\n";
echo "</select>&nbsp;&nbsp;" ;
echo "<br/>\n";

echo "<br/><input type=submit value=\"".translate("Add event")."\">\n";
echo "&nbsp;&nbsp;<input type=button value=\"".translate("Close")."\" onclick='Javascript:window.close();'>\n<br/>\n";

echo "</div><form>\n";
}
else {
  echo translate("disabled");
  }
}


/********************/
/* add/update event */
/********************/

// revalidate to prevent posting of events when addevent window is open and user is logout

if ($userlogin==1) {
  if (!isset($_SESSION["login"])) { header ("location: cal_login.php"); exit(); }
  }

if (($op=="addevent")||($op=="upevent")) {
  $title = $_POST['title'];
  $description = $_POST['description'];
  $email = $_POST['email'];
  $url = $_POST['url'];
  $cat = $_POST['cat'];
  $bday = $_POST['bday'];
  $bmonth = $_POST['bmonth'];
  $byear = $_POST['byear'];
  if ($op=="addevent") {
	$repeat = $_POST['repeat'];
	$rtimes = $_POST['rtimes'];
	$rday = $_POST['rday'];
	}
  if ($notimeentry==0) {
    $starttimehr = $_POST['starttimehr'];
    $starttimemin = $_POST['starttimemin'];
    $endtimehr = $_POST['endtimehr'];
    $endtimemin = $_POST['endtimemin'];
    if ($time12hour==1) {
	$startperiod = $_POST['startperiod'] ;
	$endperiod = $_POST['endperiod'] ;
	}
  }

if ($notimeentry==0) {

  if ($op=="addevent") {
	if ($time12hour==1) {
            addevent($title,$description,$email,$url,$cat,$repeat,$bday,$bmonth,$byear,$rday,$rtimes,
            $starttimehr,$starttimemin,$endtimehr,$endtimemin,$startperiod,$endperiod);  }
       else  {
            addevent($title,$description,$email,$url,$cat,$repeat,$bday,$bmonth,$byear,$rday,$rtimes,
            $starttimehr,$starttimemin,$endtimehr,$endtimemin,"--","--");  }

  }
  elseif ($op=="upevent") {
	if ($time12hour==1) {
            upevent($id,$title,$description,$email,$url,$cat,$bday,$bmonth,$byear,$starttimehr,$starttimemin,$endtimehr,$endtimemin,$startperiod,$endperiod);  
		}
       else {
            upevent($id,$title,$description,$email,$url,$cat,$bday,$bmonth,$byear,$starttimehr,$starttimemin,$endtimehr,$endtimemin,"--","--");  
		}
  }
}
elseif ($op=="addevent"){
  addevent($title,$description,$email,$url,$cat,$repeat,$bday,$bmonth,$byear,$rday,$rtimes,
"--","--","--","--","am","am");
  }
elseif ($op=="upevent") {
  upevent($id,$title,$description,$email,$url,$cat,$bday,$bmonth,$byear,
"--","--","--","--","am","am");
  }
}


function addevent($title,$description,$email,$url,$cat,$repeat,$bday,$bmonth,$byear,$rday,$rtimes,$starttimehr,$starttimemin,$endtimehr,$endtimemin,$startperiod,$endperiod){
global $EVENTS_TB,$CAT_TB,$caleventapprove,$userlogin,$timezone,$mailevent,
$emailrcpt,$mth,$week,$notimeentry,$calstartyear,$caladvanceyear,$copyevent,$time12hour,$id,$useFCKEditor;

if (!$title) { echo "<div class=normalfont align=center>".translate("notitle")."</div><br/>" ; back(); }
elseif (!$description) { echo "<div class=normalfont align=center>".translate("nodescription")."</div><br/>" ; back(); }
elseif (!$cat) { echo "<div class=normalfont align=center>".translate("nocat")."</div><br/>" ; back(); }
elseif (!$bday) { echo "<div class=normalfont align=center>".translate("noday")."</div><br/>" ; back(); }
elseif (!$bmonth) { echo "<div class=normalfont align=center>".translate("nomonth")."</div><br/>"; back(); }
elseif (!$byear) { echo "<div class=normalfont align=center>".translate("noyear")."</div><br/>"; back(); }

else {

$title = addslashes($title);
if ($useFCKEditor) $description = addslashes($description);
else $description = addslashes(nl2br($description));

$approve = $caleventapprove;
$nobody = $emailrcpt ;
if ($userlogin==1) {
  if (isset($_SESSION["login"])) {
	$nobody = $_SESSION["login"] ;
  }
}

echo $stime = '' ;
echo $etime = '' ;

if ($notimeentry==0) {
  if ($starttimehr!="--") {
    if ($time12hour==1) {
	$stime = convert12to24($starttimehr,$startperiod).":".$starttimemin ;
	}
    else
      $stime = $starttimehr.":".$starttimemin ;
    }
  if ($endtimehr!="--") {
    if ($time12hour==1) {
	$etime = convert12to24($endtimehr,$endperiod).":".$endtimemin ;
	}
    else
      $etime = $endtimehr.":".$endtimemin ;
    }
}

// get the correct timezone offset for timestamping of event entries
$timestamp = date("YmdHis",mktime(date("G")+$timezone,date("i"),date("s"),date("n"),date("j"),date("Y"))) ;
if ((date("G")+$timezone)>24) $timestamp = date("YmdHis",mktime(date("G")+$timezone-24,date("i"),date("s"),date("n"),date("j")+1,date("Y"))) ;
if ((date("G")+$timezone)<0) $timestamp = date("YmdHis",mktime(date("G")+$timezone+24,date("i"),date("s"),date("n"),date("j")-1,date("Y"))) ;
$timestamp = strval($timestamp) ;

$query = "insert into ".$EVENTS_TB." values
(null,'$timestamp','$title','$description','$url','$email','$cat','$stime','$etime','$bday','$bmonth','$byear','$approve','0','$nobody','')";
$result = mysql_query($query);

// Mail portion
if ($mailevent==1) {

$catquery = "select cat_name from ".$CAT_TB." where cat_id=$cat" ;
$catresult = mysql_query($catquery);
$catrow = mysql_fetch_object($catresult) ;

$mailhead = translate("Date").": ".$bday." ".$mth[$bmonth]." ".$byear ;
$mailhead = $mailhead."\r\n".translate("From").": " ;
if ($time12hour==1) $mailhead = $mailhead.show12hour($stime) ;
else $mailhead = $mailhead.$stime ;
$mailhead = $mailhead."     ".translate("To").": " ;
if ($time12hour==1) $mailhead = $mailhead.show12hour($etime) ;
else $mailhead = $mailhead.$etime ;
$mailhead = $mailhead."\r\n".translate("Category").": ".stripslashes($catrow->cat_name) ;
$mailhead = $mailhead."\r\n".translate("Event Title").": ".stripslashes(stripslashes($title)) ;
$mailhead = $mailhead."\r\n".translate("Event Description").": \r\n\r\n" ;
$maildesc = "\r\n\r\n".translate("Email").": ".$email ;
$maildesc = $maildesc."\r\n".translate("More info").": ".$url ;
if ($repeat=="more") {
	$maildesc = "\r\n\r\n ".translate("Event repeated")." ".$rtimes." ".translate("times every")." " ;
	if ($rday==0) { $maildesc = $maildesc.translate("Day")." \r\n" ; }
	else if ($rday==8) { $maildesc = $maildesc.translate("Two weeks")." \r\n" ; }
	else if ($rday==9) { $maildesc = $maildesc.translate("Month")." \r\n" ; }
	else if ($rday==10) { $maildesc = $maildesc.translate("Year")." \r\n" ; }
	else { $maildesc = $maildesc.$week[$rday]." \r\n" ; }
	}

mail($emailrcpt, "Event added - ".stripslashes(stripslashes($title))." (".$bday." ".$mth[$bmonth]." ".$byear.") ", $mailhead.stripslashes(stripslashes(str_replace("<br />","",$description))).$maildesc,
     "From: ".$nobody."\r\n"
    ."Reply-To: ".$nobody."\r\n");
}

 $year = date("Y");
 $repeatadd = 0 ;
 if ($repeat == "more"){
    $repeatset = false ;
    if ($rday<8) {
      while ($repeatadd<$rtimes) {
	  // run through a day at a time until correct day found then flag to set with repeatset
        $mdate = date("d-m-Y", mktime(0,0,0,$bmonth,++$bday,$byear)) ;
	  if ($rday==0) $repeatset = true ;
        else if ($rday==(intval(date("w",mktime(0,0,0,$bmonth,$bday,$byear)))+1)){
	    $repeatset = true ;
	    }
        if ($repeatset) {
          $bday = substr("$mdate",0,2);
            if (substr("$bday",0,1) == "0"){
              $bday = str_replace("0","",$bday);
            }
          $bmonth = substr("$mdate",3,2);
          if (substr("$bmonth",0,1) == "0"){
             $bmonth = str_replace("0","",$bmonth);
            }
          $byear = substr("$mdate",6,4);
          $query = "insert into ".$EVENTS_TB." values
(null,'$timestamp','$title','$description','$url','$email','$cat','$stime','$etime','$bday','$bmonth','$byear','$approve','0','$nobody','')";
          $result = mysql_query($query);
	    $repeatadd++ ;
	    $repeatset = false ;
	    }
	  }
	}
    else if ($rday==8) {
      while ($repeatadd<$rtimes) {
	  // add 14 days each time to be every 2 weeks
	  $bday = $bday + 14 ;
        $mdate = date("d-m-Y", mktime(0,0,0,$bmonth,$bday,$byear)) ;
        $bday = substr("$mdate",0,2);
          if (substr("$bday",0,1) == "0"){
            $bday = str_replace("0","",$bday);
          }
        $bmonth = substr("$mdate",3,2);
        if (substr("$bmonth",0,1) == "0"){
           $bmonth = str_replace("0","",$bmonth);
          }
        $byear = substr("$mdate",6,4);
	  if (($year+$caladvanceyear)<(intval($byear))) break ;
        $query = "insert into ".$EVENTS_TB." values
(null,'$timestamp','$title','$description','$url','$email','$cat','$stime','$etime','$bday','$bmonth','$byear','$approve','0','$nobody','')";
        $result = mysql_query($query);
	  $repeatadd++ ;
	  }
    }
    else if ($rday==9) {
      while ($repeatadd<$rtimes) {
	  // add 1 month each time
	  $bmonth++ ;
	  if (date("t",mktime(0,0,0,$bmonth,1,$byear))>=$bday) {
          $mdate = date("d-m-Y", mktime(0,0,0,$bmonth,$bday,$byear)) ;
          $bday = substr("$mdate",0,2);
            if (substr("$bday",0,1) == "0"){
              $bday = str_replace("0","",$bday);
            }
          $bmonth = substr("$mdate",3,2);
          if (substr("$bmonth",0,1) == "0"){
             $bmonth = str_replace("0","",$bmonth);
            }
          $byear = substr("$mdate",6,4);
          if (($year+$caladvanceyear)<(intval($byear))) break ;
          $query = "insert into ".$EVENTS_TB." values
(null,'$timestamp','$title','$description','$url','$email','$cat','$stime','$etime','$bday','$bmonth','$byear','$approve','0','$nobody','')";
          $result = mysql_query($query);
	    }
	  $repeatadd++ ;
	  }
      }
    else if ($rday==10) {
      while ($repeatadd<$rtimes) {
	  // add 1 year each time
	  $byear++ ;
        $mdate = date("d-m-Y", mktime(0,0,0,$bmonth,$bday,$byear)) ;
        $bday = substr("$mdate",0,2);
          if (substr("$bday",0,1) == "0"){
            $bday = str_replace("0","",$bday);
          }
        $bmonth = substr("$mdate",3,2);
        if (substr("$bmonth",0,1) == "0"){
           $bmonth = str_replace("0","",$bmonth);
          }
        $byear = substr("$mdate",6,4);
	  if (($year+$caladvanceyear)<(intval($byear))) break ;
        $query = "insert into ".$EVENTS_TB." values
(null,'$timestamp','$title','$description','$url','$email','$cat','$stime','$etime','$bday','$bmonth','$byear','$approve','0','$nobody','')";
        $result = mysql_query($query);
	  $repeatadd++ ;
	  }
    }
}

if ($caleventapprove == 0) {
  echo "<div class=normalfont align=center>";
  echo translate("thankyou")."<br/>";
  if ($copyevent) {
	echo "<br/>"."<a class=normalfont href=\"#\" onclick='Javascript:self.window.close();top.opener.window.location.href=\"cal_popup.php?reload=y&op=view&id=$id\";
'>".translate("Close")."</a>"."</div>\n" ;

	}
  else {
	echo "<br/><a class=normalfont href=\"#\" onclick='Javascript:window.close();top.opener.window.location.reload();'>".translate("Close")."</a></div>\n" ;
	}
  }
else {
  echo "<div class=normalfont align=center>";
  echo translate("thankyoupost")."<br/>";
  if ($copyevent) {
	echo "<br/><a class=normalfont href=\"#\" onclick='Javascript:self.window.close();top.opener.window.location.href=\"cal_popup.php?reload=y&op=view&id=$id\";
'>".translate("Close")."</a></div>\n" ;

	}
  else echo "<br/><a class=normalfont href=\"#\" onclick='Javascript:window.close();top.opener.window.location.reload();'>".translate("Close")."</a></div>\n" ;
  }
 }
}

/**********************/
/* update event: form */
/**********************/

function edit($id){
global $EVENTS_TB,$CAT_TB,$mth,$calstartyear,$caladvanceyear,$notimeentry,$time12hour,$useFCKEditor,$FCKEditorBasePath;

$query = "select id,title,description,url,email,cat,cat_name,starttime,endtime,day,month,year from ".$EVENTS_TB." left join ".$CAT_TB." on ".$EVENTS_TB.".cat=".$CAT_TB.".cat_id where ".$EVENTS_TB.".id='$id'";
$result = mysql_query($query);
$rowe = mysql_fetch_object($result);

echo "<div class=titlefont>".translate("Update Event")."</div><br/>\n";
echo "<div class=normalfont>\n" ;
echo "<form name=evfrm action='cal_addevent.php?op=upevent&id=$id' method=post>\n";
echo translate("Event Title")."<br/>\n";
echo "<input type=text name=title value='".stripslashes(quote145($rowe->title))."' size=70 onkeypress='return imposeMaxLength(this, 255)';><br/>\n";

echo translate("Event Description")."<br/>\n";
if ($useFCKEditor) {
	$oFCKeditor = new FCKeditor('description') ;
	$oFCKeditor->BasePath = $FCKEditorBasePath;
	$oFCKeditor->Value = stripslashes($rowe->description);
	$oFCKeditor->Create() ;
} else {
	echo "<textarea name=description cols=70 rows=7>";
	echo stripslashes(str_replace("<br />","",$rowe->description));
	echo "</textarea><br/>\n";
}

echo translate("Email")." (".translate("Optional").") <br/>\n";
echo "<input type=text name=email value=\"".$rowe->email."\" size=40><br/>\n";
echo "URL (".translate("Optional").") <br/>\n";
echo "<input type=text name=url value='";
if ((trim($rowe->url)<>"")&&(strtolower(substr($rowe->url,0,4))<>"http"))
  echo "http://".$rowe->url."' size=40><br/>\n";
else echo $rowe->url."' size=40><br/>\n";
// get the categories
echo translate("Event Category")."<br/>";
echo "<select name=cat>\n\t";
$query = "select cat_id,cat_name from ".$CAT_TB." order by cat_name" ;
$result = mysql_query($query);
    while ($row = mysql_fetch_object($result)){
        echo "\t<option value=".$row->cat_id;
        if ($rowe->cat == $row->cat_id){
            echo " selected";
        }
        echo ">".stripslashes($row->cat_name)."\n";
    }

echo "</select>\n<br/>\n";

if ($notimeentry==0) {

// get start time
echo translate("Start Time")." (hh:mm) <br/>\n";
echo "&nbsp;<select name=starttimehr>\n\t<option value='--'>--\n";
$thour = 24 ;
$sthour = 0 ;
$midnight=false;
if ($time12hour==1) { $thour = 13 ; $sthour = 1 ; }

if (($time12hour==1)&&(substr($rowe->starttime,0,2)=="00")) $midnight=true ;
for ($i = $sthour;$i<$thour;$i++){
if ($i<10) {
	echo "\t<option value='0$i'" ;
	if (substr($rowe->starttime,0,2)==("0".$i)) echo " selected" ;
	if ($time12hour==1) {
	  if ((intval(substr($rowe->starttime,0,2)) - 12) == $i) echo " selected " ;
	  }
	echo ">0$i\n" ;
	}
else {
	echo "\t<option value=$i" ;
	if (substr($rowe->starttime,0,2)=="$i") echo " selected" ;
      if (($midnight)&&($i==12)) echo " selected " ;
	if ($time12hour==1) {
	  if ((intval(substr($rowe->starttime,0,2)) - 12) == $i) echo " selected " ;
	  }
	echo ">$i\n";
	}
}
echo "</select>&nbsp;<b>:</b>&nbsp;\n";
echo "<select name=starttimemin>\n";
for ($i=0;$i<60;$i=$i+5){
if ($i<10) {
	echo "\t<option value='0$i'" ;
	if (substr($rowe->starttime,3,2)==("0".$i)) echo " selected" ;
	echo ">0$i\n" ;
	}
else {
	echo "\t<option value=$i" ;
	if (substr($rowe->starttime,3,2)=="$i") echo " selected" ;
	echo ">$i\n";
	}
}
echo "</select>\n";

if ($time12hour==1) {
  echo " &nbsp; <select name='startperiod'>\n";
  echo "\t<option value='am'" ;
  if (intval(substr($rowe->starttime,0,2)) < 12) echo " selected " ; 
  echo ">am" ;
  echo "\t<option value='pm'" ;
  if (intval(substr($rowe->starttime,0,2)) >= 12) echo " selected " ; 
  echo ">pm" ;
  echo "</select><br/>\n";
}
else echo "<input type='hidden' name='startperiod' value=''><br/>\n" ;

// get end time
echo translate("End Time")." (hh:mm) <br/>\n";
echo "&nbsp;<select name=endtimehr>\n\t<option value='--'>--\n";
$thour = 24 ;
$sthour = 0 ;
$midnight=false;
if ($time12hour==1) { $thour = 13 ; $sthour = 1 ; }
if (($time12hour==1)&&(substr($rowe->endtime,0,2)=="00")) $midnight=true ;
for ($i = $sthour;$i<$thour;$i++){
if ($i<10) {
	echo "\t<option value='0$i'" ;
	if (substr($rowe->endtime,0,2)==("0".$i)) echo " selected" ;
	if ($time12hour==1) {
	  if ((intval(substr($rowe->endtime,0,2)) - 12) == $i) echo " selected " ;
	  }
	echo ">0$i\n" ;
	}
else {
	echo "\t<option value=$i" ;
	if (substr($rowe->endtime,0,2)=="$i") echo " selected" ;
	if (($midnight)&&($i==12)) echo " selected " ;
      if ($time12hour==1) {
	  if ((intval(substr($rowe->endtime,0,2)) - 12) == $i) echo " selected " ;
	  }
	echo ">$i\n";
	}
}
echo "</select>&nbsp;<b>:</b>&nbsp;\n";
echo "<select name=endtimemin>\n";
for ($i=0;$i<60;$i=$i+5){
if ($i<10) {
	echo "\t<option value='0$i'" ;
	if (substr($rowe->endtime,3,2)==("0".$i)) echo " selected" ;
	echo ">0$i\n" ;
	}
else {
	echo "\t<option value=$i" ;
	if (substr($rowe->endtime,3,2)=="$i") echo " selected" ;
	echo ">$i\n";
	}
}
echo "</select>\n";

if ($time12hour==1) {
  echo " &nbsp; <select name='endperiod'>\n";
  echo "\t<option value='am'" ;
  if (intval(substr($rowe->endtime,0,2)) < 12) echo " selected " ; 
  echo ">am" ;
  echo "\t<option value='pm'" ;
  if (intval(substr($rowe->endtime,0,2)) >= 12) echo " selected " ; 
  echo ">pm" ;
  echo "</select><br/>\n";
}
else echo "<input type='hidden' name='endperiod' value=''><br/>\n" ;

}

// get days
echo translate("Date")."<br/>\n";
echo "<select name=bday>\n\t";
for ($i = 1;$i<=31;$i++){
	echo "\t<option value=".$i;
	if ($rowe->day == $i){
	echo " selected";
}
echo ">$i\n";
}
echo "</select>&nbsp;&nbsp;\n";

// get months
echo "<select name=bmonth>\n\t<option value=0>".translate("Month")."\n";
for($i=1;$i<13;$i++){ 
  echo "\t<option";
  if ($rowe->month == $i){
    echo " selected";
  }
  echo " value=".$i.">".ucfirst($mth[$i])."\n"; 
} 
echo "</select>&nbsp;&nbsp;\n";

// get year from "calstartyear" and give "caladvanceyear" years more to select
echo "<select name=byear>\n\t<option value=0>".translate("Year")."\n";
$year = date("Y");
for ($i=$calstartyear;$i<=($year+$caladvanceyear);$i++){
  echo "\t<option value=$i" ;
  if ($rowe->year==$i) echo " selected " ;
  echo ">$i\n";
}
echo "</select>\n";
$pdate = date("Y-m-d",mktime(0,0,0,$rowe->month,$rowe->day,$rowe->year));
echo "&nbsp;<input type=button value=\"".translate("Select")."\" onclick=\"Javascript:wopen('cal_date.php?op=smallcal&date=$pdate&frmname=evfrm&frmday=bday&frmmth=bmonth&frmyear=byear','pickdate',220,200,'no');\"><br/>";
echo "<br/><input type=submit value=\"".translate("Update Event")."\">\n &nbsp; \n";
echo "<input type=button value=\"".translate("Cancel")."\" onClick=\"Javascript:window.close();\">\n<br/>\n";
echo "<form></div>\n";
}

/****************/
/* update event */
/****************/
function upevent($id,$title,$description,$email,$url,$cat,$bday,$bmonth,$byear,
$starttimehr,$starttimemin,$endtimehr,$endtimemin,$startperiod,$endperiod){
global $EVENTS_TB,$timezone,$notimeentry,$time12hour,$popupevent,$useFCKEditor,$mth,$mailevent,$userlogin,$emailrcpt,$CAT_TB ;

$title = addslashes($title);
if ($useFCKEditor) $description = addslashes($description);
else $description = addslashes(nl2br($description));

echo $stime = '' ;
echo $etime = '' ;

if ($notimeentry==0) {
  if ($starttimehr!="--") {
    if ($time12hour==1) {
	$stime = convert12to24($starttimehr,$startperiod).":".$starttimemin ;
	}
    else
      $stime = $starttimehr.":".$starttimemin ;
    }
  if ($endtimehr!="--") {
    if ($time12hour==1) {
	$etime = convert12to24($endtimehr,$endperiod).":".$endtimemin ;
	}
    else
      $etime = $endtimehr.":".$endtimemin ;
    }
}

// get the correct timezone offset for timestamping of event entries
$timestamp = date("YmdHis",mktime(date("G")+$timezone,date("i"),date("s"),date("n"),date("j"),date("Y"))) ;
if ((date("G")+$timezone)>24) $timestamp = date("YmdHis",mktime(date("G")+$timezone-24,date("i"),date("s"),date("n"),date("j")+1,date("Y"))) ;
if ((date("G")+$timezone)<0) $timestamp = date("YmdHis",mktime(date("G")+$timezone+24,date("i"),date("s"),date("n"),date("j")-1,date("Y"))) ;
$timestamp = strval($timestamp) ;

$query = "update ".$EVENTS_TB." set timestamp='$timestamp',title='$title',description='$description',url='$url',email='$email',cat='$cat',day='$bday',month='$bmonth',year='$byear' " ;

if ($notimeentry==0) {
  if ($starttimehr!="--") { 
    if ($time12hour==1) 
	$query = $query.",starttime='".convert12to24($starttimehr,$startperiod).":".$starttimemin."' " ; 
    else
	$query = $query.",starttime='".$starttimehr.":".$starttimemin."' " ; 
    }
  else { $query = $query.",starttime='' " ; }
  if ($endtimehr!="--") { 
    if ($time12hour==1) 
	$query = $query.",endtime='".convert12to24($endtimehr,$endperiod).":".$endtimemin."' " ; 
    else
	$query = $query.",endtime='".$endtimehr.":".$endtimemin."' " ; 
	}
  else { $query = $query.",endtime='' " ; }
}
else {
  $query = $query.",starttime='' ".",endtime='' " ; }

$query = $query." where id='$id'";
$result = mysql_query($query);

echo "<script language=\"JavaScript\">\n" ;
echo "<!--\n" ;
if ($popupevent==1) 
  echo "self.window.close();top.opener.window.location.href=\"cal_popup.php?reload=y&op=view&id=$id\";\n" ;
else
  echo "self.window.close();top.opener.window.location.reload();\n" ;
echo "</script>\n" ;

// Mail portion
if ($mailevent==1) {
	$nobody = $emailrcpt ;
	if ($userlogin==1) {
	  if (isset($_SESSION["login"])) {
		$nobody = $_SESSION["login"] ;
	  }
	}

	$catquery = "select cat_name from ".$CAT_TB." where cat_id=$cat" ;
	$catresult = mysql_query($catquery);
	$catrow = mysql_fetch_object($catresult) ;
	
	$mailhead = translate("Date").": ".$bday." ".$mth[$bmonth]." ".$byear ;
	$mailhead = $mailhead."\r\n".translate("From").": " ;
	if ($time12hour==1) $mailhead = $mailhead.show12hour($stime) ;
	else $mailhead = $mailhead.$stime ;
	$mailhead = $mailhead."     ".translate("To").": " ;
	if ($time12hour==1) $mailhead = $mailhead.show12hour($etime) ;
	else $mailhead = $mailhead.$etime ;
	$mailhead = $mailhead."\r\n".translate("Category").": ".stripslashes($catrow->cat_name) ;
	$mailhead = $mailhead."\r\n".translate("Event Title").": ".stripslashes(stripslashes($title)) ;
	$mailhead = $mailhead."\r\n".translate("Event Description").": \r\n\r\n" ;
	$maildesc = "\r\n\r\n".translate("Email").": ".$email ;
	$maildesc = $maildesc."\r\n".translate("More info").": ".$url ;
	
//	echo "<h3>".$mailhead."</h3>";
	
	mail($emailrcpt, "Event updated - ".stripslashes(stripslashes($title))." (".$bday." ".$mth[$bmonth]." ".$byear.") ", $mailhead.stripslashes(stripslashes(str_replace("<br />","",$description))).$maildesc,
	     "From: ".$nobody."\r\n"
	    ."Reply-To: ".$nobody."\r\n");	    
	}
}

?>
</body>
</html>
