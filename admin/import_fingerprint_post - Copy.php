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
  $updateSQL = sprintf("UPDATE tbl_fingerprint SET status=%s WHERE id=%s",
                       GetSQLValueString($_POST['hidden_status'], "int"),
                       GetSQLValueString($_POST['hidden_id'], "int"));

  mysql_select_db($database_security, $security);
  $Result1 = mysql_query($updateSQL, $security) or die(mysql_error());

  $updateGoTo = "date.php";
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
$query_user = sprintf("SELECT users_id, last_name, first_name, user_admin FROM tbl_admins WHERE username = %s", GetSQLValueString($colname_user, "text"));
$user = mysql_query($query_user, $security) or die(mysql_error());
$row_user = mysql_fetch_assoc($user);
$totalRows_user = mysql_num_rows($user);

// RETRIEVE SETTINGS

mysql_select_db($database_security, $security);
$query_sett = "SELECT date_start, date_end FROM tbl_settings";
$sett = mysql_query($query_sett, $security) or die(mysql_error());
$row_sett = mysql_fetch_assoc($sett);
$totalRows_sett = mysql_num_rows($sett);

$date_start = $row_sett['date_start'];
$date_end = $row_sett['date_end'];


// SEARCH EACH RECORD ON THE DATABASE

mysql_select_db($database_security, $security);
$query_schedule = "SELECT sch.* FROM schedule sch WHERE sch_date > '" . $date_start . "' AND sch_date < '" . $date_end . "' ORDER BY sch_date DESC";
$schedule = mysql_query($query_schedule, $security) or die(mysql_error());
$row_schedule = mysql_fetch_assoc($schedule);
$totalRows_schedule = mysql_num_rows($schedule);


do {   //loop to process scheduled dates
// CREATE CHECK-IN AND CHECK-OUT DATES
$check_in = substr($row_schedule['shift'],0,5);
$check_out = substr($row_schedule['shift'],9,11);
$check_in_full = $row_schedule['sch_date'] . " " . $check_in . ":00";
$check_out_full = $row_schedule['sch_date'] . " " . $check_out . ":00";
	// CREATE FULL DATE TO LOOK FORWARD
	

	
	//echo $check_in_full . "<br>";
		
	// COMPARE THE SHIFT TIME WITH A FINGERPRINT TIME PERIOD RECORD
	
	// CHECK IN
	
	mysql_select_db($database_security, $security);
	$query_finger = "SELECT fin.date_finger, fin.id, sch.sch_id FROM schedule sch, tbl_users us, tbl_fingerprint fin WHERE sch.users_id = us.users_id AND fin.id_emp = us.id_finger AND DATE_SUB('" . $check_in_full . "' ,INTERVAL 29 MINUTE) < fin.date_finger AND DATE_ADD('" . $check_in_full . "', INTERVAL 15 MINUTE) > fin.date_finger and fin.status = 0 and sch.sch_id =" . $row_schedule['sch_id'];
	echo $query_finger . "<br>";
	
	$finger = mysql_query($query_finger, $security) or die(mysql_error());
	$row_finger = mysql_fetch_assoc($finger);
	$totalRows_finger = mysql_num_rows($finger);
	
	//echo $row_finger['id'] . " - " . $row_finger['date_finger']  . " - " . $row_finger['sch_id']  . " - " . $row_finger['fecha1']  . " - " . $row_finger['fecha2'] . "<br>";
	
	//IF A RECORD HAS BEEN FOUND UPDATE THE FINGERPRINT TABLE WITH 1 AT SCHE_ID and tipe record
	
	$updateSQL = sprintf("UPDATE tbl_fingerprint SET status=%s, sche_id=%s WHERE id=%s",
                       GetSQLValueString("1", "int"),
					   GetSQLValueString($row_finger['sch_id'], "int"),
                       GetSQLValueString($row_finger['id'], "int"));

  mysql_select_db($database_security, $security);
 $Result1 = mysql_query($updateSQL, $security) or die(mysql_error());
	
	

	// CHECK OUT
	
	mysql_select_db($database_security, $security);
	$query_finger = "SELECT fin.date_finger, fin.id, sch.sch_id FROM schedule sch, tbl_users us, tbl_fingerprint fin WHERE sch.users_id = us.users_id AND fin.id_emp = us.id_finger AND DATE_SUB('" . $check_out_full . "' ,INTERVAL 29 MINUTE) < fin.date_finger AND DATE_ADD('" . $check_out_full . "', INTERVAL 15 MINUTE) > fin.date_finger and fin.status = 0 and sch.sch_id =" . $row_schedule['sch_id'];
	echo $query_finger . "<br>";
	
	$finger = mysql_query($query_finger, $security) or die(mysql_error());
	$row_finger = mysql_fetch_assoc($finger);
	$totalRows_finger = mysql_num_rows($finger);
	
	echo $row_finger['id'] . " - " . $row_finger['date_finger']  . " - " . $row_finger['sch_id']  . " - " . $row_finger['fecha1']  . " - " . $row_finger['fecha2'] . "<br>";
	
	//IF A RECORD HAS BEEN FOUND UPDATE THE FINGERPRINT TABLE WITH 1 AT SCHE_ID and tipe record
	
	$updateSQL = sprintf("UPDATE tbl_fingerprint SET status=%s, sche_id=%s WHERE id=%s",
                       GetSQLValueString("2", "int"),
					   GetSQLValueString($row_finger['sch_id'], "int"),
                       GetSQLValueString($row_finger['id'], "int"));

  mysql_select_db($database_security, $security);
 $Result1 = mysql_query($updateSQL, $security) or die(mysql_error());
	






} while ($row_schedule = mysql_fetch_assoc($schedule))

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/adminpages.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head><script type="text/javascript" src="stmenu.js"></script>
<meta http-equiv="refresh" content="35;URL=import_fingerprin_list.php" charset=utf-8"> 
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
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>Import fingerprint post processing.....</p>
      <p>&nbsp;</p>
      <form id="form1" name="form1" method="POST" action="<?php echo $editFormAction; ?>">
        <input name="hidden_id" type="hidden" id="hidden_id" value="<?php echo $row_finger['id']; ?>" />
        <input name="hidden_status" type="hidden" id="hidden_status" value="1" />
        <input type="hidden" name="MM_update" value="form1" />
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

mysql_free_result($finger);
?>