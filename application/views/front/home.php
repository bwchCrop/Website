
<section class="revamp content container-fluid">
	<div class="row top image-banner-home" id="top">
		<div class="col-xs-12 image-banner no-pad">
			<?php foreach($banner as $row){ ?>
				<?php if(!isset($row['date']) || $row['date'] == '0000-00-00 00:00:00' || $row['date'] >= date('Y-m-d H:i:s') ){ ?>
					<div class="image-banner-list">
						<a href="<?php echo (isset($row['attach']) && $row['attach'] != '')?$row['attach']:'#';?>">
							<img src="<?php echo $row['image'];?>">
						</a>
					</div>
				<?php } ?>
			<?php } ?>
		</div>
	</div>

	<div class="container">
		<div class="row">
			<div class="col-xs-12" style="text-align: center;">
				<h1 class="italic purple">Center Of Excellence</h1>
			</div>
		</div>
		<div class="revamp-coe-wrapper">
			<?php foreach($coes as $service): ?>
				<div class="coe-box curs-point">
					<div class="coe-header">
						<div class="container-image" style="background-image: url('<?= $service['thumbnail'] ?>'), url('/assets/img/gallery/services-banner.jpg');">
						</div>
						<div class="container-image-overlay">
						</div>
					</div>
					<div class="coe-body">
						<div class="coe-body-content">
							<h4 class="purple coe-title"><?= $service['post_title'] ?></h4>
							<p class="text-justify coe-description"><?=  entity_decode(substr(strip_tags($service['thumbnailtext']), 0, 120)) .  '...' ?></p>
						</div>
						<a href="<?= coe_url($service); ?>" class="btn btn-purple coe-button">Learn More</a>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>

	<div class="container">
		<div class="revamp-promo-ig-wrapper">
			<div class="row">
				<div class="col-md-6">
					<div class="row">
						<div class="col-xs-12" style="text-align: center;">
							<h3 class="italic purple page-title">PROMO & NEWS UPDATE </h3>
						</div>
					</div>
					<div class="revamp-promo-wrapper">
						<?php foreach($offer as $row){ ?>
							<div class="promo-box">
								<div class="promo-image-wrapper">
									<img src="<?php echo $row['thumbnail'];?>" alt="">
									<!-- <div class="container-image" style="background-image: url('<?php echo $row['thumbnail'];?>');"></div> -->
								</div>
								<div class="promo-body">
									<h4 class="title">
										<?php echo $row['post_title'];?>
									</h4>
									<p class="description"><?= !empty($row['thumbnailtext']) ? $row['thumbnailtext'] : 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Accusantium qui blanditiis minus tenetur modi, quidem culpa delectus praesentium deserunt et!'; ?></p>
									<a href="#" class="link" onclick="viewPictureBtn('<?php echo $row['thumbnail'];?>','<?php echo $row['post_id'];?>','<?php echo $row['post_title'];?>','1')">Learn More</a>
								</div>
							</div>
						<?php } ?>
					</div>
				</div>
				<div class="col-md-6">
					<div class="row">
						<div class="col-xs-12" style="text-align: center;">
							<h3 class="italic purple page-title">INSTAGRAM</h3>
						</div>
					</div>
					<!-- <div class="revamp-ig-wrapper"> -->
						<!-- Place <div> tag where you want the feed to appear -->
						<div id="curator-feed-default-feed-layout"><a href="https://curator.io" target="_blank" class="crt-logo crt-tag">Powered by Curator.io</a></div>
						<?php //foreach($ig_feeds as $ig_feed): ?>
							<!-- <div class="ig-image-wrapper">
								<div class="container-image" style="background-image: url('<?php //echo $ig_feed['image'];?>');"></div>
								<div class="container-follow">
									<a title="Follow Our Instagram" target="blank" href="https://www.instagram.com/brawijaya.healthcare/"><i class="fa fa-instagram fa-3x" aria-hidden="true"></i></a>
								</div>
							</div> -->
						<?php ///endforeach; ?>
					<!-- </div> -->
					<div style="padding: 1rem;"></div>
					<div class="row">
						<div class="col-12 text-center">
							<a href="https://www.instagram.com/brawijaya.healthcare/" target="blank" class="btn btn-round btn-sm">Follow Us</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="container">
		<div class="row">
			<div class="col-xs-12" style="text-align: center;">
				<h1 class="italic purple">Video</h1>
			</div>
		</div>
		<div class="revamp-youtube">
			<div class="row">
				<!-- <div class="col-md-1"></div> -->
				<div class="col-md-6"><style>.embed-container { position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; max-width: 100%; } .embed-container iframe, .embed-container object, .embed-container embed { position: absolute; top: 0; left: 0; width: 100%; height: 100%; }</style><div class='embed-container'><iframe src='https://www.youtube.com/embed/cu1ktqm-S2s' frameborder='0' allowfullscreen></iframe></div></div>
				<div class="col-md-6"><style>.embed-container { position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; max-width: 100%; } .embed-container iframe, .embed-container object, .embed-container embed { position: absolute; top: 0; left: 0; width: 100%; height: 100%; }</style><div class='embed-container'><iframe src='https://www.youtube.com/embed/g_kvcGh8vyo' frameborder='0' allowfullscreen></iframe></div></div>
				<!-- <div class="col-md-1"></div> -->
				<!-- <div class="col-md-6"><style>.embed-container { position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; max-width: 100%; } .embed-container iframe, .embed-container object, .embed-container embed { position: absolute; top: 0; left: 0; width: 100%; height: 100%; }</style><div class='embed-container'><iframe src='https://www.youtube.com/embed/2FsB5Mqh8UI' frameborder='0' allowfullscreen></iframe></div></div> -->
			</div>
			<!-- <div style="padding: 20px;"></div>
			<div class="row">
				<div class="col-md-6"><style>.embed-container { position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; max-width: 100%; } .embed-container iframe, .embed-container object, .embed-container embed { position: absolute; top: 0; left: 0; width: 100%; height: 100%; }</style><div class='embed-container'><iframe src='https://www.youtube.com/embed/BNOXtYDzoZg' frameborder='0' allowfullscreen></iframe></div></div>
				<div class="col-md-6"><style>.embed-container { position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; max-width: 100%; } .embed-container iframe, .embed-container object, .embed-container embed { position: absolute; top: 0; left: 0; width: 100%; height: 100%; }</style><div class='embed-container'><iframe src='https://www.youtube.com/embed/cu1ktqm-S2s' frameborder='0' allowfullscreen></iframe></div></div>
			</div> -->
		</div>
	</div>

	<div class="container">
		<div class="row">
			<div class="col-xs-12" style="text-align: center;">
				<h1 class="italic purple">Patient Story</h1>
			</div>
		</div>
		<div class="revamp-testimoni-wrapper">

			<?php foreach ($patientstories as $story): ?>
				<div class="testi-box">
					<img onerror="this.src = '<?= base_url('assets/img/default.jpg'); ?>'" src="<?= $story['thumbnail']; ?>" alt="" width="40%" class="testi-profile">
					<h3 class="title"><?= $story['post_title']; ?></h3>
					<div class="rev-text">
						<?= $story['content']; ?>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
		
	</div>


</section>

<script src="<?php echo base_url('assets/front/js/jquery.min.js');?>"></script>
<!-- The Javascript can be moved to the end of the html page before the </body> tag -->
<script type="text/javascript">
/* curator-feed-default-feed-layout */
(function(){
var i,e,d=document,s="script";i=d.createElement("script");i.async=1;i.charset="UTF-8";
i.src="https://cdn.curator.io/published/864e0a7f-2583-4145-a190-4cfd142291d2.js";
e=d.getElementsByTagName(s)[0];e.parentNode.insertBefore(i, e);
})();
</script>
<script>
	$(document).ready(function(){
		$("#city").change(function(){
			$("#area").attr('disabled','disabled')

			var idlocation = $(this).val();

			$.post(
					'<?php echo base_url('home/load_area');?>',
					{idlocation:idlocation},
					function(data){
						$("#area").html(data);
						$("#area").removeAttr('disabled')
					}
			)
		});

		$("#area").change(function(){
			$("#city").attr('disabled','disabled')

			var idhospital = $(this).val();
			var idlocation = $(this).find('option:selected').attr('idlocation');

			$.post(
					'<?php echo base_url('home/load_city');?>',
					{idhospital:idhospital,idlocation:idlocation},
					function(data){
						$("#city").html(data);
						$("#city").removeAttr('disabled')
					}
			)
		});

		$(".back-form").hide();

		$("#btn-toggle-find").click(function(){
			$(".back-form").slideToggle();
		});

		$("#btn-toggle-find-header").click(function(){
			$(".back-form").slideToggle();
		});
	})
</script>