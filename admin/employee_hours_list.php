<?php require_once('../Connections/security.php'); ?>
<? $horas_total=0;
$horas_finger=0;
$hours_schedule=0;
$tipo=0;
$fix_in;
$fix_out;
$set_start="";
$set_end="";
$t2_start="";
$t2_end="";
$var_over=0;


?>
<?php
mysql_select_db($database_security, $security);
$query_settings = "SELECT * FROM tbl_settings WHERE id = 1";
$settings = mysql_query($query_settings, $security) or die(mysql_error());
$row_settings = mysql_fetch_assoc($settings);
$totalRows_settings = mysql_num_rows($settings);
?>
<?

if  ($_REQUEST['date_start'] <> "") { $set_start= $_REQUEST['date_start'];} else { $set_start = $row_settings['date_start'];}
if  ($_REQUEST['date_end'] <> "") { $set_end = $_REQUEST['date_end'];} else { $set_end = $row_settings['date_end'];}

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

$colname_hours = "-1";
if (isset($_GET['id'])) {
  $colname_hours = $_GET['id'];
}
mysql_select_db($database_security, $security);
$query_hours = sprintf("SELECT hou.*, loc.location FROM tbl_hours hou, locations loc  WHERE hou.users_id = %s AND hou.loc_id = loc.loc_id AND hou.shift_start >='" . $set_start . "' AND hou.shift_start <='" . $set_end . "'  ORDER BY hou.hours_id ASC", GetSQLValueString($colname_hours, "int"));
$hours = mysql_query($query_hours, $security) or die(mysql_error());
$row_hours = mysql_fetch_assoc($hours);
$totalRows_hours = mysql_num_rows($hours);

$colname_schedule = "-1";
if (isset($_GET['id'])) {
  $colname_schedule = $_GET['id'];
}
mysql_select_db($database_security, $security);
$query_schedule = sprintf("SELECT sch.sch_id, sch.sch_date, loc.shift_time, lc.location FROM schedule sch, locations_shifts loc, locations lc WHERE lc.loc_id = loc.loc_id AND loc.shift_id = sch.shift_id AND sch.users_id = %s  AND sch.sch_date >='" . $set_start . "' AND sch.sch_date <='" . $set_end . "'  ORDER BY sch.sch_date DESC", GetSQLValueString($colname_schedule, "int"));
$schedule = mysql_query($query_schedule, $security) or die(mysql_error());
$row_schedule = mysql_fetch_assoc($schedule);
$totalRows_schedule = mysql_num_rows($schedule);

$colname_finger = "-1";
if (isset($_GET['id'])) {
  $colname_finger = $_GET['id'];
}
mysql_select_db($database_security, $security);
$query_finger = sprintf("SELECT sch.sch_date, sch.notes, sch.shift, sch.week, us.users_id, us.id_finger, sch.sch_id, ls.shift_time, loc.location FROM schedule sch, tbl_users us, locations_shifts ls, locations loc WHERE ls.loc_id = loc.loc_id AND sch.users_id = us.users_id AND ls.shift_id= sch.shift_id AND sch.sch_date >='" . $set_start . "' AND sch.sch_date <='" . $set_end . "' AND us.users_id = %s ORDER BY sch.sch_date DESC, SUBSTRING(ls.shift_time,1,2)", GetSQLValueString($colname_finger, "int"));
$finger = mysql_query($query_finger, $security) or die(mysql_error());
$row_finger = mysql_fetch_assoc($finger);
$totalRows_finger = mysql_num_rows($finger);

$colname_finger_records = "-1";
if (isset($row_finger['id_finger'])) {
  $colname_finger_records = $row_finger['id_finger'];
}
mysql_select_db($database_security, $security);
$query_finger_records = sprintf("SELECT fin.*, loc.location  FROM tbl_fingerprint fin, locations loc WHERE fin.id_emp = %s AND fin.id_loc = loc.loc_id " . " AND SUBSTRING(fin.date_finger,1,10) >= '" . $set_start . "' AND SUBSTRING(fin.date_finger,1,10) <= '" . $set_end . "' ORDER BY fin.date_finger DESC", GetSQLValueString($colname_finger_records, "int"));
//echo $query_finger_records;
$finger_records = mysql_query($query_finger_records, $security) or die(mysql_error());
$row_finger_records = mysql_fetch_assoc($finger_records);
$totalRows_finger_records = mysql_num_rows($finger_records);

mysql_select_db($database_security, $security);
$query_other = "SELECT fin.date_finger FROM tbl_fingerprint fin, tbl_users us WHERE fin.id_emp = us.id_finger AND fin.status = 0 AND us.users_id = " . $_GET['id'] . " AND SUBSTRING(fin.date_finger,1,10) >= '" . $set_start . "' AND SUBSTRING(fin.date_finger,1,10) <= '" . $set_end . "' ORDER BY fin.date_finger DESC";
//echo $query_other;
$other = mysql_query($query_other, $security) or die(mysql_error());
$row_other = mysql_fetch_assoc($other);
$totalRows_other = mysql_num_rows($other);
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
      <p class="Titles"><?php echo $row_emp['first_name']; ?> <?php echo $row_emp['last_name']; ?> hours' list</p>
      <?php if ($totalRows_hours > 0) { // Show if recordset not empty ?>
        <table width="740" border="1">
          <tr class="cabecera">
            <td width="140">Shift start</td>
            <td width="131">Shift end</td>
            <td width="51" align="center">Hours</td>
            <td width="93" align="center">Efective Hours</td>
            <td width="137">Location</td>
            <td width="148">Comments</td>
          </tr>
          <?php do { ?>
            <tr>
              <td><?php echo substr($row_hours['shift_start'],0,16); ?></td>
              <td><?php echo substr($row_hours['shift_end'],0,16); ?></td>
              <td align="center"><?php echo round((time_diff($row_hours['shift_end'],$row_hours['shift_start']))/3600,2); $horas_total = $horas_total + $row_hours['hours'];  ?></td>
              <td align="center"><?php echo $row_hours['hours']; ?></td>
              <td><?php echo $row_hours['location']; ?></td>
              <td><?php echo $row_hours['comments']; ?></td>
            </tr>
            <?php } while ($row_hours = mysql_fetch_assoc($hours)); ?>
        </table>
        
<p>Total hour in this period: <?php echo $horas_total;  ?>
<?php } // Show if recordset not empty ?>
  
  
<p class="Titles">Fingerprint machine records compared with schedule records.</p>
<?php if ($totalRows_user > 0) { // Show if recordset not empty ?>
  <table width="835" border="1">
    <tr class="cabecera">
      <td width="139">Schedule date</td>
      <td width="110" align="center">Time shift</td>
      <td width="88" align="center">CHECK-IN</td>
      <td width="91" align="center">CHECK-OUT</td>
      <td width="109" align="center">Hours</td>
      <td width="112">Location</td>
      <td width="140">Notes:</td>
      
    
    <?php do {
		
		//Query to bring start CHECK-IN records from fingerprint machine table
		$query_finger2 = "SELECT fin.id, fin.date_finger, sft.shift_time, fin.status, CONCAT(sch.sch_date,\"" . " " . "\", CONCAT(SUBSTRING(sft.shift_time,1,5))) AS shift_start FROM tbl_fingerprint fin, schedule sch, locations_shifts sft WHERE sft.shift_id = sch.shift_id AND fin.sche_id = sch.sch_id AND fin.status = 1 AND sch.sch_id =" . $row_finger['sch_id'] . " ORDER BY shift_start ASC";
		$finger2 = mysql_query($query_finger2, $security) or die(mysql_error());
		$row_finger2 = mysql_fetch_assoc($finger2);
		$totalRows_finger2 = mysql_num_rows($finger2);		
		
		//Query to bring start CHECK-out records from fingerprint machine table
		$query_finger3 = "SELECT fin.id, fin.date_finger, sft.shift_time, fin.status, CONCAT(sch.sch_date,\"" . " " . "\", CONCAT(SUBSTRING(sft.shift_time,10,5))) AS shift_start FROM tbl_fingerprint fin, schedule sch, locations_shifts sft WHERE sft.shift_id = sch.shift_id AND fin.sche_id = sch.sch_id AND fin.status = 2 AND sch.sch_id =" . $row_finger['sch_id'] . " ORDER BY shift_start ASC";
		//echo $query_finger3 . "<br>";
		$finger3 = mysql_query($query_finger3, $security) or die(mysql_error());
		$row_finger3 = mysql_fetch_assoc($finger3);
		$totalRows_finger3 = mysql_num_rows($finger3);	
		
		
		?>
      <tr <?php
			if ($row_finger['week']%2==0){
			 echo "bgcolor=\"#99FFCC\"";
				}else{
		     echo "bgcolor=\"#FFCCCC\"";
			}
			
			?>>
        <td width="139"><?php echo date_format(date_create($row_finger['sch_date']),'D j \of M Y');
		?><br /> </td>
        <td width="110" align="center"><?php
        
		//Calculate hours scheduled
		//echo "shift time: " . $row_finger['shift_time']; 
		//echo "<br>shift time: " . $row_finger['shift']; 
				 
		 if (is_null($row_finger['shift_time'])) {
			 
		$t_start  =substr($row_finger['shift'], 0,5);
		$t_end = substr($row_finger['shift'], 9,13);
		
			echo $row_finger['shift'];
			 
		 } else {
			 
		$t_start  =substr($row_finger['shift_time'], 0,5);
		$t_end = substr($row_finger['shift_time'], 9,13);
		
		
			echo $row_finger['shift_time']; 
		 }
				
		
		if ($t_start < $t_end) {
				
				$hours_count2= round(time_diff($row_finger['sch_date'] . " " . $t_end . ":00", $row_finger['sch_date'] . " " . $t_start . ":00")/3600,2);
				
				if (substr(round($hours_count2,1), -2) == ".1") { $hours_count2 = round($hours_count2);}
				
			$hours_schedule = $hours_schedule + round($hours_count2,1);

			} else {			
			// set variable to show this check_out is overnight
				$var_over = 1;
			
			$hours_count2= round(time_diff2($row_finger['sch_date'] . " " . $t_end . ":00", $row_finger['sch_date'] . " " . $t_start . ":00")/3600,2);
			
			if (substr(round($hours_count2,1), -2) == ".1") { $hours_count2 = round($hours_count2);}
			
			$hours_schedule = $hours_schedule + round($hours_count2,1);
			
			}	
				
		
		?></td>
        <td width="88" align="center"><?php if ($row_finger2['date_finger'] <> "") { 
							 //pass the fingerprint date time to a variable to handle the rest of the process							
							$check_in = $row_finger2['date_finger'];
							echo substr($check_in,11,5);
							
                            } else { 
							
							
								//if a record wasn't found we look into the fixed times table for a record
								
								$query_fix1 = "SELECT fix.fix_time, fix.fix_id, fix.reason_text, sta.sta_label, adm.first_name, adm.last_name FROM tbl_finger_fix fix, tbl_finger_fix_status sta, tbl_admins adm WHERE fix.fix_admin = adm.users_id AND fix.reason_id = sta.sta_id AND fix.sche_id =" .  $row_finger['sch_id'] . " AND fix.status_id = 1";
								
								$fix1 = mysql_query($query_fix1, $security) or die(mysql_error());
								$row_fix1 = mysql_fetch_assoc($fix1);
								$totalRows_fix1 = mysql_num_rows($fix1);
		
								if ($row_fix1['fix_time'] <> "") { echo "*".$row_fix1['fix_time']  . " <a href=\"fix_detail.php?fix_id=" . $row_fix1['fix_id'] . "\" \"><img src=\"../images/detalle.png\" width=\"16\" height=\"16\" border=\"0\" title=\"" . $row_fix1['sta_label'] . ", " . $row_fix1['first_name'] . " " . $row_fix1['last_name'] . "\" /></a>";
		
							} else { $tipo=1;	$fix_in=$row_fix1['fix_time'];}
							}
                       ?></td><td width="91" align="center"><?php  if ($row_finger3['date_finger'] <> "") {
						   
						   
							$check_out = $row_finger3['date_finger'] . " - " . $row_finger3['id'];
							

							echo substr($check_out,11,5); 
							 } else { 
							 
							 
							 //if a record wasn't found we look into the fixed times table for a record
								
								$query_fix2 = "SELECT fix.fix_time, fix.fix_id, fix.reason_text, sta.sta_label, adm.first_name, adm.last_name FROM tbl_finger_fix fix, tbl_finger_fix_status sta, tbl_admins adm  WHERE  fix.fix_admin = adm.users_id AND fix.reason_id = sta.sta_id AND fix.sche_id =" .  $row_finger['sch_id'] . " AND fix.status_id = 2";
								
		$fix2 = mysql_query($query_fix2, $security) or die(mysql_error());
		$row_fix2 = mysql_fetch_assoc($fix2);
		$totalRows_fix2 = mysql_num_rows($fix2);
		
		if ($row_fix2['fix_time'] <> "") { echo "*".$row_fix2['fix_time'] . " <a href=\"fix_detail.php?fix_id=" . $row_fix2['fix_id'] . "\" \"><img src=\"../images/detalle.png\" width=\"16\" height=\"16\" border=\"0\" title=\"" . $row_fix2['sta_label'] . ", " . $row_fix2['first_name'] . " " . $row_fix2['last_name'] . "\" />";
		
		} else {
							$tipo=2;
							$fix_out=$row_fix2['fix_time'];}			 
							 
							 
							 
							 
							 }
		?> </td>
        <td width="109" align="center"><?php
		//determine how many hours have the employee worked
		
		if (is_null($row_finger['shift_time'])) {
			 
		$t2_start  =substr($row_finger['shift'], 0,5);
		$t2_end = substr($row_finger['shift'], 9,13);
			 
		 } else {
			 
		$t2_start  =substr($row_finger['shift_time'], 0,5);
		$t2_end = substr($row_finger['shift_time'], 9,13);
		
		 }
		
		
		if ($check_in <> "" and $check_out <> "") {
			
			if ($t2_start < $t2_end) {
				
				$hours_count= round(time_diff($row_finger['sch_date'] . " " . $t2_end . ":00", $row_finger['sch_date'] . " " . $t2_start . ":00")/3600,2);
			
			if (substr(round($hours_count,1), -2) == ".1") { $hours_count = round($hours_count);}
			
			$hours_finger = $hours_finger + round($hours_count,1);
			
			echo round($hours_count,1);
			} else {			
				
			$hours_count= round(time_diff2($row_finger['sch_date'] . " " . $t2_end . ":00", $row_finger['sch_date'] . " " . $t2_start . ":00")/3600,2);
			
			if (substr(round($hours_count,1), -2) == ".1") { $hours_count = round($hours_count);}
			
			$hours_finger = $hours_finger + round($hours_count,1);
			echo round($hours_count,1);
			
			}	
		
		} else { 
		
		//try to get the calculate the fixed records

			//if the check in left
			
			
			
			
			if ($row_fix1['fix_time'] <> "" and $check_out <> "") {
				
				$check_in2 = $row_finger['sch_date'] . " " . $row_fix1['fix_time'] . ":00";
			
				if ($row_fix1['fix_time'] < substr($check_out,11,5)) {
				
				$hours_count= round(time_diff($row_finger['sch_date'] . " " . $t2_end . ":00", $check_in2)/3600,2);
			$hours_finger = $hours_finger + $hours_count;
			echo $hours_count; 
			
					} else {			
				
			$hours_count= round(time_diff2($row_finger['sch_date'] . " " . $t2_end . ":00", $row_finger['sch_date'] . " " . $row_fix1['fix_time'] . ":00")/3600,2);
			$hours_finger = $hours_finger + $hours_count;
			echo $hours_count;
			
			
					}		
				
				}
		
		
		// if chec-out left
		if ($row_fix2['fix_time'] <> "" and $check_in <> "") { 		
		$check_out2= $row_finger['sch_date'] . " " . $row_fix2['fix_time'] . ":00";
		
		if ($check_in < $check_out2) {
				
				$hours_count= round(time_diff($check_out2, $row_finger['sch_date'] . " " . $t2_start . ":00")/3600,2);
			$hours_finger = $hours_finger + $hours_count;
			echo $hours_count;
			} else {			
				
			$hours_count= round(time_diff2($check_out2, $row_finger['sch_date'] . " " . $t2_start . ":00")/3600,2);
			$hours_finger = $hours_finger + $hours_count;
			echo $hours_count;
		
			}
		
		}
		
		// if both dates were not found in the fingerprint records try to locate the times in the fixed table.
		
		if ($check_in == "" and $check_out == "" and $row_fix2['fix_time'] <> "" and $row_fix1['fix_time']) { 
		
		
		// if chec-out left
		if ($row_fix2['fix_time'] <> "" and $row_fix1['fix_time'] <> "") { 		
		$check_in2= $row_finger['sch_date'] . " " . $row_fix1['fix_time'] . ":00";
		$check_out2= $row_finger['sch_date'] . " " . $row_fix2['fix_time'] . ":00";
		
		if ($check_in2 < $check_out2) {
				
				$hours_count= round(time_diff($check_out2, $check_in2)/3600,2);
			$hours_finger = $hours_finger + $hours_count;
			echo $hours_count;
			} else {			
				
			$hours_count= round(time_diff2($check_out2, $check_in2)/3600,2);
			$hours_finger = $hours_finger + $hours_count;
			echo $hours_count;
			  }
		   }
		}
		
		// if there is no calculated record show a window with the records on the fingerprint machine at that date that could not matched any schedule time

				
				
				if ($tipo <> 0) { 
				
				
		echo "<a href=\"#\" onClick=\"MyWindow=window.open('fingerprint_errors.php?id=" .  $row_finger['users_id'] . "&amp;dat=" . $row_finger['sch_date'] . "&amp;tipo=" . $tipo . "&amp;sch=" . $row_finger['sch_id'] . "','MyWindow',width=300,height=250); return true;\">Check manually</a>";
				}
		
		}		
		?></td>
        <td width="112"><?php
		echo $row_finger['location'];		
		?></td>
        <td width="140"><?php
		echo $row_fix1['reason_text'] . " ";
		echo $row_fix2['reason_text'];
		?><?php
		
		///////////////////////     notas de que estaba haciendo
		echo $row_finger['notes'];		
		?></td>
      </tr>
      <?php
	  		//unset variables
		unset($check_in);
		unset($check_out);
		unset($row_finger2);
		unset($row_finger3);
		unset($row_fix1);
		unset($row_fix2);
		$tipo=0;	  
	  
	  } while ($row_finger = mysql_fetch_assoc($finger)); ?>
  </table>
  <center>
    <br />
    <table width="557" border="1">
      <tr>
        <td width="272" align="center">Total hours from schedule:<br />
          <?php echo "<b><font size=\"10\">" . round($hours_schedule,1) . "</font></b>"; ?></td>
        <td width="269" align="center">Total hours from fingerprint process<br /><?php echo "<b><font size=\"10\">" . round($hours_finger,1) . "</font></b>"; ?></td>
      </tr>
    </table></center>
  <?php } // Show if recordset not empty 
  ?>
  <?php if ($totalRows_other > 0) { // Show if recordset not empty ?>
  <p class="Titles">Orphan records at fingerprint machine</p>
    <table width="287" border="1">
      <?php do { ?>
        <tr>
          <td width="277" align="center"><?php echo $row_other['date_finger']; ?></td>
        </tr>
        <?php } while ($row_other = mysql_fetch_assoc($other)); ?>
    </table>
    <?php } // Show if recordset not empty ?>
    <?php if ($totalRows_finger_records > 0) { // Show if recordset not empty ?>
  <p class="Titles">Fingerprint raw records</p>
  <table width="600" border="1">
    <tr class="cabecera">
      <td>Machine location</td>
      <td>Names (at machine)</td>
      <td align="center">Id emp.</td>
      <td>Time stamp</td>
    </tr>
    <?php do { ?>
      <tr>
        <td><?php echo $row_finger_records['location']; ?></td>
        <td><?php echo $row_finger_records['names']; ?></td>
        <td align="center"><?php echo $row_finger_records['id_emp']; ?></td>
        <td><?php echo $row_finger_records['date_finger']; ?></td>
      </tr>
      <?php } while ($row_finger_records = mysql_fetch_assoc($finger_records)); ?>
  </table>
  <?php } // Show if recordset not empty ?>
<p>&nbsp;</p>
<p>&nbsp;</p>
    <!-- InstanceEndEditable --></td>
  </tr>
</table>
<table width="300" border="0" align="right">
  <tr>
    <td align="right">User: <?php echo $row_user['first_name']; ?> <?php echo $row_user['last_name']; ?></td>
  </tr>
</table>
</body>
<!-- InstanceEnd --></html>
<?php function time_diff($dt1,$dt2){
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
 
 function time_diff2($dt1,$dt2){
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

     $r1=date('U',mktime($h1,$i1,$s1,$m1,$d1 +1,$y1));
     $r2=date('U',mktime($h2,$i2,$s2,$m2,$d2,$y2));
     return ($r1-$r2);

 }
 
mysql_free_result($user);

mysql_free_result($emp);

mysql_free_result($hours);

mysql_free_result($schedule);

mysql_free_result($finger);

mysql_free_result($settings);

mysql_free_result($finger_records);

mysql_free_result($other);
?>