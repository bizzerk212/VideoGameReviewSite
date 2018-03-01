<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/Classes/CGamesMembersJunction.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/Classes/CVideoGame.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/Classes/CMember.php');

$videoGames = new CVideoGameList();
$videoGames->GetData();

$members = new CMemberList();
$members->GetData();

if(count($_POST) >= 1) {
    $gameMember= new CGamesMembersJunction($_POST['lstGame'], $_POST['lstMember'], $_POST['txtComments']);

    $gameMember->Insert();
    $gameMember=null;
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
    <select name="lstGame" id="lstGame">
        <option value="-1" selected>--Select--</option>
        <?php
        foreach($videoGames->videoGames as $vg)
        {
        ?>
            
            <option value="<?=$vg->getId();?>" ><?=$vg->getName();?></option>

            <?php
        }
            ?>
    </select>
    <select name="lstMember" id="lstMember">
        <option value="-1">--Select--</option>
        <?php
        foreach($members->Members as $m)
        {
        ?>
            
            <option value="<?=$m->getId()?>"><?=$m->getName()?></option>

            <?php
        }
            ?>
    </select>
    <input name="txtComments" id="txtComments" type="text" />
    <input type="submit" />
</form>
</body>
</html>