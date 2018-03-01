<?PHP
require_once("./include/membersite_config.php");

if(isset($_POST['submitted']))
{
    if($fgmembersite->Login())
    {
        $fgmembersite->RedirectToURL("login-home.php");

    }
}

?>
<!doctype html>
<html lang="en-US">
<head>

    <meta charset="utf-8">

    <title>Sign In</title>

    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Varela+Round">
    <link href="style/LoginStyle.css" rel="stylesheet" />
    <!--[if lt IE 9]>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <script type='text/javascript' src='scripts/gen_validatorv31.js'></script>
</head>

<body>

    <div id="login">

        <h2><span class="fontawesome-lock"></span>Sign In</h2>

        <form id="login" action="<?php echo $fgmembersite->GetSelfScript(); ?>" method="POST" accept-charset="utf-8">

            <fieldset>
                <!--
                    <input type='hidden' name='submitted' id='submitted' value='1' />
                -->
                    <div>
                    <span class='error'>
                        <?php echo $fgmembersite->GetErrorMessage(); ?>
                    </span>
                </div>
                <p>
                    <label for="username">User Name</label>
                </p>
                <p>
                    <input type="text" id="username" name="username" value="<?php echo $fgmembersite->SafeDisplay('username') ?>" onblur="if(this.value=='')this.value='User Name'" onfocus="if(this.value=='User Name')this.value=''" />
                    <span id='login_username_errorloc' class='error'></span>                
                </p><!-- JS because of IE support; better: placeholder="mail@address.com" -->

                <p>
                    <label for="password">Password</label>
                </p>
                <p>
                    <input type="password" id="password" value="password" onblur="if(this.value=='')this.value='password'" onfocus="if(this.value=='password')this.value=''" />
                    <span id='login_password_errorloc' class='error'></span>
                </p><!-- JS because of IE support; better: placeholder="password" -->

                <p>
                    <input type="submit" name="Submit" value="Sign In" />
                </p>

            </fieldset>

        </form>
        <script type='text/javascript'>

            var frmvalidator  = new Validator("login");
            frmvalidator.EnableOnPageErrorDisplay();
            frmvalidator.EnableMsgsTogether();

            frmvalidator.addValidation("username","req","Please provide your username");

            frmvalidator.addValidation("password","req","Please provide the password");

        </script>
    </div> <!-- end login -->

</body>
</html>