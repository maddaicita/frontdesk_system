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

$MM_restrictGoTo = "../index.php";
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

$maxRows_log = 20;
$pageNum_log = 0;
if (isset($_GET['pageNum_log'])) {
  $pageNum_log = $_GET['pageNum_log'];
}
$startRow_log = $pageNum_log * $maxRows_log;

mysql_select_db($database_dplace, $dplace);
$query_log = "SELECT incident_id, incident_number, type, location, date_start, time_start, complainant, completed_by FROM tbl_incident ORDER BY date_start DESC";
$query_limit_log = sprintf("%s LIMIT %d, %d", $query_log, $startRow_log, $maxRows_log);
$log = mysql_query($query_limit_log, $dplace) or die(mysql_error());
$row_log = mysql_fetch_assoc($log);

if (isset($_GET['totalRows_log'])) {
  $totalRows_log = $_GET['totalRows_log'];
} else {
  $all_log = mysql_query($query_log);
  $totalRows_log = mysql_num_rows($all_log);
}
$totalPages_log = ceil($totalRows_log/$maxRows_log)-1;

$queryString_log = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_log") == false && 
        stristr($param, "totalRows_log") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_log = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_log = sprintf("&totalRows_log=%d%s", $totalRows_log, $queryString_log);
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
	background-image: url(../images/bgnd2.jpg);
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
    <td align="center" valign="top"><br />
      <table width="400" border="0">
      <tr>
        <td align="center" class="titulo">Incident log</td>
      </tr>
    </table
      <br />
    <?php if ($totalRows_log > 0) { // Show if recordset not empty ?>
  <table width="730" border="1">
    <tr class="etiqueta">
      <td width="126">Date/Time</td>
      <td width="94">Type</td>
      <td width="164">Location</td>
      <td width="137">Complainant</td>
      <td width="123">Completed by</td>
      <td width="46">Details</td>
    </tr>
    <?php do { ?>
      <tr>
        <td><?php echo $row_log['date_start']; ?> <?php echo $row_log['time_start']; ?></td>
        <td><?php echo $row_log['type']; ?></td>
        <td><?php echo $row_log['location']; ?></td>
        <td><?php echo $row_log['complainant']; ?></td>
        <td><?php echo $row_log['completed_by']; ?></td>
        <td><a href="incident_details.php?id=<?php echo $row_log['incident_id']; ?>"><img src="../images/details.png" width="40" height="40" border="0" /></a></td>
      </tr>
      <?php } while ($row_log = mysql_fetch_assoc($log)); ?>
  </table>
      <br />
      <br />
      <table width="295" border="0">
        <tr>
          <td width="120" align="center"><?php if ($pageNum_log > 0) { // Show if not first page ?>
              <a href="<?php printf("%s?pageNum_log=%d%s", $currentPage, max(0, $pageNum_log - 1), $queryString_log); ?>">Previous</a>
              <?php } // Show if not first page ?></td>
          <td width="64" align="center"><?php if ($pageNum_log > 0) { // Show if not first page ?>
              <a href="<?php printf("%s?pageNum_log=%d%s", $currentPage, 0, $queryString_log); ?>">First</a>
              <?php } // Show if not first page ?></td>
          <td width="97" align="center"><?php if ($pageNum_log < $totalPages_log) { // Show if not last page ?>
  <a href="<?php printf("%s?pageNum_log=%d%s", $currentPage, min($totalPages_log, $pageNum_log + 1), $queryString_log); ?>">Next</a>
  <?php } // Show if not last page ?></td>
          </tr>
      </table>
      <?php } // Show if recordset not empty ?></td>
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

mysql_free_result($log);
?>
