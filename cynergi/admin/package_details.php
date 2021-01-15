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

$colname_usuario = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_usuario = $_SESSION['MM_Username'];
}
mysql_select_db($database_dplace, $dplace);
$query_usuario = sprintf("SELECT * FROM tbl_users WHERE username = %s", GetSQLValueString($colname_usuario, "text"));
$usuario = mysql_query($query_usuario, $dplace) or die(mysql_error());
$row_usuario = mysql_fetch_assoc($usuario);
$totalRows_usuario = mysql_num_rows($usuario);

$colname_package = "-1";
if (isset($_GET['id'])) {
  $colname_package = $_GET['id'];
}
mysql_select_db($database_dplace, $dplace);
$query_package = sprintf("SELECT pac.*, ten.names, ten.apt, ten.phones, us.names AS guard, con.con_description, typ.type_desc  FROM tbl_packages pac, tbl_tennants ten, tbl_users us, tbl_condition con, tbl_package_type typ WHERE pac.id_tennant=ten.id_tennant AND pac.pkg_user=us.id_user AND  pac.pkg_id = %s AND pac.pkg_condition=con.con_id AND pac.pkg_type=typ.type_id ", GetSQLValueString($colname_package, "int"));
$package = mysql_query($query_package, $dplace) or die(mysql_error());
$row_package = mysql_fetch_assoc($package);
$totalRows_package = mysql_num_rows($package);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/employees.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>All American Security Services</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
<style type="text/css">
<!--
body {
	background-image: url(images/bgnd2.jpg);
	background-repeat: repeat-x;
}
-->
</style><script type="text/javascript" src="../stmenu.js"></script>
<link href="../css/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<table width="627" height="132" border="0" align="center">
  <tr>
    <td width="232" height="128" align="center"><img src="../images/dplace_logo.JPG" alt="" width="175" height="87" /></td>
    <td width="385" align="center"><span class="titulo">Visitor control system <br />
      All American Security Services</span></td>
  </tr>
</table>
<table width="673" border="0" align="center">
  <tr>
    <td width="362" align="center"><span> &nbsp;
      <script type="text/javascript" src="../menu.js"></script>
    </span></td>
  </tr>
</table>
<!-- InstanceBeginEditable name="central" -->
<table width="816" height="367" border="0" align="center">
  <tr>
    <td align="center" valign="top"><table width="600" border="0">
      <tr>
        <td align="center" class="titulo">Package details</td>
      </tr>
    </table>
      <br />
      <table width="600" border="1">
        <tr>
          <td width="127">Date/Time In:</td>
          <td width="457"><?php echo $row_package['pkg_date_in']; ?></td>
        </tr>
        <tr>
          <td>Date/Time Out:</td>
          <td><?php echo $row_package['pkg_date_out']; ?></td>
        </tr>
        <tr>
          <td>Unit:</td>
          <td><?php echo $row_package['apt']; ?></td>
        </tr>
        <tr>
          <td>Tenant names:</td>
          <td><?php echo $row_package['names']; ?></td>
        </tr>
        <tr>
          <td>Package type:</td>
          <td><?php echo $row_package['type_desc']; ?></td>
        </tr>
        <tr>
          <td>Condition:</td>
<td><?php echo $row_package['con_description']; ?></td>
        </tr>
        <tr>
          <td>Perishable:</td>
          <td><?php echo $row_package['pkg_perishable']; ?></td>
        </tr>
        <tr>
          <td>Label/Tracking:</td>
          <td><?php echo $row_package['pkg_label']; ?></td>
        </tr>
        <tr>
          <td>Comments:</td>
          <td><?php echo $row_package['pkg_comments']; ?></td>
        </tr>
        <tr>
          <td>Received by:</td>
          <td><?php echo $row_package['guard']; ?></td>
        </tr>
        <tr>
          <td>Recorded on:</td>
          <td><?php echo $row_package['pkg_record']; ?></td>
        </tr>
      </table>
    <p>&nbsp;</p></td>
  </tr>
</table>
<br /><!-- InstanceEndEditable -->
<table width="200" border="0" align="right">
  <tr>
    <td>User: <?php echo $row_usuario['names']; ?></td>
  </tr>
</table>

</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($usuario);

mysql_free_result($package);
?>
