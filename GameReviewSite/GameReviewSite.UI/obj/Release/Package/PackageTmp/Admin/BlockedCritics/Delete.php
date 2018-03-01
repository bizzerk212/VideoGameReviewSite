<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/Classes/CBlockedCritics.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/Classes/CCritic.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/Classes/CMember.php');

$crtiticList = new CCriticList();
$crtiticList->GetData();

$members = new CMemberList();
$members->GetData();

if(count($_POST) >= 1) {
         $new_Blockedcritic= new CBlockedCritic($_POST['lstCritic'], $_POST['lstMember'],
            $_POST['txtComments']);

            $new_Blockedcritic->Delete();
            $new_Blockedcrtiic=null;
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
    <select name="lstCritic" id="lstCritic">
        <option value="-1" selected>--Select--</option>
        <?php
        foreach($crtiticList->Critics as $cl)
        {
            $selected = (isset($_POST['lstCritic']) && ($_POST['lstCritic'] == $cl->getId()));
            ?>
            
            <option value="<?=$cl->getId()?>"<?php if($selected)echo'selected';?> ><?=$cl->getName()?></option>

            <?php
        }
            ?>
    </select>
    <select name="lstMember" id="lstMember">
        <option value="-1">--Select--</option>
        <?php
        foreach($members->Members as $m)
        {
            $selected = (isset($_POST['lstMember']) && ($_POST['lstMember'] == $m->getId()));
        ?>
            
            <option value="<?=$m->getId()?>" <?php if($selected)echo'selected';?>><?=$m->getName()?></option>

            <?php
        }
            ?>
    </select>
    <input name="txtComments" id="txtComments" value="<?php if(isset($_POST['txtComments']))echo($_POST['txtComments']);?>" type="text" />
    <input type="submit" />
</form>
</body>
</html>