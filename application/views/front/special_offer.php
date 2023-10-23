<section class="content container-fluid">
	<div class="row top banner-margin" id="top">
		<div class="col-xs-12 image-banner no-pad">
			<?php foreach($offer as $row){ if(isset($row['image']) && $row['image'] != ''){ ?>
			<div class="image-banner-list" onclick="viewPictureBtn('<?php echo $row['thumbnail'];?>','<?php echo $row['post_id'];?>','<?php echo $row['post_title'];?>')">
				<img src="<?php echo $row['image'];?>">
			</div>
			<?php } } ?>
		</div>
	</div>

	<div class="row special-offer back-gradient" id="special-offer">
		<div class="col-xs-12" align="center">
			<h1 class="italic purple">
				<!-- <img src="<?php echo base_url('assets/img/logo/icon-offer.png');?>"/> -->
				SPECIAL OFFER</h3>
		</div>	
 
		<div class="col-xs-12 poster-slide">
			<?php foreach($offer as $row){ ?>
			<div class="col-sm-4 poster-slide-list" align="center">
				<a href="javascript:void(0);" onclick="viewPictureBtn('<?php echo $row['thumbnail'];?>','<?php echo $row['post_id'];?>','<?php echo $row['post_title'];?>','1')">
					<img src="<?php echo $row['thumbnail'];?>" width="100%">
					<p>
						<?php echo $row['post_title'];?>
					</p>
				</a>
			</div>
			<?php } ?>
		</div>

	    <!-- <div class="col-xs-12 slide-btn" align="center">
	    	<a href="javascript:void(0);" class="slideTo" todiv="footer">SLIDE DOWN</a>			
	    </div> -->
	</div>
</section>

<!-- <script type="text/javascript">
	$(document).ready(function(){
		<?php if(isset($thumbnail)){ ?>
			viewPicture("<?php echo $thumbnail;?>");
		<?php } ?>
	})
</script> -->