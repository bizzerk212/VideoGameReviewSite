<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/Classes/CGamesMembersJunction.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/Classes/CVideoGame.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/Classes/CMember.php');

if (isset($_GET['VideoGameId']) && isset($_GET['MemberId']))
{
    $gameMember = new CGamesMembersJunction(-1, -1, "NONE");
    $gameMember->GetData($_GET['VideoGameId'], $_GET['MemberId']);

    $videoGame = new CVideoGame(-1, "NONE", "NONE", "NONE", "NONE", "NONE", "NONE", "NONE");
    $videoGame->GetData($gameMember->getVideoGameId());

    $member = new CMember();
    $member->GetData($gameMember->getMemberId());

    if(count($_POST)>= 1)
    {
        $gameMember->setComments($_POST['txtComments']);
        $gameMember->Update();

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

    <h5><?=$videoGame->getName();?></h5>
    <h5><?=$member->getName();?></h5>
    <input name="txtComments" id="txtComments" value="<?=$gameMember->getComments();?>" type="text" />
    <input type="submit" />
    <a href="index.php">Back</a>
</form>
</body>
</html>

<?php
}
?>