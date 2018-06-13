<?php 
use application\components\Model;
use application\models\Picture;
?>

<section class="camera">
	<div class="container">
		<div class="photo-holder">
			<aside class="left">
				<?php 
					$arrLayers = new Picture();
					$arrLayers = $arrLayers->getSuperposableImages();
				?>
				<div class="layers">
					<?php foreach ($arrLayers as $layer): ?>
						<input type="checkbox" id=<?='"'.$layer['id'].'"'?> name="" value="yes">
		      			<label for=<?='"'.$layer['id'].'"'?>>
		      				<img src=<?= '"'.$layer['src'].'"'?>>
		      			</label>
					<?php endforeach; ?>
				</div>

			</aside>
			<div class="video-holder">
				<video id="video" width="640" height="480" style="background-color: #000;" autoplay></video>
				<canvas id="preCanvas" width="640" height="480" style="background-color: rgba(0, 0, 0, 0.3);"></canvas>
			</div>
			<aside class="right">
				
			</aside>
		</div>
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
	navigator.getUserMedia = (navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia);
	const video = document.getElementById('video');
	const canvas = document.getElementById('canvas');
	var photo;
	const input = document.querySelector('input[type=file]');
	const sendPic = document.getElementById('sendPic');
	var inputs = document.getElementsByTagName("input"); //or document.forms[0].elements;
	var layers = []; //will contain all checkboxes
	var checked = []; //will contain all checked checkboxes
	for (var i = 0; i < inputs.length; i++) {
	  if (inputs[i].type == "checkbox") {
	    layers.push(inputs[i]);
	  }
	}
	
	for (var i = 0; i < layers.length; i++) {
		layers[i].addEventListener('click', drawLayer, false);
	};

	function drawLayer(){
		const place = document.getElementById('preCanvas');
		place.getContext("2d").clearRect( 0,0, place.width, place.height );
		var tmp = document.querySelector('label[for="' + this.getAttribute('id') + '"]');
		this.setAttribute('input', 'checked');
		tmp = tmp.childNodes[1];
		var link = tmp.getAttribute('src');
		var sticker = new Image();
		console.log(this);
		var wipe = this.getAttribute('input');
		// if (wipe != null)
			// sticker.src = link;
		// else
			// sticker.src = '';
			this.onclick = function(){
				// console.log("qewrtyq");
				this.removeAttribute('input');
			// place.getContext("2d").clearRect( 0,0, place.width, place.height );

			};
		// console.log(wipe);
		// console.log(this);

		// if (wipe != null)
		// {
			sticker.src = link;
			place.getContext("2d").drawImage(sticker, 0, 0, 380, 380);
		// }
		// else
		// 	place.getContext("2d").clearRect( 0,0, place.width, place.height );
	};

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
		var tmp = document.querySelector('input="checked"');
		tmp = tmp.childNodes[1];
		var link = tmp.getAttribute('src');
		var sticker = new Image();
		sticker.src = link;
		canvas.getContext("2d").drawImage(sticker, 0, 0, 380, 380);

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