<?php
use application\components\Controller;
use application\components\View;
use application\controllers\UserController;
use application\controllers\PictureController;

use application\components\Model;
use application\models\User;
use application\models\Picture;
?>

<section class="feed">
	<div class="feed-holder">
		<?php foreach ($vars as $val): ?>
			<div class="feed-item">
				<?php 
					$user = new User();
					$author = $user->extractLoginByPic($val['id_pic']);
				?>
				<div class="feed-item--author" data-author=<?php echo '"'.$author.'"'?>>
					<?php echo "<b>".$author."'s</b> picture"?>
				</div>
				<div class="feed-item--pic">
					<a href=<?php echo "'"."singlePhoto/".substr($val["link"], 6)."'"?>
						>>
						<img name="link" src=
						<?php echo '"'.$val['link'].'"'?>
						>
					</a>
				</div>
				<div class="feed-item--like">
					<button class="like" data-pic-id=<?php echo '"'.$val['id_pic'].'"'?>>
						<?php
							$user = new User();
							$userRow = $user->extractUserByLogin($_SESSION['authorizedUser']);
							$like = new Picture();
							if ($like->likeCheck($val['id_pic'], $userRow[0]['id']) == true)
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
			</div>
		<?php endforeach; ?>
		
		<div class="pagination-wrapper">
		  	<div class="pagination">
			    <a class="prev page-numbers" href="javascript:;">prev</a>
			    <span aria-current="page" class="page-numbers current">1</span>
			    <a class="page-numbers" href="javascript:;">2</a>
			    <a class="page-numbers" href="javascript:;">3</a>
			    <a class="page-numbers" href="javascript:;">4</a>
			    <a class="page-numbers" href="javascript:;">5</a>
			    <a class="page-numbers" href="javascript:;">6</a>
			    <a class="page-numbers" href="javascript:;">7</a>
			    <a class="page-numbers" href="javascript:;">8</a>
			    <a class="page-numbers" href="javascript:;">9</a>
			    <a class="page-numbers" href="javascript:;">10</a>
			    <a class="next page-numbers" href="javascript:;">next</a>
			</div>
		</div>
	</div>
</section>
<a href="http://localhost:8070/picture/camera" class="addPic">
	<img src="../../templates/img/cam.png">
</a>
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