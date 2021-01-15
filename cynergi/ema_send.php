<?php require_once('../Connections/dplace.php'); ?>
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

//--------------------------Set these paramaters--------------------------


$insertSQL = sprintf("INSERT INTO tbl_incident (incident_number, type, location, date_start, time_start, date_end, time_end, complainant, last_name, first_name, address, city, `state`, zip, phone1, phone2, company, complainant2, last_name2, first_name2, address2, city2, state2, zip2, phone12, phone22, company2, `description`, police_num, police_name, police_id, rescue, lt_name, alarm_no, completed_by, `user`) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_REQUEST['txt_incident_number'], "text"),
                       GetSQLValueString($_REQUEST['select_incident'], "text"),
                       GetSQLValueString($_REQUEST['select_loc'], "text"),
                       GetSQLValueString($_REQUEST['txt_date_in'], "date"),
                       GetSQLValueString($_REQUEST['select_hour_in'] . ":" . $_REQUEST['txt_min_in'], "text"),
                       GetSQLValueString($_REQUEST['txt_date_out'], "date"),
                       GetSQLValueString($_REQUEST['select_hour_out'] . ":" . $_REQUEST['txt_min_out'], "text"),
                       GetSQLValueString($_REQUEST['select_complainant'], "text"),
                       GetSQLValueString($_REQUEST['txt_last'], "text"),
                       GetSQLValueString($_REQUEST['txt_first'], "text"),
                       GetSQLValueString($_REQUEST['txt_address'], "text"),
                       GetSQLValueString($_REQUEST['txt_city'], "text"),
                       GetSQLValueString($_REQUEST['txt_state'], "text"),
                       GetSQLValueString($_REQUEST['txt_zip'], "text"),
                       GetSQLValueString($_REQUEST['txt_phone'], "text"),
                       GetSQLValueString($_REQUEST['txt_phone2'], "text"),
                       GetSQLValueString($_REQUEST['txt_dep_company'], "text"),
                       GetSQLValueString($_REQUEST['select_complainant2'], "text"),
                       GetSQLValueString($_REQUEST['txt_last_2'], "text"),
                       GetSQLValueString($_REQUEST['txt_first_2'], "text"),
                       GetSQLValueString($_REQUEST['txt_address_2'], "text"),
                       GetSQLValueString($_REQUEST['txt_city_2'], "text"),
                       GetSQLValueString($_REQUEST['txt_state_2'], "text"),
                       GetSQLValueString($_REQUEST['txt_zip_2'], "text"),
                       GetSQLValueString($_REQUEST['txt_phone_2'], "text"),
                       GetSQLValueString($_REQUEST['txt_phone2_2'], "text"),
                       GetSQLValueString($_REQUEST['txt_dep_company_2'], "text"),
                       GetSQLValueString($_REQUEST['txt_description'], "text"),
                       GetSQLValueString($_REQUEST['txt_police_incident_no'], "text"),
                       GetSQLValueString($_REQUEST['txt_police_name'], "text"),
                       GetSQLValueString($_REQUEST['txt_police_id'], "text"),
                       GetSQLValueString($_REQUEST['select_rescue'], "text"),
                       GetSQLValueString($_REQUEST['txt_lt_name'], "text"),
                       GetSQLValueString($_REQUEST['txt_alarm_no'], "text"),
                       GetSQLValueString($_REQUEST['txt_completed'], "text"),
                       GetSQLValueString($_REQUEST['hidden_user'], "int"));
//echo $insertSQL;
  mysql_select_db($database_dplace, $dplace);
  $Result1 = mysql_query($insertSQL, $dplace) or die(mysql_error());
  
  

// Subject of email sent to you.
$subject = 'Cynergi\'s Incident Report'; 

// Your email address. This is where the form information will be sent. 
//$emailadd = 'allamerican3043@bellsouth.net, support@websoftec.net'; 
$emailadd = 'support@websoftec.net'; 

// Where to redirect after form is processed. 
$url = "incident_ok.php"; 
echo "<p>Recording the incident on to the database and sending the email to the office, please wait few seconds..........";
$cabeceras = "From: cynergi@allamericanfl.com\r\nContent-type: text/html\r\n";

// Makes all fields required. If set to '1' no field can not be empty. If set to '0' any or all fields can be empty.
$req = '0'; 

// --------------------------Editar para cabiar presentacion--------------------------
$text = "<html xmlns=\"http://www.w3.org/1999/xhtml\">
<p><span class=\"TITULO\"><b>Cynergi's Security Incident Report.</b></span><br />
  <br />
</p>
<table width=\"600\" border=1 cellspacing=\"3\" cellpadding=\"3\">
  <tr>
    <td width=\"200\" class=\"ETIQUETAS\">Incident No.: </td>
    <td >" . $_REQUEST['txt_incident_number'] . "</td>
  </tr>
  <tr>
    <td class=\"ETIQUETAS\">Incident Type:</td>
    <td>" . $_REQUEST['select_incident'] . "</td>
  </tr>
  <tr>
    <td class=\"ETIQUETAS\">Location:</td>
    <td>" . $_REQUEST['select_loc'] . "</td>
  </tr>
  <tr>
    <td class=\"ETIQUETAS\">Date/Time incident started:</td>
    <td>" . $_REQUEST[txt_date_in] . " " . $_REQUEST[select_hour_in] . ":" . $_REQUEST[txt_min_in] . "</td>
  </tr>
  <tr>
    <td class=\"ETIQUETAS\">Date/Time Incident ended:</td>
    <td>" . $_REQUEST[txt_date_out] . " " . $_REQUEST[select_hour_out] . ":" . $_REQUEST[txt_min_out] . "</td>
  </tr>
    <tr>
    <td class=\"ETIQUETAS\">Complainant:</td>
    <td>" . $_REQUEST[select_complainant] . "</td>
  </tr>
    <tr>
    <td class=\"ETIQUETAS\">Last name:</td>
    <td>" . $_REQUEST[txt_last] . "</td>
  </tr>
  <tr>
    <td class=\"ETIQUETAS\">Fist name:</td>
    <td>" . $_REQUEST[txt_first] . "</td>
  </tr>
  <tr>
    <td class=\"ETIQUETAS\">Address:</td>
    <td>" . $_REQUEST[txt_address] . "</td>
  </tr>
    <tr>
    <td class=\"ETIQUETAS\">City:</td>
    <td>" . $_REQUEST[txt_city] . "</td>
  </tr>
    <tr>
    <td class=\"ETIQUETAS\">State:</td>
    <td>" . $_REQUEST[txt_state] . "</td>
  </tr>
    <tr>
    <td class=\"ETIQUETAS\">Zip:</td>
    <td>" . $_REQUEST[txt_zip] . "</td>
  </tr>
      <tr>
    <td class=\"ETIQUETAS\">Phone:</td>
    <td>" . $_REQUEST[txt_phone] . "</td>
  </tr>
      <tr>
    <td class=\"ETIQUETAS\">Phone2:</td>
    <td>" . $_REQUEST[txt_phone2] . "</td>
  </tr>
      <tr>
    <td class=\"ETIQUETAS\">Company:</td>
    <td>" . $_REQUEST[txt_dep_company] . "</td>
  </tr>";
  
  if ($_REQUEST[select_complainant2] <> "noselected") { 
  
  $text = $text . "<tr>
    <td class=\"ETIQUETAS\">Complainant2:</td>
    <td>" . $_REQUEST[select_complainant2] . "</td>
  </tr>
    <tr>
    <td class=\"ETIQUETAS\">Last name:</td>
    <td>" . $_REQUEST[txt_last_2] . "</td>
  </tr>
  <tr>
    <td class=\"ETIQUETAS\">Fist name:</td>
    <td>" . $_REQUEST[txt_first_2] . "</td>
  </tr>
  <tr>
    <td class=\"ETIQUETAS\">Address:</td>
    <td>" . $_REQUEST[txt_address_2] . "</td>
  </tr>
    <tr>
    <td class=\"ETIQUETAS\">City:</td>
    <td>" . $_REQUEST[txt_city_2] . "</td>
  </tr>
    <tr>
    <td class=\"ETIQUETAS\">State:</td>
    <td>" . $_REQUEST[txt_state_2] . "</td>
  </tr>
    <tr>
    <td class=\"ETIQUETAS\">Zip:</td>
    <td>" . $_REQUEST[txt_zip_2] . "</td>
  </tr>
      <tr>
    <td class=\"ETIQUETAS\">Phone:</td>
    <td>" . $_REQUEST[txt_phone_2] . "</td>
  </tr>
      <tr>
    <td class=\"ETIQUETAS\">Phone2:</td>
    <td>" . $_REQUEST[txt_phone2_2] . "</td>
  </tr>
  <tr>
    <td class=\"ETIQUETAS\">Company:</td>
    <td>" . $_REQUEST[txt_dep_company_2] . "</td>
  </tr>";
  
  }
  
 $text = $text ." <tr>
    <td class=\"ETIQUETAS\">Incident description:</td>
    <td >". $_REQUEST['txt_description'] . "</td>
  </tr>
    <tr>
    <td class=\"ETIQUETAS\">Police Incident No:</td>
    <td>" . $_REQUEST[txt_police_incident_no] . "</td>
  </tr>
    <tr>
    <td class=\"ETIQUETAS\">Police Officer's name:</td>
    <td>" . $_REQUEST[txt_police_name] . "</td>
  </tr>
   </tr>
    <tr>
    <td class=\"ETIQUETAS\">Police Officer's ID No.:</td>
    <td>" . $_REQUEST[txt_police_id] . "</td>
  </tr>
    </tr>
    <tr>
    <td class=\"ETIQUETAS\">Called rescue?:</td>
    <td>" . $_REQUEST[select_rescue] . "</td>
  </tr>
    </tr>
    <tr>
    <td class=\"ETIQUETAS\">LT Police names:</td>
    <td>" . $_REQUEST[txt_lt_name] . "</td>
  </tr>
  </tr>
    <tr>
    <td class=\"ETIQUETAS\">Alarm No.:</td>
    <td>" . $_REQUEST[txt_alarm_no] . "</td>
  </tr>
  <tr>
    <td class=\"ETIQUETAS\">Completed by</td>
    <td>" . $_REQUEST[txt_completed] . "</td>
  </tr>
    

</table>
<p>
<p>";
 

mail($emailadd, $subject, $text, $cabeceras);
echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL='.$url.'">';

?>