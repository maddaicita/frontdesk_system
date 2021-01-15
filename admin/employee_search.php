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

$colname_emp = "-1";
if (isset($_POST['txt_lastname'])) {
  $colname_emp = $_POST['txt_lastname'];
}
mysql_select_db($database_security, $security);
$query_emp = sprintf("SELECT users_id, last_name, middle_name, first_name, email, cellphone, license_class, license_number, exp_license, user_enabled FROM tbl_users WHERE last_name LIKE %s ORDER BY last_name ASC", GetSQLValueString("%" . $colname_emp . "%", "text"));
$emp = mysql_query($query_emp, $security) or die(mysql_error());
$row_emp = mysql_fetch_assoc($emp);
$totalRows_emp = mysql_num_rows($emp);
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
    <style type="text/css">
        input:focus {
            background-color: #FF6;
        }
    </style>
      <p class="Titles">Employee search:</p>
      <form id="form1" name="form1" method="post" action="">
        <table width="412" border="1">
          <tr>
            <td class="cabecera">Last name or part</td>
            <td align="left"><label>
              <input type="text" name="txt_lastname" id="txt_lastname" />
            </label></td>
            <td><label>
              <input type="submit" name="button" id="button" value="Submit" />
            </label></td>
          </tr>
        </table>
      </form>
      <br />
      <?php if ($totalRows_emp > 0) { // Show if recordset not empty ?>
  <table width="976" border="1">
    <tr class="cabecera">
      <td width="105">Last name</td>
      <td width="127">Names</td>
      <td width="76">E-mail</td>
      <td width="122">Phone</td>
      <td width="138" align="center">License #</td>
      <td width="118">Exp.date</td>
      <td width="48">Task</td>
      <td width="48">Details</td>
      <td width="48">Schedule</td>
      <td width="48">Hours</td>
      <td width="28">IDs</td>
    </tr>
    <?php do { ?>
      <tr>
        <td><?php echo $row_emp['last_name']; ?></td>
        <td><?php echo $row_emp['first_name']; ?> <?php echo $row_emp['middle_name']; ?></td>
        <td align="center"><?php if (strlen($row_emp['email']) <> 0) { echo "<a href=\"mailto:" . $row_emp['email'] . "\"><img src=\"../images/email.jpg\" width=\"35\" height=\"35\" border=\"0\" /></a>";} ?></td>
        <td><?php echo formatPhoneNumber($row_emp['cellphone']); ?></td>
        <td align="center"><?php if ($row_emp['license_number'] <> "") { echo $row_emp['license_class'];} ?><?php echo $row_emp['license_number']; ?></td>
        <td align="center" <?php if (time_diff($row_emp['exp_license'] . " 00:00:00",date('Y-m-d') . " 00:00:00")/86400 < 60) { echo "bgcolor=\"#FF0000\"";} ?> ><?php echo date("m/d/Y", strtotime($row_emp['exp_license'])); ?></td>
        <td align="center"><a href="task_scheduler.php?id=<?php echo $row_emp['users_id']; ?>"><img src="../images/task.jpg" width="35" height="35" border="0" /></a></td>
        <td align="center"><a href="<?php 
		
		if ($row_emp['user_enabled'] == 1)  { echo "details.php";} else { echo "details_non.php";}
		
		?>?id=<?php echo $row_emp['users_id']; ?>"><img src="../images/detalle.png" width="16" height="16" border="0" /></a></td>
        <td align="center"><?php 
		
		if ($row_emp['user_enabled'] == 1) {
			
			echo "<a href=\"employee_schedule.php?users_id=" . $row_emp['users_id'] . "\" ><img src=\"../images/calendar.jpg\" width=\"35\" height=\"35\" border=\"0\" /></a>";
			
		}
		 ?></td>
        <td align="center"><?php 
		
		if ($row_emp['user_enabled'] == 1) {
			
			echo "<a href=\"employee_hours.php?id=" . $row_emp['users_id'] . "\" ><img src=\"../images/clock.png\" width=\"35\" height=\"36\" border=\"0\" /></a>";
			
		} 
		 ?></td>
        <td align="center"><?php 
		
		if ($row_emp['user_enabled'] == 1) {
			
			echo "<a href=\"id_add_ok.php?id=" . $row_emp['users_id'] . "\">IDs</a>";
			
		} 		
		 ?></td>
      </tr>
      <?php } while ($row_emp = mysql_fetch_assoc($emp)); ?>
  </table>
  <?php } // Show if recordset not empty ?>
<p>&nbsp;</p>
      <p>&nbsp;</p><script type="text/javascript" language="JavaScript">
 document.forms['form1'].elements['txt_lastname'].focus();
 </script>
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

mysql_free_result($emp);
?>
