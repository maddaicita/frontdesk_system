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
  $updateSQL = sprintf("UPDATE tbl_tennant_msg SET user_read=%s, date_time_read=%s WHERE id_msg=%s",
                       GetSQLValueString($_POST['hidden_read'], "int"),
                       GetSQLValueString($_POST['hidden_date_read'], "text"),
                       GetSQLValueString($_POST['hidden_id'], "int"));

  mysql_select_db($database_dplace, $dplace);
  $Result1 = mysql_query($updateSQL, $dplace) or die(mysql_error());

  $updateGoTo = "menu.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
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

$colname_msgs = "-1";
if (isset($_GET['id'])) {
  $colname_msgs = $_GET['id'];
}
mysql_select_db($database_dplace, $dplace);
$query_msgs = sprintf("SELECT * FROM tbl_tennant_msg WHERE id_msg = %s", GetSQLValueString($colname_msgs, "int"));
$msgs = mysql_query($query_msgs, $dplace) or die(mysql_error());
$row_msgs = mysql_fetch_assoc($msgs);
$totalRows_msgs = mysql_num_rows($msgs);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/templatephp.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Visitors Control System</title>
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

<body>
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
      <table width="400" border="0">
        <tr>
          <td align="center" class="titulo">Message from tennants details</td>
        </tr>
    </table>
      <br />
      <form id="form1" name="form1" method="POST" action="<?php echo $editFormAction; ?>">
        <table width="400" border="1">
          <tr>
            <td align="left" class="etiqueta">Date/Time:
            <input name="hidden_id" type="hidden" id="hidden_id" value="<?php echo $row_msgs['id_msg']; ?>" /></td>
            <td align="left"><?php echo $row_msgs['date_time']; ?></td>
          </tr>
          <tr>
            <td align="left" class="etiqueta">Names:</td>
            <td align="left"><?php echo $row_msgs['names']; ?></td>
          </tr>
          <tr>
            <td align="left" class="etiqueta">Apt / Unit:</td>
            <td align="left"><?php echo $row_msgs['apt']; ?></td>
          </tr>
          <tr>
            <td align="left" class="etiqueta">Phone:</td>
            <td align="left"><?php echo $row_msgs['phone']; ?></td>
          </tr>
          <tr>
            <td align="left" class="etiqueta">Message:</td>
            <td align="left"><?php echo $row_msgs['message']; ?></td>
          </tr>
        </table>
        <br />
        <table width="400" border="0">
          <tr>
            <td align="center"><label>
              <input name="hidden_read" type="hidden" id="hidden_read" value="<?php echo $row_usuario['id_user']; ?>" />
              <input type="hidden" name="hidden_date_read" id="hidden_date_read" value="<?php echo date("m/d/Y-G:H:s"); ?>" />
              <input type="submit" name="button" id="button" value="   Read  " />
            </label></td>
          </tr>
        </table>
        <p>&nbsp;</p>
        <input type="hidden" name="MM_update" value="form1" />
      </form>
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

mysql_free_result($msgs);
?>
