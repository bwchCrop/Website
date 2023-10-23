<style>
	.thumbnail-desc p a {
		font-size: inherit !important;
	}

	.banner-single{
		max-height: 80vh;
		object-fit: cover;
		object-position: center;
	}
</style>
<section class="content container-fluid">
	<div class="row top" id="top">
		<div class="col-xs-12 image-banner no-pad">
			<?php foreach ($banner as $row) { ?>
				<div class="image-banner-list">
					<img class="banner-single" src="<?php echo $row['image']; ?>">
				</div>
			<?php } ?>
		</div>
	</div>

	<div class="row container-large location">

		<div class="col-xs-12 no-pad">
			<?php if(count($result)): ?>
				<?php foreach ($result as $row) { ?>
					<div class="col-xs-12 col-sm-6 no-pad location-list">
						<div class="col-xs-12 thumbnail-image">
							<img src="<?php echo $row['picture']; ?>" width="100%">
						</div>
						<div class="col-xs-12 thumbnail-desc">
							<b class="italic purple"><?php echo $row['namehospital']; ?></b>
							<p>
								<?php echo $row['addresshospital']; ?>
							</p>
	
							<a class="btn-gradient italic" href="<?php echo base_url('location/' . $row['mapurl']); ?>">Read More</a>
							<a class="btn-gradient italic" target="_blank" href="<?php echo $row['locationurl']; ?>">Google Maps</a>
						</div>
					</div>
				<?php } ?>
			<?php endif; ?>
		</div>
	</div>
</section>