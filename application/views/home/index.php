<section class="feed">
	<div class="feed-holder">
		<!-- <video id="video" width="640" height="480" style="background-color: #000;" autoplay></video>
		<button id="snap">Snap Photo</button>
		<canvas id="canvas" width="640" height="480" style="background-color: #000;"></canvas>
		<form method="post" action="/">
			
Изображение: <input type="file" name="image" id="photo"/>
<input type="submit" value="Загрузить" /> -->

</form>
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
<!-- <script type="text/javascript">
	navigator.getUserMedia(
		{video: true}, function(stream)
		{
			var video = document.getElementById('video');
			var canvas = document.getElementById('canvas');
			var button = document.getElementById('snap');
			video.srcObject = stream;
			video.play();
			button.disabled = false;
			button.onclick = function()
			{
				canvas.getContext("2d").drawImage(video, 0, 0, 640, 480, 0, 0, 640, 480);
				var img = canvas.toDataURL();
				var XHR = new XMLHttpRequest();
				XHR.open("POST", "PictureController.php", true);
				XHR.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
				var body = 'image=' + img;
				XHR.addEventListener("load", function(event) {
                console.log(event.target.responseText);
            
        });
 XHR.send(body);


        
			};

		}, function(err){alert("there was error " + err)},
	);

	const input = document.querySelector('input[type=file]');
	input.addEventListener('change', function(ev){
		// console.log(ev);
		const files = ev.target.files;
		const file = files[0];
		const formData = new FormData();
		formData.append('photo', file);

		const req = new XMLHttpRequest();
		req.addEventListener('load', function(){
			console.log(req.responseText);
		});
		req.open('POST', 'picture/upload');
		req.send(formData);
	});
</script> -->