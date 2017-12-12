<?php
    session_start();
	
	if (isset($_SESSION['id'])) {
		header("Location: userportal/index.php");
	}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>Notable</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="stylesheet.css" media="screen">
	<link rel="icon" href="../favicon.ico" type="image/x-icon">
</head>

<body>
	<div id="wrapper">
		<header class="titleHeader">
			<h1 class="title">Notable</h1>
		</header>

		<div class="signinBanner">
				<form action="login.php" method="POST" class="signinForm">
					<input type="text" class="signin" name="usernameli" placeholder="Username">
					<input type="password" class="signin" name="passwordli" placeholder="Password">
					<input type="submit" id="signinbutton" value="Log In" class="btnSignin">
				</form>
		</div>



		<main class="mainBody">
			<div class="aboutwebsite">
				<h1>Welcome to Notable!</h1>
				<h3>Start keeping track of your</h3>
				<h3>tasks and reminders.</h3>
			</div>
			<div class="signupArea">
				
				<h1 class="signupFormHeader">Sign up now!</h1>
				<form action="signup.php" method="POST" class="signupForm">
					<b>First Name</b>
					<br>
					<input type="text" class="signup" name="firstnamesu">
					<br>
					<b>Last Name</b>
					<br>
					<input type="text" class="signup" name="lastnamesu">
					<br>
					<b>Email</b>
					<br>
					<input type="text" class="signup" name="emailsu">
					<br>
					<b>Username</b>
					<br>
					<input type="text" class="signup" name="usernamesu">
					<br>
					<b>Password</b>
					<br>
					<input type="password" class="signup" name="passwordsu">
					<br><br>
					<input type="submit" class="btnSignup" value="Sign Up">
				</form>
			</div>
		</main>

		<footer>
			<a></a>
		</footer>
	</div>
</body>

</html>
