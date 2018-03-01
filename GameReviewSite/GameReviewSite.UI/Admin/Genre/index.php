<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/Classes/CGenre.php');

$genres = new CGenreList();
$genres->GetData();

?>

<table border="1">
    <tr>
        <th>Abbreviation</th>
        <th>Description</th>
    </tr>
    <?php
    foreach($genres->Genres as $genre)
    {
    ?>

    <tr>
        <td><?=$genre->getAbbreviation();?></td>
        <td><?=$genre->getDescription();?></td>
        <td>
            <a href="/Admin/Genre/Update.php?Id=<?=$genre->getId()?>">Update</a>
            <a href="/Admin/Genre/Delete.php?Id=<?=$genre->getId();?>">Delete</a>
        </td>
    </tr>

    <?php 
    }?>
    
</table>
<a href="/Admin/Genre/Add.php">Add</a>