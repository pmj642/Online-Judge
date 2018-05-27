<!DOCTYPE html>

<html>
	<head>
		<title> Register </title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="assets/stylesheets/main.css">
	</head>

	<script type="text/javascript" src="assets/scripts/getTemplate.js">    </script>

	<body onload="getTemplate()">

		<!-- Header -->

        <header id="header" class="container group">        </header>

		<!-- Register -->

		<section class="row">
			<div class="container">
				<form method="post" action="register.php">

					<?php
						session_start();

						if(isset($_SESSION['msg']))
						{
							echo "<p class='reporting error'>".$_SESSION['msg']."</p>";
							unset($_SESSION['msg']);
						}
					?>

					<!-- <p class="reporting error">Username already exists!</p>
					<p class="reporting success">User created!</p> -->

					Name
					<input type="text" name="name" placeholder="Your name..." required>

					<br>Email
					<input type="email" name="email" placeholder="Your email..." required>

					<br>Password
					<input type="password" name="pass" placeholder="Password..." required>

					<br>Age
					<input type="number" name="age" min="5" max="100" placeholder="Your age..."required>

					<br>Gender
						<select name="gender" required>

							<option value="male">Male</option>
							<option value="female">Female</option>
							<option value="other">Other</option>

						</select>

					<br>Country
						<select name="country" required>

							<option value="india">India</option>
							<option value="china">China</option>
							<option value="russia">Russia</option>

						</select>

					<br>
					<input type="submit" value="Register">

				</form>

			</div>
		</section>

		<!-- Footer -->

		<footer id="footer" class="primary-footer container group">        </footer>

	</body>
</html>