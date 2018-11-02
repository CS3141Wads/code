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
        <a class="pure-menu-heading" href="">Fantasy Broomball</a>

        <ul class="pure-menu-list">
            <li class="pure-menu-item"><a href="login.php" class="pure-menu-link">Login</a></li>
            <li class="pure-menu-item"><a href="createAccount.php" class="pure-menu-link">Create an Account</a></li>
        </ul>
    </div>
</div>
</br></br>
<form class="pure-form pure-form-stacked" action="checkLogin.php" method="post">
	<fieldset>
		<div class="pure-u-1 pure-u-md-1-4" style="margin-left: 1em;">
			<label for="username">Username</label>
			<input type="email" placeholder="email@example.com" name="username" required/>
			<label for="password">Password</label>
			<input type="password" name="password" required/>
			<button type="submit" name="login" value="Login" class="pure-button pure-button-primary">Login</button>
		</div>
	</fieldset>
</form>
<form class="pure-form pure-form-stacked" action="createAccount.php">
	<fieldset>
		<div style="margin-left: 1em;">
			<label for="createAccount">Don't have an account yet?</label>
			<button type="submit" name="createAccountB" value="create" class="pure-button pure-button-primary">Create One Here</button>
		</div>
	</fieldset>
</form>

</body>
</html>
