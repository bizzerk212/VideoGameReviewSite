<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/Classes/CVideoGame.php');

$allGames = new CVideoGameList();
//$allGames->GetData();


if(isset($_GET['Search']))
{
    $allGames->GetDataSearch($_GET['Search']);
}
else
{
    $allGames->GetData();
}

if(isset($_GET['Id']))
{
    $Ids = $_GET['Id'];
    foreach($allGames->videoGames as $g)
    {
        foreach($Ids as $id)
        {
            if ($g->getGenre() == $id)
            {
?>

<div id="v<?=$g->getId();?>" class="box1 gameBox-item-outer">
    <a href="Game.php?Id=<?=$g->getId();?>">
        <div class="gameBox" id="<?=$g->getId();?>" style="background: url(<?=$g->getThumbnailFilepath();?>)"></div>
    </a>
</div>

<?php
            }
        }
    }
}
else
{
    foreach($allGames->videoGames as $g)
    {
?>

<div id="v<?=$g->getId();?>" class="box1 gameBox-item-outer">
    <a href="Game.php?Id=<?=$g->getId();?>">
        <div class="gameBox" id="<?=$g->getId();?>" style="background: url(<?=$g->getThumbnailFilepath();?>)"></div>
    </a>
</div>

<?php
    }
}
?>