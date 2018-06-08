<?php
use application\components\Controller;
use application\components\View;
use application\controllers\UserController;
use application\controllers\PictureController;

use application\components\Model;
use application\models\User;
use application\models\Picture;
?>

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

		<form class="subscription-preferences" action="changeSubscription" method="get">
		    <div class="switch-field">
		      <div class="switch-title">Do you want to get notifications after changing login?</div>
		      <input type="radio" id="switch_left" name="login" value="yes" checked/>
		      <label for="switch_left">Yes</label>
		      <input type="radio" id="switch_right" name="login" value="no" />
		      <label for="switch_right">No</label>
		    </div>
			
			<div class="switch-field2">
		      <div class="switch-title">Do you want to get notifications after changing password?</div>
		      <input type="radio" id="switch_left2" name="pass" value="yes" checked/>
		      <label for="switch_left2">Yes</label>
		      <input type="radio" id="switch_right2" name="pass" value="no" />
		      <label for="switch_right2">No</label>
		    </div>

		    <div class="switch-field3">
		      <div class="switch-title">Do you want to get notifications after someone comment your picture?</div>
		      <input type="radio" id="switch_left3" name="comment" value="yes" checked/>
		      <label for="switch_left3">Yes</label>
		      <input type="radio" id="switch_right3" name="comment" value="no" />
		      <label for="switch_right3">No</label>
		    </div>

		    <input type="submit" name="submit" id="change-pref" value="submit">
		    
		</form>
		
	</div>
	<div class="cabinet-pics">

		<?php foreach ($vars as $val): ?>
			<div class="feed-item top">
				<?php 
					$user = new User();
					$author = $user->extractLoginByPic($val['id_pic']);
				?>
				<div class="feed-item--dell" data-author=<?php echo '"'.$author.'"'?>>
					Dell this picture
				</div>
				<div class="feed-item--pic">
					
						<img name="link" src=
						<?php echo '"'.$val['link'].'"'?>
						>
					
				</div>
				<div class="feed-item--like">
					<button class="like" data-pic-id=<?php echo '"'.$val['id_pic'].'"'?>>
						<?php
							$user = new User();
							$userRow = $user->extractUserByLogin($_SESSION['authorizedUser']);
							$pic = new Picture();
							if ($pic->likeCheck($val['id_pic'], $userRow[0]['id']) == true)
								$like_src = '../../templates/img/like4.png';
							else
								$like_src = '../../templates/img/like3.png';
						?>
						<img src=<?php echo '"'.$like_src.'"'?>>
					</button>
				</div>
				<div class="feed-item--like-count">
					<?php echo $val['likes']?>
				</div>
				<div class="feed-item--comment">
					<?php
						$comments = $pic->extractComments($val['id_pic']);
						if ($comments != null)
						{
							foreach ($comments as $com) {
								echo "<div class='comment-row'>";
								echo "<div class='comment-who'>".$com['who_comment'].": </div>";
								echo "<div class='comment-txt'>".$com['comment_text']."</div>";
								echo "</div>";
							}
						}
						else
							echo "<div class='comment-init'>Be first who comment this photo</div>"
					?>
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
	<script type="text/javascript">
		const like_btn = document.getElementsByClassName('like');
		for (var i = 0 ; i < like_btn.length; i++) {
		   like_btn[i].addEventListener('click', like, false);
		};
		   	function like(ev){
			var item = this.getAttribute('data-pic-id');
			var body = "pic_id=" + item;
			const req = new XMLHttpRequest();
			req.open('POST', 'http://localhost:8070/picture/like');
			req.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
			req.addEventListener("load", function(event) {

				console.log("responseText:", event.target.responseText);
	            let likesNumber = event.target.responseText;

	            let button = document.querySelectorAll("[data-pic-id='" + item + "']")[0];
	            let tmp = parseInt(button.parentElement.nextElementSibling.innerHTML);
	            if (likesNumber - tmp == -1)
	            	(button.getElementsByTagName('img')[0].setAttribute('src', 'http://localhost:8070/templates/img/like4.png'));
	            else
	            	(button.getElementsByTagName('img')[0].setAttribute('src', 'http://localhost:8070/templates/img/like3.png'));
	            button.parentElement.nextElementSibling.innerHTML = likesNumber;
	        });
			req.send(body);
			};
	</script>
</div>