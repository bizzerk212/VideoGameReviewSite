<?php
session_start();
require_once('./CreateAccount/include/fg_membersite.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/Classes/CGenre.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/Classes/CVideoGame.php');
//require_once(dirname(__FILE__).'./CreateAccount/include/membersite_config.php');



$Vary=false;
if($_SESSION["loggedin"]==TRUE){
    $Vary=true;
}


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
    <title>Membership Website Sample</title>
    <link rel="STYLESHEET" type="text/css" href="style/fg_membersite.css" />

    <!--Bootstrap CSS-->
    <link href="https://fonts.googleapis.com/css?family=Lato|Open+Sans|Roboto|Roboto+Slab" rel="stylesheet" />
    <link href="css/bootstrap.css" rel="stylesheet" />
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <link href="css/bootstrap-theme.css" rel="stylesheet" />
    <link href="css/bootstrap-theme.min.css" rel="stylesheet" />
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
                        <input class="search-bar" type="text" name="searchtext" id="searchtext" <?php if(isset($_GET['Search'])){ $search=$_GET['Search']; echo("value=\"$search\"");}?>/>
                        <input class="search-btn" type="submit" name="submit" id="submit" value="Search" onclick="limit()" />
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
                        <img src="/images/gears4.jpg" />
                    </div>
                    <div class="col-md-4 col-md-pull-8 col-sm-12 jumbotron-stats-box">
                        <span>Gears of War 4</span>
                        <span>Rated: R</span>
                        <span>$60:00</span>
                        <span>4 Stars</span>
                        <span>Xbox, PS4, PC</span>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <section class="main-content-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 col-md-4">
                    <div class="SideBar" id="SideBar">
                        <div class="SideBarInner" id="SideBarInner">
                            <div id="Genre">
                                <h3>Genre</h3>
                                <hr />
                                <?php
                                $genres = new CGenreList();
                                $genres->GetData();


                                foreach ($genres->Genres as $genre)
                                {
                                ?>
                                <label>
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
                                </label>
                                <input onclick="limit()" id="<?=$genre->getId();?>" type="checkbox" class="Genre" />
                                <br />
                                <?php
                                }
                                ?>

                                <!--
                            <label>FPS</label>
                            <input onclick="check()" id="fps" type="checkbox" />
                            <br />
                            <label>MMORPG</label>
                            <input onclick="check()" id="mmorpg" type="checkbox" />
                            <br />
                            <label>RPG</label>
                            <input onclick="check()" id="rpg" type="checkbox" />
                            <br />
                            <label>Sports</label>
                            <input onclick="check()" id="sports" type="checkbox" />
                            <br />
                            <label>Racing</label>
                            <input onclick="check()" id="racing" type="checkbox" />
                            -->
                            </div>

                            <div id="Price">
                                <h3>Price</h3>
                                <hr />
                                <label>$60.00 & Up USD</label>
                                <input type="radio" />
                                <br />
                                <label>$50.00 & Up USD</label>
                                <input type="radio" />
                                <br />
                                <label>$40.00 & Up USD</label>
                                <input type="radio" />
                                <br />
                                <label>$30.00 & Up USD</label>
                                <input type="radio" />
                                <br />
                                <label>$20.00 & Up USD</label>
                                <input type="radio" />
                                <br />
                                <label>Under $20.00 USD</label>
                                <input type="radio" />
                                <br />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-8">
                    <div class="gameBoxContainer" id="gameBoxContainer">
                        <?php
                        $allGames = new CVideoGameList();
                        $allGames->GetData();

                        foreach($allGames->videoGames as $g)
                        {
                        ?>

                        <div id="v<?=$g->getId();?>" class="box1 gameBox-item-outer">
                            <a href="Game.php?Id=<?=$g->getId();?>">
                                <div class="gameBox" id="<?=$g->getId();?>" style="background: url(<?=$g->getThumbnailFilepath();?>) center center no-repeat; background-size: cover;"></div>
                            </a>
                        </div>

                        <?php
                        }
                        ?>
                        <!--<div id="doom" class="box1 gameBox-item-outer">
                    <a href="Game.php?Id=1">
                        <div class="box1 gameBox" id="gameBox1"></div>
                    </a>
                </div>
                <div id="rocket-league" class="gameBox-item-outer">
                    <a href="doom.php">
                        <div class="box2 gameBox" id="gameBox2"></div>
                    </a>
                </div>
                <div id="overwatch" class="gameBox-item-outer">
                    <a href="doom.php">
                        <div class="box3 gameBox" id="gameBox10"></div>
                    </a>
                </div>
                <div id="civ-vi" class="gameBox-item-outer">
                    <a href="doom.php">
                        <div class="box4 gameBox" id="gameBox3"></div>
                    </a>
                </div>
                <div id="cod-mwr" class="FPS gameBox-item-outer">
                    <a href="doom.php">
                        <div class="box5 gameBox" id="gameBox4"></div>
                    </a>
                </div>
                <div id="skyrim-se" class="gameBox-item-outer">
                    <a href="doom.php">
                        <div class="box6 gameBox" id="gameBox5"></div>
                    </a>
                </div>
                <div id="gow4" class="gameBox-item-outer">
                    <a href="doom.php">
                        <div class="box7 gameBox" id="gameBox6"></div>
                    </a>
                </div>
                <div id="titanfall2" class="gameBox-item-outer">
                    <a href="doom.php">
                        <div class="box8 gameBox" id="gameBox7"></div>
                    </a>
                </div>
                <div id="nba-2k17" class="gameBox-item-outer">
                    <a href="doom.php">
                        <div class="box9 gameBox" id="gameBox8"></div>
                    </a>
                </div>
                <div id="fifa17" class="gameBox-item-outer">
                    <a href="doom.php">
                        <div class="box10 gameBox" id="gameBox9"></div>
                    </a>
                </div>-->
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
    
    
    <!--should be left at the bottom of the body if it can-->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>
    <script src="/js/NPKJavaScript.js"></script>
    <?php 
    if(isset($search))
    {
        
    ?>
    <script type="text/javascript">
        limit();
    </script>
    <?php
    }
    ?>
</body>
</html>