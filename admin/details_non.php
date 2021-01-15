<?php require_once('../Connections/security.php'); ?>
<?php include('../Connections/security.php');
include('seg.php'); ?>
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

$colname_details = "-1";
if (isset($_GET['id'])) {
  $colname_details = $_GET['id'];
}
mysql_select_db($database_security, $security);
$query_details = sprintf("SELECT us.*, loc.location, pos.position, ad.first_name AS ad_first, ad.last_name AS ad_last, cit.city, stu.label FROM tbl_users us, locations loc, positions pos, tbl_admins ad, tbl_cities cit, tbl_license_status stu  WHERE us.city = cit.city_id AND us.user_admin = ad.users_id AND us.users_id = %s AND us.loc_id=loc.loc_id AND us.position=pos.position_id AND us.license_status=stu.id", GetSQLValueString($colname_details, "int"));
$details = mysql_query($query_details, $security) or die(mysql_error());
$row_details = mysql_fetch_assoc($details);
$totalRows_details = mysql_num_rows($details);

$colname_hire_history = "-1";
if (isset($_GET['id'])) {
  $colname_hire_history = $_GET['id'];
}
mysql_select_db($database_security, $security);
$query_hire_history = sprintf("SELECT sta.*, adm.first_name, adm.last_name  FROM tbl_hire_status sta, tbl_admins adm WHERE sta.users_id = %s AND sta.admin_id = adm.users_id  ORDER BY sta.hire_status_id DESC", GetSQLValueString($colname_hire_history, "int"));
$hire_history = mysql_query($query_hire_history, $security) or die(mysql_error());
$row_hire_history = mysql_fetch_assoc($hire_history);
$totalRows_hire_history = mysql_num_rows($hire_history);
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
      <p><span class="Titles">Non employee record details</span><br />
      </p>
      <table width="629" border="1">
        <tr>
          <td width="88" rowspan="5" align="left">&nbsp;</td>
          <td width="140" align="left" class="cabecera">Names:</td>
          <td colspan="4" align="left"><?php echo $row_details['last_name']; ?>, <?php echo $row_details['first_name']; ?> <?php echo $row_details['middle_name']; ?></td>
        </tr>
        <tr>
          <td align="left" class="cabecera">Phone numbers: </td>
          <td colspan="4" align="left"><?php echo formatPhoneNumber($row_details['cellphone']); ?> <?php if($row_details['homephone'] <>"") { echo " - " . formatPhoneNumber($row_details['homephone']); } ?></td>
        </tr>
        <tr>
          <td align="left" class="cabecera">E-mail:</td>
          <td colspan="4" align="left"><a href="mailto:<?php echo $row_details['email']; ?>"><?php echo $row_details['email']; ?></a></td>
        </tr>
        <tr>
          <td height="23" align="left" class="cabecera">SSN# </td>
          <td height="23" colspan="4" align="left" <?php
		  			$ssn_number = str_replace("-","",$row_details['ssn']);
					$ssn_number2 = preg_replace('/^([\d]{3})([\d]{2})([\d]{4})/', '\1-\2-\3', $ssn_number);
					if (strlen($ssn_number2) < 11) { echo "bgcolor=red";}
		  ?> ><?php 
			if (strlen($row_details['ssn2'])>0) {
	   			echo substr(des($row_details['ssn2']),0,11);
	  			} else {echo $row_details['ssn'];}
			?></td>
        </tr>
        <tr>
          <td align="left" class="cabecera">Address:</td>
          <td colspan="4" align="left"><?php echo $row_details['address']; ?>, <?php echo $row_details['city']; ?>, <?php echo $row_details['state']; ?> <?php echo $row_details['zipcode']; ?></td>
        </tr>
        <tr>
          <td align="left" class="cabecera">Last Position:</td>
          <td align="left"><?php echo $row_details['position']; ?></td>
          <td width="125" align="left" class="cabecera">Last Place of work:</td>
          <td colspan="3" align="center"><?php echo $row_details['location']; ?></td>
        </tr>
        <tr>
          <td align="left" class="cabecera">License #</td>
          <td align="left" <?php
		   if ($row_details['license_training'] == 1) { echo "bgcolor=\"#FFFF33\"";} else { echo "bgcolor=\"#00FF00\"";} ?>><?php
		  
		  if ($row_details['license_training'] == 1) { echo "Acknowledgment Card";} else { echo $row_details['license_class'] . $row_details['license_number']; }		  
		  ?></td>
          <td align="left" class="cabecera">Expiration date:</td>
          <td width="100" align="center" <?php if (time_diff($row_details['exp_license'] . " 00:00:00",date('Y-m-d') . " 00:00:00")/86400 < 60) { echo "bgcolor=\"#FF0000\"";} ?> ><?php 
		  if ($row_details['exp_license'] <> "")
		  echo date("m/d/Y", strtotime($row_details['exp_license']));   
		  
		  ?></td>
          <td width="71" colspan="2" align="center" <?php if (time_diff($row_details['exp_license'] . " 00:00:00",date('Y-m-d') . " 00:00:00")/86400 < 60) { echo "bgcolor=\"#FF0000\"";} ?> ><?php echo $row_details['label']; ?></td>
        </tr>
        <tr>
          <td align="left" class="cabecera">Last date hired:</td>
          <td align="left"><?php echo date("m/d/Y", strtotime($row_details['date_hired'])); ?></td>
          <td align="left" class="cabecera">Last update / By</td>
          <td colspan="2" align="center"><?php echo date('m/d/Y',strtotime(substr($row_details['last_update'],0,10))) . " " .substr($row_details['last_update'],11,5) . "<br>" .  $row_details['ad_first'] . " " . $row_details['ad_last'] ; ?></td>
          <td width="65" align="center"><a href="employee_edit.php?id=<?php echo $row_details['users_id']; ?>">Edit</a></td>
        </tr>
        <tr>
          <td height="29" align="center" class="cabecera">Comments:</td>
          <td colspan="4" align="center"><?php echo $row_details['comments']; ?></td>
          <td align="center"><a href="employee_rehire.php?users_id=<?php echo $row_details['users_id']; ?>">Re-hire</a></td>
        </tr>
      </table>
      <br />
      <?php if ($totalRows_hire_history > 0) { // Show if recordset not empty ?>
  <table width="296" border="0">
    <tr>
      <td align="center" class="today">Hire, fire or quit history</td>
      </tr>
  </table>
        <br />
        <table width="699" border="1">
          <tr class="cabecera">
            <td width="127">Status</td>
            <td width="174">Date</td>
            <td width="247">Comments</td>
            <td width="123">Admin</td>
          </tr>
          <?php do { ?>
            <tr>
              <td><?php echo $row_hire_history['label_status']; ?></td>
              <td><?php echo $row_hire_history['date_status']; ?></td>
              <td><?php echo $row_hire_history['comments']; ?></td>
              <td><?php echo $row_hire_history['first_name']; ?>&nbsp;<?php echo $row_hire_history['last_name']; ?></td>
            </tr>
            <?php } while ($row_hire_history = mysql_fetch_assoc($hire_history)); ?>
        </table>
        <?php } // Show if recordset not empty ?>
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

mysql_free_result($details);

mysql_free_result($hire_history);
?>
