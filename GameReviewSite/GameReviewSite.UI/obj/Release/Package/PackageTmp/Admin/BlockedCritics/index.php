<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/Classes/CBlockedCritics.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/Classes/CCritic.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/Classes/CMember.php');

$blockedCritics = new CBlockedCriticList();
$blockedCritics->GetData();

$critic = new CCritic(-1, "NONE", "NONE", "NONE", "NONE");
$member = new CMember();

$root = $_SERVER['DOCUMENT_ROOT'];
?>

<table border="1">
    <tr>
        <th>Critic</th>
        <th>Member</th>
        <th>Comments</th>
    </tr>
    <?php
    foreach($blockedCritics->BlockedCritics as $bc)
    {
        $critic->GetData($bc->getCriticId());
        $member->GetData($bc->getMemberId());
    ?>

    <tr>
        <td><?=$critic->getName();?></td>
        <td><?=$member->getName();?></td>
        <td><?=$bc->getComments();?></td>
        <td>
            <a href="/Admin/BlockedCritics/Update.php?CriticId=<?=$bc->getCriticId();?>&MemberId=<?=$bc->getMemberId();?>">Update</a>
            <a href="/Admin/BlockedCritics/Delete.php?CriticId=<?=$bc->getCriticId();?>&MemberId=<?=$bc->getMemberId();?>">Delete</a>
        </td>
    </tr>

    <?php 
    }?>
    
</table>
<a href="/Admin/BlockedCritics/Add.php">Add</a>