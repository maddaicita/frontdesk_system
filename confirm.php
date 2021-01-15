<?php require_once('Connections/security.php');
if (!isset($_SESSION)) {
  session_start();
}
?>
<?php 	  
	  //declare session variable to work with
	  
	   $_SESSION['ssn'] = $_REQUEST['txt_ssn'];
	   $_SESSION['email'] = $_REQUEST['txt_email'];
	   $_SESSION['username'] = $_REQUEST['txt_username'];
	   $_SESSION['password'] = $_REQUEST['txt_password'];
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

$colname_emp = "-1";
if (isset($_SESSION['ssn'])) {
  $colname_emp = $_SESSION['ssn'];
}
mysql_select_db($database_security, $security);
$query_emp = sprintf("SELECT users_id, locked, last_name, middle_name, first_name, ssn, address, city, `state`, zipcode, cellphone, date_hired, user_enabled FROM tbl_users WHERE ssn = %s", GetSQLValueString(md5($colname_emp), "text"));
$emp = mysql_query($query_emp, $security) or die(mysql_error());
$row_emp = mysql_fetch_assoc($emp);
$totalRows_emp = mysql_num_rows($emp);
?>
<link href="css/styles.css" rel="stylesheet" type="text/css" />


<table width="600" border="0" align="center">
  <tr>
    <td height="479" align="center" valign="top"><p>&nbsp;</p>
      <?php if ($totalRows_emp > 0) { // Show if recordset not empty ?>
        <p class="Titles"><?php if ($row_emp['locked'] == "1") { echo "Your records are locked because was a previous atempt to create an account with your data, please call the office to solve that!!";} else { 
		
		if ($row_emp['user_enabled'] == 1) {
			echo "We found your record but there is an account already active. If you lost your password please follow the next link (under construction)";
			die;
		} else { 
		echo "We found your records!!!";
		}
		
		
		} ?></p>
        <table width="533" border="1">
          <tr>
            <td width="111" class="cabecera">Names:</td>
            <td width="406"><?php echo $row_emp['last_name']; ?>, <?php echo $row_emp['first_name']; ?> <?php echo $row_emp['middle_name']; ?></td>
          </tr>
          <tr>
            <td class="cabecera">Address:</td>
            <td><?php echo $row_emp['address']; ?>, <?php echo $row_emp['city']; ?> <?php echo $row_emp['state']; ?> <?php echo $row_emp['zipcode']; ?></td>
          </tr>
          <tr>
            <td class="cabecera">Phone number:</td>
            <td><?php echo $row_emp['cellphone'];
			$_SESSION['id'] = $row_emp['users_id'];?></td>
          </tr>
        </table><?php if ($row_emp['locked'] == "0") { echo "<p>If this is correct please follow this link.</p>
        <p><a href=\"confirm2.php\"><img src=\"images/checkmark.png\" width=\"35\" height=\"31\" border=\"0\" /></a></p>";
		$_SESSION['fecha'] = $row_emp['date_hired'];}  ?>
        <?php } // Show if recordset not empty ?>
      <p>&nbsp;</p>
      <?php if ($totalRows_emp == 0) { // Show if recordset empty ?>
  <p><span class="Titles">We are sorry! </span><br />
    <br />
    But we haven't found any record that match your data.</p>
        <p>Maybe your data has not been uploaded yet to the system or there is a mistake with your record.</p>
        <p>Please fill out the form bellow to let us check our records to find  a solution, thanks</p>
        <p>&nbsp;</p>
        <form id="form1" name="form1" method="post" action="">
          <table width="400" border="1">
            <tr>
              <td class="cabecera">Last name:</td>
              <td><label>
                <input type="text" name="txt_last" id="txt_last" />
              </label></td>
            </tr>
            <tr>
              <td class="cabecera">First name:</td>
              <td><label>
                <input type="text" name="txt_first" id="txt_first" />
              </label></td>
            </tr>
            <tr>
              <td class="cabecera">Midle name:</td>
              <td><label>
                <input type="text" name="txt_middle" id="txt_middle" />
              </label></td>
            </tr>
            <tr>
              <td class="cabecera">E-mail:</td>
              <td><?php echo $_SESSION['email']; ?></td>
            </tr>
            <tr>
              <td class="cabecera">Last four digits <br />
              of your SSN # </td>
              <td class="caja_grande"><?php echo $_SESSION['ssn']; ?></td>
            </tr>
            <tr>
              <td class="cabecera">&nbsp;</td>
              <td><label>
                <input type="submit" name="button" id="button" value="Submit" />
              </label></td>
            </tr>
          </table>
        </form>
        <p>&nbsp;</p>
        <?php } // Show if recordset empty ?>
<p>&nbsp;</p>
    <p>&nbsp;</p></td>
  </tr>
</table>
<?php
mysql_free_result($emp);
?>
