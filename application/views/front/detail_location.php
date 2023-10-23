<style>
	.blocker {
		position: fixed;
		top: 0;
		right: 0;
		bottom: 0;
		left: 0;
		width: 100%;
		height: 100%;
		overflow: auto;
		z-index: 100;
		padding: 20px;
		box-sizing: border-box;
		background-color: #000;
		background-color: rgba(0, 0, 0, 0.75);
		text-align: center;
	}
	.blocker .modal {
		display: none;
		vertical-align: middle;
		position: relative;
		z-index: 100;
		max-width: 500px;
		box-sizing: border-box;
		width: 90%;
		background: #fff;
		padding: 15px 30px;
		-webkit-border-radius: 8px;
		-moz-border-radius: 8px;
		-o-border-radius: 8px;
		-ms-border-radius: 8px;
		border-radius: 8px;
		-webkit-box-shadow: 0 0 10px #000;
		-moz-box-shadow: 0 0 10px #000;
		-o-box-shadow: 0 0 10px #000;
		-ms-box-shadow: 0 0 10px #000;
		box-shadow: 0 0 10px #000;
		text-align: left;
	}

	.blocker .modal a.close-modal {
		position: absolute;
		top: -12.5px;
		right: -12.5px;
		display: block;
		width: 30px;
		height: 30px;
		text-indent: -9999px;
		background-size: contain;
		background-repeat: no-repeat;
		background-position: center center;
		background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADwAAAA8CAYAAAA6/NlyAAAAAXNSR0IArs4c6QAAA3hJREFUaAXlm8+K00Acx7MiCIJH/yw+gA9g25O49SL4AO3Bp1jw5NvktC+wF88qevK4BU97EmzxUBCEolK/n5gp3W6TTJPfpNPNF37MNsl85/vN/DaTmU6PknC4K+pniqeKJ3k8UnkvDxXJzzy+q/yaxxeVHxW/FNHjgRSeKt4rFoplzaAuHHDBGR2eS9G54reirsmienDCTRt7xwsp+KAoEmt9nLaGitZxrBbPFNaGfPloGw2t4JVamSt8xYW6Dg1oCYo3Yv+rCGViV160oMkcd8SYKnYV1Nb1aEOjCe6L5ZOiLfF120EjWhuBu3YIZt1NQmujnk5F4MgOpURzLfAwOBSTmzp3fpDxuI/pabxpqOoz2r2HLAb0GMbZKlNV5/Hg9XJypguryA7lPF5KMdTZQzHjqxNPhWhzIuAruOl1eNqKEx1tSh5rfbxdw7mOxCq4qS68ZTjKS1YVvilu559vWvFHhh4rZrdyZ69Vmpgdj8fJbDZLJpNJ0uv1cnr/gjrUhQMuI+ANjyuwftQ0bbL6Erp0mM/ny8Fg4M3LtdRxgMtKl3jwmIHVxYXChFy94/Rmpa/pTbNUhstKV+4Rr8lLQ9KlUvJKLyG8yvQ2s9SBy1Jb7jV5a0yapfF6apaZLjLLcWtd4sNrmJUMHyM+1xibTjH82Zh01TNlhsrOhdKTe00uAzZQmN6+KW+sDa/JD2PSVQ873m29yf+1Q9VDzfEYlHi1G5LKBBWZbtEsHbFwb1oYDwr1ZiF/2bnCSg1OBE/pfr9/bWx26UxJL3ONPISOLKUvQza0LZUxSKyjpdTGa/vDEr25rddbMM0Q3O6Lx3rqFvU+x6UrRKQY7tyrZecmD9FODy8uLizTmilwNj0kraNcAJhOp5aGVwsAGD5VmJBrWWbJSgWT9zrzWepQF47RaGSiKfeGx6Szi3gzmX/HHbihwBser4B9UJYpFBNX4R6vTn3VQnez0SymnrHQMsRYGTr1dSk34ljRqS/EMd2pLQ8YBp3a1PLfcqCpo8gtHkZFHKkTX6fs3MY0blKnth66rKCnU0VRGu37ONrQaA4eZDFtWAu2fXj9zjFkxTBOo8F7t926gTp/83Kyzzcy2kZD6xiqxTYnHLRFm3vHiRSwNSjkz3hoIzo8lCKWUlg/YtGs7tObunDAZfpDLbfEI15zsEIY3U/x/gHHc/G1zltnAgAAAABJRU5ErkJggg==);
	}
	.location-banner img {
		width: 100%;
	}

	#hospital-doctors .card{
		padding: 0px;
	}

	#hospital-doctors .card span.location-doctor-spec {
		margin: 0 0 10px;
		font-family: 'Roboto';
		letter-spacing: 1px;
		line-height: 1.65em;
		text-align: left;
		display: inline-block;
	}
</style>
<section class="content container-fluid">
	<div class="row top banner-margin" id="top">
		<div class="col-xs-12 image-banner no-pad">
			<?php echo ''; ?>
			<div class="image-banner-list location-banner">
				<img src="<?php echo $resulthospital['image']; ?>">
			</div>
			<?php echo ''; ?>
		</div>
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
		<h3 class="location-title"><?php echo strtoupper($resulthospital['namehospital']); ?></h3>
		<p class="location-description">
			<?php echo nl2br($resulthospital['description']); ?>
		</p>
	</div>

	<!-- Features -->
	<?php if($id == 7): ?>
		<div class="container" id="hospital-features">
			<h3 class="location-title">Center Of Excelences</h3>
			<div class="row" style="display: flex; flex-wrap: wrap;">
				<?php foreach($coes as $coe): ?>
					<div class="card col-12 col-md-6 col-lg-3">
						<div class="card-wrapper">
							<div class="card-img">
								<a href="javascript:void(0);" onclick="viewPost('<?php echo $coe['post_id']; ?>')">
									<img class="img-responsive location-feature-img" style="width: 100%;" src="<?php echo $coe['thumbnail']; ?>" onerror="this.src = '/assets/img/gallery/services-banner.jpg'">
								</a>
							</div>
							<div class="card-box">
								<h4 class="location-description"><?= $coe['post_title']; ?></h4>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
				
			</div>
		</div>
	<?php endif; ?>

	<!-- SERVICES & FACILITIES -->
	<div class="container" id="hospital-services-facilities">
		<div class="col-md-12 no-pad">
			<h3 class="location-title">Services & Facilities</h3>
			<?php foreach($fas_sers as $fas_ser): ?>
				<div class="col-md-4 no-pad">
					<?php foreach ($fas_ser as $row) { ?>
						<p class="location-services">
							<a href="javascript:void(0);" onclick="viewPost('<?php echo $row['post_id']; ?>')">
								<?php echo strtoupper($row['post_title']);
								if (strlen($row['post_title']) >= 25) {
									echo '';
								} ?>
							</a>
						</p>
					<?php } ?>
				</div>
			<?php endforeach; ?>
		</div>
	</div>

	<?php if($id == 7): ?>
	<!-- Doctors -->
	<div class="container" id="hospital-doctors">
		<h3 class="location-title">Our Doctors</h3>
		<div class="row">
			<div class="card col-12 col-md-6 col-lg-2">
				<a href="<?php echo base_url('assets/static_page/akupuntur/index.php'); ?>" rel="modal:open">
					<div>
						<!-- <img class="location-doctor-icon" src="<?php echo base_url('assets/img/gallery/category/ic_hospital.png'); ?>"> -->
						<span class="location-doctor-spec">Akupuntur</span>
					</div>
				</a>
			</div>
			<div class="card col-12 col-md-6 col-lg-2">
				<a href="<?php echo base_url('assets/static_page/anak/index.php'); ?>" rel="modal:open">
					<div>
						<!-- <img class="location-doctor-icon" src="<?php echo base_url('assets/img/gallery/category/ic_hospital.png'); ?>"> -->
						<span class="location-doctor-spec">Anak</span>
					</div>
				</a>
			</div>
			<div class="card col-12 col-md-6 col-lg-2">
				<a href="<?php echo base_url('assets/static_page/anestesi/index.php'); ?>" rel="modal:open">
					<div>
						<!-- <img class="location-doctor-icon" src="<?php echo base_url('assets/img/gallery/category/ic_hospital.png'); ?>"> -->
						<span class="location-doctor-spec">Anestesi</span>
					</div>
				</a>
			</div>
			<div class="card col-12 col-md-6 col-lg-2">
				<a href="<?php echo base_url('assets/static_page/bedah/index.php'); ?>" rel="modal:open">
					<div>
						<!-- <img class="location-doctor-icon" src="<?php echo base_url('assets/img/gallery/category/ic_hospital.png'); ?>"> -->
						<span class="location-doctor-spec">Bedah</span>
					</div>
				</a>
			</div>
			<div class="card col-12 col-md-6 col-lg-2">
				<a href="<?php echo base_url('assets/static_page/bedah_plastik/index.php'); ?>" rel="modal:open">
					<div>
						<!-- <img class="location-doctor-icon" src="<?php echo base_url('assets/img/gallery/category/ic_hospital.png'); ?>"> -->
						<span class="location-doctor-spec">Bedah Plastik</span>
					</div>
				</a>
			</div>
			<div class="card col-12 col-md-6 col-lg-2">
				<a href="<?php echo base_url('assets/static_page/bedah_saraf/index.php'); ?>" rel="modal:open">
					<div>
						<!-- <img class="location-doctor-icon" src="<?php echo base_url('assets/img/gallery/category/ic_hospital.png'); ?>"> -->
						<span class="location-doctor-spec">Bedah Saraf</span>
					</div>
				</a>
			</div>

			<!-- <div class="card col-12 col-md-6 col-lg-2">
					<a href="<?php echo base_url('assets/static_page/anak/index.php'); ?>" rel="modal:open">
						<div class="card-wrapper">
							<div class="card-img location-doctor-category">
								<img class="img-responsive" src="<?php echo base_url('assets/img/gallery/category/ic_anesthesia.png'); ?>">
								<h4>Anak</h4>
							</div>
						</div>
					</a>
				</div>

				<div class="card col-12 col-md-6 col-lg-2">
					<a href="<?php echo base_url('assets/static_page/anestesi/index.php'); ?>" rel="modal:open">
						<div class="card-wrapper">
							<div class="card-img location-doctor-category">
								<img class="img-responsive" src="<?php echo base_url('assets/img/gallery/category/ic_anesthesia.png'); ?>">
								<h4>Anestesi</h4>
							</div>
						</div>
					</a>
				</div>
			
				<div class="card col-12 col-md-6 col-lg-2">
					<a href="<?php echo base_url('assets/static_page/bedah/index.php'); ?>" rel="modal:open">
					<div class="card-wrapper">
							<div class="card-img location-doctor-category">
								<img class="img-responsive" src="<?php echo base_url('assets/img/gallery/category/ic_anesthesia.png'); ?>">
								<h4>Bedah</h4>
							</div>
						</div>
					</a>
				</div>

				<div class="card col-12 col-md-6 col-lg-2">
					<a href="<?php echo base_url('assets/static_page/bedah_plastik/index.php'); ?>" rel="modal:open">
					<div class="card-wrapper">
							<div class="card-img location-doctor-category">
								<img class="img-responsive" src="<?php echo base_url('assets/img/gallery/category/ic_anesthesia.png'); ?>">
								<h4>Bedah Plastik</h4>
							</div>
						</div>
					</a>
				</div>

				<div class="card col-12 col-md-6 col-lg-2">
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
			<div class="card col-12 col-md-6 col-lg-2">
				<a href="<?php echo base_url('assets/static_page/bedah_kardiak/index.php'); ?>" rel="modal:open">
					<div>
						<!-- <img class="location-doctor-icon" src="<?php echo base_url('assets/img/gallery/category/ic_hospital.png'); ?>"> -->
						<span class="location-doctor-spec">Bedah Torak, Kardiak & Vaskuler</span>
					</div>
				</a>
			</div>
			<div class="card col-12 col-md-6 col-lg-2">
				<a href="<?php echo base_url('assets/static_page/dental/index.php'); ?>" rel="modal:open">
					<div>
						<!-- <img class="location-doctor-icon" src="<?php echo base_url('assets/img/gallery/category/ic_hospital.png'); ?>"> -->
						<span class="location-doctor-spec">Gigi & Mulut</span>
					</div>
				</a>
			</div>
			<div class="card col-12 col-md-6 col-lg-2">
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
			<div class="card col-12 col-md-6 col-lg-2">
				<a href="<?php echo base_url('assets/static_page/mata/index.php'); ?>" rel="modal:open">
					<div>
						<!-- <img class="location-doctor-icon" src="<?php echo base_url('assets/img/gallery/category/ic_hospital.png'); ?>"> -->
						<span class="location-doctor-spec">Mata</span>
					</div>
				</a>
			</div>
			<div class="card col-12 col-md-6 col-lg-2">
				<a href="<?php echo base_url('assets/static_page/obsgyn/index.php'); ?>" rel="modal:open">
					<div>
						<!-- <img class="location-doctor-icon" src="<?php echo base_url('assets/img/gallery/category/ic_hospital.png'); ?>"> -->
						<span class="location-doctor-spec">Obstetri & Ginekologi</span>
					</div>
				</a>
			</div>
			<div class="card col-12 col-md-6 col-lg-2">
				<a href="<?php echo base_url('assets/static_page/ortopedi/index.php'); ?>" rel="modal:open">
					<div>
						<!-- <img class="location-doctor-icon" src="<?php echo base_url('assets/img/gallery/category/ic_hospital.png'); ?>"> -->
						<span class="location-doctor-spec">Ortopedi</span>
					</div>
				</a>
			</div>
			<div class="card col-12 col-md-6 col-lg-2">
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
			<div class="card col-12 col-md-6 col-lg-2">
				<a href="<?php echo base_url('assets/static_page/radiologi/index.php'); ?>" rel="modal:open">
					<div>
						<!-- <img class="location-doctor-icon" src="<?php echo base_url('assets/img/gallery/category/ic_hospital.png'); ?>"> -->
						<span class="location-doctor-spec">Radiologi</span>
					</div>
				</a>
			</div>
			<div class="card col-12 col-md-6 col-lg-2">
				<a href="<?php echo base_url('assets/static_page/rehabilitasi_medik/index.php'); ?>" rel="modal:open">
					<div>
						<!-- <img class="location-doctor-icon" src="<?php echo base_url('assets/img/gallery/category/ic_hospital.png'); ?>"> -->
						<span class="location-doctor-spec">Rehabilitasi Medik</span>
					</div>
				</a>
			</div>
			<div class="card col-12 col-md-6 col-lg-2">
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
	<?php endif; ?>

	<!-- LOCATION -->
	<div class="container hide" id="hospital-address">
		<div class="col-xs-12 no-pad">
			<h3 class="location-title">Location</h3>
			<p class="no-pad location-description">
				<?php echo $resulthospital['addresshospital']; ?>
			</p>
			<p class="no-pad location-description">
				<?php echo strtoupper($resulthospital['namelocation']); ?>
			</p>
			<br />
			<?php
			$arr = explode(" ", $resulthospital['namehospital']);
			$namehospital = implode("+", $arr);

			?>
			<a class="btn-circle" href="https://maps.google.com/?q=<?= $resulthospital['latitude']; ?>,<?= $resulthospital['longitude']; ?>">Open location in Maps</a>
		</div>
	</div>
	<br />
	<br />
</section>