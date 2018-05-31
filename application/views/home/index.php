<section class="feed">
	<div class="feed-holder">
</form>
		<?php foreach ($vars as $val): ?>
			<div class="feed-item">
				<div class="feed-item--pic">
					<img name="link" src=
						<?php echo '"'.$val['link'].'"'?>
					>
				</div>
				<div class="feed-item--like">
					<button class="like" data-pic-id=<?php echo '"'.$val['id_pic'].'"'?>>
						<img src="../../templates/img/like5.jpg">
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
	// var like_btn = document.getElementsByClassName('like');
	// for (var i = 0 ; i < like_btn.length; i++) {
	//    like_btn[i].addEventListener('click', like(like_btn[i]), false ) ; 
	// };
	// function like(event){
	// 	var item = event.querySelector('.link img')
	// 	const req = new XMLHttpRequest();
	// 	req.open('POST', 'http://localhost:8070/picture/like');
	// 	// var tmp = event.parentElement.getAttribute('src');
	// 	var body = "link=" + item;
	// 	alert(item);
		
	// 	req.addEventListener("load", function(event) {
 //            console.log(event.target.responseText);
 //        });
	// 	req.send(body);
	// };
	const like_btn = document.getElementsByClassName('like');
	for (var i = 0 ; i < like_btn.length; i++) {
	   like_btn[i].addEventListener('click', like, false);
	};
	   	function like(ev){
		// var item = ev.firstChild;
		var item = this.getAttribute('data-pic-id');
		var body = "link=" + item;
		const req = new XMLHttpRequest();
		req.open('POST', 'http://localhost:8070/picture/like');
		req.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		req.addEventListener("load", function(event) {

			console.log("responseText:", event.target.responseText);
            let likesNumber = event.target.responseText;

            let button = document.querySelectorAll("[data-pic-id='" + item + "']")[0];
            var tmp = parseInt(button.parentElement.nextElementSibling.innerHTML);
            if (likesNumber - tmp == -1)
            	(button.getElementsByTagName('img')[0].setAttribute('src', 'http://localhost:8070/templates/img/like2.jpg'));
            else
            	(button.getElementsByTagName('img')[0].setAttribute('src', 'http://localhost:8070/templates/img/like5.jpg'));
            // console.log("button:", button);
            button.parentElement.nextElementSibling.innerHTML = likesNumber;
            // var newDiv = document.createElement('div')

			// newDiv.innerHTML = event.target.responseText;
			// newDiv.appendChild(event.target);
            // event.target.innerHTML = '"' + event.target.responseText + '"';
        });
		// console.log(ev[0].childNodes[0]);
		// console.log(body);
		// console.log(ev);
		req.send(body);
		}; 

</script>