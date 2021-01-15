<?php require_once('../Connections/dplace.php'); ?>
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
	
  $logoutGoTo = "emp_login.php";
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

$MM_restrictGoTo = "emp_login.php";
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

$colname_tenant = "-1";
if (isset($_GET['id'])) {
  $colname_tenant = $_GET['id'];
}
mysql_select_db($database_dplace, $dplace);
$query_tenant = sprintf("SELECT id_tennant, apt, `names`, phones, email FROM tbl_tennants WHERE id_tennant = %s", GetSQLValueString($colname_tenant, "int"));
$tenant = mysql_query($query_tenant, $dplace) or die(mysql_error());
$row_tenant = mysql_fetch_assoc($tenant);
$totalRows_tenant = mysql_num_rows($tenant);

$colname_usuario = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_usuario = $_SESSION['MM_Username'];
}
mysql_select_db($database_dplace, $dplace);
$query_usuario = sprintf("SELECT * FROM tbl_users WHERE username = %s", GetSQLValueString($colname_usuario, "text"));
$usuario = mysql_query($query_usuario, $dplace) or die(mysql_error());
$row_usuario = mysql_fetch_assoc($usuario);
$totalRows_usuario = mysql_num_rows($usuario);

mysql_select_db($database_dplace, $dplace);
$query_package = "SELECT pak.*, typ.type_desc, cond.con_description  FROM tbl_packages pak, tbl_package_type typ, tbl_condition cond WHERE pak.pkg_label = '" . $_REQUEST['pkg_id'] . "' AND pak.pkg_type=typ.type_id AND pak.pkg_condition= cond.con_id";
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
<script>
// (C) 2001 www.CodeLifter.com
// http://www.codelifter.com
// Free for all users, but leave in this header
var theURL = 'http://localhost/dial.php?phone=<?php echo $row_id['phones']; ?>';
var width  = 400;
var height = 200;
function popWindow() {
newWindow = window.open(theURL,'newWindow','toolbar=no,menubar=no,resizable=no,scrollbars=no,status=no,location=no,width='+width+',height='+height);
}
</script>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable --><script type="text/javascript" src="stmenu.js"></script>
<link href="../css/styles.css" rel="stylesheet" type="text/css" />
</head>

<body>
<br />
<table width="600" border="0" align="center">
  <tr>
    <td align="center"><script type="text/javascript" src="menu.js"></script></td>
  </tr>
</table>
<table width="600" border="0" align="center">
  <tr>
    <td height="466" align="center" valign="top"><!-- InstanceBeginEditable name="content" -->
      <p class="Titles">Package arrival notification for unit# <?php echo $row_tenant['apt']; ?></p>
      <p class="Titles"><?php echo $row_tenant['names']; ?></p>
      <p>As part of our duty we must notify the tenant about his/her package. If there is an email address on file, the option will appear bellow. If not please click on the phone icon to call inmediately the owner of the package.</p>
      <table width="273" border="1">
        <tr>
          <td width="126" height="98" align="center"><?php
		  
		  if (strlen($row_tenant['email']) > 0) {
				echo "<a href=\"mailto:" . $row_tenant['email'] . "?subject=Cynergi's lobby package notification.&body=Dear: " . $row_tenant['names'] .  "%0D%0A%0D%0AA Package was left for you at the lobby, please pick it up when you wish.%0D%0A%0D%0APackage description:%0D%0A%0D%0ABarcode: " . $row_package['pkg_label']. "%0D%0APackage type: " . $row_package['type_desc'] . "%0D%0APerishable: " .$row_package['pkg_perishable'] . "%0D%0ACondition: " . $row_package['con_description'] . "%0D%0A%0D%0ABest regards%0D%0A%0D%0ACynergi's frontdesk.\"><img src=\"images/email.png\" alt=\"Send an E-mail\" width=\"60\" height=\"60\" border=\"0\" title=\"Send an E-mail\" /></a>"; } else { echo "<img src=\"images/noemail.png\" alt=\"No E-mail avaliable!\" width=\"60\" height=\"60\" border=\"0\" title=\"Send an E-mail\"";}?></td>
          <td width="131" align="center"><a href="javascript:popWindow()"><img src="images/phono.png" alt="Call tennant" width="60" height="44" border="0" /></a></td>
        </tr>
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
mysql_free_result($tenant);

mysql_free_result($usuario);

mysql_free_result($package);
?>
