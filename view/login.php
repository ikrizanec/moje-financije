<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moje financije</title>
    <link rel="stylesheet" type="text/css" href="<?php echo __SITE_URL . '/css/login.css';?>">
</head>
<body>
	<form action="<?php echo __SITE_URL . '/index.php?rt=users/login'; ?>" method="post">
		<div class="login-box">
			<h1>Login</h1>

			<div class="textbox">
				<i class="fa fa-user" aria-hidden="true"></i>
				<input type="text" placeholder="username"
						name="username" value="">
			</div>

			<div class="textbox">
				<i class="fa fa-lock" aria-hidden="true"></i>
				<input type="password" placeholder="password"
						name="password" value="">
			</div>

			<input class="button" type="submit" name="login" value="sign in">
		</div>
	</form>
</body>

</html>