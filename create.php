<?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>All American Security Services</title>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
</head>
<body>
<br />
<table width="600" border="0" align="center">
  <tr>
    <td align="center"><script type="text/javascript" src="employees.js"></script></td>
  </tr>
</table>
<table width="600" border="0" align="center">
  <tr>
    <td height="466" align="center" valign="top">
      <p class="Titles">&nbsp;</p>
      <p class="Titles">Create an account<br />
      </p>
      <form action="confirm.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
        <table width="443" border="1">
          <tr>
            <td width="140" class="cabecera">E-mail:</td>
            <td width="287"><label>
              <input name="txt_email" type="text" id="txt_email" size="50" maxlength="40" />
            </label></td>
          </tr>
          <tr>
            <td class="cabecera">Username:</td>
            <td><label>
              <input name="txt_username" type="text" id="txt_username" maxlength="20" />
            </label></td>
          </tr>
          <tr>
            <td class="cabecera">Password:</td>
            <td><label>
              <input name="txt_password" type="password" id="txt_password" maxlength="40" />
            </label></td>
          </tr>
          <tr>
            <td class="cabecera">Re-type password:</td>
            <td><label>
              <input name="txt_password2" type="password" id="txt_password2" maxlength="40" />
            </label></td>
          </tr>
          <tr>
            <td class="cabecera">Last four digits <br />
            SSN number:</td>
            <td><label>
              <input name="txt_ssn" type="text" class="caja_grande" id="txt_ssn" size="7" maxlength="4" />
            </label></td>
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
  </tr>
</table>
<br /></body>
</html>