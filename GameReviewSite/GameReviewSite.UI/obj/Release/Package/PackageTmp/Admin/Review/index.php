<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/Classes/CReview.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/Classes/CCritic.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/Classes/CVideoGame.php');

$videoGames = new CReviewList();
$videoGames->GetData();

$critic = new CCritic(-1, "NONE", "NONE", "NONE", "NONE");
$videoGame = new CVideoGame(-1, "NONE", "NONE", "NONE", "NONE", "NONE", "NONE", "NONE");

$root = $_SERVER['DOCUMENT_ROOT'];
?>

<table border="1">
    <tr>
        <th>Critic</th>
        <th>VideoGame</th>
        <th>Content</th>
        <th>Comments</th>
    </tr>
    <?php
    foreach($videoGames->reviews as $r)
    {
        $critic->GetData($r->getCriticId());
        $videoGame->GetData($r->getVideoGameId());

    ?>

    <tr>
        <td><?=$critic->getName();?></td>
        <td><?=$videoGame->getName();?></td>
        <td><?=$r->getContent();?></td>
        <td><?=$r->getComents();?></td>
        <td>
            <a href="/Admin/Review/Update.php?Id=<?=$r->getId();?>">Update</a>
            <a href="/Admin/Review/Delete.php?Id=<?=$r->getId();?>">Delete</a>
        </td>
    </tr>

    <?php 
    }?>
    
</table>
<a href="/Admin/Review/Add.php">Add</a>