<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
  <title>datepicker test</title>
  </head>
  <body>
<?php
    // requires the class
    require "../class.datepicker.php";
    
    // instantiate the object
    $db=new datepicker();
    
    // uncomment the next line to have the calendar show up in german
    //$db->language = "dutch";
    
    $db->firstDayOfWeek = 1;

    // set the format in which the date to be returned
    $db->dateFormat = "m d Y";
?>

    <input type="text" id="date">
    <input type="button" value="Click to open the date picker" onclick="<?=$db->show("date")?>">

  </body>
</html>
