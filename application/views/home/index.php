<section class="feed">
	<div class="feed-holder">
		<video id="video" width="640" height="480" style="background-color: #000;" autoplay></video>
		<button id="snap">Snap Photo</button>
		<canvas id="canvas" width="640" height="480" style="background-color: #000;"></canvas>
		<form enctype="multipart/form-data" method="post" action="upload">
Изображение: <input type="file" name="image" />
<input type="submit" value="Загрузить" />
</form>
		<?php foreach ($items as $val): ?>
			<div class="feed-item">
				<div class="feed-item--pic">
					<img src=
						<?php echo '"'.$val['pic'].'"'?>
					>
				</div>
				<div class="feed-item--like">
					<img src="../../templates/img/like5.jpg">
				</div>
				<div class="feed-item--like-count">

					12
				</div>
				<div class="feed-item--last-com">
					<p class="feed-item--last-com_who">

						rish
					</p>
					<p class="feed-item--last-com_text">
						Super
					</p>
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
<script type="text/javascript">
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
				var img = canvas.toDataURL("image/png");
			};
		}, function(err){alert("there was error " + err)},
	);

// 	var canvas = document.getElementById('canvas');
// var context = canvas.getContext('2d');
// var video = document.getElementById('video');

// // Trigger photo take
// document.getElementById("snap").addEventListener("click", function() {
// 	context.drawImage(video, 0, 0, 640, 480);
// });

// // Get access to the camera!
// if(navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
//     // Not adding `{ audio: true }` since we only want video now
//     navigator.mediaDevices.getUserMedia({ video: true }).then(function(stream) {
//         video.src = window.URL.createObjectURL(stream);
//         video.play();
//     });
// }
</script>