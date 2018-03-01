<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/Classes/CGamesMembersJunction.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/Classes/CVideoGame.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/Classes/CMember.php');

$gameMembers = new CGamesMembersJunctionList();
$gameMembers->GetData();

$videoGame = new CVideoGame(-1, "NONE", "NONE", "NONE", "NONE", "NONE", "NONE", "NONE");
$member = new CMember();

$root = $_SERVER['DOCUMENT_ROOT'];
?>

<table border="1">
    <tr>
        <th>Videogame</th>
        <th>Member</th>
        <th>Comments</th>
    </tr>
    <?php
    foreach($gameMembers->GameMembers as $gm)
    {
        $videoGame->GetData($gm->getVideoGameId());
        $member->GetData($gm->getMemberId());
    ?>

    <tr>
        <td><?=$videoGame->getName();?></td>
        <td><?=$member->getName();?></td>
        <td><?=$gm->getComments();?></td>
        <td>
            <a href="/Admin/GamesMembers/Update.php?VideoGameId=<?=$gm->getVideoGameId();?>&MemberId=<?=$gm->getMemberId();?>">Update</a>
            <a href="/Admin/GamesMembers/Delete.php?VideoGameId=<?=$gm->getVideoGameId();?>&MemberId=<?=$gm->getMemberId();?>">Delete</a>
        </td>
    </tr>

    <?php 
    }?>
    
</table>
<a href="/Admin/GamesMembers/Add.php">Add</a>