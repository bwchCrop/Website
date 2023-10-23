<section class="content container-fluid">
	<div class="row container about vismiss">
	    <div class="col-xs-12 no-pad tab-pane" role="tabpanel" id="performanceboard" align="center">
			<div class="col-xs-12 header" align="center">
				<div class="col-xs-12 header-title">
					<h1 class="italic purple">PERFORMANCE</h3>
					<h1 class="italic pink">BOARD</h3>					
				</div>
			</div>
			<div class="col-xs-8 col-xs-offset-2 slider-newsevent">
				<div class="col-xs-12 slider-for">
				<?php for($i=1; $i<=14; $i++){ ?>
					<div class="col-sm-12">
						<!-- <img src="<?php echo base_url('assets/img/content/performance/perform-board-'.$i.'.jpg');?>" width="100%"> -->
						<img src="<?php echo base_url('assets/img/content/performance/2018/Slide'.$i.'.JPG');?>" width="100%">
					</div>		
				<?php } ?>
				</div>

				<div class="col-xs-12 slider-nav">
				<?php for($i=1; $i<=14; $i++){ ?>
					<div class="col-sm-3">
						<!-- <img src="<?php echo base_url('assets/img/content/performance/perform-board-'.$i.'.jpg');?>" width="100%"> -->
						<img src="<?php echo base_url('assets/img/content/performance/2018/Slide'.$i.'.JPG');?>" width="100%">
					</div>
				<?php } ?>
				</div>
			</div>
	    </div>

	    <div class="col-xs-12 slide-btn" align="center">
			<a href="javascript:void(0);" class="slideTo" todiv="footer">SLIDE DOWN</a>		    	
	    </div>
	</div>
</section>