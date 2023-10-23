<section class="content container-fluid">
	<div class="row container services">
		<div class="col-xs-12 header titleS" align="center">
			<h1 class="italic purple">Center Of Excellence</h1>
		</div>

		<div class="tab-content">
			<div class="col-xs-12 no-pad">
				<?php foreach($services as $service): ?>
					<div class="col-sm-4 no-pad-left curs-point" onclick="loadDivPage('services','detail_services','<?= $service['post_id'];?>')">
					<a href="<?= coe_url($service); ?>">
						<div class="col-xs-12 service-list no-pad">
							<div class="container-image" align="center" style="padding-top: 37.5%;color: white;font-family: 'Quenda';font-size: 1.5em;/*font-family: 'Museo Sans 900';font-size: 1.25em;*/letter-spacing: 1px;">
								<b><?php echo strtoupper(str_replace(' (', '<br>(',$service['post_title']));?></b>
							</div>
							<img src="<?php echo $service['thumbnail'];?>" onerror="this.src='/assets/img/gallery/services-banner.jpg'">
						</div>
					</a>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</section>