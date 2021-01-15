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

include ('cal_header.inc.php');
include ("search_func.php");
include ("../cal_utils.php") ;

if (file_exists("../FCKeditor/fckeditor.php")) include("../FCKeditor/fckeditor.php") ;
else $useFCKEditor = 0;	

if (!isset($_GET['history']))
  $history = -2;
else
  $history = $_GET['history'];

#today's date and search
echo "<table class=todaytop width=100% align=center border=0><tr><td align=left valign=top>" ;
$weekday = date ("w", mktime(12,0,0,$m,$d,$y));
$weekday++;
echo $week[$weekday]." ".$d." ".ucfirst($mth[$m])." ".$y;
echo "</td><td align=right>" ;
search() ;
echo "</td></tr></table>" ;

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

/*********************************/
/* single quote replace function */
/*********************************/
function quote145($str) {
	return str_replace("'", "&#145;", $str);
}

/**************/
/* view event */
/**************/

function view($id){
global $EVENTS_TB,$CAT_TB,$mth,$notimeentry,$week;

$query = "select id,title,cat_name,description,starttime,endtime,day,month,year,approved,url,email,user,DATE_FORMAT(timestamp,'%Y-%m-%d %H:%i:%s') as timestamp from ".$EVENTS_TB." left join ".$CAT_TB." on ".$EVENTS_TB.".cat=".$CAT_TB.".cat_id where id='$id'";
$result = mysql_query($query);
$row = mysql_fetch_object($result);
echo "<div class=menufont>" ;
echo "<a href='cal_event.php?op=edit&id=".$row->id."&history=-3'>".translate("Edit event")."</a>\n";
echo " - <a href='cal_event.php?op=delev&id=".$row->id."&history=-3' >".translate("Delete event")."</a>\n";
if ($row->approved != 1){
echo " - <a href=calendar.php?op=approve&id=".$row->id.">".translate("Approve")."</a>\n"; }
echo "</div><hr/>" ;
echo "<div class=titlefont><u>".stripslashes($row->title)."</u></div><br/>\n";
echo "<div class=normalfont>\n";
$weekday = mktime(0,0,0,$row->month,$row->day,$row->year);
$weekday = strftime("%w",$weekday);
$weekday++;
echo "<b>".translate("Date")." : </b>".$row->day ." ".$mth[$row->month]." ".$row->year." (".$week[$weekday].") \n";

if ($notimeentry==0) showtime($row->starttime,$row->endtime,2);

echo "<br/>\n<b>".translate("Category")." : </b>".stripslashes($row->cat_name)."<br/>\n";
echo "<br/><b>".translate("Event Description").": </b><br/>\n<blockquote>";
echo stripslashes($row->description);
echo "</blockquote><br/>";
if ($row->email)
        echo "<br/><b>".translate("Email")." : </b><a href=mailto:".$row->email.">".$row->email."</a>\n";
if ($row->url) {
	echo "<br/><b>".translate("More info")." : </b><a href=";
	// for compatibility with up to 0.5 version
  if ((trim($row->url)<>"")&&(strtolower(substr($row->url,0,4))<>"http"))
	echo "http://".$row->url." target=_blank>http://".$row->url."</a>\n";
  else echo $row->url." target=_blank>".$row->url."</a>\n";
}
echo "<br/><br/><b>".translate("User")." : </b>".$row->user."<br/>\n";
$tyear = substr($row->timestamp,0,4) ;
$tmonth = substr($row->timestamp,5,2) ;
if (substr($tmonth,0,1) == "0") $tmonth = str_replace("0","",$tmonth);
$tday = substr($row->timestamp,8,2) ;
if (substr($tday,0,1) == "0") $tday = str_replace("0","",$tday);
$ttime = substr($row->timestamp,11,8);
echo "<b>".translate("Time added or updated")." : </b>".$tday." ".$mth[$tmonth]." ".$tyear." ".date("H:i:s",mktime(substr($ttime,0,2),substr($ttime,3,2),substr($ttime,6,2)))."<br/>\n";

echo "</div><br/>" ;

echo "<div class=menufont align=center><a href='cal_event.php?op=eventform&id=$id&history=-3'>".translate("Copy Event")."</a></div><br/>";

back() ;
}

/***********************/
/* add event: the form */
/***********************/

function eventform($add_day,$add_month,$add_year,$id,$history){
global $EVENTS_TB,$CAT_TB,$mth,$d,$m,$y,$calstartyear,$week,$caladvanceyear,$notimeentry,$time12hour,$useFCKEditor,$FCKEditorBasePath,$defaultcat;

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
echo "<div class=normalfont><form name=evfrm action='cal_event.php?op=addevent&history=$history' method=post>\n";
echo translate("Event Title")."<br/>\n";
echo "<input type=text name=title size=70 onkeypress='return imposeMaxLength(this, 255)'; " ;
if ($copyevent) echo " value='".stripslashes(quote145($copyrow->title))."' " ;
echo "><br/>\n";
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

//echo "<textarea name=description cols=50 rows=7>" ;
//if ($copyevent) echo stripslashes(str_replace("<br />","",$copyrow->description));
//echo "</textarea><br/>\n";

echo translate("Email")." (".translate("Optional").") <br/>\n";
echo "<input type=text name=email size=30" ;
if ($copyevent) echo " value=\"".$copyrow->email."\" " ;
echo "><br/>\n";
echo "URL"." (".translate("Optional").") "."<br/>\n" ;
echo "<input type=text name=url size=30" ;
if ($copyevent) {
	// for compatibility with up to 0.5 version
  if ((trim($copyrow->url)<>"")&&(strtolower(substr($copyrow->url,0,4))<>"http"))
  	echo " value='http://".$copyrow->url."' ";
  else echo " value='".$copyrow->url."' ";
}
echo "><br/>\n";

// get the categories
echo translate("Event Category")."<br/>\n";
echo "<select name=cat>\n\t<option value=0>".translate("Choose Category")."\n";
$query = "select cat_id,cat_name from ".$CAT_TB." order by cat_name" ;
$result = mysql_query($query);
    while ($row = mysql_fetch_object($result)){
        echo "\t<option value=".$row->cat_id ;
	  if ($copyevent) { if (stripslashes($copyrow->cat_name)==stripslashes($row->cat_name)) echo " selected " ; } 
	  else if ($row->cat_name==$defaultcat) echo " selected " ;	  
	  echo ">".stripslashes($row->cat_name)."\n";
    }

echo "</select>\n<br/>\n";

if ($notimeentry==0) {

// get start time
// echo "<input type=checkbox name=starttime value='on'>\n" ;
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
// echo "<input type=checkbox name=endtime value='on'>\n" ;
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

// checkbutton for repeated dates !

echo "<input type=radio value=one name=repeat checked> ".translate("No Repeat")." &nbsp; <input type=radio value=more name=repeat>".translate("Repeat")."\n";
echo " &nbsp; <select name=rtimes>\n";
for ($i = 1;$i<=30;$i++){
echo "\t<option value=$i" ;
if ($i==1) echo " selected " ;
echo ">$i\n";
}
echo "</select>&nbsp;&nbsp;" ;
echo translate("times every") ;
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
echo "&nbsp;&nbsp;<input type=button value=\"".translate("Cancel")."\" onclick='Javascript:window.history.go(-1);'>\n<br/>\n";

echo "</form>\n";

}

/*************/
/* add event */
/*************/

if ($op == "addevent" || $op == "upevent"){

  if ($op == "addevent"){
    $repeat = $_POST['repeat'];
    $rtimes = $_POST['rtimes'];
    $rday = $_POST['rday'];
  }

  $title = $_POST['title'];
  $description = $_POST['description'];
  $email = $_POST['email'];
  $url = $_POST['url'];
  $cat = $_POST['cat'];
  $bday = $_POST['bday'];
  $bmonth = $_POST['bmonth'];
  $byear = $_POST['byear'];
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
}

function addevent($title,$description,$url,$email,$cat,$repeat,$bday,$bmonth,$byear,$rday,$rtimes,
$starttimehr,$starttimemin,$endtimehr,$endtimemin,$startperiod,$endperiod,$history){
global $EVENTS_TB,$CAT_TB,$caleventadminapprove,$timezone,$notimeentry,$time12hour,$useFCKEditor;

$title = addslashes($title);
if ($useFCKEditor) $description = addslashes($description);
else $description = addslashes(nl2br($description));
$approve = $caleventadminapprove;

if (!$title) { echo "<div class=normalfont align=center>".translate("notitle")."</div><br/>" ; back(); }
elseif (!$description) { echo "<div class=normalfont align=center>".translate("nodescription")."</div><br/>" ; back(); }
elseif (!$cat) { echo "<div class=normalfont align=center>".translate("nocat")."</div><br/>" ; back(); }
elseif (!$bday) { echo "<div class=normalfont align=center>".translate("noday")."</div><br/>" ; back(); }
elseif (!$bmonth) { echo "<div class=normalfont align=center>".translate("nomonth")."</div><br/>"; back(); }
elseif (!$byear) { echo "<div class=normalfont align=center>".translate("noyear")."</div><br/>"; back(); }

else {

$nobody = '' ;
  if (isset($_SESSION["login"])) {
	$nobody = $_SESSION["login"] ;
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

  $sdate = date("Y-m-d", mktime(0,0,0,$bmonth,$bday,$byear)) ;

// get the correct timezone offset for timestamping of event entries
$timestamp = date("YmdHis",mktime(date("G")+$timezone,date("i"),date("s"),date("n"),date("j"),date("Y"))) ;
if ((date("G")+$timezone)>24) $timestamp = date("YmdHis",mktime(date("G")+$timezone-24,date("i"),date("s"),date("n"),date("j")+1,date("Y"))) ;
if ((date("G")+$timezone)<0) $timestamp = date("YmdHis",mktime(date("G")+$timezone+24,date("i"),date("s"),date("n"),date("j")-1,date("Y"))) ;
$timestamp = strval($timestamp) ;

  $query = "insert into ".$EVENTS_TB." values
(null,'$timestamp','$title','$description','$url','$email','$cat','$stime','$etime','$bday','$bmonth','$byear','$approve','0','$nobody','')";
  $result = mysql_query($query);
 
 $year = date("Y");
 $repeatadd = 0 ;
 if ($repeat == "more"){
    $repeatset = false ;
    if ($rday<8) {
      while ($repeatadd<$rtimes) {
        // run through a day at a time until correct day found then flag to set with repeatset
        $mdate = date("Y-m-d", mktime(0,0,0,$bmonth,++$bday,$byear)) ;
        if ($rday==0) $repeatset = true ;
	  else if ($rday==(intval(date("w",mktime(0,0,0,$bmonth,$bday,$byear)))+1)){
	    $repeatset = true ;
	    }
	  if ($repeatset) {
          $bday = substr("$mdate",8,2);
          if (substr("$bday",0,1) == "0"){
             $bday = str_replace("0","",$bday);
            }
          $bmonth = substr("$mdate",5,2);
          if (substr("$bmonth",0,1) == "0"){
             $bmonth = str_replace("0","",$bmonth);
          }

        $byear = substr("$mdate",0,4);
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

  echo "<h4>".translate("Adding event")." ...</h4>" ;
  if ($history==-3) {
    echo "<script language='Javascript'>";
    echo "<!-- \n";    
    echo "history.go(-3);";
    echo "// --> \n";        
    echo "</script>";    
    }
  else {
    echo "<script language='Javascript'>";
    echo "<!-- \n";    
    echo "history.go(-2);";
    echo "// --> \n";        
    echo "</script>";
    }
  }
}

/**********************/
/* update event: form */
/**********************/

function edit($id,$history){
global $EVENTS_TB,$CAT_TB,$mth,$calstartyear,$caladvanceyear,$notimeentry,$time12hour,$useFCKEditor,$FCKEditorBasePath;

$query = "select id,title,description,url,email,cat,cat_name,starttime,endtime,day,month,year from ".$EVENTS_TB." left join ".$CAT_TB." on ".$EVENTS_TB.".cat=".$CAT_TB.".cat_id where ".$EVENTS_TB.".id='$id'";
$result = mysql_query($query);
$rowe = mysql_fetch_object($result);

echo "<div class=titlefont>".translate("Update Event")."</div><br/>\n";
echo "<div class=normalfont>\n" ;
echo "<form name=evfrm action='cal_event.php?op=upevent&id=$id&history=$history' method=post>\n";
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

//echo "<textarea name=description cols=50 rows=7>";
//echo stripslashes(str_replace("<br />","",$rowe->description));
//echo "</textarea><br/>\n";
echo translate("Email")."<br/>\n";
echo "<input type=text name=email value=\"".$rowe->email."\" size=40><br/>\n";
echo "URL<br/>\n";
echo "<input type=text name=url value='";
if ((trim($rowe->url)<>"")&&(strtolower(substr($rowe->url,0,4))<>"http"))
  echo "http://".$rowe->url."' size=40><br/>\n";
else echo $rowe->url."' size=40><br/>\n";
// get the categories
echo translate("Category")."<br/>";
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
echo "<input type=button value=\"".translate("Cancel")."\" onClick=\"Javascript:window.history.go(-1);\">\n<br/>\n";
echo "<form></div>\n";
}

/****************/
/* update event */
/****************/

function upevent($id,$title,$description,$url,$email,$cat,$bday,$bmonth,$byear,
$starttimehr,$starttimemin,$endtimehr,$endtimemin,$startperiod,$endperiod,$history){
global $EVENTS_TB,$timezone,$notimeentry,$time12hour,$useFCKEditor ;

$title = addslashes($title);
if ($useFCKEditor) $description = addslashes($description);
else $description = addslashes(nl2br($description));

//$url = str_replace("http://","",$url);

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
echo "<h4>".translate("Updating event")." ...</h4>" ;
if ($history==-3){
    echo "<script language='Javascript'>";
    echo "<!-- \n";    
    echo "history.go(-3);";
    echo "// --> \n";        
    echo "</script>";    
	}
else {
    echo "<script language='Javascript'>";
    echo "<!-- \n";    
    echo "history.go(-2);";
    echo "// --> \n";        
    echo "</script>";
	}
}

/**************************/
/* delete event: question */
/**************************/

function delev($id,$history){
global $EVENTS_TB,$CAT_TB,$mth,$notimeentry;

echo "<div class=titlefont>".translate("Delete event")." ?</div>";
echo "<hr/>" ;

$query = "select id,title,cat_name,description,starttime,endtime,day,month,year,approved,url,email,user,timestamp from ".$EVENTS_TB." left join ".$CAT_TB." on ".$EVENTS_TB.".cat=".$CAT_TB.".cat_id where id='$id'";
$result = mysql_query($query);
$row = mysql_fetch_object($result);
echo "<div class=titlefont><u>".stripslashes($row->title)."</u></div><br/>\n";
echo "<div class=normalfont>\n";
echo "<b>".translate("Date")." : </b>".$row->day ." ".$mth[$row->month]." ".$row->year." \n";

if ($notimeentry==0) showtime($row->starttime,$row->endtime,2);

echo "<br/>\n<b>".translate("Category")." : </b>".stripslashes($row->cat_name)."<br/>\n";
echo "<br/><b>".translate("Event Description").": </b><br/>\n<blockquote>";
echo stripslashes($row->description);
echo "</blockquote><br/>";
if ($row->email)
        echo "<br/><b>".translate("Email")." : </b><a href=mailto:".$row->email.">".$row->email."</a>\n";
if ($row->url) {
	echo "<br/><b>".translate("More info")." : </b><a href=";
	// for compatibility with up to 0.5 version
	if ((trim($row->url)<>"")&&(strtolower(substr($row->url,0,4))<>"http"))
	  echo "http://".$row->url." target=_blank>http://".$row->url."</a>\n";
	else echo $row->url." target=_blank>".$row->url."</a>\n";
}
echo "<br/><br/><b>".translate("User")." : </b>".$row->user."<br/>\n";
$tyear = substr($row->timestamp,0,4) ;
$tmonth = substr($row->timestamp,5,2) ;
if (substr($tmonth,0,1) == "0") $tmonth = str_replace("0","",$tmonth);
$tday = substr($row->timestamp,8,2) ;
if (substr($tday,0,1) == "0") $tday = str_replace("0","",$tday);
$ttime = substr($row->timestamp,11,8);
echo "<b>".translate("Time added or updated")." : </b>".$tday." ".$mth[$tmonth]." ".$tyear." ".date("H:i:s",mktime(substr($ttime,0,2),substr($ttime,3,2),substr($ttime,6,2)))."<br/>\n";
echo "</div><br/>" ;
echo "<div class=titlefont><a href='cal_event.php?op=delevok&id=$id&history=$history'>".translate("Yes, delete event !")."</a></div>";
back() ;

}

/********************/
/* delete event: ok */
/*******************/

function delevok($id,$history){
global $EVENTS_TB;
  $query = "delete from ".$EVENTS_TB." where id='$id'";
  mysql_query($query);
  echo "<h4>".translate("Deleting event")." ...</h4>" ;
  if ($history==-3) {
    echo "<script language='Javascript'>";
    echo "<!-- \n";    
    echo "history.go(-3);";
    echo "// --> \n";        
    echo "</script>";    
    }
  else {
    echo "<script language='Javascript'>";
    echo "<!-- \n";    
    echo "history.go(-2);";
    echo "// --> \n";        
    echo "</script>";
    }
}

if (!isset($_SESSION["login"])) header("location: cal_login.php");
else {	
  	switch ($op){

    // add event form
    case"eventform":{
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

       eventform($add_day,$add_month,$add_year,$id,$history);
    break;
    }

    // add event
    case "addevent":{

	if ($notimeentry==0) {
	  if ($time12hour==1) {
            addevent($title,$description,$url,$email,$cat,$repeat,$bday,$bmonth,$byear,$rday,$rtimes,$starttimehr,$starttimemin,$endtimehr,$endtimemin,$startperiod,$endperiod,$history);  }
         else  {
            addevent($title,$description,$url,$email,$cat,$repeat,$bday,$bmonth,$byear,$rday,$rtimes,$starttimehr,$starttimemin,$endtimehr,$endtimemin,"--","--",$history);  }
  	}
	else {
  		addevent($title,$description,$email,$url,$cat,$repeat,$bday,$bmonth,$byear,$rday,$rtimes,"--","--","--","--","am","am",$history);
	}


    break;
    }

    // view details of event    
    case "view":{
        view($id);
    break;
    }
    
    // edit event form
    case"edit":{
        edit($id,$history);
    break;
    }
    
    // update event
    case"upevent":{
	if ($time12hour==1) {
            upevent($id,$title,$description,$url,$email,$cat,$bday,$bmonth,$byear,
$starttimehr,$starttimemin,$endtimehr,$endtimemin,$startperiod,$endperiod,$history);  }
       else  {
        upevent($id,$title,$description,$url,$email,$cat,$bday,$bmonth,$byear,
$starttimehr,$starttimemin,$endtimehr,$endtimemin,"--","--",$history);  }
    break;
    }

    // delete event: question
    case"delev":{
        delev($id,$history);
    break;
    }
    
    // delete event: ok
    case"delevok":{
        delevok($id,$history);
    break;
    }
  }
}
include ('cal_footer.inc.php');
?>
