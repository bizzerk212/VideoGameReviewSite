<?php
require_once("./include/membersite_config.php");

if(!$fgmembersite->CheckLogin())
{
    $fgmembersite->RedirectToURL("login.php");
    exit;
}

if(isset($_POST['update']))
{
    $dbhost = "us-cdbr-azure-central-a.cloudapp.net";
    $dbuser = 'bdb22a73230b85';
    $dbpass = '864466e8';

    $conn = mysql_connect($dbhost, $dbuser, $dbpass);

    if(! $conn ) {
        die('Could not connect: ' . mysql_error());
    }

    $avatarURL = $_POST['txtavatarurl'];
    $userEmail = $_SESSION['email_of_user'];

    $sql = 'UPDATE members SET Member_Image_Pathway = "'.mysql_real_escape_string($avatarURL).'" WHERE email = "'.mysql_real_escape_string($userEmail).'"';
    
    mysql_select_db('agiledb');
    $retval = mysql_query($sql, $conn);

    if(!$retval)
    {
        die('Could not update information: ' . mysql_error());
    }
    echo "Updated data successfully\n";

    $_SESSION['avatar_of_user'] = $avatarURL;
    mysql_close($conn);
}
?>

<html lang="en-US">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html">
    <title>Change avatar of <?= $fgmembersite->UserFullName() ?></title>
    <meta name="author" content="TeamNameTeam4">
    <link rel="shortcut icon" href="http://designshack.net/favicon.ico">
    <link rel="icon" href="http://designshack.net/favicon.ico">
    <link rel="stylesheet" type="text/css" media="all" href="style/styles.css">
    <script type="text/javascript" src="scripts/jquery-1.10.2.min.js"></script>
</head>

<body>
    <div id="topbar">
        <a href="MyAccount2.php#settings">Back to Settings</a>
    </div>
    <form id='frmChangeAvatar' name='frmChangeAvatar' action='ChangeAvatar.php' method='post'>        
        Please enter URL of your new avatar image:
        <input type="text" id="txtavatarurl" name="txtavatarurl" />
        <input id="update" name="update" type="submit" value="Update"/>
    </form>
</body>
</html>