<?php require_once('../Connections/security.php'); ?>
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

$colname_usario = "-1";
if (isset($_COOKIE['username'])) {
  $colname_usario = $_COOKIE['username'];
}
mysql_select_db($database_security, $security);
$query_usario = sprintf("SELECT id_finger, last_name, first_name FROM tbl_users WHERE username = %s", GetSQLValueString($colname_usario, "text"));
$usario = mysql_query($query_usario, $security) or die(mysql_error());
$row_usario = mysql_fetch_assoc($usario);
$totalRows_usario = mysql_num_rows($usario);
?>
<!doctype html>
<!--[if lt IE 7]> <html class="ie6 oldie"> <![endif]-->
<!--[if IE 7]>    <html class="ie7 oldie"> <![endif]-->
<!--[if IE 8]>    <html class="ie8 oldie"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class=""><!-- InstanceBegin template="/Templates/mobile.dwt.php" codeOutsideHTMLIsLocked="false" -->
<!--<![endif]-->
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- InstanceBeginEditable name="doctitle" -->
<title>All American Security Services</title>
<!-- InstanceEndEditable -->
<link href="boilerplate.css" rel="stylesheet" type="text/css">
<link href="../mobile.css" rel="stylesheet" type="text/css">
<!-- 
To learn more about the conditional comments around the html tags at the top of the file:
paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/

Do the following if you're using your customized build of modernizr (http://www.modernizr.com/):
* insert the link to your js here
* remove the link below to the html5shiv
* add the "no-js" class to the html tags at the top
* you can also remove the link to respond.min.js if you included the MQ Polyfill in your modernizr build 
-->
<!--[if lt IE 9]>
<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<script src="respond.min.js"></script>
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
</head>
<body>
<div class="gridContainer clearfix"><br>
  <table width="238" border="0" align="center">
    <tr>
      <td width="232" align="center">You are logged as <?php echo $row_usario['first_name'] . " " . $row_usario['last_name']; ?></td>
    </tr>
  </table>
  <div id="LayoutDiv1">
    <table width="324" border="0" align="center">
      <tr>
        <td></td>
      </tr>
    </table>
    <!-- InstanceBeginEditable name="EditRegion1" -->
    <table width="200" border="0" align="center">
      <tr>
        <td align="center">Security incident report</td>
      </tr>
    </table>
    <br>
    <form name="form1" method="post" action="">
      <table width="325" border="1" align="center">
        <tr>
          <td colspan="2">Complainant's or witness data</td>
        </tr>
        <tr>
          <td width="78">Last name</td>
          <td width="231"><label for="txt_lastname"></label>
            <input type="text" name="txt_lastname" id="txt_lastname"></td>
        </tr>
        <tr>
          <td>First name</td>
          <td><label for="txt_firstname"></label>
            <input type="text" name="txt_firstname" id="txt_firstname"></td>
        </tr>
        <tr>
          <td>Full address:</td>
          <td><label for="txt_address"></label>
            <input name="txt_address" type="text" id="txt_address" size="40"></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>Description:</td>
          <td><label for="textarea"></label>
            <textarea name="textarea" cols="40" rows="7" id="textarea">ONLY INCLUDE FACTS</textarea></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table>
    </form>
    <table width="350" border="0" align="center">
      <tr>
        <td>&nbsp;</td>
      </tr>
    </table>
    <!-- InstanceEndEditable -->
    <p>&nbsp;</p>
    <p></p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
  </div>
</div>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($usario);
?>
