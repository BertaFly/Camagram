<section class="feed">
	<div class="feed-holder">

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