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
#  Copyright © 2002-2006 Vincent Hor
##########################################################################

include ("cal_admintop.php");

if (!isset($_GET['limit']))
  $limit = 0;
else
  $limit = $_GET['limit'];


/**************************/
/* overview of categories */
/**************************/

function cats(){
global $EVENTS_TB,$CAT_TB,$mth,$catcolor,$secondcatcolor,$y;

$query = "select cat_id,cat_name from ".$CAT_TB." order by cat_name ASC";
$result = mysql_query($query);
$rows = mysql_num_rows($result);

    // if no rows
    if ($rows == "0"){
        echo "<br/><div class=headerfont>".translate("No categories yet").".</div><br/>\n";
    }
    // show categories
    else {
        echo "<table border=0 width=100% class=headerfont cellspacing=0><tr><td align=left>".translate("Categories")."&nbsp; (".$rows.")</td></tr></table>\n";
        echo "<table border=0 cellspacing=0 cellpadding=4 width=100% class=titlefont>\n";
        $foo = '';
	while ($row = mysql_fetch_object($result)){
            $foo++ % 2 ? $color="$secondcatcolor" : $color="$catcolor";
            echo "<tr bgcolor='$color' align=left><td><a href=cal_cat.php?op=cat&id=".$row->cat_id.">".stripslashes($row->cat_name)."</a>";

		// get total number of events under category
		$tquery = "select id from ".$EVENTS_TB." where ".$EVENTS_TB.".cat='".$row->cat_id."' " ;
		$tresult = mysql_query($tquery);
		$trows = mysql_num_rows($tresult);
		echo " &nbsp; &nbsp; (".$trows." ".translate("events for whole calendar").")" ;
		echo "</td>\n";
            echo " <td align=left><div class=menufont><a href=cal_cat.php?op=editcat&id=".$row->cat_id.">".translate("Edit category")."</a></div></td>\n";
            echo " <td align=left><div class=menufont><a href=cal_cat.php?op=delcat&id=".$row->cat_id.">".translate("Delete category")."</a></div></td></tr>\n";
        }
        echo "</table>\n";
    }

echo "<hr/>\n";
echo "\n<div class=titlefont>".translate("Add Category")."\n</div>\n";
echo "<form action=cal_cat.php?op=addcat method=post>\n";
echo "<input type=text name=cat size=40><br/><br/>\n";
echo "<input type=submit value=\"".translate("Add Category")."\">\n";
echo "</form>\n";
}

/*******************************/
/* view events of one category */
/*******************************/

function cat($id,$catcolor,$secondcatcolor,$year,$sort,$cuser,$limit){
global $USER_TB,$EVENTS_TB,$CAT_TB,$language,$mth,$unapprovedclr,$titlefont,$y,$calstartyear,
$caladvanceyear,$limitrow;

$qstr = " id,title,cat_name,day,month,year,approved " ;
$query = " from ".$EVENTS_TB." left join ".$CAT_TB." on ".$EVENTS_TB.".cat=".$CAT_TB.".cat_id where ".$EVENTS_TB.".cat='$id' and ".$EVENTS_TB.".year='$year' " ;

if (($cuser!="-")&&($cuser!="")) {  // view user specific events only
  $uquery = "select username,group_id from ".$USER_TB." where ".$USER_TB.".user_id=".$cuser ;
  $uresult = mysql_query($uquery) ;
  $urow = mysql_fetch_object($uresult);
  $query .= " and ".$EVENTS_TB.".user='".$urow->username."' ";
}

if (($sort)&&($sort==1))
  $query = $query . " order by title ASC, year ASC, month ASC, day ASC";
else
  $query = $query . " order by year ASC, month ASC, day ASC, title ASC";

$tquery = "select count(*) ".$query ;
$tresult = mysql_query($tquery);
$trow = mysql_fetch_array($tresult);
$totalrows = $trow[0] ;

if ($limit>$totalrows) $limit = 0 ;
$query .= " LIMIT ".$limit.",".$limitrow ;

$query = "select ".$qstr.$query ;
$result = mysql_query($query);
$rowname = mysql_fetch_object($result);
$rows = mysql_num_rows($result);

// this is for the category sort order redirection javascript
echo "<script language=\"JavaScript\" type=\"text/JavaScript\">\n" ;
echo "\tfunction sortev(order) {\n" ;
echo "\t\tswitch (order) { \n" ;
echo "case 1 : { window.location.href='cal_cat.php?op=cat&id=".$id."&year=".$year."&sort=1&cuser=$cuser&limit=$limit' ; break ;} \n" ;
echo "case 2 : { window.location.href='cal_cat.php?op=cat&id=".$id."&year=".$year."&sort=2&cuser=$cuser&limit=$limit' ; break ;} \n" ;
echo "default : { window.location.href='cal_cat.php?op=cat&id=".$id."&year=".$y."&sort=2&cuser=$cuser&limit=$limit' ; break;} \n" ;
echo "\t\t}\n" ;
echo "\t}\n" ;
echo "</script>" ;

$cquery = "select cat_name from ".$CAT_TB." where cat_id='$id' " ;
$cresult = mysql_query($cquery) ;
$crow = mysql_fetch_object($cresult) ;

echo "<table width=100% border=0 cellspacing=0 class=headerfont><tr><td align=left valign=middle>" ;
echo translate("Events in category").": &nbsp; ".stripslashes($crow->cat_name)."</td><td align=right valign=middle><div class=menufont><b>".translate("Sort by").": </b>" ;
echo " &nbsp; &nbsp; <a href='#' onclick=\"Javascript:sortev(1);\"><img src='../images/sort1.gif' border=0 alt='".translate("Sort by events")."'/></a>" ;
echo " &nbsp;<a href='#' onclick=\"Javascript:sortev(2);\"><img src='../images/sort2.gif' border=0 alt='".translate("Sort by date")."'/></a>" ;
echo " &nbsp;</div></td></tr></table>\n";

if (!$rows) {
	echo "<br/><div class=titlefont> &nbsp; ".translate("No events").".</div><br/><br/>\n";
	}

else {

	$result = mysql_query($query);
	$foo = '';
	while ($row = mysql_fetch_object($result)){
	  $foo++ % 2 ? $color=$catcolor : $color=$secondcatcolor;
	  echo "<table class=normalfont border=0 bgcolor=$color cellspacing=0 cellpadding=4 width=\"100%\">\n";
	  echo "<tr><td" ;
	  if ($row->approved=='0') echo " bgcolor='$unapprovedclr'" ;
	  echo ">\n<li>" ;
	  echo "<b>".stripslashes($row->title)."</b> ".translate("on")." ".$row->day." ".$mth[$row->month]." ".$row->year."\n";
	  echo " - <a href=cal_event.php?op=view&id=".$row->id.">".translate("View event")."</a>\n";
	  echo " - <a href=cal_event.php?op=edit&id=".$row->id.">".translate("Edit event")."</a>\n";
        echo " - <a href=cal_event.php?op=delev&id=".$row->id.">".translate("Delete event")."</a>\n";
	  if ($row->approved=='0')
          echo " - <a href=calendar.php?op=approve&id=".$row->id.">".translate("Approve")."</a>\n";
	  echo "</li></td></tr>\n";
	  echo "</table>\n";
	  }
}

// this is for the goto year under categories redirection javascript
echo "<script language=\"JavaScript\" type=\"text/JavaScript\">\n" ;
echo "\tfunction gotocatevyear(selectopt) {\n" ;
echo "var geti = '1' ;\n" ;
echo "for (i=0;i<selectopt.options.length;i++) {\n" ;
echo "\tif (selectopt.options[i].selected) {\n" ;
echo "\t\tgeti = selectopt.options[i].value ;\n" ;
echo "\t\tbreak ;\n" ;
echo "\t}\n" ;
echo "}\n\n" ;
echo "\t\tswitch (geti) { \n" ;
for ($i=$calstartyear;$i<=($y+$caladvanceyear);++$i) {
  echo "case \"$i\" : { window.location.href='cal_cat.php?op=cat&id=".$id."&year=".$i."&sort=$sort&cuser=$cuser&limit=$limit' ; break ;} \n" ;
}

echo "default : { window.location.href='cal_cat.php?op=cat&id=".$id."&year=".$y."&sort=$sort&cuser=$cuser&limit=$limit' ; break;} \n" ;
echo "\t\t}\n" ;
echo "\t}\n" ;
echo "</script>" ;

// this is for the goto user under categories redirection javascript
echo "<script language=\"JavaScript\" type=\"text/JavaScript\">\n" ;
echo "\tfunction gotocatuser(selectopt) {\n" ;
echo "var geti = '1' ;\n" ;
echo "for (i=0;i<selectopt.options.length;i++) {\n" ;
echo "\tif (selectopt.options[i].selected) {\n" ;
echo "\t\tgeti = selectopt.options[i].value ;\n" ;
echo "\t\tbreak ;\n" ;
echo "\t}\n" ;
echo "}\n\n" ;
echo "\t\tswitch (geti) { \n" ;
echo "case \"-\" : { window.location.href='cal_cat.php?op=cat&id=".$id."&year=".$year."&sort=$sort&cuser=-&limit=$limit' ; break ;} \n" ;

$uquery = "select username,user_id from ".$USER_TB ;
$uresult = mysql_query($uquery) ;
while ($urow = mysql_fetch_object($uresult)){
//  echo "\t<option value='$urow->user_id'" ;

  echo "case \"$urow->user_id\" : { window.location.href='cal_cat.php?op=cat&id=".$id."&sort=$sort&year=".$year."&cuser=$urow->user_id&limit=$limit' ; break ;} \n" ;
}

echo "default : { window.location.href='cal_cat.php?op=cat&id=".$id."&year=".$y."&sort=$sort&cuser=$cuser&limit=$limit' ; break;} \n" ;
echo "\t\t}\n" ;
echo "\t}\n" ;
echo "</script>" ;


// display form functions
echo "<table border=0 width=100%><tr>" ;
echo "<td align=left valign=top width=50%>\n" ;
echo "<table width=100 cellspacing=0 cellpadding=2 align=left class=txtbox><tr><td bgcolor='$unapprovedclr' align=center><div class=normalfont>".translate("Unapproved events")."</div></td></tr></table>\n" ;

echo "<form action='#' name='catform'>\n";

// previous and next rows
if ($limit!=0)  echo "<input type='button' value='&nbsp;&lt;&nbsp;' title='".translate("Previous")."' onclick=\"Javascript:window.location.href='cal_cat.php?op=cat&id=".$id."&year=".$year."&sort=$sort&cuser=$cuser&limit=".($limit-$limitrow)."' ;\"> &nbsp; &nbsp; \n" ;
if (($limit+$limitrow)<$totalrows)
  echo "<input type='button' value='&nbsp;&gt;&nbsp;' title='".translate('Next')."' onclick=\"Javascript:window.location.href='cal_cat.php?op=cat&id=".$id."&year=".$year."&sort=$sort&cuser=$cuser&limit=".($limit+$limitrow)."' ;\">\n<br/>" ;
else
  echo "<br/>" ;

echo "<div class=menufont><b>".translate("Total number of events for user").": ".($limit+1)." - " ;
if (($limit+$limitrow)<$totalrows) echo ($limit+$limitrow) ;
else echo $totalrows ;
echo "/".$totalrows."</b></div>" ;

echo "</td>" ;
echo "<td align=right valign=top width=50%><div class=menufont>" ;

// get year from "calstartyear" and give "caladvanceyear" years more to select
echo "<b>".translate("View events under this category in year").": </b> &nbsp;" ;
echo "<select name=gocatevyear onchange=\"javascript:gotocatevyear(this);\">\n";
for ($i=$calstartyear;$i<=($y+$caladvanceyear);$i++){
  echo "\t<option value=$i" ;
  if ($year==$i) echo " selected " ;
  echo ">$i\n";
}
echo "</select><br/>\n";

// get users
echo "<b>".translate("View events of user").": </b> " ;
$uquery = "select username,user_id from ".$USER_TB ;
$uresult = mysql_query($uquery) ;

echo "<select name=cuser onchange=\"Javascript:gotocatuser(this);\">\n";
echo "\t<option value='-'" ;
if (($cuser=="-")||($cuser=="")) echo " selected " ;
echo ">--\n";
while ($urow = mysql_fetch_object($uresult)){
  echo "\t<option value='$urow->user_id'" ;
  if ($cuser=="$urow->user_id") echo " selected " ;
  echo ">".$urow->username."\n";
  }
echo "</select>\n";
echo "</div></td></tr></table>" ;
echo "</form>" ;

}


/****************/
/* add category */
/****************/

if ($op == "addcat" || $op == "updatecat"){
   $cat = $_POST['cat'];
}

function addcat($cat){
global $CAT_TB;
  if (trim($cat)!='') {
    $cat = trim($cat);
    $query = "insert into ".$CAT_TB." values(null,'".addslashes($cat)."')";
    echo "<h4>".translate("Adding category")." ...</h4>" ;
    $result = mysql_query($query);
    echo "<meta http-equiv=\"refresh\" content=\"0; url=cal_cat.php?op=cats\">";
    }
  else { 
    echo "<div class=titlefont>".translate("Cannot have a category with blank name")."!</div>" ;
    back();
    }
}

/*****************/
/* edit category */
/*****************/

function editcat ($id){
global $CAT_TB;
 echo "<div class=titlefont>".translate("Edit category")."</div>" ;
 $query = "select cat_name from ".$CAT_TB." where cat_id='$id'";
 $result = mysql_query($query);
 $row = mysql_fetch_object($result);
 echo "<form action=cal_cat.php?op=updatecat&id=$id method=post>\n";
 echo "<input type=text name=cat value=\"".stripslashes($row->cat_name)."\"><br/><br/>\n";
 echo "<input type=submit value=\"".translate("Update")."\"> &nbsp;  \n";
 echo "<input type=button value=\"".translate("Cancel")."\" onclick='Javascript:window.history.go(-1)'>\n";
 echo "</form>\n";

}

/*******************/
/* update category */
/*******************/

function updatecat($cat,$id){
global $CAT_TB;
  if (trim($cat)!='') {
    $query = "update ".$CAT_TB." set cat_name='".addslashes(trim($cat))."' where cat_id='$id'";
    echo "<h4>".translate("Updating category")." ...</h4>" ;
    mysql_query($query);
    echo "<meta http-equiv=\"refresh\" content=\"0; url=cal_cat.php?op=cats\">";
    }
  else { 
    echo "<div class=titlefont>".translate("Cannot have a category with blank name")."!</div>" ;
    back();
    }
}

/***************************/
/* delete category question*/
/***************************/

function delcat($id){
global $CAT_TB ;
$query = "select cat_name from ".$CAT_TB." where cat_id='$id'";
$result = mysql_query($query);
$row = mysql_fetch_object($result);
echo "<div class=titlefont>".translate("To delete category").": <u>".stripslashes($row->cat_name)."</u><br/><br/>" ; ;
echo translate("reallydelcat")."<br/><br/>\n";
echo "<a href=javascript:history.back()>".translate("No, go back!")."</a><br/><br/>\n";
echo "<a href=cal_cat.php?op=delcatok&id=$id>".translate("Yes, delete it!")."</a>\n";
echo "</div>";
}

/*******************************/
/* delete category confirmation*/
/*******************************/

function delcatok($id){
global $CAT_TB,$EVENTS_TB;
// del from cat
echo "<h4>".translate("Deleting category")." ...</h4>" ;
$res = mysql_query("delete from ".$CAT_TB." where cat_id='$id'");

// del events with cat = $id
$querysel = "select id from ".$EVENTS_TB." where cat='$id'";
$resultsel = mysql_query($querysel);
while ($rowsel = mysql_fetch_object($resultsel)){
$querydel = "delete from ".$EVENTS_TB." where id='".$rowsel->id."'";

$resultdel = mysql_query($querydel);
}
echo "<meta http-equiv=\"refresh\" content=\"0; url=cal_cat.php?op=cats\">";

}

switch ($op){
    
    // overview of category
    case"cats":{
       cats();
    break;
    }

    // overview of one cat
    case"cat":{
	if (!isset($_GET['sort']))
	  $sort = '2';
	else
	  $sort = $_GET['sort'];
	if (!isset($_GET['cuser']))
	  $cuser = '-';
	else
	  $cuser = $_GET['cuser'];
        if ($year) cat($id,$catcolor,$secondcatcolor,$year,$sort,$cuser,$limit);
	  else cat($id,$catcolor,$secondcatcolor,$y,$sort,$cuser,$limit);
    break;
    }

    // add new category
    case"addcat":{
       addcat($cat);
    break;
    }

    // edit category
    case "editcat":{
        editcat ($id);
    break;
    }

    // update category
    case"updatecat":{
        updatecat($cat,$id);
    break;
    }    
    
    // delete cat: question
    case"delcat":{
        delcat($id);
    break;
    }    

    // confirmation of delete cat
    case "delcatok":{
        delcatok($id);
    break;
    }

    // default: 
    default:{
        cats();
    break;
    }
}

include ('cal_footer.inc.php');
?>
