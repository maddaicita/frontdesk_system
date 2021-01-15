<?php include('../Connections/security.php');
?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$special_shift = 0;
$ci_hour = "";
$ci_min = "";
$co_hour = "";
$co_min = "";
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

if ($_POST['hidden_fixed'] == 1) {
  $insertSQL = sprintf("INSERT INTO schedule (users_id, shift_id, sch_date, shift, notes, week, shc_set, admin_id) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['hidden_user'], "int"),
                       GetSQLValueString($_POST['hidden_shift'], "int"),
                       GetSQLValueString($_POST['txt_date'], "date"),
					   GetSQLValueString($_POST['hidden_ci'] . " to " . $_POST['hidden_co'], "text"),
					   GetSQLValueString($_POST['txt_notes'], "text"),
                       GetSQLValueString(date("W", strtotime($_POST['txt_date'])), "int"),
                       GetSQLValueString($_POST['hidden_datetime'], "date"),
                       GetSQLValueString($_POST['hidden_admin'], "int"));

} else {
  $insertSQL = sprintf("INSERT INTO schedule (users_id, shift_id, sch_date, shift, notes, week, shc_set, admin_id) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['hidden_user'], "int"),
                       GetSQLValueString($_POST['hidden_shift'], "int"),
                       GetSQLValueString($_POST['txt_date'], "date"),
					   GetSQLValueString($_POST['hidden_ci'] . " to " . $_POST['hidden_co'], "text"),
					   GetSQLValueString($_POST['txt_notes'], "text"),
                       GetSQLValueString(date("W", strtotime($_POST['txt_date'])), "int"),
                       GetSQLValueString($_POST['hidden_datetime'], "date"),
                       GetSQLValueString($_POST['hidden_admin'], "int"));
}
//echo $insertSQL;
  mysql_select_db($database_security, $security);
  $Result1 = mysql_query($insertSQL, $security) or die(mysql_error());

  $insertGoTo = "employee_schedule.php?users_id=" . $row_emp['users_id'] . "";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
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

$colname_emp = "-1";
if (isset($_GET['users_id'])) {
  $colname_emp = $_GET['users_id'];
}
mysql_select_db($database_security, $security);
$query_emp = sprintf("SELECT users_id, last_name, first_name FROM tbl_users WHERE users_id = %s", GetSQLValueString($colname_emp, "int"));
$emp = mysql_query($query_emp, $security) or die(mysql_error());
$row_emp = mysql_fetch_assoc($emp);
$totalRows_emp = mysql_num_rows($emp);

$colname_shift = "-1";
if (isset($_REQUEST['shift_id'])) {
  $colname_shift = $_REQUEST['shift_id'];
}

if ($_GET['shift_id'] == 0) { 

$special_shift = 1;
$ci_hour = $_REQUEST['select_ci_hour'];
$ci_min = $_REQUEST['txt_ci_min'];
$co_hour = $_REQUEST['select_co_hour'];
$co_min = $_REQUEST['txt_co_min'];

mysql_select_db($database_security, $security);
		$query_shift ="SELECT location, loc_id, d_shift FROM locations WHERE loc_id = " . $_COOKIE["loc_id"] . "";
		$shift = mysql_query($query_shift, $security) or die(mysql_error());
		$row_shift = mysql_fetch_assoc($shift);
		$totalRows_shift = mysql_num_rows($shift);

} else {
		mysql_select_db($database_security, $security);
		$query_shift = sprintf("SELECT sh.*, loca.location, loca.d_shift FROM locations_shifts sh, locations loca WHERE sh.shift_id = %s AND sh.loc_id = loca.loc_id", GetSQLValueString($colname_shift, "int"));
		$shift = mysql_query($query_shift, $security) or die(mysql_error());
		$row_shift = mysql_fetch_assoc($shift);
		$totalRows_shift = mysql_num_rows($shift);
}


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
      <p class="Titles">Select date to set this shift</p>
       <?php
    require "calendar/class.datepicker.php";
    $db=new datepicker();
    $db->firstDayOfWeek = 1;
    $db->dateFormat = "Y-m-d";
?> <form id="form1" name="form1" method="POST" action="<?php echo $editFormAction; ?>">
        <table width="471" border="1" cellpadding="2">
          <tr>
            <td width="141" align="left" class="cabecera">Employee:</td>
            <td width="314" align="left"><?php echo $row_emp['first_name']; ?> <?php echo $row_emp['last_name']; ?>
            <input name="hidden_user" type="hidden" id="hidden_user" value="<?php echo $row_emp['users_id']; ?>" /></td>
          </tr>
          <tr>
            <td align="left" class="cabecera">Working property:</td>
            <td align="left"><?php echo $row_shift['location']; ?>
            <input name="hidden_loc" type="hidden" id="hidden_loc" value="<?php echo $row_shift['loc_id']; ?>" /></td>
          </tr>
          <tr>
            <td align="left" class="cabecera">Shift time:</td>
            <td align="left"><?php
			
			if ($special_shift == 1) {
				
				echo $ci_hour . ":" .  $ci_min . " to ";
				echo $co_hour . ":" .  $co_min;
				
				} else {
			
			 //echo $row_shift['shift_time'];
			 $ci_hour = substr($row_shift['shift_time'], 0,2);
			 $ci_min = substr($row_shift['shift_time'], 3,2);
			 $co_hour = substr($row_shift['shift_time'], 9,2);
			 $co_min = substr($row_shift['shift_time'], 12,2);
			 echo $ci_hour . ":" .  $ci_min . " to ";
				echo $co_hour . ":" .  $co_min;
			}?>
            <input name="hidden_shift" type="hidden" id="hidden_shift" value="<?php
			
			if ($special_shift == 1) {echo $row_shift['d_shift'];} else {
				 echo $row_shift['shift_id'];
			}?>" />
            <input type="hidden" name="hidden_ci" id="hidden_ci" value="<?php echo $ci_hour . ":" .  $ci_min; ?>" />			<input type="hidden" name="hidden_co" id="hidden_co" value="<?php echo $co_hour . ":" .  $co_min; ?>" /></td>
          </tr>
          <tr>
            <td align="left" class="cabecera">Date:</td>
            <td align="left"><label>
              <input name="txt_date" type="text" class="caja_grande" id="txt_date" size="15" maxlength="10" onclick="<?=$db->show("txt_date")?>" />
            </label></td>
          </tr>
          <tr>
            <td align="left" class="cabecera">Note:</td>
            <td align="left"><label for="txt_notes"></label>
            <textarea name="txt_notes" id="txt_notes" cols="45" rows="5"></textarea></td>
          </tr>
          <tr>
            <td align="left" class="cabecera"><input name="hidden_admin" type="hidden" id="hidden_admin" value="<?php echo $row_user['users_id']; ?>" />
            <input type="hidden" name="hidden_datetime" id="hidden_datetime" value="<?php echo date("Y-m-d G:i:s");  ?>" />
            <input name="hidden_fixed" type="hidden" id="hidden_fixed" value="<?php echo $special_shift; ?>" />
            <input name="hidden_default" type="hidden" id="hidden_default" value="<?php echo $row_shift['d_shift']; ?>" /></td>
            <td align="left"><label>
              <input name="button" type="submit" class="caja_grande" id="button" value="Submit" />
            <?php echo $row_shift['d_shift']; ?></label></td>
          </tr>
        </table>
        <input type="hidden" name="MM_insert" value="form1" />
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

mysql_free_result($emp);

mysql_free_result($shift);
?>