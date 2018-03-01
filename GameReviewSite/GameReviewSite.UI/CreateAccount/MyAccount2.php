<?PHP
require_once("./include/membersite_config.php");

if(!$fgmembersite->CheckLogin())
{
    $fgmembersite->RedirectToURL("login.php");
    exit;
}

$servername = "us-cdbr-azure-central-a.cloudapp.net";
$username = 'bdb22a73230b85';
$password = '864466e8';
$dbname = 'agiledb';

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error)
{
    die("Connection failed: " . $conn->connect_error);
}

$bannedcriticsql = "SELECT c.Critics_Name
                    FROM critics c
                    JOIN blocked_critics_junction bcj ON c.Critics_ID = bcj.Critics_ID
                    JOIN members c ON c.Member_ID = bcj.Member_ID";
$bannedcritic_result = $conn->query($sql);


?>
<!doctype html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html">
    <title>User Profile of <?= $fgmembersite->UserFullName() ?></title>
    <meta name="author" content="TeamNameTeam4">
    <link rel="shortcut icon" href="http://designshack.net/favicon.ico">
    <link rel="icon" href="http://designshack.net/favicon.ico">
    <link rel="stylesheet" type="text/css" media="all" href="style/styles.css">
    <link href="https://fonts.googleapis.com/css?family=Lato|Open+Sans|Roboto|Roboto+Slab" rel="stylesheet" />
    <link href="/css/bootstrap.css" rel="stylesheet" />
    <link href="/css/bootstrap.min.css" rel="stylesheet" />
    <link href="/css/bootstrap-theme.css" rel="stylesheet" />
    <link href="/css/bootstrap-theme.min.css" rel="stylesheet" />
    <link href="/css/NPKStyleSheet.css" rel="stylesheet" />
    <script type="text/javascript" src="scripts/jquery-1.10.2.min.js"></script>
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
                        <input class="search-bar" type="text" name="searchtext" id="searchtext" />
                        <input class="search-btn" type="submit" name="submit" id="submit" value="Search" onclick="limit()" />

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
        </div>

        <div id="w">
            <div id="content" class="clearfix">
                <div id="userphoto">
                    <img src="<?= $fgmembersite->MemberAvatar()?>" alt="default avatar" height="100" width="100" />
                </div>
                <h1>Welcome <?= $fgmembersite->UserFullName() ?></h1>

                <nav id="profiletabs">
                    <ul class="clearfix">
                        <li><a href="#activity">Activity</a></li>
                        <li><a href="#friends">Favorites</a></li>
                        <li><a href="#blocked">Blocked Users</a></li>
                        <li><a href="#settings">Settings</a></li>
                    </ul>
                </nav>

                <section id="activity">
                    <p>***This is an example***</p>
                    <p>Most recent actions:</p>

                    <p class="activity">@10:15PM - Submitted a %TYPE_OF_REVIEW% on %GAME%</p>

                    <p class="activity">@8:15PM - Posted a comment on %GAME%</p>

                    <p class="activity">@4:30PM - Blocked <strong>Troll123</strong></p>

                    <p class="activity">@12:30PM - Submitted a news article</p>
                </section>

                <section id="favoritelist" class="hidden">
                    <p>Favorites list:</p>

                    <ul id="favoritelist" class="clearfix">
                        <STRONG>Code here to display query from DB showing list of Games tagged as favorite </STRONG>
                        <!--<li><a href="#"><img src="images/avatar.png" width="22" height="22"> Username</a></li>
                        <li><a href="#"><img src="images/avatar.png" width="22" height="22"> SomeGuy123</a></li>
                        <li><a href="#"><img src="images/avatar.png" width="22" height="22"> PurpleGiraffe</a></li>-->
                    </ul>
                </section>

                <section id="blocked" class="hidden">
                    <p>Blocked Critic list:</p>
                    <ul id="blockedlist" class="clearfix">
                        <?php
                        if ($bannedcritic_result->num_rows > 0)
                        {
                            while($row = $result->fetch_assoc())
                            {
                                echo "<li><a href='#'><img src='images/blocked.jpg' width='22' height='22'>".$row["Critics_Name"];
                            }
                        }
                        ?>
                    </ul>
                </section>
                <section id="settings" class="hidden">
                    <p>Edit your user settings:</p>
                    <p class="setting"><span>E-mail Address </span><?= $fgmembersite->UserEmail() ?></p>
                    <p class="setting"><span>Password </span><a href="change-pwd.php">Change<img src="images/edit.png" alt="*Edit*" /></a></p>
                    <p class="setting"><span>Avatar </span> <img src="<?= $fgmembersite->MemberAvatar()?>" height="50" width="50" /><a href="ChangeAvatar.php"><img src="images/edit.png" alt="*Edit*" /></a></p>
                    <p class="setting">
                        <span>Language </span>
                        <select>
                            name="userLanguage">
                            <option value="English">English</option>
                            <option value="French">French</option>
                            <option value="Klingon">Klingon</option>
                            <option value="Yooper">Yooper</option>
                        </select><img src="images/edit.png" alt="*Edit*">
                    </p>
                </section>
                <!--place Save/Cancel buttons here-->
            </div><!-- @end #content -->
        </div><!-- @end #w -->
        <script type="text/javascript">
$(function(){
  $('#profiletabs ul li a').on('click', function(e){
    e.preventDefault();
    var newcontent = $(this).attr('href');
    $('#profiletabs ul li a').removeClass('sel');
    $(this).addClass('sel');
    $('#content section').each(function(){
      if(!$(this).hasClass('hidden')) { $(this).addClass('hidden'); }
    });
    $(newcontent).removeClass('hidden');
  });
});
        </script>
</body>
</html>
