<?PHP
require_once("./include/membersite_config.php");
if(!$fgmembersite->CheckLogin())
{
    $fgmembersite->RedirectToURL("login.php");
    exit;
}
?>

<!doctype html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html">
    <title>User Profile of <?php echo $fgmembersite->UserFullName() ?></title>
    <meta name="author" content="TeamNameTeam4">
    <link rel="shortcut icon" href="http://designshack.net/favicon.ico">
    <link rel="icon" href="http://designshack.net/favicon.ico">
    <link rel="stylesheet" type="text/css" media="all" href="style/styles.css">
    <script type="text/javascript" src="scripts/jquery-1.10.2.min.js"></script>
</head>

<body>
    <div id="topbar">
        <a href="../index.php">Back to Home Page</a>
    </div>

    <div id="w">
        <div id="content" class="clearfix">
            <div id="userphoto">
            <img src="<?php echo $fgmembersite->MemberAvatar()?>" alt="default avatar" /></div>
            <h1>Minimal User Profile Layout</h1>

            <nav id="profiletabs">
                <ul class="clearfix">
                    <li><a href="#activity">Activity</a></li>
                    <li><a href="#friends">Favorites</a></li>
                    <li><a href="#blocked">Blocked Users</a></li>
                    <li><a href="#settings">Settings</a></li>
                </ul>
            </nav>

            <section id="activity">
                <p>Most recent actions:</p>

                <p class="activity">@10:15PM - Submitted a %TYPE_OF_REVIEW% on %GAME%</p>

                <p class="activity">@8:15PM - Posted a comment on %GAME%</p>

                <p class="activity">@4:30PM - Blocked <strong>Troll123</strong></p>

                <p class="activity">@12:30PM - Submitted a news article</p>
            </section>

            <section id="friends" class="hidden">
                <p>Friends list:</p>

                <ul id="friendslist" class="clearfix">
                    <li><a href="#"><img src="images/avatar.png" width="22" height="22"> Username</a></li>
                    <li><a href="#"><img src="images/avatar.png" width="22" height="22"> SomeGuy123</a></li>
                    <li><a href="#"><img src="images/avatar.png" width="22" height="22"> PurpleGiraffe</a></li>
                </ul>
            </section>

            <section id="blocked" class="hidden">
                <p>Blocked Critic list:</p>

                <ul> id="blockedlist" class="clearfix">
                    <li><a href="#"><img src="images/blocked.jpg" width="22" height="22"> Troll123</a></li>
                    <li><a href="#"><img src="images/blocked.jpg" width="22" height="22" />The_Donald</a></li>
                </ul>
            </section>

            <section id="settings" class="hidden">
                <p>Edit your user settings:</p>

                <p class="setting"><span>Change E-mail Address <img src="images/edit.png" alt="*Edit*"></span><a href="#">lolno@gmail.com</a></p>

                <p class="setting"><span>Password <img src="images/edit.png" alt="*Edit*"></span><a href="#">Change</a></p>

                <p class="setting"><span>Avatar <img src="images/edit.png" alt="*Edit*" /></span> <img src="images/avatar.png" height="50" width="50" /></p>

                <p class="setting"><span>Language <img src="images/edit.png" alt="*Edit*"></span> English(US)</p>
            </section>
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