<?php require_once('Connections/security.php'); ?>
<?php 
if (!isset($_SESSION)) {
  session_start();
}
$fecha= $_SESSION['fecha'];
$resultado="";
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
  
  if ($fecha == $_POST['select']) {
  
  $updateSQL = sprintf("UPDATE tbl_users SET email=%s, username=%s, password=%s, user_enabled=1 WHERE users_id=%s",
                       GetSQLValueString($_SESSION['email'], "text"),
					   GetSQLValueString($_POST['hidden_username'], "text"),
                       GetSQLValueString($_POST['hidden_password'], "text"),
					   GetSQLValueString("1", "int"),
                       GetSQLValueString($_POST['hidden_id'], "int"));
  				$resultado="1";
				//echo $updateSQL;
  } else  {
	   $updateSQL = sprintf("UPDATE tbl_users SET locked=%s WHERE users_id=%s",
                       GetSQLValueString("1", "int"),
                       GetSQLValueString($_POST['hidden_id'], "int"));
	   			$resultado="2";
				//echo $fecha . " = " . $_POST['select'];
  }

  mysql_select_db($database_security, $security);
  $Result1 = mysql_query($updateSQL, $security) or die(mysql_error());

  $updateGoTo = "create_ok.php?res=" . $resultado;
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_emp_id = "-1";
if (isset($_SESSION['id'])) {
  $colname_emp_id = $_SESSION['id'];
}
mysql_select_db($database_security, $security);
$query_emp_id = sprintf("SELECT users_id, date_hired FROM tbl_users WHERE users_id = %s", GetSQLValueString($colname_emp_id, "int"));
$emp_id = mysql_query($query_emp_id, $security) or die(mysql_error());
$row_emp_id = mysql_fetch_assoc($emp_id);
$totalRows_emp_id = mysql_num_rows($emp_id);
?>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<table width="600" border="1" align="center">
  <tr>
    <td height="492" align="center" valign="top"><p>&nbsp;</p>
    <p class="Titles">Just to be sure. When, aproximately, did we hire you?</p>
    <p>Please check and option and clik the button.</p>
    <p>You got just one chance to pick a date. If it fails you must go to the <br />
      office to help to create your account.</p>
    <form id="form1" name="form1" method="POST" action="<?php echo $editFormAction; ?>">
      <table width="400" border="0">
        <tr>
          <td align="center"><label>
            <select name="select" class="caja_grande" id="select">
              <option value="<?php echo add_date($row_emp_id['date_hired'],+3,6,+0); ?>"><?php echo add_date($row_emp_id['date_hired'],+3,6,+0); ?></option>
              <option value="<?php
			  //show and set the date to compare to update
			  echo date("m/d/Y", strtotime($row_emp_id['date_hired']));
			  $fecha = date("m/d/Y", strtotime($row_emp_id['date_hired']));
			  
			  ?>"><?php echo date("m/d/Y", strtotime($row_emp_id['date_hired'])); ?></option>
              <option value="<?php echo sub_date($row_emp_id['date_hired'],-6,-8,-1); ?>"><?php echo add_date($row_emp_id['date_hired'],-6,-8,-1); ?></option>
               <option value="<?php echo sub_date($row_emp_id['date_hired'],-2,-8,-2); ?>"><?php echo add_date($row_emp_id['date_hired'],-2,-8,-1); ?></option>
            </select>
          </label></td>
        </tr>
        <tr>
          <td align="center"><p>&nbsp;
            </p>
            <p>
              <input name="hidden_id" type="hidden" id="hidden_id" value="<?php echo $row_emp_id['users_id']; ?>" />
              <input type="hidden" name="hidden_username" id="hidden_username" value="<?php echo $_SESSION['username']; ?>" />
              <input type="hidden" name="hidden_password" id="hidden_password" value="<?php echo md5($_SESSION['password']); ?>" />
              <input type="hidden" name="hidden_email" id="hidden_email" value="<?php echo $_SESSION['email']; ?>" />
            </p>
            <p></p>
            <p>
              <label>
                <input type="submit" name="button" id="button" value="Submit" />
              </label>
            </p></td>
        </tr>
      </table>
      <input type="hidden" name="MM_update" value="form1" />
    </form>
    <p>&nbsp;</p></td>
  </tr>
</table>
<?php function add_date($orgDate,$mth,$dth,$yth){ 
   $cd = strtotime($orgDate); 
   $retDAY = date('m/d/Y', mktime(0,0,0,date('m',$cd)+$mth,date('d',$cd)+$dth,date('Y',$cd)+$yth)); 
   return $retDAY; 
 } 
 function sub_date($orgDate,$mth,$dth,$yth){ 
   $cd = strtotime($orgDate); 
   $retDAY = date('m/d/Y', mktime(0,0,0,date('m',$cd)-$mth,date('d',$cd)-$dth,date('Y',$cd)-$yth)); 
   return $retDAY; 
 } 
mysql_free_result($emp_id);
?>
