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
  $insertGoTo = "tennant_msg_ok.php";
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
      <br />
      <table width="535" border="1">
        <tr>
          <td width="431" align="center">This system is not a real time messager service. Your message will be opened the next time that a guard logs in over the front desk system. If you need something urgent, please contact them by phone.</td>
        </tr>
      </table>
      <br />
      <form id="form1" name="form1" method="POST" action="<?php echo $editFormAction; ?>">
        <table width="536" border="1">
          <tr>
            <td width="195" align="left" class="etiqueta">Names:
            <input type="hidden" name="hidden_fecha" id="hidden_fecha" value="<?php echo date("m/d/Y-G:H:s"); ?>" /></td>
            <td width="346" align="left"><label>
              <input type="text" name="txt_names" id="txt_names" />
            </label></td>
          </tr>
          <tr>
            <td align="left" class="etiqueta">Unit/Apt:</td>
            <td align="left"><label>
              <input type="text" name="txt_apt" id="txt_apt" />
            </label></td>
          </tr>
          <tr>
            <td align="left" class="etiqueta">Tennant Phone number:</td>
            <td align="left"><label>
              <input type="text" name="txt_phone" id="txt_phone" />
            </label></td>
          </tr>
          <tr>
            <td align="left" class="etiqueta">Message:</td>
            <td align="left"><label>
              <textarea name="txt_msgs" id="txt_msgs" cols="45" rows="5"></textarea>
            </label></td>
          </tr>
          <tr>
            <td align="left" class="etiqueta">&nbsp;</td>
            <td align="left"><label>
              <input type="submit" name="button" id="button" value="Submit" />
            </label></td>
          </tr>
        </table>
        <input type="hidden" name="MM_insert" value="form1" />
      </form>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
    <p>&nbsp;</p></td>
  </tr>
</table>
<br />
</body>
