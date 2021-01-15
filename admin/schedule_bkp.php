<?php include('../Connections/security.php');
$loc = $_REQUEST['loc'];?>
<?php
$monthNames = Array("January", "February", "March", "April", "May", "June", "July", 
"August", "September", "October", "November", "December");

if (!isset($_REQUEST["month"])) $_REQUEST["month"] = date("n");
if (!isset($_REQUEST["year"])) $_REQUEST["year"] = date("Y");

$cMonth = $_REQUEST["month"];
$cYear = $_REQUEST["year"];
 
$prev_year = $cYear;
$next_year = $cYear;
$prev_month = $cMonth-1;
$next_month = $cMonth+1;
 
if ($prev_month == 0 ) {
    $prev_month = 12;
    $prev_year = $cYear - 1;
}
if ($next_month == 13 ) {
    $next_month = 1;
    $next_year = $cYear + 1;
}
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
$query_user = sprintf("SELECT users_id, last_name, first_name, user_admin FROM tbl_users WHERE username = %s", GetSQLValueString($colname_user, "text"));
$user = mysql_query($query_user, $security) or die(mysql_error());
$row_user = mysql_fetch_assoc($user);
$totalRows_user = mysql_num_rows($user);
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
      <p class="Titles">Schedule by property</p>
      <p>&nbsp;</p>
      <table width="800">
<tr align="center">
<td bgcolor="#999999" style="color:#FFFFFF">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="50%" align="left"><a href="<?php echo $_SERVER["PHP_SELF"] . "?month=". $prev_month . "&year=" . $prev_year  . "&loc=" . $loc; ?>" style="color:#FFFFFF">Previous</a></td>
<td width="50%" align="right"><a href="<?php echo $_SERVER["PHP_SELF"] . "?month=". $next_month . "&year=" . $next_year  . "&loc=" . $loc; ?>" style="color:#FFFFFF">Next</a></td>
</tr>
</table>
</td>
</tr>
<tr>
<td align="center">
<table width="100%" border="1" cellpadding="2" cellspacing="2">
<tr align="center">
<td colspan="7" bgcolor="#999999" style="color:#FFFFFF"><strong><?php echo $monthNames[$cMonth-1].' '.$cYear; ?></strong></td>
</tr>
<tr>
<td width="100" align="center" bgcolor="#999999" style="color:#FFFFFF"><strong>M</strong></td>
<td width="100" align="center" bgcolor="#999999" style="color:#FFFFFF"><strong>T</strong></td>
<td width="100" align="center" bgcolor="#999999" style="color:#FFFFFF"><strong>W</strong></td>
<td width="100" align="center" bgcolor="#999999" style="color:#FFFFFF"><strong>T</strong></td>
<td width="100" align="center" bgcolor="#999999" style="color:#FFFFFF"><strong>F</strong></td>
<td width="100" align="center" bgcolor="#999999" style="color:#FFFFFF"><strong>S</strong></td>
<td width="100" align="center" bgcolor="#999999" style="color:#FFFFFF"><strong>S</strong></td>
</tr>
<?php
$timestamp = mktime(0,0,0,$cMonth,1,$cYear);
$maxday = date("t",$timestamp);
$thismonth = getdate ($timestamp);
$startday = $thismonth['wday']-1;
for ($i=0; $i<($maxday+$startday); $i++) {
    if(($i % 7) == 0 ) echo "<tr>&nbsp;";
    if($i < $startday) echo "<td></td>&nbsp;";
    else 
	
	

	if ( ($i - $startday + 1) == date("j") && ($cMonth) == date("n"))
    {	
		echo "<td class='today' align='center' valign='top' height='20px'>".  ($i - $startday + 1);
		//echo "<br><img src=\"../images/calendar.jpg\" width=\"35\" height=\"35\" border=\"0\" />";

	//bring the data base records for scheduled timeshifts
	mysql_select_db($database_security, $security);
	$query_dates = "SELECT sft.shift_time, us.first_name, us.last_name FROM schedule sch, locations_shifts sft, locations loc, tbl_users us WHERE sch.users_id = us.users_id AND sft.loc_id = loc.loc_id AND sft.shift_id=sch.shift_id AND sch.sch_date = '" . date("Y-m-d", strtotime($cYear . "-" . $cMonth . "-" . ($i - $startday + 1))) . "' AND loc.loc_id = " . $loc . " ORDER BY sft.shift_time, us.first_name ASC";
	//echo $query_dates;
	$dates = mysql_query($query_dates, $security) or die(mysql_error());
	$row_dates = mysql_fetch_assoc($dates);
	$totalRows_dates = mysql_num_rows($dates);	


do { 
echo "<p class=\"lineas\" >" . $row_dates['first_name']. " " . $row_dates['last_name'];
echo "<br>" . $row_dates['shift_time'];
	
} while ($row_dates = mysql_fetch_assoc($dates));


		 echo "</td>";
    }
	
    else
	
    {
        echo "<td class='hover' align='center' valign='top' height='20px'>".  ($i - $startday + 1);
		//echo "<br><img src=\"../images/calendar.jpg\" width=\"35\" height=\"35\" border=\"0\" />";
	
	
	
	//bring the data base records for scheduled timeshifts
	mysql_select_db($database_security, $security);
	$query_dates = "SELECT sft.shift_time, us.first_name, us.last_name FROM schedule sch, locations_shifts sft, locations loc, tbl_users us WHERE sch.users_id = us.users_id AND sft.loc_id = loc.loc_id AND sft.shift_id=sch.shift_id AND sch.sch_date = '" . date("Y-m-d", strtotime($cYear . "-" . $cMonth . "-" . ($i - $startday + 1))) . "' AND loc.loc_id = " .$loc . " ORDER BY sft.shift_time, us.first_name ASC";
	//echo $query_dates;
	$dates = mysql_query($query_dates, $security) or die(mysql_error());
	$row_dates = mysql_fetch_assoc($dates);
	$totalRows_dates = mysql_num_rows($dates);	

do { 
echo "<p class=\"lineas\" >" . $row_dates['first_name']. " " . $row_dates['last_name'];
echo "<br $query_employees>" .$row_dates['shift_time'];
} while ($row_dates = mysql_fetch_assoc($dates));
		
		echo "</td>";

	}
	
    if(($i % 7) == 6 ) echo "</tr>&nbsp;";
}
?>
</table>
</td>
</tr>
</table>
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
<?php
mysql_free_result($user);
?>