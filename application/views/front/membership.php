<section class="content container-fluid">
	<div class="row top banner-margin" id="top">
		<div class="col-xs-12 image-banner no-pad">
			<?php foreach($banner as $row){ ?>
			<div class="image-banner-list">
				<img src="<?php echo $row['image'];?>">
			</div>
			<?php } ?>
		</div>
	</div>

	<div class="row container services back-gradient">
		<ul class="nav nav-tabs" role="tablist">
		    <li role="presentation" class="active"><a href="#brawijayamomsclub" aria-controls="brawijayamomsclub" role="tab" data-toggle="tab">BRAWIJAYA MOM’S CLUB</a></li>
		    <li class="hide-xxs"><a href="javascript:void(0);">|</a></li>
		    <li role="presentation"><a href="#starkidzclub" aria-controls="starkidzclub" role="tab" data-toggle="tab">STAR KIDZ CLUB</a></li>
		    <li class="hide-xxs"><a href="javascript:void(0);">|</a></li>
		    <li role="presentation"><a href="#momsjourney" aria-controls="momsjourney" role="tab" data-toggle="tab">MOM'S JOURNEY</a></li>
		</ul>

		<div class="tab-content">
			<div class="col-xs-12 no-pad tab-pane active" role="tabpanel" id="brawijayamomsclub" align="center">
				<?php $getAbout1 = $this->mpost->getJoinByWhere('post.id = 715')->row_array();?>
				<?php $content1  = explode('<hr />', $getAbout1['content']);?>

				<div class="col-xs-12 no-pad" align="center">
					<h1 class="italic purple">
						<!-- <img src="<?php echo base_url('assets/img/logo/icon-momsclub.png');?>"> -->
					BRAWIJAYA MOM’S CLUB</h1>

					<?php echo $content1[0];?>
					<!-- <p class="no-marg no-pad-bottom" align="left">
						To obtain integrated antenatal programs, we are proud to present "Brawijaya Mom's Club"
						(BMC). As a member of our BMC, mother-to-be will be entitled to various facilities, such as:
						<br>
						<b>During pregnancy</b>
					</p>
					<ul class="regular liteblack" align="left">
						<li>Special price 10% off laboratory test</li>
						<li>Special price 25% off USG 4D by Fetomaternal</li>
						<li>Special price 20% off Consultation with Specialist Doctor</li>
						<li>Training and mentoring during pregnancy process and comfortable birth preparation are also
						given to Brawijaya Moms Club members in order to complete the Moms Journey program<br>
							<ul>
								<li>
									Pregnancy exercise free 1x
								</li>
								<li>
									Nutrition &amp; lactation education free 1x
								</li>
								<li>
									10% off Prenatal Gentle Yoga
								</li>
							</ul>
						<li>
						<li>Free Pass for Health Talk</li>
						<li>Pregnancy Kit</li>
					</ul> -->
				</div>		

				<div class="col-md-6 no-pad-left" align="left">
					<?php echo $content1[1];?>
					<!-- <p class="no-marg no-pad-bottom">
						<b>During hospitalization and after delivery</b>
					</p>
					<ul class="regular liteblack">
						<li>Special price 10% off Room rate (normal delivery 2 days &amp; SC 3 days)</li>
						<li>Free 1x Home Care Visit</li>
						<li>Bunch of Gift</li>
					</ul> -->
				</div>
				<div class="col-md-6 no-pad-right" align="left">
					<p class="no-marg no-pad-bottom"></p>
					<img src="<?php echo base_url('assets/img/gallery/membership.png');?>" width="60%">

					<?php echo $content1[2];?>
					<!-- <p class="no-pad pad-top-sm">
						<b class="regular purple">MEMBERSHIP REQUIREMENTS :</b>
					</p>
					<ul class="regular medium purple bold">
						<li>
							<b>	
								Members are pregnant women, patient of Brawijaya Hospital
							</b>
						</li>
						<li>
							<b>	
								Pay membership fee of IDR 1.000.000,-							
							</b>
						</li>
						<li>
							<b>	
								Members will receive complete education during pregnancy in the Moms Journey program
							</b>
						</li>
					</ul> -->
				</div>
			</div>

		    <div class="col-xs-12 no-pad tab-pane" role="tabpanel" id="starkidzclub" align="center">
				<?php $getAbout2 = $this->mpost->getJoinByWhere('post.id = 716')->row_array();?>
				<?php $content2  = explode('<hr />', $getAbout2['content']);?>

				<div class="col-xs-12 no-pad" align="center">
					<h1 class="italic purple">
						<!-- <img src="<?php echo base_url('assets/img/logo/icon-momsclub.png');?>"> -->
						STAR KIDZ CLUB</h1>

					<?php echo $content2[0];?>
					<!-- <p class="no-marg no-pad-bottom" align="left">
						Ayo, mari bergabung dengan STAR KIDZ CLUB!<br>
						Tumbuh kembang anak yang optimal di masa &quot;golden period&quot; sangat menetukan kehidupan masa hidup
						anak di masa mendatang. Stimulasi dan frekuensi yang tepat akan membuahkan bulan masa datang
						dengan kualitas yang terbaik.<br>
						Star Kidz Club hadir mendampingi Anda dalam melewati masa-masa emas si kecil, karena Smart
						Parenting means Smart &amp; Healthy Kids
					</p> -->
				</div>
				<div class="col-xs-12 no-pad pad-top-md" align="left">

					<?php echo $content2[1];?>
					<!-- <b class="regular purple">Little Star</b><br>
					<b class="regular purple">(Registration Fee IDR 1.000.000,-)</b><br>
						With benefit:
					<ul class="regular liteblack" align="left">
						<li>Special price 20% off for Neoscreening &amp; Metascreen Test</li>
						<li>Special price 10% off for Mandatory Immunization</li>
						<li>Special price 10% off for Allergy Test</li>
						<li>Free 1x Baby Gym &amp; Baby Massage (baby aged 3-6 months) with Medical Rehabilitation
						Therapist</li>
						<li>Special price 10% off Room Rate</li>
						<li>Special price 10% off OAE Medical equipment</li>
						<li>Free Pass for Health Talk</li>
						<li>Bunch of Gift</li>
					</ul> -->
				</div>

				<div class="col-md-6 no-pad-left" align="left">
					
					<?php echo $content2[2];?>
					<!-- <p class="no-marg no-pad-bottom"></p>
					<b class="regular purple">Twinkle Star</b><br>
					<b class="regular purple">(Registration Fee IDR 800.000,-)</b><br>
						With benefit:
					<ul class="regular liteblack" align="left">
						<li>Special price 10% off Immunization</li>
						<li>Special price 20% off for Dental Scaling</li>
						<li>Special price 10% off for Rom Rate</li>
						<li>Bunch of Gift</li>
					</ul> -->
				</div>
				<div class="col-md-6 no-pad-right" align="left">
					<p class="no-marg no-pad-bottom"></p>
					<img src="<?php echo base_url('assets/img/gallery/membership2.png');?>" width="60%">

					<?php echo $content2[3];?>
					<!-- <p class="no-pad pad-top-sm">
						<b class="regular purple">MEMBERSHIP REQUIREMENTS :</b>
					</p>
					<ul class="regular medium purple bold">
						<li>
							<b>
								Members are patient of BWCH age 0 to 5 y.o
							</b>
						</li>
						<li>
							<b>
								Pay membership fee
							</b>
						</li>
					</ul> -->
				</div>
		    </div>

		    <div class="col-xs-12 no-pad tab-pane" role="tabpanel" id="momsjourney" align="center">
				<?php $getAbout3 = $this->mpost->getJoinByWhere('post.id = 717')->row_array();?>
				<?php $content3  = explode('<hr />', $getAbout3['content']);?>

				<div class="col-xs-12 no-pad" align="center">
					<h1 class="italic purple">
						<!-- <img src="<?php echo base_url('assets/img/logo/icon-momsclub.png');?>"> -->
						MOM'S JOURNEY</h1>

					<?php echo $content3[0];?>
					<!-- <p class="no-marg no-pad-bottom" align="left">
						Mom’s Journey adalah salah satu program unggulan RSIA Brawijaya dimana setiap Ibu bisa mendapatkan pelayanan kehamilan yang terbaik. Layanan ini akan diberikan oleh tim dokter yang profesional dan tenaga kesehatan lain yang saling mendukung. Dokter dan petugas kesehatan kami akan selalu siap membantu calon Ibu untuk menjalani proses kehamilannya dengan melakukan anjuran pemeriksaan secara berkala, deteksi dini untuk kelainan-kelainan pada ibu dan bayi dan juga membantu persiapan proses melahirkan bagi Ibu. Layanan Mom Journey akan selalu mendampingi para Ibu selama menjalani proses kehamilan, proses persalinan dan pasca persalinan di RSIA Brawijaya.
					</p> -->
				</div>
				<div class="col-xs-12 col-md-6 no-pad pad-top-md" align="left">
					
					<?php echo $content3[1];?>
					<!-- <b class="regular purple">APA SAJA KEUNGGULAN MELAHIRKAN DI RSIA BRAWIJAYA?</b>
					<ul class="regular liteblack" align="left">
						<li>
							RSIA Brawijaya memiliki dokter – dokter professional yang siap membantu kehamilan Anda, seperti :
						</li>
						<li>
							RSIA Brawijaya memiliki Dokter Perinatologi yang profesional dan handal disertai dengan fasilitas Neonatal Intensive Care Unit yang lengkap
						</li>
						<li>
							Dokter umum, perawat, bidan, dan petugas kesehatan lainnya yang siap 24 jam
						</li>
						<li>
							Unit Gawat Darurat khusus Ibu Hamil
						</li>
						<li>
							Ruang Kamar Bersalin yang nyaman
						</li>
						<li>
							Petugas Mom Journey yang selalu mengontrol tahapan kehamilan yang dilalui para Ibu
						</li>
						<li>
							Homecare untuk perawatan Ibu pasca melahirkan dan bayi
						</li>
						<li>
							Layanan Antar Jemput Ambulance 24 jam
						</li>
						<li>
							Paket Melahirkan sesuai dengan kebutuhan anda :
						</li>
					</ul> -->
				</div>	

				<div class="col-xs-12 col-md-6 no-pad-right" align="left">
					<p class="no-marg no-pad-bottom"></p>
					<img src="<?php echo base_url('assets/img/gallery/logo_moms_journey.png');?>" width="60%">
					
					<?php echo $content3[2];?>
					<!-- <p class="no-pad pad-top-sm">
						<b class="regular purple">Untuk keterangan lebih lanjut, hubungi staff kami:</b>
					</p>
					<ul class="regular medium purple bold">
						<li>
							<b>
							Bidan Rima 0813 8541 9939 (telepon & WA only)
							</b>
						</li>
						<li>
							<b>
							Senin - Sabtu : jam 09.00-17.00
							</b>
						</li>
					</ul> -->
				</div>
		    </div>

		    <!-- <div class="col-xs-12 slide-btn" align="center">
		    	<a href="javascript:void(0);" class="slideTo" todiv="footer">SLIDE DOWN</a>			
		    </div> -->
		</div>
	</div>
</section>