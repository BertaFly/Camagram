<section class="top" name="menu">
	<a href="http://localhost:8100/home" class="logo">
		<p>
			Cramata
		</p>
	</a>
	<nav class="menu__unknown">
		<a href="http://localhost:8100/about">
			About
		</a>
		<?php if (array_key_exists('authorizedUser', $_SESSION)): ?>
			<a href="http://localhost:8100/user/cabinet" class="login">
				<?php echo $_SESSION['authorizedUser']?>
			</a>
			<a href="http://localhost:8100/logout">
				Logout
			</a>
		<?php else: ?>
			<a href="http://localhost:8100/user/login">
				Log/Sign in
			</a>
		<?php endif; ?>
	</nav>
</section>