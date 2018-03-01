<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/Classes/CCriticsMembersRatingsJunction.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/Classes/CCritic.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/Classes/CMember.php');

$cmr = new CCriticsMembersRatingsJunctionList();
$cmr->GetData();

$critic = new CCritic(-1, "NONE", "NONE", "NONE", "NONE");
$member = new CMember();

$root = $_SERVER['DOCUMENT_ROOT'];
?>

<table border="1">
    <tr>
        <th>Critic</th>
        <th>Member</th>
        <th>Rating</th>
    </tr>
    <?php
    foreach($cmr->CriticMemberRatings as $cmrl)
    {
        $critic->GetData($cmrl->getCriticId());
        $member->GetData($cmrl->getMemberId());
    ?>

    <tr>
        <td><?=$critic->getName();?></td>
        <td><?=$member->getName();?></td>
        <td><?=$cmrl->getRating();?></td>
        <td>
            <a href="/Admin/CriticsMembersRatings/Update.php?CriticId=<?=$cmrl->getCriticId();?>&MemberId=<?=$cmrl->getMemberId();?>">Update</a>
            <a href="/Admin/CriticsMembersRatings/Delete.php?CriticId=<?=$cmrl->getCriticId();?>&MemberId=<?=$cmrl->getMemberId();?>">Delete</a>
        </td>
    </tr>

    <?php 
    }?>
    
</table>
<a href="/Admin/CriticsMembersRatings/Add.php">Add</a>