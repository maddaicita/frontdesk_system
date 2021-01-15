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

$colname_usuario = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_usuario = $_SESSION['MM_Username'];
}
mysql_select_db($database_dplace, $dplace);
$query_usuario = sprintf("SELECT * FROM tbl_users WHERE username = %s", GetSQLValueString($colname_usuario, "text"));
$usuario = mysql_query($query_usuario, $dplace) or die(mysql_error());
$row_usuario = mysql_fetch_assoc($usuario);
$totalRows_usuario = mysql_num_rows($usuario);

$colname_mesages = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_mesages = $_SESSION['MM_Username'];
}
mysql_select_db($database_dplace, $dplace);
$query_mesages = sprintf("SELECT msg.*, user.username, user.id_user, adm.names adminis FROM tbl_msgs msg, tbl_users user, tbl_admins adm  WHERE msg.read = '0' AND msg.id_usuario=user.id_user AND msg.id_admin=adm.id_admin AND user.username = %s ORDER BY msgs_date DESC", GetSQLValueString($colname_mesages, "text"));
$mesages = mysql_query($query_mesages, $dplace) or die(mysql_error());
$row_mesages = mysql_fetch_assoc($mesages);
$totalRows_mesages = mysql_num_rows($mesages);

mysql_select_db($database_dplace, $dplace);
$query_t_msgs = "SELECT * FROM tbl_tennant_msg WHERE user_read = '0' ORDER BY date_time ASC";
$t_msgs = mysql_query($query_t_msgs, $dplace) or die(mysql_error());
$row_t_msgs = mysql_fetch_assoc($t_msgs);
$totalRows_t_msgs = mysql_num_rows($t_msgs);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/templatephp.dwt.php" codeOutsideHTMLIsLocked="false" -->
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
<table width="692" height="367" border="0" align="center">
  <tr>
    <td align="center" valign="top"><?php if ($totalRows_t_msgs > 0) { // Show if recordset not empty ?>
        <br />
        <table width="400" border="1">
          <tr>
            <td align="center" class="highlight_important">Messages from a tennant:</td>
          </tr>
        </table>
        <br />
        <table width="540" border="1">
          <tr class="etiqueta">
            <td width="212" align="left">Names:</td>
            <td width="223" align="left">Date / Time:</td>
            <td width="83" align="center">Read</td>
          </tr>
          <?php do { ?>
            <tr>
              <td align="left"><?php echo $row_t_msgs['names']; ?></td>
              <td align="left"><?php echo $row_t_msgs['date_time']; ?></td>
              <td align="center"><a href="tennant_msg_detail.php?id=<?php echo $row_t_msgs['id_msg']; ?>"><img src="images/details.png" width="40" height="40" border="0" /></a></td>
            </tr>
            <?php } while ($row_t_msgs = mysql_fetch_assoc($t_msgs)); ?>
        </table>
        <?php } // Show if recordset not empty ?>
<?php if ($totalRows_mesages > 0) { // Show if recordset not empty ?><form id="form1" name="form1" method="post" action="">
      <table width="400" border="1">
        <tr>
          <td align="center" class="highlight_important">Messages from The Administration:</td>
        </tr>
      </table>
      <br />
      <table width="728" border="1">
        <tr class="etiqueta">
          <td width="158">From:</td>
          <td width="141">Date/Time:</td>
          <td width="336">Message:</td>
          <td width="65">Read:</td>
        </tr>
        <?php do { ?>
          <tr align="left">
            <td><?php echo $row_mesages['adminis']; ?></td>
            <td><?php echo $row_mesages['msgs_date']; ?></td>
            <td><?php echo $row_mesages['msgs_text']; ?></td>
<td align="center"><label><a href="msgs_answer.php?id=<?php echo $row_mesages['id_msgs']; ?>"><img src="images/details.png" alt="Read the message" width="40" height="40" border="0" /></a></label></td>
            </tr>
          <?php } while ($row_mesages = mysql_fetch_assoc($mesages)); ?>
      </table>&nbsp;</br>
    </form>
      <?php } // Show if recordset not empty ?>
<p>&nbsp;</p>
      <table width="487" border="0">
        <tr>
        <td width="481" align="center"><p>Please use the upper menu and select your options.<br />
          If you need assistance please call to:<br />
          <br />
          <span class="linea">All American Security Services<br />
        305-646-8134</span></p>
          <p>Remember that all the activity, including search will be recorded and the IP address will be registered with your username. This software was develop only for working purporse and to help you in your duties.</p></td>
      </tr>
    </table></td>
  </tr>
</table>
<!-- InstanceEndEditable -->
<table width="200" border="0" align="right">
  <tr>
    <td>User: <?php echo $row_usuario['names']; ?></td>
  </tr>
</table>

</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($usuario);

mysql_free_result($mesages);

mysql_free_result($t_msgs);
?>
