<!DOCTYPE html>
<?php
  session_start();
 ?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A layout example that shows off a responsive product landing page.">
    <title>Login</title>
    
    <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/pure-min.css" integrity="sha384-" crossorigin="anonymous">
    
    <!--[if lte IE 8]>
        <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/grids-responsive-old-ie-min.css">
    <![endif]-->
    <!--[if gt IE 8]><!-->
        <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/grids-responsive-min.css">
    <!--<![endif]-->
    
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    
        <!--[if lte IE 8]>
            <link rel="stylesheet" href="css/layouts/marketing-old-ie.css">
        <![endif]-->
        <!--[if gt IE 8]><!-->
            <link rel="stylesheet" href="marketing.css">
        <!--<![endif]-->
</head>

<body>

<div class="header">
    <div class="home-menu pure-menu pure-menu-horizontal pure-menu-fixed">
        <a class="pure-menu-heading" href="">Fantasy Broomabll</a>

        <ul class="pure-menu-list">
            <li class="pure-menu-item"><a href="login.php" class="pure-menu-link">Login</a></li>
            <li class="pure-menu-item"><a href="createAccount.php" class="pure-menu-link">Create an Account</a></li>
        </ul>
    </div>
</div>


	<h2>Login</h2>
		<form action = "checkLogin.php" method = "post">
			Username:<br/> <input type = "email" placeholder = "email@example.com" name = "username" required/> <br/>
			Password:<br/> <input type = "password" name = "password" required/> <br/>
			<input type = "submit" name = "login" value = "Login"/>
		</form>
		<p>Don't have an account yet? <br/>
		<input name="createAccountB" type="button" value="Create one here" onclick="window.location.href='createAccount.php'"/> <br/>
		</p>
</body>
</html>
