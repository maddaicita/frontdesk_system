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

$usuario = $row_user['users_id'];

mysql_select_db($database_security, $security);
$query_loc = "SELECT * FROM locations ORDER BY location ASC";
$loc = mysql_query($query_loc, $security) or die(mysql_error());
$row_loc = mysql_fetch_assoc($loc);
$totalRows_loc = mysql_num_rows($loc);
  

//connect to the database 
$connect = mysql_connect("localhost","allameri_logan","Targus25"); 
//$connect = mysql_connect("localhost","root","targus25"); 
mysql_select_db("allameri",$connect); //select the table 
// 

if ($_FILES[csv][size] > 0) { 

    //get the csv file 
    $file = $_FILES[csv][tmp_name]; 
    $handle = fopen($file,"r"); 
     
    //loop through the csv file and insert into database 
    do { 
        if ($data[0]) { 
            mysql_query("INSERT INTO tbl_fingerprint (id_loc, names, id_emp, date_finger, date_import, user_id) VALUES 
                ( 
                    '".$_POST['select_location']. "', 
                    '".addslashes($data[1])."', 
					'".addslashes($data[2])."',
					'".addslashes($data[3])."',
					'". date("Y-m-d") ."',
                    '". $usuario ."' 
                ) 
            ");
        } 
    } while ($data = fgetcsv($handle,1000,",","'")); 
    // 

    //redirect 
    header('Location: import_fingerprint_post.php'); die; 

} 

?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/adminpages.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head><script type="text/javascript" src="stmenu.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Import from fingerprint devices - All American</title> 
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
    <td height="568" align="center" valign="top"><!-- InstanceBeginEditable name="Content" --><span class="Titles"> Import data from Fingerprint devices. </span></p>
<table width="400" border="0">
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
  <table width="524" border="1" align="center">
  <tr>
    <td width="256" align="left">Please select the location:</td>
    <td width="256" align="left"><label>
      <select name="select_location" id="select_location">
        <?php
do {  
?>
        <option value="<?php echo $row_loc['loc_id']?>"><?php echo $row_loc['location']?></option>
        <?php
} while ($row_loc = mysql_fetch_assoc($loc));
  $rows = mysql_num_rows($loc);
  if($rows > 0) {
      mysql_data_seek($loc, 0);
	  $row_loc = mysql_fetch_assoc($loc);
  }
?>
      </select>
    </label></td>
  </tr>
  <tr>
    <td align="left">Choose your file: </td>
    <td align="left"><input name="csv" type="file" id="csv" /></td>
  </tr>
  <tr>
    <td align="left">&nbsp;</td>
    <td align="left"><input type="submit" name="Submit" value="Submit" /></td>
  </tr>
</table>

  <p>
    <?php if (!empty($_GET[success])) { echo "<b>Your file has been imported. You can leave this page now.</b><br><br>"; } //generic success notice ?>
  </p>
  <p><br />
  </p>
</form> 

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
mysql_free_result($loc);
?>
