<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/Classes/CCritic.php');

$critics = new CCriticList();
$critics->GetData();

$root = $_SERVER['DOCUMENT_ROOT'];
?>

<table border="1">
    <tr>
        <th>Name</th>
        <th>Employer</th>
        <th>Rating</th>
        <th>Comments</th>
    </tr>
    <?php
    foreach($critics->Critics as $c)
    {
    ?>

    <tr>
        <td><?=$c->getName();?></td>
        <td><?=$c->getCriticCurrentEmployer();?></td>
        <td><?=$c->getCriticRatings();?></td>
        <td><?=$c->getCriticComments();?></td>
        <td>
            <a href="/Admin/Critic/Update.php?Id=<?=$c->getId();?>">Update</a>
            <a href="/Admin/Critic/Delete.php?Id=<?=$c->getId();?>">Delete</a>
        </td>
    </tr>

    <?php 
    }?>
    
</table>
<a href="/Admin/Critic/Add.php">Add</a>