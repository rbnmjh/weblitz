<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--><html lang="en"><!--<![endif]-->
<head>
<meta charset="utf-8">
<title>Admin Login</title>
<link href="<?php echo Yii::app()->request->baseUrl;?>/media/stylesheet/login.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="login-wrapper">
        <div id="login">
            <h1>Login</h1>
            <div class="login-lock"><i class="icon-lock">è</i></div>
            <div id="mws-login-form">
              <?php echo $content;?>
            </div>
        </div>
    </div>
</body>
</html>