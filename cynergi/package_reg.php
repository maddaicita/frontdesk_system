<?php require_once('../Connections/dplace.php'); ?>
<?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
	
  $logoutGoTo = "../emp_login.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
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

$MM_restrictGoTo = "../emp_login.php";
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
	
	$fecha_in = date('Y-m-d H:i:s', strtotime(str_replace('-', '/', $_POST['txt_date'] . " " . $_POST['txt_hour'] . ":" . $_POST['txt_minute'] . ":00")));
	
  $insertSQL = sprintf("INSERT INTO tbl_packages (pkg_label, id_tennant, pkg_type, pkg_condition, pkg_perishable, pkg_date_in, pkg_comments, pkg_user, pkg_record) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['txt_label'], "text"),
					   GetSQLValueString($_POST['hidden_tennant'], "int"),
                       GetSQLValueString($_POST['select_package'], "int"),
                       GetSQLValueString($_POST['select_condition'], "int"),
                       GetSQLValueString($_POST['select_perishable'], "int"),
                       GetSQLValueString($fecha_in, "date"),
                       GetSQLValueString($_POST['txt_comments'], "text"),
                       GetSQLValueString($_POST['hidden_user'], "int"),
                       GetSQLValueString($_POST['hidden_record'], "date"));

  mysql_select_db($database_dplace, $dplace);
  $Result1 = mysql_query($insertSQL, $dplace) or die(mysql_error());

  $insertGoTo = "package_notify.php?id=" . $row_tenant['id_tennant'] . "&pkg_id=" . $_POST['txt_label'] . "";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

$colname_tenant = "-1";
if (isset($_GET['id'])) {
  $colname_tenant = $_GET['id'];
}
mysql_select_db($database_dplace, $dplace);
$query_tenant = sprintf("SELECT * FROM tbl_tennants WHERE id_tennant = %s ORDER BY `names` ASC", GetSQLValueString($colname_tenant, "int"));
$tenant = mysql_query($query_tenant, $dplace) or die(mysql_error());
$row_tenant = mysql_fetch_assoc($tenant);
$totalRows_tenant = mysql_num_rows($tenant);

$colname_usuario = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_usuario = $_SESSION['MM_Username'];
}
mysql_select_db($database_dplace, $dplace);
$query_usuario = sprintf("SELECT * FROM tbl_users WHERE username = %s", GetSQLValueString($colname_usuario, "text"));
$usuario = mysql_query($query_usuario, $dplace) or die(mysql_error());
$row_usuario = mysql_fetch_assoc($usuario);
$totalRows_usuario = mysql_num_rows($usuario);

mysql_select_db($database_dplace, $dplace);
$query_condit = "SELECT * FROM tbl_condition";
$condit = mysql_query($query_condit, $dplace) or die(mysql_error());
$row_condit = mysql_fetch_assoc($condit);
$totalRows_condit = mysql_num_rows($condit);

mysql_select_db($database_dplace, $dplace);
$query_packtype = "SELECT * FROM tbl_package_type ORDER BY type_id ASC";
$packtype = mysql_query($query_packtype, $dplace) or die(mysql_error());
$row_packtype = mysql_fetch_assoc($packtype);
$totalRows_packtype = mysql_num_rows($packtype);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/employees.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>All American Security Services</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable --><script type="text/javascript" src="stmenu.js"></script>
<link href="../css/styles.css" rel="stylesheet" type="text/css" />
</head>

<body onload="setFocus();">
<br />
<table width="600" border="0" align="center">
  <tr>
    <td align="center"><script type="text/javascript" src="menu.js"></script></td>
  </tr>
</table>
<table width="600" border="0" align="center">
  <tr>
    <td height="466" align="center" valign="top"><!-- InstanceBeginEditable name="content" -->
      <p class="Titles">Package registration for unit# <?php echo $row_tenant['apt']; ?></p>
      <p class="Titles">For: <?php echo $row_tenant['names']; ?><a href="package_list_ten.php?ten=<?php echo $row_tenant['id_tennant']; ?>"></a></p>
      <form id="form1" name="form1" method="POST" action="<?php echo $editFormAction; ?>">
        <table width="424" border="1">
          <tr>
            <td align="left" class="cabecera"><input name="hidden_tenant" type="hidden" id="hidden_tenant" value="<?php echo $row_tenant['id_tennant']; ?>" />
              Pack. label<br />
              Scan code:</td>
            <td align="left"><label>
              <input name="txt_label" type="text" class="caja_grande" id="txt_label" size="40" />
            </label></td>
          </tr>
          <tr>
            <td width="140" align="left" class="cabecera">Package type:</td>
            <td width="268" align="left"><select name="select_package" class="caja_grande" id="select_package">
              <?php
do {  
?>
              <option value="<?php echo $row_packtype['type_id']?>"><?php echo $row_packtype['type_desc']?></option>
              <?php
} while ($row_packtype = mysql_fetch_assoc($packtype));
  $rows = mysql_num_rows($packtype);
  if($rows > 0) {
      mysql_data_seek($packtype, 0);
	  $row_packtype = mysql_fetch_assoc($packtype);
  }
?>
            </select></td>
          </tr>
          <tr>
            <td align="left" class="cabecera">Condition:</td>
            <td align="left"><label>
              <select name="select_condition" class="caja_grande" id="select_condition">
                <?php
do {  
?>
                <option value="<?php echo $row_condit['con_id']?>"><?php echo $row_condit['con_description']?></option>
                <?php
} while ($row_condit = mysql_fetch_assoc($condit));
  $rows = mysql_num_rows($condit);
  if($rows > 0) {
      mysql_data_seek($condit, 0);
	  $row_condit = mysql_fetch_assoc($condit);
  }
?>
              </select>
            </label></td>
          </tr>
          <tr>
            <td align="left" class="cabecera">Perishable:</td>
            <td align="left"><label>
              <select name="select_perishable" class="caja_grande" id="select_perishable">
                <option value="No" selected="selected">No</option>
                <option value="Yes">Yes</option>
              </select>
            </label></td>
          </tr>
          <tr>
            <td align="left" class="cabecera">Date arrival *:</td>
            <td align="left"><label>
              <input name="txt_date" type="text" disabled="disabled" class="caja_grande" id="txt_date" size="12" maxlength="10" value="<?php echo date("m/d/Y"); ?>" />
            </label></td>
          </tr>
          <tr>
            <td align="left" class="cabecera">Time arrival *:</td>
            <td align="left"><label>
              <span class="caja_grande">
<input name="txt_hour" type="text" class="caja_grande" id="txt_hour" size="3" maxlength="2" value="<?php echo date("H"); ?>" />
:</span>
              <input name="txt_minute" type="text" class="caja_grande" id="txt_minute" size="4" maxlength="2" value="<?php echo date("i"); ?>" />
            </label></td>
          </tr>
          <tr>
            <td align="left" class="cabecera">Comments:</td>
            <td align="left"><label>
              <textarea name="txt_comments" id="txt_comments" cols="45" rows="5"></textarea>
            </label></td>
          </tr>
          <tr>
            <td height="63" align="left" class="cabecera"><input name="hidden_user" type="hidden" id="hidden_user" value="<?php echo $row_usuario['id_user']; ?>" />
            <input type="hidden" name="hidden_record" id="hidden_record" value="<?php echo date("Y-m-d H:i:s"); ?>" />
            <input name="hidden_tennant" type="hidden" id="hidden_tennant" value="<?php echo $row_tenant['id_tennant']; ?>" /></td>
            <td align="left"><label>
              <input name="button" type="submit" class="caja_grande" id="button" value="   Submit   " />
            <?php
			//echo date_format("10/03/2014" . " " . "12" . ":" . "31" . ":00", 'Y-m-d H:i:s') ;
			
			?></label></td>
          </tr>

<script type="text/javascript">
<!--
var formObj = document.getElementById('form1');
var inputArr = formObj.getElementsByTagName("input");
for (i=0; i<inputArr.length-1; i++)
{
inputArr[i].onfocus = function()
{
this.style.backgroundColor = "yellow";
};

inputArr[i].onblur = function()
{
this.style.backgroundColor = "";
};
}

-->
</script>
<script type="text/javascript">
function setFocus(){
document.getElementById("txt_label").focus();
}
</script>


        </table>
        <input type="hidden" name="MM_insert" value="form1" />
      </form>
      <p>&nbsp; </p>
    <!-- InstanceEndEditable --></td>
  </tr>
</table>
<br />
<table width="600" border="0" align="right">
  <tr>
    <td align="right"><p>You are logged as <strong><?php echo $row_usuario['first_name']; ?></strong> <strong><?php echo $row_usuario['last_name']; ?><br />
      <a href="<?php echo $logoutAction ?>">Log out</a></strong></p></td>
  </tr>
</table>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($tenant);

mysql_free_result($usuario);

mysql_free_result($condit);

mysql_free_result($packtype);
?>
