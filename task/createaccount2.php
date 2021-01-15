<?php require_once('../Connections/allamerican.php'); ?>
<?php include('../admin/seg.php'); ?>
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

$phone_usuario = "-1";
if (isset($_POST['txt_phone'])) {
  $phone_usuario = $_POST['txt_phone'];
}
$ssn_usuario = "-1";
if (isset($_POST['txt_ssn'])) {
  $ssn_usuario = $_POST['txt_ssn'];
}
mysql_select_db($database_allamerican, $allamerican);
$query_userreg = sprintf("SELECT users_id, last_name, first_name FROM tbl_users WHERE `cellphone` = %s AND `ssn`= %s", GetSQLValueString($phone_usuario, "text"),GetSQLValueString(md5($ssn_usuario), "text"));
$userreg = mysql_query($query_userreg, $allamerican) or die(mysql_error());
$row_userreg = mysql_fetch_assoc($userreg);
$totalRows_userreg = mysql_num_rows($userreg);

$phone_usuario = "-1";
if (isset($_POST['txt_phone'])) {
  $phone_usuario = $_POST['txt_phone'];
}
$ssn_usuario = "-1";
if (isset($_POST['txt_ssn'])) {
  $ssn_usuario = $_POST['txt_ssn'];
}
mysql_select_db($database_allamerican, $allamerican);
$query_userno = sprintf("SELECT users_id, last_name, first_name FROM tbl_users WHERE user_task = 0 AND `cellphone` = %s AND `ssn`= %s", GetSQLValueString($phone_usuario, "text"),GetSQLValueString(md5($ssn_usuario), "text"));
$userno = mysql_query($query_userno, $allamerican) or die(mysql_error());
$row_userno = mysql_fetch_assoc($userno);
$totalRows_userno = mysql_num_rows($userno);

$phone_usuario = "-1";
if (isset($_POST['txt_phone'])) {
  $phone_usuario = $_POST['txt_phone'];
}
$ssn_usuario = "-1";
if (isset($_POST['txt_ssn'])) {
  $ssn_usuario = $_POST['txt_ssn'];
}

mysql_select_db($database_allamerican, $allamerican);
$query_usuario = sprintf("SELECT users_id, last_name, first_name, LENGTH(date_fired) AS le FROM tbl_users WHERE user_task = 1 AND `cellphone` = %s AND `ssn`= %s AND username IS NULL", GetSQLValueString($phone_usuario, "text"),GetSQLValueString(md5($ssn_usuario), "text"));
$usuario = mysql_query($query_usuario, $allamerican) or die(mysql_error());
$row_usuario = mysql_fetch_assoc($usuario);
$totalRows_usuario = mysql_num_rows($usuario);

$phone_usuario = "-1";
if (isset($_POST['txt_phone'])) {
  $phone_usuario = $_POST['txt_phone'];
}
$ssn_usuario = "-1";
if (isset($_POST['txt_ssn'])) {
  $ssn_usuario = $_POST['txt_ssn'];
}

mysql_select_db($database_allamerican, $allamerican);
$query_usuario2 = sprintf("SELECT users_id, last_name, first_name, LENGTH(date_fired) AS le FROM tbl_users WHERE user_task = 1 AND `cellphone` = %s AND `ssn`= %s AND username IS NOT NULL", GetSQLValueString($phone_usuario, "text"),GetSQLValueString(md5($ssn_usuario), "text"));
$usuario = mysql_query($query_usuario2, $allamerican) or die(mysql_error());
$row_usuario = mysql_fetch_assoc($usuario);
$totalRows_usuario = mysql_num_rows($usuario);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>All American</title>
</head>

<body>
<br />
<table width="448" border="0" align="center">
  <?php if ($totalRows_userreg == 0) { // Show if recordset empty ?>
  <tr>
    <td width="442" align="center">Sorry but we have not found any record matching your data. Please call the office if you need assitance with this matter.</td>
  </tr>
  <?php } // Show if recordset empty ?>
</table>
<br />
<table width="606" height="194" border="0" align="center">
  <?php if ($totalRows_userreg > 0) { // Show if recordset not empty ?>
    <tr>
      <td width="600" align="center"><table width="516" height="124" border="0" align="center">
          <?php if ($totalRows_usuario == 0) { // Show if recordset empty ?>
            <tr>
              <td height="120"><table width="430" border="0" align="center">
                <?php if ($totalRows_userno == 0) { // Show if recordset empty ?>
                  <tr>
                    <td width="424" align="center">We found your record, <?php echo $row_userreg['first_name']; ?> <?php echo $row_userreg['last_name']; ?>,  but you are not allowed yet to create an account to manage task services.<br />
                      <br />
                      Please give us a call to activate your records, to let you to create an account, thanks.</td>
                  </tr>
                  <?php } // Show if recordset empty ?>
              </table></td>
              <br />
            </tr>
            <?php } // Show if recordset empty ?>
        </table>
        <table width="505" height="119" border="0">
          <?php if ($totalRows_usuario > 0) { // Show if recordset not empty ?>
  <tr>
    <td width="499"><?php if ($totalRows_usuario2 > 0) { // Show if recordset not empty ?>
        <table width="390" border="0" align="center">
          <tr>
            <td width="384" align="center">Hi <?php echo $row_usuario['first_name']; ?> <?php echo $row_usuario['last_name']; ?>, Please chose an username and a password for your account.</td>
          </tr>
        </table>
        <?php } // Show if recordset not empty ?>
      <br />
      <?php if ($totalRows_usuario2 > 0) { // Show if recordset not empty ?>
        <table width="300" border="1" align="center">
          <tr>
            <td>Username:</td>
            <td><label>
              <input type="text" name="textfield" id="textfield" />
            </label></td>
          </tr>
          <tr>
            <td>Password:</td>
            <td><input type="text" name="textfield2" id="textfield2" /></td>
          </tr>
          <tr>
            <td>Confirm password:</td>
            <td><input type="text" name="textfield3" id="textfield3" /></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td><label>
              <input type="submit" name="button" id="button" value="Submit" />
            </label></td>
          </tr>
        </table>
        <?php } // Show if recordset not empty ?>
<table width="300" border="0" align="center">
  <?php if ($totalRows_usuario2 == 0) { // Show if recordset empty ?>
  <tr>
    <td align="center">You have already created  an account, please click here to try to recover your password</td>
  </tr>
  <?php } // Show if recordset empty ?>
      </table></td>
  </tr>
  <?php } // Show if recordset not empty ?>
        </table>
<p><br />
      </p></td>
    </tr>
    <?php } // Show if recordset not empty ?>
</table>
<br />
<br />
<br />
<br />
</body>
</html>
<?php
mysql_free_result($usuario);

mysql_free_result($userno);
?>
