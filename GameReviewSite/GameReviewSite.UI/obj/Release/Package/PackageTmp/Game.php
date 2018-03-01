<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'].'/Classes/CVideoGame.php');
include($_SERVER['DOCUMENT_ROOT'].'/Classes/CReview.php');
include($_SERVER['DOCUMENT_ROOT'].'/Classes/CCritic.php');
include($_SERVER['DOCUMENT_ROOT'].'/Classes/CGenre.php');
include($_SERVER['DOCUMENT_ROOT'].'/Classes/CBlockedCritics.php');

$Vary=false;
if($_SESSION["loggedin"]==TRUE){
    $Vary=true;
}

if(isset($_POST['searchtext']))
{
    $search = $_POST['searchtext'];
    header("Location: index.php?Search=$search");
    die();
}

if(isset($_GET['Id']))
{
    $game = new CVideoGame(-1, "NONE", -1, -1, "NONE", "NONE", "NONE", "NONE");
    $game->GetData($_GET['Id']);

    $genre = new CGenre(-1, "NONE", "NONE");
    $genre->GetData($game->getGenre());

    $reviews = new CReviewList();
    $reviews->GetDataByVideoGameId($game->getId());

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>
        <?=$game->getName();?>
    </title>
    <!--Bootstrap CSS-->
    <link href="../css/bootstrap.css" rel="stylesheet" />
    <link href="../css/bootstrap.min.css" rel="stylesheet" />
    <link href="../css/bootstrap-theme.css" rel="stylesheet" />
    <link href="../css/bootstrap-theme.min.css" rel="stylesheet" />
    <link href="css/NPKStyleSheet.css" rel="stylesheet" />
</head>
<body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <div class="wrapper">
        <section class="header search-bar-container" id="searchBarContainer">
            <div class="container-fluid main-container">
                <div class="row noMarg">
                    <div class="col-sm-4 col-xs-12">
                        <img class="center-block" src="/images/LogoMini.png" />
                    </div>
                    <div class="col-sm-3 col-sm-push-5 col-xs-12 log-btns">
                        <a class="custom-button" href="/index.php">
                            <span>Home</span>
                        </a>
                        <!--Added onclick event for Login / Register ... MFS-->
                        <?php if (!$Vary) { ?>
                        <!--<input type="button" name="btnLogin" id="btnLogin" class="searchBarBtns" value="Log In" onclick="window.location = '/CreateAccount/login.php';" />-->
                        <a class="custom-button btnLogin" href="/CreateAccount/login.php">
                            <span>Login</span>
                        </a>
                        <a class="custom-button btnRegister" href="/CreateAccount/register.php">
                            <span>Register</span>
                        </a>
                        <?php } else{  ?>

                        <!--the name here is btnLogut should it be btnLogout? (NPK)-->
                        <!--<input type="button" name="btnLogut" id="btnLogout" class="searchBarBtns" value="Log Out" onclick="window.location = '/CreateAccount/logout.php';" />-->
                        <a class="custom-button btnLogout" href="/CreateAccount/logout.php">
                            <span>Logout</span>
                        </a>
                        <a class="custom-button my-account" href="/CreateAccount/MyAccount2.php">
                            <span>My Account</span>
                        </a>
                        <?php } ?>
                    </div>
                    <div class="col-sm-5 col-sm-pull-3 col-xs-12 searchBtnsLeft">
                        <form method="post">
                            <input class="search-bar" type="text" name="searchtext" id="searchtext" />
                            <input class="search-btn" type="submit" name="submit" id="submit" value="Search" />
                        </form>

                        <gcse:search></gcse:search>
                    </div>
                </div>
                <!--                    
                not sure what this is (NPK)

                <h1 class="display-3"></h1>
                <p class="lead"></p>
                -->
            </div>
        </section>
        <section class="jumbotron jumbotron-fluid mainJumbo">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8 col-md-push-4 col-sm-12 jumbotron-img-box">
                        <img class="game-jumbo" src="<?=$game->getImageFilepath();?>" />
                    </div>
                    <div class="col-md-4 col-md-pull-8 col-sm-12 jumbotron-stats-box">
                        <span><?=$game->getName();?></span>
                        <span>Rated: <?=$game->getLetterRating();?></span>
                        <span>$<?=$game->getPrice()?></span>
                        <span>4 Stars</span>
                        <span>Xbox, PS4, PC</span>
                    </div>
                </div>
            </div>
        </section>
      </div>


        <!--Collapse-->
    <section class="main-content-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 col-md-4">
                    <div class="SideBar" id="SideBar">
                        <div class="SideBarInner" id="SideBarInner">
                            <div class="big-name-critics">
                                <h3>Big Name Critics</h3>
                                <hr />
                                <a>IGN</a>
                                <a>Gamespot</a>
                                <a>Metacritic</a>
                                <a>Polygon</a>
                                <a>Game Informer</a>
                            </div>
                            <div class="my-critics">
                                <h3>My Critics</h3>
                                <hr />
                                <a>ClipClop</a>
                                <a>JohnyReviews</a>
                                <a>TheGamesGuy</a>
                                <a>Reviews4U</a>
                                <a>Jeff</a>
                                <br />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-8">
                    <div id="accordion" role="tablist" aria-multiselectable="true" class="collapseBox">
                        <?php
                    $counter = 0;
                    foreach($reviews->reviews as $r)
                    {
                        if($r->getIsProfessional())
                        {
                            $critic = new CCritic(-1, "NONE", "NONE", "NONE", "NONE");
                            $critic->GetData($r->getCriticId());

                        ?>

                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="heading<?=$counter?>">
                                <h4 class="panel-title">
                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse<?=$counter?>" aria-expanded="false" aria-controls="collapse<?=$counter?>">
                                        <?=$critic->getName();?>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse<?=$counter?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?=$counter?>">
                                <?php
                            if(!$r->getIsProfessional())
                            {
                                ?>
                                <p>
                                    <?=$r->getContent();?>
                                </p>
                                <?php
                            }
                            else
                            {
                                echo($r->getContent());
                            }
                                ?>
                            </div>
                        </div>

                        <?php
                        }
                        $counter++;
                    }
                        ?>

                        <?php
                    foreach($reviews->reviews as $r)
                    {
                        if(!$r->getIsProfessional())
                        {
                            $critic = new CCritic(-1, "NONE", "NONE", "NONE", "NONE");
                            $critic->GetData($r->getCriticId());
                        ?>

                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="heading<?=$counter?>">
                                <h4 class="panel-title">
                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse<?=$counter?>" aria-expanded="false" aria-controls="collapse<?=$counter?>">
                                        <?=$critic->getName();?>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse<?=$counter?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?=$counter?>">
                                <?php
                            if(!$r->getIsProfessional())
                            {
                                ?>
                                <p>
                                    <?=$r->getContent();?>
                                </p>
                                <?php
                                    }
                                    else
                                    {
                                        echo($r->getContent());
                                    }
                                ?>
                            </div>
                        </div>

                        <?php
                                }
                                $counter++;
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

        <div class="footer" id="footer">
            <div class="container">
                <h1>Site Updated.  Constantly.</h1>
            </div>
        </div>

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="../js/bootstrap.min.js"></script>
        <script src="/js/NPKJavaScript.js"></script>


</body>
</html>


<?php
}
?>