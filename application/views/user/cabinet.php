<div class="container cabinet">
	<h1 class="cabinet-title">
		Information about me
	</h1>
	<div class="cabinet-features">
		<p class="cabinet-login">
			My login: 
			<?php echo $_SESSION['authorizedUser'];?>
		</p>
		<button class="change-login" onclick="show('block', 'login');">
			Change login
		</button>
		<div id="grey" onclick="show('none', 'login')"></div>
		<button class="change-pass" onclick="show('block', 'pass');">
			Change password
		</button>
		<div id="grey" onclick="show('none', 'pass')"></div>

		<button class="change-email" onclick="show('block', 'email');">
			Change email
		</button>
		<div id="grey" onclick="show('none', 'email')"></div>
		
	</div>
	<div class="cabinet-pics">

		<?php foreach ($vars as $val): ?>
			<div class="feed-item">
				<div class="feed-item--pic">
					<img src=
						<?php echo '"'.$val['link'].'"'?>
					>
				</div>
				<div class="feed-item--like">
					<img src="../../templates/img/like5.jpg">
				</div>
				<div class="feed-item--like-count">
					<?php echo '"'.$val['likes'].'"'?>
				</div>
				<div class="feed-item--last-com">
					<p class="feed-item--comment">
						Lora: Lorem Ipsum
					</p>
				</div>
			</div>
		<?php endforeach; ?>
		
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