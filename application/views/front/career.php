<section class="content container-fluid">
	<div class="row container-large newsevent back-gradient">
		<div class="col-xs-12 content">
			<h2 class="no-marg italic purple pad-bottom-md">
				<?php echo $resultData['post_title'];?>
			</h2>
		</div>

		<?php if(count($resultImage) == 1 && $resultImage != ''){ ?>
			<div class="col-xs-12">
				<?php if(is_array($resultData['image'])): ?>
					<?php if(count($resultData['image']) > 0){ ?>
						<div class="col-xs-12 no-pad">
							<img src="<?php echo $resultData['image'];?>" width="100%">
						</div>
					<?php } ?>
				<?php else: ?>
					<div class="col-xs-12 no-pad">
						<img src="<?php echo $resultData['image'];?>" width="100%">
					</div>
				<?php endif; ?>
				
			</div>
		<?php }if(count($resultImage) > 1){ ?>
			<div class="col-xs-12 slider-newsevent">
				<div class="col-xs-12 slider-for">
				<?php foreach($resultImage as $row){ ?>
					<div class="col-sm-12">
						<img src="<?php echo $row['postpicture'];?>" width="100%">
					</div>		
				<?php } ?>
				</div>

				<div class="col-xs-12 slider-nav">
				<?php foreach($resultImage as $row){ ?>
					<div class="col-sm-3">
						<img src="<?php echo $row['postpicture'];?>" width="100%">
					</div>
				<?php } ?>
				</div>
			</div>
		<?php } ?>

		<div class="col-xs-12 content">
			<?php echo $resultData['content'];?>
		</div>
	</div>
</section>