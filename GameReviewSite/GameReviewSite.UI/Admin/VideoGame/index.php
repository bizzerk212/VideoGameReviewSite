<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/Classes/CGenre.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/Classes/CVideoGame.php');

$videoGames = new CVideoGameList();
$videoGames->GetData();

$genre = new CGenre(-1, "NONE", "NONE");

$root = $_SERVER['DOCUMENT_ROOT'];
?>

<table border="1">
    <tr>
        <th>Name</th>
        <th>Genre</th>
        <th>Price</th>
        <th>Rating</th>
        <th>Image</th>
        <th>Thumbnail</th>
        <th>Release Date</th>
        <th>Comments</th>
    </tr>
    <?php
    foreach($videoGames->videoGames as $v)
    {
        $genre->GetData($v->getGenre());

    ?>

    <tr>
        <td><?=$v->getName();?></td>
        <td>
        <?php
        if($genre->getAbbreviation() != null)
        {
            echo($genre->getAbbreviation());
        }
        else
        {
            echo($genre->getDescription());
        }
        ?>
        </td>
        <td><?=$v->getPrice();?></td>
        <td><?=$v->getLetterRating();?></td>
        <td><img src="<?=$v->getImageFilepath();?>" height="200" width="500"/></td>
        <td><img src="<?=$v->getThumbnailFilepath();?>" /></td>
        <td><?=$v->getReleaseDate();?></td>
        <td><?=$v->getComents();?></td>
        <td>
            <a href="/Admin/VideoGame/Update.php?Id=<?=$v->getId();?>">Update</a>
            <a href="/Admin/VideoGame/Delete.php?Id=<?=$v->getId();?>">Delete</a>
        </td>
    </tr>

    <?php 
    }?>
    
</table>
<a href="/Admin/VideoGame/Add.php">Add</a>