<?php require_once('../Connections/dplace.php'); ?>
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
mysql_select_db($database_dplace, $dplace);
$query_user = sprintf("SELECT id_user, names FROM tbl_users WHERE username = %s", GetSQLValueString($colname_user, "text"));
$user = mysql_query($query_user, $dplace) or die(mysql_error());
$row_user = mysql_fetch_assoc($user);
$totalRows_user = mysql_num_rows($user);

mysql_select_db($database_dplace, $dplace);
$query_tenants = "SELECT * FROM tbl_tennants ORDER BY apt ASC";
$tenants = mysql_query($query_tenants, $dplace) or die(mysql_error());
$row_tenants = mysql_fetch_assoc($tenants);
$totalRows_tenants = mysql_num_rows($tenants);
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
      <table width="600" border="0">
        <tr>
          <td align="center" class="Titles">Tenants general list</td>
        </tr>
      </table>
      <br />
      <table width="633" border="1">
        <tr class="cabecera">
          <td width="84">Unit:</td>
          <td width="221">Names:</td>
          <td width="104">Phone:</td>
          <td width="196">E-mail</td>
        </tr>
        <?php do { ?>
          <tr>
            <td><?php echo $row_tenants['apt']; ?></td>
            <td><?php echo $row_tenants['names']; ?></td>
            <td><?php echo $row_tenants['phones']; ?></td>
            <td><?php echo $row_tenants['email']; ?></td>
          </tr>
          <?php } while ($row_tenants = mysql_fetch_assoc($tenants)); ?>
      </table>
      <br />
      <table width="284" border="0" align="right">
        <tr>
          <td>Printed on <?php echo date('m/d/Y h:i A'); ?></td>
        </tr>
      </table>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
    <!-- InstanceEndEditable --></td>
  </tr>
</table>
<table width="300" border="0" align="right">
  <tr>
    <td align="right"><?php echo $row_user['names']; ?></td>
  </tr>
</table>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($user);

mysql_free_result($tenants);
?>
