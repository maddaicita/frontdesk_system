<?php include('../Connections/security.php');
$usuario="";
?>
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
if (isset($_GET['id'])) {
  $colname_emp = $_GET['id'];
}
mysql_select_db($database_security, $security);
$query_emp = sprintf("SELECT users_id, last_name, first_name FROM tbl_users WHERE users_id = %s", GetSQLValueString($colname_emp, "int"));
$emp = mysql_query($query_emp, $security) or die(mysql_error());
$row_emp = mysql_fetch_assoc($emp);
$totalRows_emp = mysql_num_rows($emp);

$colname_schedule = "-1";
if (isset($_GET['week'])) {
  $colname_schedule = $_GET['week'] + 1;
}
$colname2_schedule = "-1";
if (isset($_GET['id'])) {
  $colname2_schedule = $_GET['id'];
}
mysql_select_db($database_security, $security);
$query_schedule = sprintf("SELECT sch.users_id, sch.shift_id, sch.shift, sch.sch_date, sch.week, sft.shift_time, loc.location FROM schedule sch, locations_shifts sft, locations loc WHERE sft.loc_id = loc.loc_id AND sch.shift_id = sft.shift_id AND sch.week = %s AND sch.users_id = %s ORDER BY sch.sch_date DESC", GetSQLValueString($colname_schedule, "int"),GetSQLValueString($colname2_schedule, "int"));
//echo $query_schedule;
$schedule = mysql_query($query_schedule, $security) or die(mysql_error());
$row_schedule = mysql_fetch_assoc($schedule);
$totalRows_schedule = mysql_num_rows($schedule);
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
      <p class="Titles">Duplicate las scheduled week.</p>
      <p class="caja_grande"><?php echo $row_emp['last_name']; ?>, <?php echo $row_emp['first_name']; ?></p>
      <?php if ($totalRows_schedule == 0) { // Show if recordset empty ?>
  <p>Something gone wrong, please repeat your search.</p>
  <?php } // Show if recordset empty ?>
      <?php if ($totalRows_schedule > 0) { // Show if recordset not empty ?>
        <table width="725" border="1">
          <tr class="cabecera">
            <td width="185">Original date</td>
            <td width="180">New date</td>
            <td width="128">Time shift</td>
            <td width="204">Location</td>
          </tr>
          <?php do { ?>
            <tr>
              <td class="standar"><?php echo date_format(date_create($row_schedule['sch_date']),'D j \of M Y'); ?></td>
              <td class="standar"><?php
			  $date = $row_schedule['sch_date'];// current date

$date = strtotime(date("Y-m-d", strtotime($date)) . " +7 day");
echo date('D j \of M Y',$date);
?></td>
              <td><?php echo $row_schedule['shift']; ?></td>
              <td><?php echo $row_schedule['location']; ?></td>
            </tr><?php
					// record the new shedule shift
					
					
			 $insertSQL = "INSERT INTO schedule (users_id, shift_id, shift, sch_date, week, shc_set, admin_id) VALUES (" . $row_schedule['users_id'].", ". $row_schedule['shift_id']. ", '" . $row_schedule['shift'] ."', '". date('Y-m-d',$date) ."', ". date('W',$date).", '". date("Y-m-d G:i:s")."', ". $row_user['users_id'] . ")";
			//echo $insertSQL . "<br>";
			mysql_select_db($database_security, $security);
            $Result1 = mysql_query($insertSQL, $security) or die(mysql_error());																						
			unset($date);
			$usuario=$row_schedule['users_id'];
			?>
            <?php } while ($row_schedule = mysql_fetch_assoc($schedule)); ?>
        </table>
        <br />
        
       </p>
       <a href="employee_schedule.php?users_id=<?php echo $usuario; ?>">Back to the schedule</a>
       
       
        <?php } // Show if recordset not empty ?>
<p>&nbsp;</p>
      <p>&nbsp;</p>
      <p><?php
	  

?> 
	  
	  </p>
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
<?php function nextday($d){
	
 $d->modify( 'next Wednesday' );

//$d->modify( 'first day of +1 week' );
 echo $d->format( 'Y-m-d' ), "\n";
}

mysql_free_result($user);

mysql_free_result($emp);

mysql_free_result($schedule);
?>
