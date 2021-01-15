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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO tbl_visitors (id_tennat, `names`, phones, autorized, chapa, make, model, comments, id_user) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['hidden_tennant'], "int"),
                       GetSQLValueString($_POST['text_names'], "text"),
                       GetSQLValueString($_POST['text_phones'], "text"),
                       GetSQLValueString($_POST['select_autorized'], "text"),
                       GetSQLValueString($_POST['text_chapa'], "text"),
                       GetSQLValueString($_POST['text_make'], "text"),
                       GetSQLValueString($_POST['text_model'], "text"),
                       GetSQLValueString($_POST['text_comments'], "text"),
                       GetSQLValueString($_POST['hidden_user'], "int"));

  mysql_select_db($database_dplace, $dplace);
  $Result1 = mysql_query($insertSQL, $dplace) or die(mysql_error());

  $insertGoTo = "visitor_ok.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
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

$colname_tennant = "-1";
if (isset($_GET['id'])) {
  $colname_tennant = $_GET['id'];
}
mysql_select_db($database_dplace, $dplace);
$query_tennant = sprintf("SELECT * FROM tbl_tennants WHERE id_tennant = %s", GetSQLValueString($colname_tennant, "int"));
$tennant = mysql_query($query_tennant, $dplace) or die(mysql_error());
$row_tennant = mysql_fetch_assoc($tennant);
$totalRows_tennant = mysql_num_rows($tennant);
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
<!-- InstanceBeginEditable name="central" --><br />
<table width="400" border="0" align="center">
  <tr>
    <td align="center" class="titulo">Visitors registration</td>
  </tr>
</table>
<table width="816" height="367" border="0" align="center">
  <tr>
    <td align="center" valign="top"><p>&nbsp;</p>
      <form id="form1" name="form1" method="POST" action="<?php echo $editFormAction; ?>">
        <table width="468" border="1">
          <tr>
            <td width="84" class="etiqueta">Tennant:
            <input name="hidden_tennant" type="hidden" id="hidden_tennant" value="<?php echo $row_tennant['id_tennant']; ?>" /></td>
            <td width="368"><?php echo $row_tennant['names']; ?><br />
              <?php echo $row_tennant['bldg']; ?> <?php echo $row_tennant['address']; ?> APT# <?php echo $row_tennant['apt']; ?></td>
          </tr>
          <tr>
            <td class="etiqueta">Names:</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td class="etiqueta">Phones:</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td class="etiqueta">License plate:</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td class="etiqueta">Make:</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td class="etiqueta">Model:</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td class="etiqueta">Autorized?</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td valign="top" class="etiqueta">Comments:</td>
            <td><label>
              <textarea name="text_comments" id="text_comments" cols="45" rows="5"></textarea>
            </label></td>
          </tr>
          <tr>
            <td class="etiqueta"><input name="hidden_user" type="hidden" id="hidden_user" value="<?php echo $row_usuario['id_user']; ?>" /></td>
            <td><label>
              <input type="submit" name="button" id="button" value="Submit" />
            </label></td>
          </tr>
        </table>
        <input type="hidden" name="MM_insert" value="form1" />
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

mysql_free_result($tennant);
?>
