<?php include('../Connections/security.php');
$week = 0;
$week_last = 0;
$hours_week=0;
$show_week=0;
$dupli=0;
$abierto=0;
$lineas=0;
$shift_time="";
?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && true) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "index.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($QUERY_STRING) && strlen($QUERY_STRING) > 0) 
  $MM_referrer .= "?" . $QUERY_STRING;
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$colname_user = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_user = $_SESSION['MM_Username'];
}
mysql_select_db($database_security, $security);
$query_user = sprintf("SELECT users_id, last_name, first_name, user_admin FROM tbl_admins WHERE username = %s", GetSQLValueString($colname_user, "text"));
$user = mysql_query($query_user, $security) or die(mysql_error());
$row_user = mysql_fetch_assoc($user);
$totalRows_user = mysql_num_rows($user);

$colname_emp = "-1";
if (isset($_GET['users_id'])) {
  $colname_emp = $_GET['users_id'];
}
mysql_select_db($database_security, $security);
$query_emp = sprintf("SELECT users_id, last_name, first_name FROM tbl_users WHERE users_id = %s", GetSQLValueString($colname_emp, "int"));
$emp = mysql_query($query_emp, $security) or die(mysql_error());
$row_emp = mysql_fetch_assoc($emp);
$totalRows_emp = mysql_num_rows($emp);

$maxRows_sche = 60;
$pageNum_sche = 0;
if (isset($_GET['pageNum_sche'])) {
  $pageNum_sche = $_GET['pageNum_sche'];
}
$startRow_sche = $pageNum_sche * $maxRows_sche;

$colname_sche = "-1";
if (isset($_GET['users_id'])) {
  $colname_sche = $_GET['users_id'];
}
mysql_select_db($database_security, $security);
$query_sche = sprintf("SELECT sch.*, si.shift_time, loc.location, adm.first_name, adm.last_name  FROM schedule sch, locations_shifts si, locations loc, tbl_admins adm WHERE sch.users_id = %s AND sch.shift_id = si.shift_id AND si.loc_id=loc.loc_id AND sch.admin_id = adm.users_id ORDER BY sch.sch_date DESC", GetSQLValueString($colname_sche, "int"));
//echo $query_sche;
$query_limit_sche = sprintf("%s LIMIT %d, %d", $query_sche, $startRow_sche, $maxRows_sche);
$sche = mysql_query($query_limit_sche, $security) or die(mysql_error());
$row_sche = mysql_fetch_assoc($sche);

if (isset($_GET['totalRows_sche'])) {
  $totalRows_sche = $_GET['totalRows_sche'];
} else {
  $all_sche = mysql_query($query_sche);
  $totalRows_sche = mysql_num_rows($all_sche);
}
$totalPages_sche = ceil($totalRows_sche/$maxRows_sche)-1;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/adminpages.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head><script type="text/javascript" src="stmenu.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Allamerican Security Services</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
<link href="../css/styles.css" rel="stylesheet" type="text/css" />
</head>

<body>
<table width="800" border="0" align="center">
  <tr>
    <td height="59" align="center"><script type="text/javascript" src="admin_menu.js"></script></td>
  </tr>
  <tr>
    <td height="568" align="center" valign="top"><!-- InstanceBeginEditable name="Content" -->
      <p class="Titles">Employee Schedule for <?php echo $row_emp['first_name']; ?> <?php echo $row_emp['last_name']; ?></p>
      <p><a href="employee_schedule_loc.php?users_id=<?php echo $row_emp['users_id']; ?>">add shifts</a></p>
      <?php if ($totalRows_sche > 0) { // Show if recordset not empty ?>
        <table width="821" border="1">
          <tr class="cabecera">
            <td width="142">Date:</td>
            <td width="103">Shift:</td>
            <td width="47">Hours</td>
            <td width="202">Property:</td>
            <td width="117">Set by:</td>
            <td width="117">Set on:</td>
            <td width="36" align="center">Del</td>
          </tr>
          </table>
          <?php		
				do {	
	// process to show the hours per week and set the table headers for next row or table week.
	if ($week_last == $row_sche['week']) {  // if already passed before
					echo "<tr ";
					$linea = $linea + 1;
			// set color row
			if ($row_sche['week']%2==0){
			 				echo "bgcolor=\"#99FFCC\"";
			} else {
		    				 echo "bgcolor=\"#FFCCCC\"";
			}
			// end set color row		
	} else {   // if week is different from last week create a new table
				
				
		if ($hours_week <> 0) {
				
				if ($dupli == 0) {
					if ($linea > 1) { 
					 
						echo "</p>Hours for week # " . $week_last . " : <b>" . 	round($hours_week,1) . " Hours</b></br><a href=javascript:goto('employee_hours_dupli.php?week=". $row_sche['week'] ."&amp;id=".  $row_sche['users_id'] ."') \">Duplicate this week to the next one</a></p>";}
						$hours_week=0;
						$dupli=1;
				} else {
						echo "</p>Hours for week # " . $week_last . " : <b>" . round($hours_week,1) . " Hours</b></p>";
						$hours_week=0;
				}	
		}				
				// set the new table header  
 echo "<table width=\"821\" border=\"1\"><tr ";
 			$linea=1;
				// set color row
			if ($row_sche['week']%2==0){
			 				echo "bgcolor=\"#99FFCC\"";
			} else {
		    				 echo "bgcolor=\"#FFCCCC\"";
			}
			// end set color row
			}	
?>>
      <td width="142"><?php echo date_format(date_create($row_sche['sch_date']),'D j \of M Y'); ?></td>
      <td width="103"><?php
	  
		    $shift_time = $row_sche['shift']; 
	   		echo $shift_time;
			
	   ?></td>
      <td width="47" align="center" class="standard"><?php			  
			  
			  $date1= $row_sche['sch_date'] . " " . substr($shift_time,0,5) . ":00";
			  $date2=  $row_sche['sch_date'] . " " . substr($shift_time,9,5) . ":00";
			  
			  
			   if (substr($shift_time,0,5) < substr($shift_time,9,5)) {
					$hours_count= round(time_diff($date2, $date1)/3600,2);
					$hours_week = $hours_week + $hours_count;
					 if (substr(round($hours_week,1), -2) == ".1") { $hours_week = round($hours_week);}
					 if (substr(round($hours_count,1), -2) == ".1") { $hours_count = round($hours_count);}
					echo round($hours_count,1);
				
				} else {			
				
					$hours_count= round(time_diff2($date2, $date1)/3600,2);
					$hours_week = $hours_week + $hours_count;
					if (substr(round($hours_week,1), -2) == ".1") { $hours_week = round($hours_week);}
					if (substr(round($hours_count,1), -2) == ".1") { $hours_count = round($hours_count);}
					echo round($hours_count,1);
			  }
			  ?></td>
              <td width="202"><?php echo $row_sche['location']; ?></td>
              <td width="117"><?php echo $row_sche['first_name']; ?> <?php echo $row_sche['last_name']; ?></td>
              <td width="117"><?php echo substr($row_sche['shc_set'],0,16); ?></td>
              <td width="36" align="center"><a href="employee_schedule_del.php?id=<?php echo $row_sche['sch_id']; ?>"><img src="../images/delete.png" width="16" height="16" border="0" /></a></td>
            </tr>
        <?php 
			$week_last = $row_sche['week']; // set the last week variable to compare futher
			} while ($row_sche = mysql_fetch_assoc($sche));
echo "</p>Hours for week # " . $week_last . " : <b>" . $hours_week . " Hours</b></p>";
			?>
        </table>
        <?php		
		} // Show if recordset not empty ?>
      <?php if ($totalRows_sche == 0) { // Show if recordset empty ?>
  <p>No shifts have been recorded for this employee.</p>
  <?php } // Show if recordset empty ?>
<p>&nbsp;</p><script>
 function goto(site) {
 var msg = confirm("Please confirm you want to duplicate these records. All the shift times will be duplicate into the next week. Then you can delete any record indidually.                                                            " + site + "?")
 if (msg) {window.location.href = site}
 else (null)
 }
 </script>
    <!-- InstanceEndEditable --></td>
  </tr>
</table>
<table width="300" border="0" align="right">
  <tr>
    <td align="right"><?php echo $row_user['first_name']; ?> <?php echo $row_user['last_name']; ?></td>
  </tr>
</table>
</body>
<!-- InstanceEnd --></html>
<?php function time_diff($dt1,$dt2){
     $y1 = substr($dt1,0,4);
     $m1 = substr($dt1,5,2);
     $d1 = substr($dt1,8,2);
     $h1 = substr($dt1,11,2);
     $i1 = substr($dt1,14,2);
     $s1 = substr($dt1,17,2);    

     $y2 = substr($dt2,0,4);
     $m2 = substr($dt2,5,2);
     $d2 = substr($dt2,8,2);
     $h2 = substr($dt2,11,2);
     $i2 = substr($dt2,14,2);
     $s2 = substr($dt2,17,2);    

     $r1=date('U',mktime($h1,$i1,$s1,$m1,$d1,$y1));
     $r2=date('U',mktime($h2,$i2,$s2,$m2,$d2,$y2));
     return ($r1-$r2);

 }
 
 function time_diff2($dt1,$dt2){
     $y1 = substr($dt1,0,4);
     $m1 = substr($dt1,5,2);
     $d1 = substr($dt1,8,2);
     $h1 = substr($dt1,11,2);
     $i1 = substr($dt1,14,2);
     $s1 = substr($dt1,17,2);    

     $y2 = substr($dt2,0,4);
     $m2 = substr($dt2,5,2);
     $d2 = substr($dt2,8,2);
     $h2 = substr($dt2,11,2);
     $i2 = substr($dt2,14,2);
     $s2 = substr($dt2,17,2);    

     $r1=date('U',mktime($h1,$i1,$s1,$m1,$d1 +1,$y1));
     $r2=date('U',mktime($h2,$i2,$s2,$m2,$d2,$y2));
     return ($r1-$r2);

 }
 
mysql_free_result($user);

mysql_free_result($emp);

mysql_free_result($sche);
?>
