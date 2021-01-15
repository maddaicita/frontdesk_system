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

$currentPage = $_SERVER["PHP_SELF"];

$colname_usuario = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_usuario = $_SESSION['MM_Username'];
}
mysql_select_db($database_dplace, $dplace);
$query_usuario = sprintf("SELECT * FROM tbl_users WHERE username = %s", GetSQLValueString($colname_usuario, "text"));
$usuario = mysql_query($query_usuario, $dplace) or die(mysql_error());
$row_usuario = mysql_fetch_assoc($usuario);
$totalRows_usuario = mysql_num_rows($usuario);

$maxRows_packages = 20;
$pageNum_packages = 0;
if (isset($_GET['pageNum_packages'])) {
  $pageNum_packages = $_GET['pageNum_packages'];
}
$startRow_packages = $pageNum_packages * $maxRows_packages;

mysql_select_db($database_dplace, $dplace);
$query_packages = "SELECT pac.*, ten.names, ten.apt, ten.phones, us.names AS guard FROM tbl_packages pac, tbl_tennants ten, tbl_users us WHERE pac.id_tennant=ten.id_tennant AND pac.del_user=us.id_user AND pac.delivered = '1' ORDER BY pac.pkg_date_in DESC";
$query_limit_packages = sprintf("%s LIMIT %d, %d", $query_packages, $startRow_packages, $maxRows_packages);
$packages = mysql_query($query_limit_packages, $dplace) or die(mysql_error());
$row_packages = mysql_fetch_assoc($packages);

if (isset($_GET['totalRows_packages'])) {
  $totalRows_packages = $_GET['totalRows_packages'];
} else {
  $all_packages = mysql_query($query_packages);
  $totalRows_packages = mysql_num_rows($all_packages);
}
$totalPages_packages = ceil($totalRows_packages/$maxRows_packages)-1;

$queryString_packages = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_packages") == false && 
        stristr($param, "totalRows_packages") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_packages = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_packages = sprintf("&totalRows_packages=%d%s", $totalRows_packages, $queryString_packages);
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
      <table width="600" border="0">
      <tr>
        <td align="center" class="titulo">Packages delivered list</td>
      </tr>
    </table>
    <br />
    <?php if ($totalRows_packages > 0) { // Show if recordset not empty ?>
  <table width="514" border="1">
    <tr class="etiqueta">
      <td width="135">Date/Time</td>
      <td width="54">Unit</td>
      <td width="87">Tenant</td>
      <td width="158">Delivered by:</td>
      <td width="46">Details</td>
      </tr>
    <?php do { ?>
      <tr>
        <td><?php echo $row_packages['pkg_date_out']; ?></td>
        <td><?php echo $row_packages['apt']; ?></td>
        <td><?php echo $row_packages['names']; ?></td>
<td><?php echo $row_packages['guard']; ?></td>
        <td><a href="package_details.php?id=<?php echo $row_packages['pkg_id']; ?>"><img src="images/details.png" alt="Package details" title="Package details" width="40" height="40" border="0" /></a></td>
        </tr>
      <?php } while ($row_packages = mysql_fetch_assoc($packages)); ?>
  </table><?php } // Show if recordset not empty ?>
  <br />
  <table width="363" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="222" align="center"><?php if ($pageNum_packages > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_packages=%d%s", $currentPage, max(0, $pageNum_packages - 1), $queryString_packages); ?>">Previous</a>
          <?php } // Show if not first page ?></td>
      <td width="204" align="center"><?php if ($pageNum_packages > 0) { // Show if not first page ?>
  <a href="<?php printf("%s?pageNum_packages=%d%s", $currentPage, 0, $queryString_packages); ?>">First</a>
  <?php } // Show if not first page ?></td>
      <td width="166" align="center"><?php if ($pageNum_packages < $totalPages_packages) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_packages=%d%s", $currentPage, min($totalPages_packages, $pageNum_packages + 1), $queryString_packages); ?>">Next</a>
          <?php } // Show if not last page ?></td>
    </tr>
  </table>
</td>
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

mysql_free_result($packages);
?>
