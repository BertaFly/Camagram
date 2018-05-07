<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="
		width=device-width,
		height=device-height,
		initial-scale=1,
		minimum-scale=1,
		maximum-scale=1,
		user-scalable=0"/>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:200,300,400,400i,500,800,800i" rel="stylesheet">
    <link rel="stylesheet" href="../templates/css/style2.css">
    <link rel="stylesheet" href="../templates/css/home.css">
    <title>Camarama</title>
</head>
<section class="login-page">
  <div class="form">
		<form class="register-form" action="create.php" method="post">
	 	<p class="register-form_title">
			Create an account
		</p>
	  	<input type="text" name="login" placeholder="username" value="" />
	  	<input type="password" name="passwd" placeholder="password" value=""/>
	  	<input type="email" name="email" placeholder="email" value=""/>
	  	<input type="text" name="name" placeholder="Name: only latin letters" value=""/>
	  	<button name="submit" value="OK" />create</button>
	  	<p class="message">Already registered? <a href="#login">Login In</a></p>
		</form>
	</div>
</section>
</html>