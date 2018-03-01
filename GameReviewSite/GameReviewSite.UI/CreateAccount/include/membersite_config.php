<?PHP
require_once("fg_membersite.php");

$fgmembersite = new FGMembersite();

//Provide your site name here
$fgmembersite->SetWebsiteName('Team Name Team 4');

//Provide the email address where you want to get notifications
$fgmembersite->SetAdminEmail('mfschoofs@gmail.com');

//Provide your database login details here:
//hostname, user name, password, database name and table name
//note that the script will create the table (for example, fgusers in this case)
//by itself on submitting register.php for the first time
$fgmembersite->InitDB(/*hostname*/'us-cdbr-azure-central-a.cloudapp.net',
                      /*username*/'bdb22a73230b85',
                      /*password*/'864466e8',
                      /*database name*/'agiledb',
                      /*table name*/'members');

//For better security. Get a random string from this link: http://tinyurl.com/randstr
// and put it here
$fgmembersite->SetRandomKey('qSRcVS6DrTzrPvr');

?>