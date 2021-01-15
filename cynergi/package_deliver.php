<?php require_once('Connections/dplace.php'); ?>
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE tbl_packages SET delivered=%s, pkg_date_out=%s, del_comments=%s, del_user=%s WHERE pkg_id=%s",
                       GetSQLValueString($_POST['hidden_delivered'], "int"),
                       GetSQLValueString($_POST['hidden_out'], "date"),
                       GetSQLValueString($_POST['txt_comments'], "text"),
                       GetSQLValueString($_POST['hidden_user'], "int"),
                       GetSQLValueString($_POST['hidden_id'], "int"));

  mysql_select_db($database_dplace, $dplace);
  $Result1 = mysql_query($updateSQL, $dplace) or die(mysql_error());

  $updateGoTo = "package_list.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

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
if (isset($_GET['pkg_id'])) {
  $colname_package = $_GET['pkg_id'];
}
mysql_select_db($database_dplace, $dplace);
$query_package = sprintf("SELECT pac.*, ten.names, us.names AS guard, typ.type_desc  FROM tbl_packages pac, tbl_tennants ten, tbl_users us, tbl_package_type typ  WHERE pac.id_tennant=ten.id_tennant AND pac.pkg_user=us.id_user AND pac.pkg_type=typ.type_id AND pac.pkg_id = %s", GetSQLValueString($colname_package, "int"));
$package = mysql_query($query_package, $dplace) or die(mysql_error());
$row_package = mysql_fetch_assoc($package);
$totalRows_package = mysql_num_rows($package);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/employees.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Dplace Visitors Control System</title>
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
</style><script type="text/javascript" src="stmenu.js"></script>
<link href="css/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<table width="627" height="132" border="0" align="center">
  <tr>
    <td width="232" height="128" align="center"><img src="images/dplace_logo.JPG" alt="" width="175" height="87" /></td>
    <td width="385" align="center"><span class="titulo">Visitor control system <br />
      All American Security Services</span></td>
  </tr>
</table>
<table width="673" border="0" align="center">
  <tr>
    <td width="362" align="center"><span> &nbsp;
      <script type="text/javascript" src="menu.js"></script>
    </span></td>
  </tr>
</table>
<!-- InstanceBeginEditable name="central" -->
<table width="816" height="367" border="0" align="center">
  <tr>
    <td align="center" valign="top"><br />
      <table width="300" border="0">
      <tr>
        <td align="center" class="titulo">Deliver tennat's package</td>
        </tr>
    </table>
    <br />
    <br />
    <form id="form1" name="form1" method="POST" action="<?php echo $editFormAction; ?>">
      For now, the camera system will be our proof of delivery. Please note to do that is necessary <br />
      you submit this form the same moment on the delivery of the package, so we can match the <br />
      footage with the system time in case of a claim. If that is not correct or 
      thre is any aditional <br />
      comments, 
      please write it on the apropiate box. <br />
      <br />
      <table width="300" border="1">
        <tr>
          <td align="left" class="etiqueta">Tenant's names:
            <input name="hidden_id" type="hidden" id="hidden_id" value="<?php echo $row_package['pkg_id']; ?>" /></td>
          <td align="left"><?php echo $row_package['names']; ?></td>
        </tr>
        <tr>
          <td align="left" class="etiqueta">Package label:</td>
          <td align="left"><?php echo $row_package['pkg_label']; ?></td>
        </tr>
        <tr>
          <td align="left" class="etiqueta">Type:</td>
<td align="left"><?php echo $row_package['type_desc']; ?></td>
        </tr>
        <tr>
          <td align="left" class="etiqueta">Condition:</td>
          <td align="left"><?php echo $row_package['pkg_condition']; ?></td>
        </tr>
        <tr>
          <td align="left" class="etiqueta">Arrived:</td>
          <td align="left"><?php echo $row_package['pkg_date_in']; ?></td>
        </tr>
        <tr>
          <td align="left" class="etiqueta">Received by:</td>
          <td align="left"><?php echo $row_package['guard']; ?></td>
        </tr>
        <tr>
          <td align="left" class="etiqueta">Receiver comments:</td>
          <td align="left"><?php echo $row_package['pkg_comments']; ?></td>
        </tr>
        <tr>
          <td align="left" class="etiqueta">Delivery comments:</td>
          <td align="left"><label>
            <textarea name="txt_comments" id="txt_comments" cols="45" rows="5"></textarea>
          </label></td>
        </tr>
        <tr>
          <td class="etiqueta"><input name="hidden_out" type="hidden" id="hidden_out" value="<?php echo date("Y-m-d H:i:s"); ?>" />
            <input name="hidden_delivered" type="hidden" id="hidden_delivered" value="1" />            <input name="hidden_user" type="hidden" id="hidden_user" value="<?php echo $row_usuario['id_user']; ?>" /></td>
          <td align="left"><label>
            <input type="submit" name="button" id="button" value="Submit" />
          </label></td>
        </tr>
      </table>
      <input type="hidden" name="MM_update" value="form1" />
    </form></td>
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
