<?php include('../Connections/security.php'); ?>
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
  $updateSQL = sprintf("UPDATE tbl_pending_task SET datetime_end=%s, admin_id_end=%s, comments_end=%s, task_status=%s WHERE task_id=%s",
                       GetSQLValueString($_POST['hidden_set'], "date"),
                       GetSQLValueString($_POST['hidden_admin'], "int"),
                       GetSQLValueString($_POST['textarea'], "text"),
					   GetSQLValueString($_POST['textarea'], "text"),
                       GetSQLValueString($_POST['hiddentask'], "int"));

  mysql_select_db($database_security, $security);
  $Result1 = mysql_query($updateSQL, $security) or die(mysql_error());

  $updateGoTo = "menu.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_user = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_user = $_SESSION['MM_Username'];
}
mysql_select_db($database_security, $security);
$query_user = sprintf("SELECT users_id, last_name, first_name, user_admin FROM tbl_users WHERE username = %s", GetSQLValueString($colname_user, "text"));
$user = mysql_query($query_user, $security) or die(mysql_error());
$row_user = mysql_fetch_assoc($user);
$totalRows_user = mysql_num_rows($user);

$colname_task = "-1";
if (isset($_GET['task'])) {
  $colname_task = $_GET['task'];
}
mysql_select_db($database_security, $security);
$query_task = sprintf("SELECT task.*, loc.location, us.first_name, us.last_name  FROM tbl_pending_task task, locations loc, tbl_users us  WHERE task_id = %s AND task.loc_id = loc.loc_id AND task.users_id = us.users_id", GetSQLValueString($colname_task, "int"));
$task = mysql_query($query_task, $security) or die(mysql_error());
$row_task = mysql_fetch_assoc($task);
$totalRows_task = mysql_num_rows($task);
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
<link href="../css/styles.css" rel="stylesheet" type="text/css" />
</head>

<body>
<table width="800" border="0" align="center">
  <tr>
    <td height="59" align="center"><script type="text/javascript" src="admin_menu.js"></script></td>
  </tr>
  <tr>
    <td height="568" align="center" valign="top"><!-- InstanceBeginEditable name="Content" -->
      <p class="Titles">Task details</p>
      <form id="form1" name="form1" method="POST" action="<?php echo $editFormAction; ?>">
        <table width="440" border="1">
          <tr>
            <td width="97" class="cabecera">Employee:              
            <input name="hiddentask" type="hidden" id="hiddentask" value="<?php echo $row_task['task_id']; ?>" /></td>
            <td width="327"><label for="txt"><?php echo $row_task['first_name']; ?> <?php echo $row_task['last_name']; ?></label></td>
          </tr>
          <tr>
            <td class="cabecera">Date/Time:</td>
            <td><?php echo $row_task['task_datetime']; ?></td>
          </tr>
          <tr>
            <td class="cabecera">Location:</td>
            <td><label for="select_location"><?php echo $row_task['location']; ?></label></td>
          </tr>
          <tr>
            <td class="cabecera">Comments:</td>
            <td><label for="txt_comments"><?php echo $row_task['comments']; ?></label></td>
          </tr>
          <tr>
            <td class="cabecera">Completion notes (if any)</td>
            <td><label for="textarea"></label>
            <textarea name="textarea" id="textarea" cols="45" rows="5"></textarea></td>
          </tr>
          <tr>
            <td class="cabecera"><input name="hidden_admin" type="hidden" id="hidden_admin" value="<?php echo $row_user['users_id']; ?>" />
              <input name="hidden_set" type="hidden" id="hidden_set" value="<?php echo date("Y-m-d H:i:s"); ?>" /></td>
            <td><input type="submit" name="button" id="button" value="     End task    " /></td>
          </tr>
        </table>
        <input type="hidden" name="MM_update" value="form1" />
      </form>
      <p>&nbsp;</p>
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

mysql_free_result($task);
?>
