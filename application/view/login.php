<?php
require_once('application/model/model_user.php');
$model_user = new model_user;
?>
<html>
<head>
    <title>SIGN IN</title>
    <script src="../js/jquery.min.js" type="text/javascript"></script>
    <script src="js/jquery.custom.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" media="screen" href="css/base.css"/>
</head>
<body class="login">
<div id="login">
    <h1>Barcode Scanner</h1>
    <form id="loginform" action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
        <p id="NIK">
            <input type="text" name="username" placeholder="Masukan Username Anda" required autofocus>
        </p>
        <p id="password">
            <input type="password" name="password" placeholder="Masukan Password Anda" required>
        </p>
        <input type="submit" value="SIGN IN">
    </form>
</div>
<div class="clear"></div>
<?php
ob_flush();
if ($_SERVER['REQUEST_METHOD'] == "POST")
{
    if (empty($_POST['username']) == FALSE AND empty($_POST['password']) == FALSE)
    {
        $model_user->login();
    }
    else
    {
        echo
        "<script>
                        $('#login').addClass('animated shake');
                        alert('Masukan Username / Password Anda');
                    </script>";
    }
}
?>
</body>
</html>