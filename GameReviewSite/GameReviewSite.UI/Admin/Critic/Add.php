<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/Classes/CCritic.php');



if(count($_POST) >= 1) {
         $new_critic= new CCRitic(-1, $_POST['txtname'],
         $_POST['txtcurrentemployer'], $_POST['txtcomments'], $_POST['txtrating']);

         $new_critic->Insert();
         $new_critic=null;
         header('Location: index.php');
   }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
    <title></title>
    <link rel="STYLESHEET" type="text/css" href="style/fg_membersite.css" />

    <!--Bootstrap CSS-->
    <link href="css/bootstrap.css" rel="stylesheet" />
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <link href="css/bootstrap-theme.css" rel="stylesheet" />
    <link href="css/bootstrap-theme.min.css" rel="stylesheet" />
    <link href="css/NPKStyleSheet.css" rel="stylesheet" />
</head>
<body>

<form id="form1" name="form1" method="post">
    <input name="txtname" value="" type="text" />
    <input name="txtcurrentemployer" value="" type="text" />
    <input name="txtrating" value="" type="number" />
    <input name="txtcomments" value="" type="text" />
    <input name="savedata" value="Save Data" type="submit" />
</form>
</body>
</html>