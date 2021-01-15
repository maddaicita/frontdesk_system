<?php require_once('Connections/security.php'); ?>
<?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
	
  $logoutGoTo = "login.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
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

$MM_restrictGoTo = "login.php";
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

$colname_usuario = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_usuario = $_SESSION['MM_Username'];
}
mysql_select_db($database_security, $security);
$query_usuario = sprintf("SELECT users_id, last_name, first_name, email, cellphone FROM tbl_users WHERE username = %s", GetSQLValueString($colname_usuario, "text"));
$usuario = mysql_query($query_usuario, $security) or die(mysql_error());
$row_usuario = mysql_fetch_assoc($usuario);
$totalRows_usuario = mysql_num_rows($usuario);

$colname_sche = $row_usuario['users_id'];

$maxRows_sche = 60;
$pageNum_sche = 0;
if (isset($_GET['pageNum_sche'])) {
  $pageNum_sche = $_GET['pageNum_sche'];
}
$startRow_sche = $pageNum_sche * $maxRows_sche;

$colname_sche = $row_usuario['users_id'];

mysql_select_db($database_security, $security);
$query_sche = sprintf("SELECT sch.*, si.shift_time, loc.location, adm.first_name, adm.last_name FROM schedule sch, locations_shifts si, locations loc, tbl_admins adm WHERE sch.users_id = %s AND sch.shift_id = si.shift_id AND si.loc_id=loc.loc_id AND sch.admin_id = adm.users_id ORDER BY sch.sch_date DESC", GetSQLValueString($colname_sche, "int"));
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
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/employees.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>All American Security Services</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable --><script type="text/javascript" src="stmenu.js"></script>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
</head>

<body>
<br />
<table width="600" border="0" align="center">
  <tr>
    <td align="center"><script type="text/javascript" src="employees.js"></script></td>
  </tr>
</table>
<table width="600" border="0" align="center">
  <tr>
    <td height="466" align="center" valign="top"><!-- InstanceBeginEditable name="content" -->
      <p class="Titles">Schedule</p>
      <table width="724" border="1">
        <tr class="cabecera">
          <td width="133">Date:</td>
          <td width="107">Shift:</td>
          <td width="171">Property:</td>
          <td width="133">Admin:</td>
          <td width="146">Set on:</td>
        </tr>
        <?php do { ?>
          <tr <?php if ($row_sche['week']%2==0){
			 				echo "bgcolor=\"#99FFCC\"";
			} else {
		    				 echo "bgcolor=\"#FFCCCC\"";
			}
			?> >
            <td>
			<?php //echo date_format(date_create($row_sche['sch_date']),'m/d/y'); ?>
            <?php echo date_format(date_create($row_sche['sch_date']),'D j \of M Y'); ?>
            </td>
            <td><?php echo $row_sche['shift_time']; ?></td>
            <td><?php echo $row_sche['location']; ?></td>
            <td><?php echo $row_sche['first_name'] . " " . $row_sche['last_name'] ?></td>
            <td><?php echo date("m/d/Y H:i", strtotime($row_sche['shc_set'])); ?></td>
          </tr>
          <?php } while ($row_sche = mysql_fetch_assoc($sche)); ?>
      </table>
      <p>&nbsp;</p>
    <!-- InstanceEndEditable --></td>
  </tr>
</table>
<br />
<table width="600" border="0" align="right">
  <tr>
    <td align="right"><p>You are logged as <strong><?php echo $row_usuario['first_name']; ?></strong> <strong><?php echo $row_usuario['last_name']; ?><br />
      <a href="<?php echo $logoutAction ?>">Log out</a></strong></p></td>
  </tr>
</table>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($sche);

mysql_free_result($usuario);
?>
