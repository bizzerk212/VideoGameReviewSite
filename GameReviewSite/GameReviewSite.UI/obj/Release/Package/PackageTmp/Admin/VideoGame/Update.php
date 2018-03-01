<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/Classes/CGenre.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/Classes/CVideoGame.php');

if (isset($_GET['Id']))
{
    $videoGame = new CVideoGame(-1, "NONE", "NONE", 0, "NONE", "NONE", "NONE", "NONE", "NONE");
    $videoGame->GetData($_GET['Id']);

    $genres = new CGenreList();;
    $genres->GetData();

    if(count($_POST) >= 1) {
        
        $targetDir = "/images/";
        if(!empty($_FILES["fluImage"]["tmp_name"]))
        {
            $targetFile= $targetDir . basename($_FILES["fluImage"]["name"]);
            $imageFileType=pathinfo($targetFile, PATHINFO_EXTENSION);
            move_uploaded_file($_FILES["fluImage"]["tmp_name"], $targetFile);
            $LargeImage = $targetFile;
            
            $videoGame->setImageFilepath($LargeImage);
        }
        else
        {
            
        }

        if(!empty($_FILES["fluTImage"]["tmp_name"]))
        {
            $targetFile=$targetDir . basename($_FILES["fluTImage"]["name"]);
            $imageFileType=pathinfo($targetFile, PATHINFO_EXTENSION);
            move_uploaded_file($_FILES["fluTImage"]["tmp_name"], $targetFile);
            $Thumbnail = $targetFile;
            $videoGame->setThumbnailFilepath($Thumbnail);
        }
        else
        {
            
        }

        $videoGame->setName($_POST['txtName']);
        $videoGame->setGenre($_POST['lstGenre']);
        $videoGame->setPrice($_POST['txtPrice']);
        $videoGame->setLetterRating($_POST['txtRating']);
        $videoGame->setReleaseDate($_POST['txtreleaseDate']);
        $videoGame->setComents($_POST['txtComments']);

        $videoGame->Update();
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

    Name: <input name="txtName" value="<?=$videoGame->getName();?>" type="text" />
    Genre: <select name="lstGenre" id="lstGenre">
        <option selected value="-1">--Select--</option>
        <?php
    foreach($genres->Genres as $genre)
    {
        $selected = ($genre->getId() == $videoGame->getGenre());
        ?>

        <option value="<?=$genre->getId();?>" <?php if($selected)echo("selected");?> ><?=$genre->getDescription();?></option>

        <?php
    }
        ?>
    </select>
    Price: <input type="number" step="any" name="txtPrice" id="txtPrice" value="<?=$videoGame->getPrice();?>"/>
    Rating: <input type="text" name="txtRating" id="txtRating" />
    Thumbnail: <input type="file" name="fluTImage" id="fluTImage" accept=".jpg,.png,.jpeg"/>
    Header Image: <input type="file" name="fluImage" id="fluImage" accept=".jpg,.png,.jpeg" />
    Release date: <input name="txtreleaseDate" value="<?=$videoGame->getReleaseDate();?>" type="date"/>
    Comments: <input name="txtComments" value="<?=$videoGame->getComents();?>" type="text" />
    <input name="savedata" value="Save Data" type="submit" />
</form>
</body>
</html>
<?php 
}
?>