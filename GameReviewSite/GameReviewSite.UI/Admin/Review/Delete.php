<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/Classes/CReview.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/Classes/CCritic.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/Classes/CVideoGame.php');

$critics = new CCriticList();
$critics->GetData();

$videoGames = new CVideoGameList();
$videoGames->GetData();

if(count($_POST) >= 1) {
    $review= new CReview();
    $review->CriticId = $_POST['lstCritic'];
    $review->VideoGameId=$_POST['lstVideoGame'];
    $review->GetDataByForeignKeys();

    $review->Delete();
    $review=null;
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
        foreach($critics->Critics as $cl)
        {
        ?>
            
            <option value="<?=$cl->getId()?>"><?=$cl->getName()?></option>

            <?php
        }
            ?>
    </select>
    <select name="lstVideoGame" id="lstVideoGame">
        <option value="-1">--Select--</option>
        <?php
        foreach($videoGames->videoGames as $v)
        {
        ?>
            
            <option value="<?=$v->getId()?>"><?=$v->getName()?></option>

            <?php
        }
            ?>
    </select>

</form>
</body>
</html>