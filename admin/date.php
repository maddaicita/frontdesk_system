<?php include('../Connections/security.php'); ?>
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

$colname_user = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_user = $_SESSION['MM_Username'];
}
mysql_select_db($database_security, $security);
$query_user = sprintf("SELECT users_id, last_name, first_name, user_admin FROM tbl_admins WHERE username = %s", GetSQLValueString($colname_user, "text"));
$user = mysql_query($query_user, $security) or die(mysql_error());
$row_user = mysql_fetch_assoc($user);
$totalRows_user = mysql_num_rows($user);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/adminpages.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head><script type="text/javascript" src="stmenu.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Allamerican Security Services</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
<link href="css/styles.css" rel="stylesheet" type="text/css" />
</head>

<body>
<table width="800" border="0" align="center">
  <tr>
    <td height="59" align="center"><script type="text/javascript" src="admin_menu.js"></script></td>
  </tr>
  <tr>
    <td height="568" align="center" valign="top"><!-- InstanceBeginEditable name="Content" -->
      <p>Compare dates</p>
      <form action="date.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
        <table width="400" border="1">
          <tr>
            <td>Date time start</td>
            <td><label>
              <input name="txt_time_start" type="text" id="txt_time_start" value="12/17/2013 06:00:00" />
            </label></td>
          </tr>
          <tr>
            <td>Date time end</td>
            <td><label>
              <input name="txt_time_end" type="text" id="txt_time_end" value="12/17/2013 08:00:00" />
            </label></td>
          </tr>
          <tr>
            <td>Date set</td>
            <td><label>
              <input name="txt_date_set" type="text" id="txt_date_set" />
            </label></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td><label>
              <input type="submit" name="button" id="button" value="Submit" />
            </label></td>
          </tr>
        </table>
        <p><?php 
		$time_min = strtotime($_POST['txt_time_start']);
		$time_max = strtotime($_POST['txt_time_end']);
		$time_set = strtotime($_POST['txt_date_set']);
		
		if ($time_set > $time_in and $time_set < $time_max) { echo "YES";} else { echo "NO";}  ?></p>
      </form>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
    <!-- InstanceEndEditable --></td>
  </tr>
</table>
<table width="300" border="0" align="right">
  <tr>
    <td align="right"><?php echo $row_user['first_name']; ?> <?php echo $row_user['last_name']; ?></td>
  </tr>
</table>
</body>
<!-- InstanceEnd --></html>
<?php

mysql_free_result($user);
?>
