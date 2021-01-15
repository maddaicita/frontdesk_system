<?php include('../Connections/security.php'); ?>
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

$colname_loc = "-1";
if (isset($_GET['loc'])) {
  $colname_loc = $_GET['loc'];
}
mysql_select_db($database_security, $security);
$query_loc = sprintf("SELECT * FROM locations WHERE loc_id = %s", GetSQLValueString($colname_loc, "int"));
$loc = mysql_query($query_loc, $security) or die(mysql_error());
$row_loc = mysql_fetch_assoc($loc);
$totalRows_loc = mysql_num_rows($loc);

$colname_shifts = "-1";
if (isset($_GET['loc'])) {
  $colname_shifts = $_GET['loc'];
}
mysql_select_db($database_security, $security);
$query_shifts = sprintf("SELECT shi.*, us.first_name, us.last_name FROM locations_shifts shi, tbl_users us WHERE shi.users_id = us.users_id AND shi.loc_id = %s  ORDER BY shi.shift_time ASC", GetSQLValueString($colname_shifts, "int"));
$shifts = mysql_query($query_shifts, $security) or die(mysql_error());
$row_shifts = mysql_fetch_assoc($shifts);
$totalRows_shifts = mysql_num_rows($shifts);
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
      <p class="Titles">Shift templates for <?php echo $row_loc['location']; ?></p>
      <p><a href="shift_templates_add.php?loc=<?php echo $row_loc['loc_id']; ?>">Add template</a></p>
      <?php if ($totalRows_shifts == 0) { // Show if recordset empty ?>
  <p><p><p>There is not any shift regitered to this property yet.</p>
  <?php } // Show if recordset empty ?>
<?php if ($totalRows_shifts > 0) { // Show if recordset not empty ?>
  <table width="762" border="1">
    <tr class="cabecera">
      <td width="176" align="center">Shift</td>
      <td width="247" align="center">Overnight</td>
      <td width="247" align="center">Created by</td>
      <td width="64">Deactivate</td>
      </tr>
    <?php do { ?>
      <tr>
        <td align="center"><?php echo $row_shifts['shift_time']; ?></td>
        <td align="center"><?php if ($row_shifts['overnight']==0) { echo "NO";} else {echo "YES";} ?></td>
        <td align="center"><?php echo $row_shifts['first_name']; ?> <?php echo $row_shifts['last_name']; ?></td>
        <td align="center"><img src="../images/delete.png" width="16" height="16" border="0" /></td>
      </tr>
      <?php } while ($row_shifts = mysql_fetch_assoc($shifts)); ?>
  </table>
  <?php } // Show if recordset not empty ?>
<p>&nbsp;</p>
      <p>&nbsp;</p>
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

mysql_free_result($loc);

mysql_free_result($shifts);
?>
