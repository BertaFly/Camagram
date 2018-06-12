<section class="camera">
	<div class="container">
		<video id="video" width="640" height="480" style="background-color: #000;" autoplay></video>
		<div class="camera-featurs">
			<button id="snap">Snap Photo</button>
			<form method="post" action="/" class="camera-featurs--upload">
				<label for="photo" class="capture-btn">Upload file</label>
				<input type="file" id="photo" name="image" accept="image/*">
			</form>
			<button id="sendPic">post picture</button>
		</div>
			<canvas id="canvas" width="640" height="480" style="background-color: #000;"></canvas>

</div>
</section>
<script type="text/javascript">
	// navigator.getUserMedia(
	// 	{video: true}, function(stream)
	// 	{
	// 		var video = document.getElementById('video');
	// 		var canvas = document.getElementById('canvas');
	// 		var button = document.getElementById('snap');
	// 		video.srcObject = stream;
	// 		video.play();
	// 		button.disabled = false;
	// 		button.onclick = function()
	// 		{
	// 			canvas.getContext("2d").drawImage(video, 0, 0, 640, 480, 0, 0, 640, 480);
	// 			var img = canvas.toDataURL();
	// 			var XHR = new XMLHttpRequest();
	// 			XHR.open("POST", "PictureController.php", true);
	// 			XHR.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	// 			var body = 'image=' + img;
	// 			XHR.addEventListener("load", function(event) {
 //                	console.log(event.target.responseText);
			
 //       			});
 // 				XHR.send(body);
	// 		};

	// 	}, function(err){alert("there was error " + err)},
	// );

	// const input = document.querySelector('input[type=file]');
	// input.addEventListener('change', function(ev){
	// 	// console.log(ev);
	// 	const files = ev.target.files;
	// 	// console.log(files);

	// 	const file = files[0];
	// 	console.log(files);

	// 	const formData = new FormData();
	// 	formData.append('photo', file);
	// 	const req = new XMLHttpRequest();
		
	// 	req.addEventListener('load', function(){
	// 		console.log(req.responseText);
	// 	});

	// 	req.open('POST', 'http://localhost:8100/picture/upload');
	// 	req.send(formData);
	// });

	navigator.getUserMedia = (navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia);
	const video = document.getElementById('video');
	const canvas = document.getElementById('canvas');
	var photo;
	const input = document.querySelector('input[type=file]');
	const sendPic = document.getElementById('sendPic');

if (navigator.getUserMedia) {
   navigator.getUserMedia({ audio: false, video: { width: 640, height: 480 } },
	  function(stream) {
		 video.srcObject = stream;
		 video.onloadedmetadata = function(e) {
		   video.play();
		 };
	  },
	  function(err) {
		 console.log("The following error occurred: " + err.name);
	  }
   );
} else {
   console.log("getUserMedia not supported");
}

	var snap = document.getElementById('snap');
	snap.onclick = function draw(){
		canvas.getContext("2d").drawImage(video, 0, 0, 640, 480, 0, 0, 640, 480);
		photo = canvas.toDataURL();
	};

	input.addEventListener('change', function(ev){
		const files = ev.target.files;
		const file = files[0];
		var FR = new FileReader();
		FR.onload = function(e) {
		   var img = new Image();
		   img.addEventListener("load", function() {
			 canvas.getContext("2d").drawImage(img, 0, 0, 640, 480);
				photo = canvas.toDataURL();
		   });
		   img.src = e.target.result;
		};       
		FR.readAsDataURL(file);
	});

	sendPic.onclick = function(){
		if (photo != '')
		{
			const req = new XMLHttpRequest();
			req.open("POST", "PictureController.php", true);
			req.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
			var body = 'image=' + photo;
			req.addEventListener("load", function(event) {
				console.log(event.target.responseText);
		
			});
			req.send(body);
		}
	};


</script>