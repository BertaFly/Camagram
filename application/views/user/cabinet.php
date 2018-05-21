<div class="container">
	<div class="cabinet-features">
		<button class="change-login" onclick="show('block', 'login');">
			Change login
		</button>
		<div id="grey" onclick="show('none', 'login')"></div>
		<button class="change-pass" onclick="show('block', 'pass');">
			Change password
		</button>
		<button class="change-email" onclick="show('block', 'email');">
			Change email
		</button>
	</div>
	<div class="cabinet-pics">
		<div class="user-pic">
			<img src="" alt="some photo">
			<p class="user-pic__likes">
				99 likes
			</p>
			<div class="user-pic__comments">
				some text
			</div>
		</div>
	</div>
	<div id="login">
		<div class="pop-up">
			<img src="../../../templates/img/close.png" alt="close" class="close" onclick="show('none', 'login');">
			<h2>
				Change login
			</h2>
			<form action="changeLogin" name="f1" method="post">
				<input type="text" name="loginOld" placeholder="enter current login" class="input" required/>
				<div data-tip="Input at least 5 characters">
					<input type="text" name="loginNew" placeholder="enter new login" class="input" required/>
				</div>
				<input type="submit" name="Submit" value="Submit" class="input submit" required/>
			</form>
		</div>
	</div>
	<div id="pass">
		<div class="pop-up">
			<img src="../../../templates/img/close.png" alt="close" class="close" onclick="show('none', 'pass');">
			<h2>
				Change password
			</h2>
			<form action="changePass" name="f2" method="post">
				<input type="password" name="passwdOld" placeholder="enter current password" class="input" required/>
				<div data-tip="Input at least 7 characters">
					<input type="password" name="passwdNew" placeholder="enter new password" class="input" required/>
				</div>
				<input type="submit" name="Submit" value="Submit" class="input submit" required/>
			</form>
		</div>
	</div>
	<div id="email">
		<div class="pop-up">
			<img src="../../../templates/img/close.png" alt="close" class="close" onclick="show('none', 'email');">
			<h2>
				Change email
			</h2>
			<form action="changeEmail" name="f3" method="post">
				<input type="email" name="emailOld" placeholder="enter current email" class="input" required/>
				<div data-tip="We will send you an activation link">
					<input type="email" name="emailNew" placeholder="enter new email" class="input" required/>
				</div>
				<input type="submit" name="Submit" value="Submit" class="input submit" required/>
			</form>
		</div>
	</div>
	<script>
		function show(state, str) {
			document.getElementById(str).style.display = state;	
			document.getElementById('grey').style.display = state;
		}
	</script>	
</div>