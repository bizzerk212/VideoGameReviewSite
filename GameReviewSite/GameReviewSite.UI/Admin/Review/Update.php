<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/Classes/CReview.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/Classes/CCritic.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/Classes/CVideoGame.php');

if (isset($_GET['Id']))
{
    $review = new CReview(-1, "NONE", "NONE", false, "NONE", "NONE");
    $review->GetData($_GET['Id']);

    $critics = new CCriticList();
    $critics->GetData();

    $videoGames = new CVideoGameList();
    $videoGames->GetData();

    if(count($_POST) >= 1) {
        
        $review->setCriticId($_POST['lstCritic']);
        $review->setVideoGameId($_POST['lstVideoGame']);
        $review->setContent($_POST['txtContent']);
        $review->setComents($_POST['txtComments']);

        $review->Update();

        header('Location: index.php');
    }
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
        foreach($critics->Critics as $cl)
        {
            $selected = ($review->getCriticId() == $cl->getId());
        ?>
            
            <option value="<?=$cl->getId()?>" <?php if($selected)echo'selected';?> ><?=$cl->getName()?></option>

            <?php
        }
            ?>
    </select>
    <select name="lstVideoGame" id="lstVideoGame">
        <option value="-1">--Select--</option>
        <?php
        foreach($videoGames->videoGames as $v)
        {
            $selected = ($review->getVideoGameId() == $v->getId())
        ?>
            
            <option value="<?=$v->getId()?>" <?php if($selected)echo'selected';?> ><?=$v->getName()?></option>

            <?php
        }
            ?>
    </select>

    <textarea rows="10" cols="50" name="txtContent" id="txtContent"><?=$review->getContent();?></textarea>
    <input name="txtComments" value="<?=$review->getComents();?>" type="text" />
    <input name="savedata" value="Save Data" type="submit" />
</form>
</body>
</html>