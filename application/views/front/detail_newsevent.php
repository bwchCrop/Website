<section class="content container-fluid">
	<div class="row container-large newsevent back-gradient">

		
		<div class="col-xs-12 content">
			<h2 class="no-marg pad-bottom-md">
				<?php echo $resultData['post_title'];?>
			</h2>
		</div>

		<div class="col-xs-12">
			<p class="no-pad no-marg detail-upload"">
				Upload by <?php echo $resultData['user'];?>, <?php echo $this->marge->date_ID($resultData['date'],'d F Y');?> | <?php echo date('H:i',strtotime($resultData['date']));?>
			</p>
		</div>

		<?php if((count($resultImage) == 1 && $resultImage != '') || (isset($resultData['image']) && $resultData['image'] != '')){ ?>
			<div class="col-xs-12">
				<?php 
					if(isset($resultData['image']) && $resultData['image'] != '' ){ 
						$image = $resultData['image']; 
					}else{
						$image = $resultImage[0]['postpicture'];
					}
				?>
				<div class="col-xs-12 no-pad">
					<img src="<?php echo $image;?>" width="100%">
				</div>
			</div>
		<?php } if(count($resultImage) > 1){ ?>
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
	    <!-- <div class="col-xs-12 slide-btn" align="center">
			<a href="javascript:void(0);" class="slideTo" todiv="footer">SLIDE DOWN</a>		    	
	    </div> -->
	</div>
</section>