<section class="content container-fluid">
	<div class="row top banner-margin" id="top">
		<div class="col-xs-12 image-banner no-pad">
			
			<?php //$n=0; foreach($banner as $row){ $n++;?>
				<?php //if($n==1){ ?>
				<!-- <div class="image-banner-list">
					<img src="<?php echo $row['image'];?>">
				</div> -->
				<?php //} ?>
			<?php //} ?>
		</div>
	</div>

	<?php if($tab == 0): ?>
		<div class="row container about vismiss" style="padding: 0 10% !important;">
			<div class="col-xs-12" id="about">
				<h2 class="purple page-title text-center">WELCOME TO THE MOST "CONSTANTLY REFINED" HEALTH CARE GROUP IN INDONESIA</h2>
				<div class="text-center">
					<p style="margin: 0; padding: 10px 0 !important;">We started humbly as Brawijaya Women & Children Hospital on the 17th of September 2006, located in Antasari South Jakarta. Our commitment kept growing from providing healthcare services for Women & Children to expanding our services to General Hospitals in the most prominent areas. All the way from Jakarta to Bandung. </p>
		
					<p style="margin: 0; padding: 10px 0 !important;">Fast-moving, always upgrading, always seizing opportunities to expand our health services aggressively, we continued to reach more area coverage ¬to more areas of Jakarta and greater Jakarta like Depok and Tangerang. </p>
		
					<p style="margin: 0; padding: 10px 0 !important;">The more areas we cover, the more our services are open to everyone. From regular patients, insurance patients, to BPJS Kesehatan and BPJS Tenaga Kerja patients, we are ready to give them the health services they need and deserve.</p>
		
					<p style="margin: 0; padding: 10px 0 !important;">Brawijaya Group also extended its commitment to implement the best services for customers and stakeholders. After all, expansion would be meaningless if not accompanied with excellent services. </p>
		
					<p style="margin: 0; padding: 10px 0 !important;">We only offer fair partnerships to doctors and/or other parties. The type of partnership where we grow together. Expanding the business and healthcare services, doing it all from our hearts. 
					<br>Our strong partnership is the foundation on which we build excellent HOSPITAL WITH A HEART.	
					</p>
				</div>
			</div>
		</div>
	<?php endif; ?>

	<?php if($tab == '1'): //vision-mission ?>
		<div class="row container about vismiss">
			<div class="col-xs-12" id="visionmission">
				<?php $getAbout1 = $this->mpost->getJoinByWhere('post.id = 712')->row_array();?>
				<?php echo $getAbout1['content'];?>
			</div>
		</div>
	<?php endif; ?>

	<?php if($tab == '2'): //patient-family-rights ?>
		<div class="row container about vismiss">
			<div class="col-xs-12" id="patientfamilyrights">
				<?php $getAbout2 = $this->mpost->getJoinByWhere('post.id = 713')->row_array();?>
				<h3 class="italic purple page-title" style="text-align: center;">PATIENT & FAMILY RIGHTS</h3>
				<?php echo $getAbout2['content'];?>
			</div>
		</div>
	<?php endif; ?>

	<?php if($tab == '3'): //patient-family-obligation ?>
		<div class="row container about vismiss">
			<div class="col-xs-12" id="patientfamilyobligation">
				<?php $getAbout3 = $this->mpost->getJoinByWhere('post.id = 714')->row_array();?>
				<h3 class="italic purple page-title" style="text-align: center;">PATIENT & FAMILY OBLIGATION</h3>
				<?php echo $getAbout3['content'];?>
			</div>
		</div>
	<?php endif; ?>

	<?php if($tab == '4'): //kepuasan-pasien-dan-keluarga ?>
		<div class="row container about vismiss">
			<div class="col-12 slider-newsevent" id="kepuasanpasienkeluarga">
				<h3 class="italic purple page-title" style="text-align: center;">SERVICE QUALITY INDICATOR </h3>
					<div class="col-xs-12 slider-for">
					<?php for($i=1; $i<=3; $i++){ ?>
						<div class="col-sm-12">
							<img src="<?php echo base_url('assets/img/content/performance/2023/Slide'.$i.'.jpg');?>" width="100%">
						</div>		
					<?php } ?>
					</div>

					<div class="col-xs-12 slider-nav">
					<?php for($i=1; $i<=3; $i++){ ?>
						<div class="col-sm-3">
							<img src="<?php echo base_url('assets/img/content/performance/2023/Slide'.$i.'.jpg');?>" width="100%">
						</div>
					<?php } ?>
					</div>
			</div>
		</div>
	<?php endif; ?>
	
	
	
	
	
	


	
</section>