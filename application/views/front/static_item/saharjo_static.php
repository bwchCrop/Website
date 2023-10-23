<link rel="stylesheet" href="<?php echo base_url('assets/front/css/modal.css'); ?>" type="text/css" />
<style>
	.location-banner img {
		width: 100%;
	}
</style>
<section class="content container-fluid">

	<!-- BANNER -->
	<div class="row">
		<div class="image-banner">
			<div class="image-banner-list location-banner">
				<img src="<?php echo base_url('assets/img/hospital/web banner saharjo.jpg'); ?>">
			</div>
		</div>
	</div>


	<!-- SUB NAVIGATION -->
	<div class="container">
		<nav class="navbar" style="margin-bottom: 0;">
			<div class="collapse navbar-collapse location-subnav">
				<ul class="navbar-nav">
					<li class="nav-item marginx-2">
						<a class="nav-link" href="#hospital-info">Hospital Info</span></a>
					</li>
					<li class="nav-item marginx-2">
						<a class="nav-link" href="#hospital-features">Features</a>
					</li>
					<li class="nav-item marginx-2">
						<a class="nav-link" href="#hospital-doctors">Doctors</a>
					</li>
					<li class="nav-item marginx-2">
						<a class="nav-link" href="#hospital-services-facilities">Services & Facilities</a>
					</li>
					<!-- <li class="nav-item marginx-2">
						<a class="nav-link" href="#hospital-address">Location</a>
					</li> -->
				</ul>
			</div>
		</nav>
	</div>

	<div class="container" id="hospital-link">
		<div class="link-wrap">
			<a target="_blank" href="https://wa.me/<?= $resulthospital['whatsapp']; ?>" class="link">
				<img src="<?php echo base_url('assets/img/icons/whatsapp.png'); ?>" class="w-100">
			</a>
			<a target="_blank" href="<?= $resulthospital['instagram']; ?>" class="link">
				<img src="<?php echo base_url('assets/img/icons/instagram.png'); ?>" class="w-100">
			</a>
			<a target="_blank" href="<?= $resulthospital['facebook']; ?>" class="link">
				<img src="<?php echo base_url('assets/img/icons/facebook.png'); ?>" class="w-100">
			</a>
			<a target="_blank" href="<?= $resulthospital['locationurl']; ?>" class="link">
				<img src="<?php echo base_url('assets/img/icons/location.png'); ?>" class="w-100">
			</a>

		</div>
	</div>


	<!-- DESCRIPTION -->
	<div class="container" id="hospital-info">
		<h3 class="location-title"><?= $title ?></h3>
		<p class="location-description">
			Brawijaya Hospital Saharjo memiliki layanan unggulan antara lain pusat layanan jantung terpadu yang bekerjasama dengan heartology, minimally invasive surgery, oncology center, pain clinic & endoscopy centre yang akan ditangani oleh team dokter profesional dan berpengalaman dibidangnya dengan didukung berbagai fasilitas terbaik.
		</p>
		<p class="location-description">
			Melalui konsep healthy life style dengan gaya arsitektur dan design semi outdoor, memadukan konsep gaya hidup dan rumah sakit dengan harapan dapat memberikan kenyamanan dan healing ambience lebih bagi pasien dan keluarga.
		</p>
	</div>


	<!-- FEATURES -->
	<div class="container" id="hospital-features">
		<h3 class="location-title">Features</h3>
		<div class="media-container-row slider autoplay">
			<div class="card p-3 col-12 col-md-6 col-lg-3">

				<div class="card-wrapper">
					<div class="card-img">
						<a href="<?php echo base_url('assets/static_page/hospital_features/heart_center.html'); ?>" rel="modal:open">
							<img class="img-responsive location-feature-img" src="<?php echo base_url('assets/img/gallery/up_heartcenter.jpg'); ?>">
						</a>
					</div>
					<div class="card-box">
						<h4 class="location-description">PUSAT LAYANAN JANTUNG TERPADU (CARDIOVASCULAR CENTER)</h4>
					</div>
				</div>
			</div>

			<div class="card p-3 col-12 col-md-6 col-lg-3">
				<div class="card-wrapper">
					<div class="card-img">

						<a href="<?php echo base_url('assets/static_page/hospital_features/mis.html'); ?>" rel="modal:open">
							<img class="img-responsive location-feature-img" src="<?php echo base_url('assets/img/gallery/up_mis.jpg'); ?>">
						</a>
					</div>
					<div class="card-box">
						<h4 class="location-description">MINIMALLY INVASIVE SURGERY (MIS)</h4>
					</div>
				</div>
			</div>

			<div class="card p-3 col-12 col-md-6 col-lg-3">
				<div class="card-wrapper">
					<div class="card-img">

						<a href="<?php echo base_url('assets/static_page/hospital_features/pain_clinic.html'); ?>" rel="modal:open">
							<img class="img-responsive location-feature-img" src="<?php echo base_url('assets/img/gallery/up_painclinic.jpg'); ?>">
						</a>
					</div>
					<div class="card-box">
						<h4 class="location-description">PAIN CLINIC</h4>
					</div>
				</div>
			</div>

			<div class="card p-3 col-12 col-md-6 col-lg-3">
				<div class="card-wrapper">
					<div class="card-img">
						<a href="<?php echo base_url('assets/static_page/hospital_features/endoscopy_center.html'); ?>" rel="modal:open">
							<img class="img-responsive location-feature-img" src="<?php echo base_url('assets/img/gallery/up_endoscopy.jpg'); ?>">
						</a>
					</div>
					<div class="card-box">
						<h4 class="location-description">ENDOSCOPY CENTER</h4>
					</div>
				</div>
			</div>

			<div class="card p-3 col-12 col-md-6 col-lg-3">
				<div class="card-wrapper">
					<div class="card-img">
						<a href="<?php echo base_url('assets/static_page/hospital_features/oncology_center.html'); ?>" rel="modal:open">
							<img class="img-responsive location-feature-img" src="<?php echo base_url('assets/img/gallery/up_oncology.jpg'); ?>">
						</a>
					</div>
					<div class="card-box">
						<h4 class="location-description">ONCOLOGY CENTER</h4>
					</div>
				</div>
			</div>
		</div>
	</div>


	<!-- Doctors -->
	<div class="container" id="hospital-doctors">
		<h3 class="location-title">Our Doctors</h3>
		<div class="row">
			<div class="card p-3 col-12 col-md-6 col-lg-2">
				<a href="<?php echo base_url('assets/static_page/akupuntur/index.php'); ?>" rel="modal:open">
					<div>
						<!-- <img class="location-doctor-icon" src="<?php echo base_url('assets/img/gallery/category/ic_hospital.png'); ?>"> -->
						<span class="location-doctor-spec">Akupuntur</span>
					</div>
				</a>
			</div>
			<div class="card p-3 col-12 col-md-6 col-lg-2">
				<a href="<?php echo base_url('assets/static_page/anak/index.php'); ?>" rel="modal:open">
					<div>
						<!-- <img class="location-doctor-icon" src="<?php echo base_url('assets/img/gallery/category/ic_hospital.png'); ?>"> -->
						<span class="location-doctor-spec">Anak</span>
					</div>
				</a>
			</div>
			<div class="card p-3 col-12 col-md-6 col-lg-2">
				<a href="<?php echo base_url('assets/static_page/anestesi/index.php'); ?>" rel="modal:open">
					<div>
						<!-- <img class="location-doctor-icon" src="<?php echo base_url('assets/img/gallery/category/ic_hospital.png'); ?>"> -->
						<span class="location-doctor-spec">Anestesi</span>
					</div>
				</a>
			</div>
			<div class="card p-3 col-12 col-md-6 col-lg-2">
				<a href="<?php echo base_url('assets/static_page/bedah/index.php'); ?>" rel="modal:open">
					<div>
						<!-- <img class="location-doctor-icon" src="<?php echo base_url('assets/img/gallery/category/ic_hospital.png'); ?>"> -->
						<span class="location-doctor-spec">Bedah</span>
					</div>
				</a>
			</div>
			<div class="card p-3 col-12 col-md-6 col-lg-2">
				<a href="<?php echo base_url('assets/static_page/bedah_plastik/index.php'); ?>" rel="modal:open">
					<div>
						<!-- <img class="location-doctor-icon" src="<?php echo base_url('assets/img/gallery/category/ic_hospital.png'); ?>"> -->
						<span class="location-doctor-spec">Bedah Plastik</span>
					</div>
				</a>
			</div>
			<div class="card p-3 col-12 col-md-6 col-lg-2">
				<a href="<?php echo base_url('assets/static_page/bedah_saraf/index.php'); ?>" rel="modal:open">
					<div>
						<!-- <img class="location-doctor-icon" src="<?php echo base_url('assets/img/gallery/category/ic_hospital.png'); ?>"> -->
						<span class="location-doctor-spec">Bedah Saraf</span>
					</div>
				</a>
			</div>

			<!-- <div class="card p-3 col-12 col-md-6 col-lg-2">
					<a href="<?php echo base_url('assets/static_page/anak/index.php'); ?>" rel="modal:open">
						<div class="card-wrapper">
							<div class="card-img location-doctor-category">
								<img class="img-responsive" src="<?php echo base_url('assets/img/gallery/category/ic_anesthesia.png'); ?>">
								<h4>Anak</h4>
							</div>
						</div>
					</a>
				</div>

				<div class="card p-3 col-12 col-md-6 col-lg-2">
					<a href="<?php echo base_url('assets/static_page/anestesi/index.php'); ?>" rel="modal:open">
						<div class="card-wrapper">
							<div class="card-img location-doctor-category">
								<img class="img-responsive" src="<?php echo base_url('assets/img/gallery/category/ic_anesthesia.png'); ?>">
								<h4>Anestesi</h4>
							</div>
						</div>
					</a>
				</div>
			
				<div class="card p-3 col-12 col-md-6 col-lg-2">
					<a href="<?php echo base_url('assets/static_page/bedah/index.php'); ?>" rel="modal:open">
					<div class="card-wrapper">
							<div class="card-img location-doctor-category">
								<img class="img-responsive" src="<?php echo base_url('assets/img/gallery/category/ic_anesthesia.png'); ?>">
								<h4>Bedah</h4>
							</div>
						</div>
					</a>
				</div>

				<div class="card p-3 col-12 col-md-6 col-lg-2">
					<a href="<?php echo base_url('assets/static_page/bedah_plastik/index.php'); ?>" rel="modal:open">
					<div class="card-wrapper">
							<div class="card-img location-doctor-category">
								<img class="img-responsive" src="<?php echo base_url('assets/img/gallery/category/ic_anesthesia.png'); ?>">
								<h4>Bedah Plastik</h4>
							</div>
						</div>
					</a>
				</div>

				<div class="card p-3 col-12 col-md-6 col-lg-2">
					<a href="<?php echo base_url('assets/static_page/bedah_saraf/index.php'); ?>" rel="modal:open">
					<div class="card-wrapper">
							<div class="card-img location-doctor-category">
								<img class="img-responsive" src="<?php echo base_url('assets/img/gallery/category/ic_anesthesia.png'); ?>">
								<h4>Bedah Saraf</h4>
							</div>
						</div>
					</a>
				</div> -->
		</div>
		<div class="row">
			<div class="card p-3 col-12 col-md-6 col-lg-2">
				<a href="<?php echo base_url('assets/static_page/bedah_kardiak/index.php'); ?>" rel="modal:open">
					<div>
						<!-- <img class="location-doctor-icon" src="<?php echo base_url('assets/img/gallery/category/ic_hospital.png'); ?>"> -->
						<span class="location-doctor-spec">Bedah Torak, Kardiak & Vaskuler</span>
					</div>
				</a>
			</div>
			<div class="card p-3 col-12 col-md-6 col-lg-2">
				<a href="<?php echo base_url('assets/static_page/dental/index.php'); ?>" rel="modal:open">
					<div>
						<!-- <img class="location-doctor-icon" src="<?php echo base_url('assets/img/gallery/category/ic_hospital.png'); ?>"> -->
						<span class="location-doctor-spec">Gigi & Mulut</span>
					</div>
				</a>
			</div>
			<div class="card p-3 col-12 col-md-6 col-lg-2">
				<a href="<?php echo base_url('assets/static_page/gizi_klinik/index.php'); ?>" rel="modal:open">
					<div>
						<!-- <img class="location-doctor-icon" src="<?php echo base_url('assets/img/gallery/category/ic_hospital.png'); ?>"> -->
						<span class="location-doctor-spec">Gizi Klinik</span>
					</div>
				</a>
			</div>
			<div class="card col-12 col-md-6 col-lg-2">
				<a href="<?php echo base_url('assets/static_page/jantung_pembuluh_darah/index.php'); ?>" rel="modal:open">
					<div>
						<!-- <img class="location-doctor-icon" src="<?php echo base_url('assets/img/gallery/category/ic_hospital.png'); ?>"> -->
						<span class="location-doctor-spec">Jantung & Pembuluh Darah</span>
					</div>
				</a>
			</div>
			<div class="card col-12 col-md-6 col-lg-2">
				<a href="<?php echo base_url('assets/static_page/kesehatan_jiwa/index.php'); ?>" rel="modal:open">
					<div>
						<!-- <img class="location-doctor-icon" src="<?php echo base_url('assets/img/gallery/category/ic_hospital.png'); ?>"> -->
						<span class="location-doctor-spec">Kesehatan Jiwa</span>
					</div>
				</a>
			</div>
			<div class="card col-12 col-md-6 col-lg-2">
				<a href="<?php echo base_url('assets/static_page/kulit_kelamin/index.php'); ?>" rel="modal:open">
					<div>
						<!-- <img class="location-doctor-icon" src="<?php echo base_url('assets/img/gallery/category/ic_hospital.png'); ?>"> -->
						<span class="location-doctor-spec">Kulit & Kelamin</span>
					</div>
				</a>
			</div>
		</div>

		<div class="row">
			
			
			<div class="card p-3 col-12 col-md-6 col-lg-2">
				<a href="<?php echo base_url('assets/static_page/mata/index.php'); ?>" rel="modal:open">
					<div>
						<!-- <img class="location-doctor-icon" src="<?php echo base_url('assets/img/gallery/category/ic_hospital.png'); ?>"> -->
						<span class="location-doctor-spec">Mata</span>
					</div>
				</a>
			</div>
			<div class="card p-3 col-12 col-md-6 col-lg-2">
				<a href="<?php echo base_url('assets/static_page/obsgyn/index.php'); ?>" rel="modal:open">
					<div>
						<!-- <img class="location-doctor-icon" src="<?php echo base_url('assets/img/gallery/category/ic_hospital.png'); ?>"> -->
						<span class="location-doctor-spec">Obstetri & Ginekologi</span>
					</div>
				</a>
			</div>
			<div class="card p-3 col-12 col-md-6 col-lg-2">
				<a href="<?php echo base_url('assets/static_page/ortopedi/index.php'); ?>" rel="modal:open">
					<div>
						<!-- <img class="location-doctor-icon" src="<?php echo base_url('assets/img/gallery/category/ic_hospital.png'); ?>"> -->
						<span class="location-doctor-spec">Ortopedi</span>
					</div>
				</a>
			</div>
			<div class="card p-3 col-12 col-md-6 col-lg-2">
				<a href="<?php echo base_url('assets/static_page/paru/index.php'); ?>" rel="modal:open">
					<div>
						<!-- <img class="location-doctor-icon" src="<?php echo base_url('assets/img/gallery/category/ic_hospital.png'); ?>"> -->
						<span class="location-doctor-spec">Paru</span>
					</div>
				</a>
			</div>
			<div class="card col-12 col-md-6 col-lg-2">
				<a href="<?php echo base_url('assets/static_page/patologi_anatomi/index.php'); ?>" rel="modal:open">
					<div>
						<!-- <img class="location-doctor-icon" src="<?php echo base_url('assets/img/gallery/category/ic_hospital.png'); ?>"> -->
						<span class="location-doctor-spec">Patologi Anatomi</span>
					</div>
				</a>
			</div>
			<div class="card col-12 col-md-6 col-lg-2">
				<a href="<?php echo base_url('assets/static_page/patologi_klinik/index.php'); ?>" rel="modal:open">
					<div>
						<!-- <img class="location-doctor-icon" src="<?php echo base_url('assets/img/gallery/category/ic_hospital.png'); ?>"> -->
						<span class="location-doctor-spec">Patologi Klinik</span>
					</div>
				</a>
			</div>
		</div>
		<div class="row">
			
			<div class="card col-12 col-md-6 col-lg-2">
				<a href="<?php echo base_url('assets/static_page/penyakit_dalam/index.php'); ?>" rel="modal:open">
					<div>
						<!-- <img class="location-doctor-icon" src="<?php echo base_url('assets/img/gallery/category/ic_hospital.png'); ?>"> -->
						<span class="location-doctor-spec">Penyakit Dalam</span>
					</div>
				</a>
			</div>
			<div class="card p-3 col-12 col-md-6 col-lg-2">
				<a href="<?php echo base_url('assets/static_page/radiologi/index.php'); ?>" rel="modal:open">
					<div>
						<!-- <img class="location-doctor-icon" src="<?php echo base_url('assets/img/gallery/category/ic_hospital.png'); ?>"> -->
						<span class="location-doctor-spec">Radiologi</span>
					</div>
				</a>
			</div>
			<div class="card p-3 col-12 col-md-6 col-lg-2">
				<a href="<?php echo base_url('assets/static_page/rehabilitasi_medik/index.php'); ?>" rel="modal:open">
					<div>
						<!-- <img class="location-doctor-icon" src="<?php echo base_url('assets/img/gallery/category/ic_hospital.png'); ?>"> -->
						<span class="location-doctor-spec">Rehabilitasi Medik</span>
					</div>
				</a>
			</div>
			<div class="card p-3 col-12 col-md-6 col-lg-2">
				<a href="<?php echo base_url('assets/static_page/saraf/index.php'); ?>" rel="modal:open">
					<div>
						<!-- <img class="location-doctor-icon" src="<?php echo base_url('assets/img/gallery/category/ic_hospital.png'); ?>"> -->
						<span class="location-doctor-spec">Saraf</span>
					</div>
				</a>
			</div>
			<div class="card col-12 col-md-6 col-lg-2">
				<a href="<?php echo base_url('assets/static_page/tht_kl/index.php'); ?>" rel="modal:open">
					<div>
						<!-- <img class="location-doctor-icon" src="<?php echo base_url('assets/img/gallery/category/ic_hospital.png'); ?>"> -->
						<span class="location-doctor-spec">THT-KL</span>
					</div>
				</a>
			</div>
			<div class="card col-12 col-md-6 col-lg-2">
				<a href="<?php echo base_url('assets/static_page/urologi/index.php'); ?>" rel="modal:open">
					<div>
						<!-- <img class="location-doctor-icon" src="<?php echo base_url('assets/img/gallery/category/ic_hospital.png'); ?>"> -->
						<span class="location-doctor-spec">Urologi</span>
					</div>
				</a>
			</div>
		</div>
	</div>


	<!-- SERVICES & FACILITIES -->
	<div class="container" id="hospital-services-facilities">
		<div class="col-md-12 no-pad">
			<h3 class="location-title">Facilities</h3>
			<div class="col-md-4 no-pad">
				<p class="location-services">24 hour Emergency</p>
				<p class="location-services">Ambulance</p>
				<p class="location-services"><a class="link" href="<?php echo base_url('assets/static_page/hospital_features/mri.html'); ?>" rel="modal:open">MRI 1.5 Tesla</a></p>
				<p class="location-services"><a class="link" href="<?php echo base_url('assets/static_page/hospital_features/msct.html'); ?>" rel="modal:open">CT Scan 128 slice</a></p>
			</div>
			<div class="col-md-4 no-pad">
				<p class="location-services">Hybrid Operating Room</p>
				<p class="location-services">Clinical Pathology Laboratory</p>
				<p class="location-services">Pathology Laboratory</p>
				<p class="location-services">X Ray</p>
			</div>
			<div class="col-md-4 no-pad">
				<p class="location-services"><a class="link" href="<?php echo base_url('assets/static_page/hospital_features/abus.html'); ?>" rel="modal:open">ABUS (Automated Breast Ultrasound)</a></p>
				<p class="location-services">Panoramic Dental X-Ray & Cephalometry</p>
				<p class="location-services">Catheterization Lab</p>
			</div>

		</div>
	</div>


	<!-- LOCATION -->
	<!-- <div class="container" id="hospital-address">
		<div class="col-xs-12 no-pad">
			<h3 class="location-title">Location</h3>
			<p class="no-pad location-description">
				Brawijaya Hospital Saharjo<br />
				Jl. DR. Saharjo No.199, Tebet Barat<br />
				Tebet, Jakarta Selatan 12810<br /><br />

				Customer Service: <a href="tel:+622139737890">021-397 37890</a><br />
				Emergency: <a href="tel:+622139729090">021-397 29090</a><br />
				WhatsApp: <a href="tel:+62811820206">0811 820 206</a><br />
				Email: <a href="mailto:admin@rsbrawijayasaharjo.com">admin@rsbrawijayasaharjo.com</a><br />
			</p>
			<br />
			<a class="btn-circle" href="https://goo.gl/maps/4HNfhX2wX8874Lih8">Open location in Maps</a>
		</div>
	</div> -->

	<br />
	<br />
	<br />
</section>

<script>
	$('.autoplay').slick({
		slidesToShow: 3,
		slidesToScroll: 1,
		autoplay: true,
		autoplaySpeed: 2000,
	});
</script>