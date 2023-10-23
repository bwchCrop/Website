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
				<img src="<?php echo base_url('assets/img/hospital/web banner permata.jpg'); ?>">
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
		<h3 class="location-title"><a href="http://rspermataibu.com/" target="_blank" rel="noopener noreferrer" style="text-decoration: none; color: inherit;"><?= $title ?></a></h3>
		<p class="location-description">
			Brawijaya Hospital Tangerang merupakan Rumah Sakit Umum yang berdiri sejak 20 Mei 2011 di Kota Tangerang.
		</p>
		<p class="location-description">
			Brawijaya Hospital Tangerang memiliki layanan unggulan antara lain pusat pelayanan ibu dan anak, untuk persalinan
			dengan metode ERACS, teknik bedah katarak menggunakan metode phacoemulsifikasi, minimal invasive
			surgery (laparascopy) yang akan ditangani oleh team dokter profesional dan berpengalaman
			dibidangnya dengan didukung berbagai fasilitas terbaik.
		</p>

		<p class="location-description">
			Selain berfokus pada penyembuhan, Brawijaya Hospital Tangerang mendukung setiap pasien untuk menjalani hidup
			yang sehat dengan menyediakan beragam paket pemeriksaan kesehatan rutin seperti paket medical
			check up dan berbagai paket pemeriksanaan kesehatan lainnya.
		</p>

	</div>


	<!-- FEATURES -->
	<div class="container" id="hospital-features">
		<div class="col-md-12 no-pad">
			<h3 class="location-title">Features</h3>
			<div class="col-md-4 no-pad">
				<p class="location-services">Pusat Pelayanan Ibu dan Anak</p>
				<p class="location-services">Persalinan dengan Metode ERACS</p>
				<p class="location-services">Teknik bedah katarak dengan metode phacoemulsifikasi</p>
				<p class="location-services">Minimal invasive surgery (laparascopy)</p>
			</div>
		</div>
	</div>

	<!-- Doctors -->
	<div class="container" id="hospital-doctors">
		<h3 class="location-title">Our Doctors</h3>
		<div class="row">
			<div class="card col-12 col-md-6 col-lg-2">
				<div>
					<span class="location-doctor-spec">Obstetri & Ginekologi</span>
				</div>
			</div>
			<div class="card col-12 col-md-6 col-lg-2">
				<div>
					<span class="location-doctor-spec">Anak</span>
				</div>
			</div>
			<div class="card col-12 col-md-6 col-lg-2">
				<div>
					<!-- <img class="location-doctor-icon" src="<?php echo base_url('assets/img/gallery/category/ic_hospital.png'); ?>"> -->
					<span class="location-doctor-spec">Jantung & Pembuluh Darah</span>
				</div>
			</div>
			<div class="card col-12 col-md-6 col-lg-2">
				<div>
					<!-- <img class="location-doctor-icon" src="<?php echo base_url('assets/img/gallery/category/ic_hospital.png'); ?>"> -->
					<span class="location-doctor-spec">Mata</span>
				</div>
			</div>
			<div class="card col-12 col-md-6 col-lg-2">
				<div>
					<!-- <img class="location-doctor-icon" src="<?php echo base_url('assets/img/gallery/category/ic_hospital.png'); ?>"> -->
					<span class="location-doctor-spec">Saraf</span>
				</div>
			</div>
			<div class="card col-12 col-md-6 col-lg-2">
				<div>
					<!-- <img class="location-doctor-icon" src="<?php echo base_url('assets/img/gallery/category/ic_hospital.png'); ?>"> -->
					<span class="location-doctor-spec">Paru</span>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="card col-12 col-md-6 col-lg-2">
				<div>
					<!-- <img class="location-doctor-icon" src="<?php echo base_url('assets/img/gallery/category/ic_hospital.png'); ?>"> -->
					<span class="location-doctor-spec">THT-KL</span>
				</div>
			</div>
			<div class="card col-12 col-md-6 col-lg-2">
				<div>
					<!-- <img class="location-doctor-icon" src="<?php echo base_url('assets/img/gallery/category/ic_hospital.png'); ?>"> -->
					<span class="location-doctor-spec">Penyakit Dalam</span>
				</div>
			</div>
			<div class="card col-12 col-md-6 col-lg-2">
				<div>
					<!-- <img class="location-doctor-icon" src="<?php echo base_url('assets/img/gallery/category/ic_hospital.png'); ?>"> -->
					<span class="location-doctor-spec">Ortopedi</span>
				</div>
			</div>
			<div class="card col-12 col-md-6 col-lg-2">
				<div>
					<!-- <img class="location-doctor-icon" src="<?php echo base_url('assets/img/gallery/category/ic_hospital.png'); ?>"> -->
					<span class="location-doctor-spec">Bedah</span>
				</div>
			</div>
			<div class="card col-12 col-md-6 col-lg-2">
				<div>
					<!-- <img class="location-doctor-icon" src="<?php echo base_url('assets/img/gallery/category/ic_hospital.png'); ?>"> -->
					<span class="location-doctor-spec">Gigi & Mulut</span>
				</div>
			</div>
			<div class="card col-12 col-md-6 col-lg-2">
				<div>
					<!-- <img class="location-doctor-icon" src="<?php echo base_url('assets/img/gallery/category/ic_hospital.png'); ?>"> -->
					<span class="location-doctor-spec">Rehabilitasi Medik</span>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="card col-12 col-md-6 col-lg-2">
				<div>
					<!-- <img class="location-doctor-icon" src="<?php echo base_url('assets/img/gallery/category/ic_hospital.png'); ?>"> -->
					<span class="location-doctor-spec">Radiologi</span>
				</div>
			</div>
			<div class="card col-12 col-md-6 col-lg-2">
				<div>
					<!-- <img class="location-doctor-icon" src="<?php echo base_url('assets/img/gallery/category/ic_hospital.png'); ?>"> -->
					<span class="location-doctor-spec">Anestesi</span>
				</div>
			</div>
			<div class="card col-12 col-md-6 col-lg-2">
				<div>
					<!-- <img class="location-doctor-icon" src="<?php echo base_url('assets/img/gallery/category/ic_hospital.png'); ?>"> -->
					<span class="location-doctor-spec">Patologi Klinik</span>
				</div>
			</div>
		</div>
	</div>



	<!-- SERVICES & FACILITIES -->
	<div class="container" id="hospital-services-facilities">
		<div class="col-md-12 no-pad">
			<h3 class="location-title">Facilities</h3>
			<div class="col-md-4 no-pad">
				<p class="location-services">24 Jam Instalasi Gawat Darurat</p>
				<p class="location-services">Ruang Rawat Inap</p>
				<p class="location-services">Ruang Operasi</p>
				<p class="location-services">Ruang ICU</p>
				<p class="location-services">Ruang NICU</p>
			</div>
			<div class="col-md-4 no-pad">
				<p class="location-services">Fisioterapi</p>
				<p class="location-services">Laboratorium</p>
				<p class="location-services">Radiologi</p>
				<p class="location-services">Farmasi</p>
				<p class="location-services">Baby SPA</p>
			</div>
			<div class="col-md-4 no-pad">
				<p class="location-services">Pojok laktasi</p>
				<p class="location-services">Mushola</p>
				<p class="location-services">ATM</p>
			</div>

		</div>
	</div>


	<!-- LOCATION -->
	<!-- <div class="container" id="hospital-address">
		<div class="col-xs-12 no-pad">
			<h3 class="location-title">Location</h3>
			<p class="no-pad location-description">
				RS Permata Ibu<br />
				Jl. KH. Mas Mansyur No. 2, Kunciran<br />
				Pinang, Tangerang<br /><br />

				Phone: <a href="tel:0217300898">(021)7300898</a><br />
				Admission: <a href="tel:+622139729090">087827302941</a><br />
				Customer Relation: <a href="tel:+62811820206">081315980418</a><br />
			</p>
			<br />
			<a target="_blank" class="btn-circle" href="https://www.google.com/maps/place/RS+Permata+Ibu/@-6.2270224,106.6813258,17z/data=!3m1!4b1!4m5!3m4!1s0x2e69fa2d00298dcb:0xab0f66fdd045589c!8m2!3d-6.2270277!4d106.6835199?hl=id">Open location in Maps</a>
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