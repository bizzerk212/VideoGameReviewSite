<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/Classes/CCriticsMembersRatingsJunction.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/Classes/CCritic.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/Classes/CMember.php');

if (isset($_GET['CriticId']) && isset($_GET['MemberId']))
{
    $cmr = new CCriticsMembersRatingsJunction(-1, -1, "NONE");
    $cmr->GetData($_GET['CriticId'], $_GET['MemberId']);

    $critic = new CCritic(-1, "NONE", "NONE", "NONE", "NONE");
    $critic->GetData($cmr->getCriticId());

    $member = new CMember();
    $member->GetData($cmr->getMemberId());

    if(count($_POST)>= 1)
    {
        $cmr->setRating($_POST['txtRating']);
        $cmr->Update();

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

    <h5><?=$critic->getName();?></h5>
    <h5><?=$member->getName();?></h5>
    <input name="txtRating" id="txtRating" value="<?=$cmr->getRating();?>" type="number" />
    <input type="submit" />
    <a href="index.php">Back</a>
</form>
</body>
</html>

<?php
}
?>