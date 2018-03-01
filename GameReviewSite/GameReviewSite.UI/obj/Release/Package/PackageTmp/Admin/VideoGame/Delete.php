<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/Classes/CVideoGame.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/Classes/CGenre.php');

$videogames = new CVideoGameList();
$videogames->GetData();

if(count($_POST) >= 1) {


    //$targetDir = "/images/";
    //$targetFile= $targetDir . basename($_FILES["fluImage"]["name"]);
    //$imageFileType=pathinfo($targetFile, PATHINFO_EXTENSION);

    //move_uploaded_file($_FILES["fluImage"]["tmp_name"], $targetFile);
    //$LargeImage = $targetFile;

    //$targetFile=$targetDir . basename($_FILES["fluTImage"]["name"]);
    //$imageFileType=pathinfo($targetFile, PATHINFO_EXTENSION);

    //move_uploaded_file($_FILES["fluTImage"]["tmp_name"], $targetFile);
    //$Thumbnail = $targetFile;

    $Game= new CVideoGame($_POST['lstVideoGame']);

    $Game->Delete();
    $Game=null;
    
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

<form id="form1" name="form1" method="post" enctype="multipart/form-data">
    <select name="lstVideoGame" id="lstVideoGame">
        <option selected value="-1">--Select--</option>
        <?php
        foreach($videogames->videoGames as $v)
        {
            ?>

        <option value="<?=$v->getId();?>"><?=$v->getName();?></option>

        <?php
        }
        ?>
    </select>
    <input name="savedata" value="Save Data" type="submit" />
</form>
</body>
</html>