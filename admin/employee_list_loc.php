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

$colname_user = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_user = $_SESSION['MM_Username'];
}
mysql_select_db($database_security, $security);
$query_user = sprintf("SELECT users_id, last_name, first_name, user_admin FROM tbl_admins WHERE username = %s", GetSQLValueString($colname_user, "text"));
$user = mysql_query($query_user, $security) or die(mysql_error());
$row_user = mysql_fetch_assoc($user);
$totalRows_user = mysql_num_rows($user);

$colname_employees = "-1";
if (isset($_POST['loc'])) {
  $colname_employees = $_POST['loc'];
}
mysql_select_db($database_security, $security);
$query_employees = sprintf("SELECT us.*, lo.location FROM tbl_users us, locations lo WHERE us.loc_id = lo.loc_id AND user_enabled=1 AND lo.loc_id = %s ORDER BY us.last_name ASC", GetSQLValueString($colname_employees, "int"));
$employees = mysql_query($query_employees, $security) or die(mysql_error());
$row_employees = mysql_fetch_assoc($employees);
$totalRows_employees = mysql_num_rows($employees);

mysql_select_db($database_security, $security);
$query_prop = "SELECT * FROM locations ORDER BY location ASC";
$prop = mysql_query($query_prop, $security) or die(mysql_error());
$row_prop = mysql_fetch_assoc($prop);
$totalRows_prop = mysql_num_rows($prop);

$colname_loc_title = "-1";
if (isset($_POST['loc'])) {
  $colname_loc_title = $_POST['loc'];
}
mysql_select_db($database_security, $security);
$query_loc_title = sprintf("SELECT * FROM locations WHERE loc_id = %s", GetSQLValueString($colname_loc_title, "int"));
$loc_title = mysql_query($query_loc_title, $security) or die(mysql_error());
$row_loc_title = mysql_fetch_assoc($loc_title);
$totalRows_loc_title = mysql_num_rows($loc_title);
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
      <p class="Titles"> <?php echo $row_loc_title['location']; ?> Employee List </p>
      <form id="form1" name="form1" method="post" action="">
        <table width="400" border="1">
          <tr>
            <td width="142" class="cabecera">Property:</td>
            <td width="167"><label>
              <select name="loc" id="loc">
                <?php
do {  
?>
                <option value="<?php echo $row_prop['loc_id']?>"><?php echo $row_prop['location']?></option>
                <?php
} while ($row_prop = mysql_fetch_assoc($prop));
  $rows = mysql_num_rows($prop);
  if($rows > 0) {
      mysql_data_seek($prop, 0);
	  $row_prop = mysql_fetch_assoc($prop);
  }
?>
              </select>
            </label></td>
            <td width="69"><label>
              <input type="submit" name="button" id="button" value="Submit" />
            </label></td>
          </tr>
        </table>
      </form>
      <br />
      <?php if ($totalRows_employees > 0) { // Show if recordset not empty ?>
  <table width="1007" border="1">
    <tr class="cabecera">
      <td width="154">Last name</td>
      <td width="60">Fist name</td>
      <td width="147">Middle</td>
      <td width="147">Cell Phone</td>
      <td>E-mail</td>
      <td width="109">Lic#</td>
      <td width="90">Lic.exp date</td>
      <td width="41">Hours</td>
      <td width="41">Shifts</td>
      <td width="41">Details</td>
      <td width="20">Edit</td>
    </tr>
    <?php do { ?>
      <tr class="lineas">
        <td><?php echo $row_employees['last_name']; ?></td>
        <td><?php echo $row_employees['first_name']; ?></td>
        <td><?php echo $row_employees['middle_name']; ?></td>
        <td><?php echo formatPhoneNumber($row_employees['cellphone']); ?></td>
        <td align="center"><?php if ($row_employees['email'] <> "") {
				echo "<a href=\"mailto:" . $row_employees['email'] . "\"><img src=\"../images/email.jpg\" width=\"35\" height=\"35\" border=\"0\" /></a>"; }	?></td>
        <td><?php
		  if ($row_employees['license_training'] == 1) { echo "Acknowledgment Card";} else { echo $row_employees['license_class'] . $row_employees['license_number']; }
		  ?></td>
        <td align="center" <?php if (time_diff($row_employees['exp_license'] . " 00:00:00",date('Y-m-d') . " 00:00:00")/86400 < 60) { echo "bgcolor=\"#FF0000\"";} ?> ><?php 
			if ($row_employees['exp_license'] <> "") { echo date("m/d/Y", strtotime($row_employees['exp_license'])); }
			
			?></td>
        <td align="center"><a href="employee_hours.php?id=<?php echo $row_employees['users_id']; ?>"><img src="../images/clock.png" alt="Hours" width="28" height="31" border="0" /></a></td>
        <td align="center"><a href="employee_schedule.php?users_id=<?php echo $row_employees['users_id']; ?>"><img src="../images/calendar.jpg" width="35" height="35" border="0" /></a></td>
        <td align="center"><a href="details.php?id=<?php echo $row_employees['users_id']; ?>"><img src="../images/detalle.png" alt="Employee Details" width="16" height="16" border="0" /></a></td>
        <td align="center"><a href="employee_edit.php?id=<?php echo $row_employees['users_id']; ?>"><img src="../images/editi.png" alt="Edit employee" width="16" height="16" border="0" /></a></td>
      </tr>
      <?php } while ($row_employees = mysql_fetch_assoc($employees)); ?>
  </table>
  <?php } // Show if recordset not empty ?>
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

 function formatPhoneNumber($phoneNumber) {
    $phoneNumber = preg_replace('/[^0-9]/','',$phoneNumber);

    if(strlen($phoneNumber) > 10) {
        $countryCode = substr($phoneNumber, 0, strlen($phoneNumber)-10);
        $areaCode = substr($phoneNumber, -10, 3);
        $nextThree = substr($phoneNumber, -7, 3);
        $lastFour = substr($phoneNumber, -4, 4);

        $phoneNumber = '+'.$countryCode.' ('.$areaCode.') '.$nextThree.'-'.$lastFour;
    }
    else if(strlen($phoneNumber) == 10) {
        $areaCode = substr($phoneNumber, 0, 3);
        $nextThree = substr($phoneNumber, 3, 3);
        $lastFour = substr($phoneNumber, 6, 4);

        $phoneNumber = '('.$areaCode.') '.$nextThree.'-'.$lastFour;
    }
    else if(strlen($phoneNumber) == 7) {
        $nextThree = substr($phoneNumber, 0, 3);
        $lastFour = substr($phoneNumber, 3, 4);

        $phoneNumber = $nextThree.'-'.$lastFour;
    }

    return $phoneNumber;
}

function time_diff($dt1,$dt2){
     $y1 = substr($dt1,0,4);
     $m1 = substr($dt1,5,2);
     $d1 = substr($dt1,8,2);
     $h1 = substr($dt1,11,2);
     $i1 = substr($dt1,14,2);
     $s1 = substr($dt1,17,2);    

     $y2 = substr($dt2,0,4);
     $m2 = substr($dt2,5,2);
     $d2 = substr($dt2,8,2);
     $h2 = substr($dt2,11,2);
     $i2 = substr($dt2,14,2);
     $s2 = substr($dt2,17,2);    

     $r1=date('U',mktime($h1,$i1,$s1,$m1,$d1,$y1));
     $r2=date('U',mktime($h2,$i2,$s2,$m2,$d2,$y2));
     return ($r1-$r2);

 }


mysql_free_result($user);

mysql_free_result($employees);

mysql_free_result($prop);

mysql_free_result($loc_title);
?>
