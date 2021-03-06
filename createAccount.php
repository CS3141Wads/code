<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A layout example that shows off a responsive product landing page.">
    <title>Create an Account</title>
    
    <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/pure-min.css" integrity="sha384-" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/grids-responsive-min.css">
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <link rel="stylesheet" href="marketing.css">
</head>
<body>

<!-- creates the top menu on the webpage with links to the homepage, the login page, and the create account page --> 
<div class="header">
    <div class="home-menu pure-menu pure-menu-horizontal pure-menu-fixed">
        <a class="pure-menu-heading" href="index.html">Fantasy Broomball</a>

        <ul class="pure-menu-list">
            <li class="pure-menu-item"><a href="login.php" class="pure-menu-link">Login</a></li>
            <li class="pure-menu-item"><a href="createAccount.php" class="pure-menu-link">Create an Account</a></li>
        </ul>
    </div>
</div>
</br></br>

<!-- Present the user with fields to create their account -->
<form class="pure-form pure-form-stacked" action = "newAccount.php" method = "post">
	<fieldset>
		<div class="pure-u-1 pure-u-md-1-4" style="margin-left: 1em;">
			<label for="name">Name</label>
			<input type =  "text" name="name" required />

			<label for="username">Username</label>
			<input type = "email" placeholder="email@example.com" name = "username" required />

			<label for="password">Password</label>
			<input type = "password" name = "password" required />

			<label for="teamName">Team Name</label>
			<input type = "text" name = "teamName" required />
            
			<button type="submit" name="createAccount" value="Create Account" class="pure-button pure-button-primary">Create Account</button>
		</div>
	</fieldset> 
</form>

</body>
</html>
