<section class="content container-fluid">
	<!-- <div class="row top" id="top">
		<div class="col-xs-12 image-banner no-pad">
			<?php foreach($banner as $row){ ?>
			<div class="image-banner-list">
				<img src="<?php echo $row['image'];?>">
			</div>
			<?php } ?>
		</div>
	</div> -->

	<div class="row container-medium newsevent back-gradient" id="newsevent">
		<div class="col-xs-12 no-pad" align="center">
			<div class="col-xs-12" style="margin-bottom: 30px;">
				<h1 class="italic purple">
					<!-- <img class="small" src="<?php echo base_url('assets/img/logo/icon-newsevent.png');?>"> -->
					NEWS & EVENT</h1>
			</div>
			<div class="col-xs-12 outer-newsevent-list">
				<?php foreach($newsevent as $row){ ?>
				<div class="col-xs-12 newsevent-list" align="left">
					<div class="col-sm-4 col-md-3" style="padding: 15px;">
						<div class="col-sm-8 col-sm-offset-2 thumbnail-image" style="background: url('<?php echo $row['thumbnail'];?>'); background-position: center; background-size: cover;"></div>
					</div>
					<div class="thumbnail-content col-sm-8 col-md-9" align="left">
						<b><?php echo strtoupper($row['post_title']);?></b>
						<br />
						<p class="no-marg">
							<?php echo substr($row['thumbnailtext'], 0,180);?>
						</p>
						<br />
						<!-- <p class="darkgrey"><b class="small"><i>UPLOADED BY <?php echo strtoupper(($row['user'].', '.date('F d, Y',strtotime($row['date']))));?></i></b></p> -->
						<a class="home-news-link" href="<?php echo base_url('newsevent/'.$row['slug']);//('sub/detail_newsevent/1/'.$row['post_id']);?>"><i>Read More</i></a>
					</div>
				</div>
				<?php } ?>			
			</div>

			<div class="col-xs-12" align="center" style="padding-top: 30px;">
				<a class="home-news-link" limit="6" onclick="loadMore()" href="javascript:void(0);">SEE MORE</a><br>
				<a class="home-news-link" onclick="loadMore(3)" href="javascript:void(0);" style="display: none;">SEE LESS</a><br>
			</div>
		    <!-- <div class="col-xs-12 slide-btn" align="center">
		    	<a href="javascript:void(0);" class="slideTo" todiv="footer">SLIDE DOWN</a>			
		    </div> -->
		</div>
	</div>
</section>