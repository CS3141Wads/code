<!DOCTYPE html>
<html>
<body>
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
