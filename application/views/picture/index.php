<section>
	<video id="video" width="640" height="480" style="background-color: #000;" autoplay></video>
		<button id="snap">Snap Photo</button>
		<canvas id="canvas" width="640" height="480" style="background-color: #000;"></canvas>
		<form method="post" action="/">
			
Изображение: <input type="file" name="image" id="photo"/>
<input type="submit" value="Загрузить" />
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
</script>