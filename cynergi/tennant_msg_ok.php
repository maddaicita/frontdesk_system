<?php require_once('Connections/dplace.php'); ?>
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
  $insertSQL = sprintf("INSERT INTO tbl_tennant_msg (date_time, `names`, apt, phone, message) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['hidden_fecha'], "text"),
                       GetSQLValueString($_POST['txt_names'], "text"),
                       GetSQLValueString($_POST['txt_apt'], "text"),
                       GetSQLValueString($_POST['txt_phone'], "text"),
                       GetSQLValueString($_POST['txt_msgs'], "text"));

  mysql_select_db($database_dplace, $dplace);
  $Result1 = mysql_query($insertSQL, $dplace) or die(mysql_error());
  $insertGoTo = "index.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Visitors Control System</title>
<style type="text/css">
<!--
body {
	background-image: url(images/bgnd2.jpg);
	background-repeat: repeat-x;
}
-->
</style>
<link href="css/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
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
    </span></td>
  </tr>
</table>
<table width="816" height="367" border="0" align="center">
  <tr>
    <td align="center" valign="top"><table width="460" border="0">
        <tr>
          <td align="center" class="titulo">Message to the front desk / front gate</td>
        </tr>
      </table>
      <p><br />
      </p>
      <table width="569" border="1">
        <tr>
          <td width="559" align="center" class="highlight"><strong>Your message has been sent correctly. The message will be showed on the front desk computer.</strong></td>
        </tr>
      </table>
      <br />
      <p>&nbsp;</p>
      <p>&nbsp;</p>
    <p>&nbsp;</p></td>
  </tr>
</table>
<br />
</body>
