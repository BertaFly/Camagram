<section class="login-page">
  <div class="form">
		<form class="register-form" action="" method="post">
		 	<p class="register-form_title">
				Create an account
			</p>
			<div data-tip="Input at least 5 characters">
				<input type="text" name="login" placeholder="username" value="" required/>
			</div>
			<div data-tip="Input at least 7 characters">
				<input type="password" name="passwd" placeholder="password" title="Input at least 7 characters" value="" required/>
			</div>
			<input type="password" name="cpasswd" placeholder="confirm your password" value="" required/>
			<div data-tip="We will send you an activation link">
				<input type="email" name="email" placeholder="email" value="" required/>
			</div>
			<button type="submit" name="submit" value="OK"/>
				create
			</button>
			<p class="message">
				Already registered?
					<a href="http://localhost:8100/user/login">
						Login In
					</a>
			</p>
		</form>
	</div>
</section>