<section class="header container-fluid smaller" id="header" style="display: none;">
  <div class="row">
    <div class="col-xs-12 header-content">
      <div class="header-margin">
        <div class="col-xs-12 col-lg-4 logo no-pad-sm" align="left">
          <div class="row">
            <div class="col-xs-6">

              <a href="<?php echo base_url(''); ?>" title="Brawijaya Hospital">
                <img src="<?php echo base_url('assets/img/logo/logo_bw_transparent.png'); ?>" class="logo-size" alt="Brawijaya Hospital" title="Brawijaya Hospital"/>
              </a>

              <div class="icon-wrapper">
                <div class="d-flex flex-row p-icon">
                  <a href="https://www.instagram.com/brawijaya.healthcare/" target="_blank">
                    <img class="icon-size" src="<?php echo base_url('assets/img/icons/instagram.png'); ?>">
                  </a>
                  <a href="https://www.facebook.com/Brawijaya-Women-Children-Hospital-37356813420/" target="_blank">
                    <img class="icon-size" src="<?php echo base_url('assets/img/icons/facebook.png'); ?>">
                  </a>
                  <a href="https://twitter.com/RS_BWCH" target="_blank">
                    <img class="icon-size" src="<?php echo base_url('assets/img/icons/twitter.png'); ?>">
                  </a>
                  <a href="https://www.youtube.com/channel/UCHAXS8tJo0a9SpnSvow253Q" target="_blank">
                    <img class="icon-size" src="<?php echo base_url('assets/img/icons/youtube.png'); ?>">
                  </a>
                  <a href="mailto:marketing@brawijayahealthcare.com">
                    <img class="icon-size" src="<?php echo base_url('assets/img/icons/mail.png'); ?>">
                  </a>
                  <a href="<?= base_url('ugd'); ?>">
                    <img class="icon-size" src="<?php echo base_url('/assets/img/icons/ugd.png'); ?>">
                  </a>
                </div>
              </div>

            </div>


            <div class="col-xs-6 mobile-view">
              <nav class="navbar navbar-default" style="background-color:transparent; border-color: transparent;">
                <div class="container-fluid">
                  <div class="navbar-header">
                    <button id="clickNavbar" type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                      <span class="sr-only">Toggle navigation</span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                    </button>
                  </div>
                </div>
              </nav>
            </div>

            <div class="col-xs-12 header-menu mobile-view">
              <nav id="contentNavbar" class="navbar navbar-default" style="background-color:#F9F9F9; position:absolute; z-index: 1; width: inherit;">
                <div class="container-fluid">
                  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" align="center">
                    <ul class="nav navbar-nav nav-style">
                      <li class="main"><a href="<?php echo base_url(); ?>">Home</a></li>
                      <li class="main dropdown">
                        <a href="javascript:void(0);" class="parent parent-1 ropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                          About Us
                        </a>
                        <ul class="dropdown-menu">
                          <li><a href="<?php echo base_url('about/vision-mission'); //('about/sub/about/1');
                                        ?>">Vision & Mission</a></li>
                          <li><a href="<?php echo base_url('about/patient-family-rights'); //('about/sub/about/2');
                                        ?>">Patient & Family Rights</a></li>
                          <li><a href="<?php echo base_url('about/patient-family-obligation'); //('about/sub/about/3');
                                        ?>">Patient & Family Obligation</a></li>
                          <!-- <li><a href="<?php echo base_url('about/kepuasan-pasien-dan-keluarga'); //('about/sub/about/3');
                                            ?>">PATIENT & FAMILY SATISFACTION INDICATOR</a></li> -->
                          <!--<li><a href="<?php echo base_url('about/sevice-quality'); //('about/sub/about/3');
                                            ?>">Service Quality Indicator of Brawijaya Hospital Duren Tiga</a></li>-->
                        </ul>
                      </li>

                      <li class="main dropdown">
                        <a href="javascript:void(0)" class="parent parent-2" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                          Location
                        </a>
                        <ul class="dropdown-menu">
                          <?php $getHospital = $this->mhospital->getActived('sort ASC')->result_array(); ?>
                          <?php foreach ($getHospital as $rowHospital) {
                            if ($rowHospital['idhospital'] != '7') { ?>
                              <li><a href="<?php echo base_url('location/' . $rowHospital['mapurl']); ?>"><?php echo $rowHospital['namehospital']; ?></a></li>
                          <?php }
                          } ?>
                          <li><a href="<?php echo base_url('microsite/brawijayasaharjo'); ?>">Brawijaya Hospital Saharjo</a></li>
                        </ul>
                      </li>

                      <li class="main dropdown">
                        <a href="javascript:void(0)" class="parent parent-3" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                          Services & Facilities
                        </a>
                        <ul class="dropdown-menu serv-facil">
                          <li class="col-xs-12 no-pad outer-flex-sm">
                            <ul class="col-xs-12 col-sm-6 no-pad service">
                              <li class="title"><a href="<?php echo base_url('services'); ?>">Services</a></li>
                              <?php //$getService = $this->mpost->getJoinPublishedBy('3','idcategory',0,0,'ASC')->result_array();
                              ?>
                              <?php $getService = $this->mpost->getByMenuCategory(3)->result_array(); ?>
                              <?php foreach ($getService as $rowService) { ?>
                                <li><a href="<?php echo base_url('services/' . $rowService['slug']); ?>"><?php echo ucwords(strtolower($rowService['title'])); ?></a></li>
                              <?php } ?>
                            </ul>
                            <ul class="col-xs-12 col-sm-6 no-pad facilities">
                              <li class="title"><a href="<?php echo base_url('facilities'); ?>">Facilities</a></li>
                              <?php //$getFacilities = $this->mpost->getJoinPublishedBy('4', 'idcategory', 0, 0, 'ASC')->result_array(); 
                              ?>
                              <?php $getFacilities = $this->mpost->getByMenuCategory(4)->result_array(); ?>
                              <?php foreach ($getFacilities as $rowFacilities) { ?>
                                <li><a href="<?php echo base_url('facilities/' . $rowFacilities['slug']); ?>"><?php echo ucwords(strtolower($rowFacilities['title'])); ?></a></li>
                              <?php } ?>
                            </ul>
                          </li>
                        </ul>
                      </li>

                      <li class="main dropdown">
                        <a href="javascript:void(0);" class="parent parent-4" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                          Doctor's Schedule
                        </a>
                        <ul class="dropdown-menu">
                          <?php if(!empty($allS) && is_array($allS)): ?>
                           <?php foreach ($allS as $a) { ?>
                             <li><a href="<?php echo base_url('doctor-schedule/' . $a['tmgroupid']); ?>"><?php echo $a['tmgroupname'] ?></a></li>
                           <?php } ?>
                          <?php endif; ?>
                        </ul>
                      </li>

                      <li class="main">
                        <a href="<?php echo base_url('sub/special_offer'); ?>">
                          Special Offer
                        </a>
                      </li>

                      <li class="main hide">
                        <a href="<?php echo base_url('sub/membership'); ?>">
                          Membership
                        </a>
                      </li>
                      <li class="main">
                        <a href="<?php echo base_url('sub/newsevent'); ?>">
                          News & Event
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
              </nav>
            </div>

          </div>
        </div>
        <div class="col-xs-12 col-lg-4 call no-pad" align="left">
          <div style="display:flex; flex-direction: row; align-items: center;">

            <div class="channel-button mobile-view">
              <div class="container-btn">
                <a class="btn-circle ext slideTo" id="btn-toggle-find-header" todiv="search" href="<?php if ($this->uri->segment(1) == 'search' or $this->uri->segment(1) == '') {
                                                                                                      echo 'javascript:void(0)';
                                                                                                    } else {
                                                                                                      echo base_url('search');
                                                                                                    } ?>">Find What You Need</a>
              </div>
              <div class="container-btn">
                <?php if ($this->session->userdata(_PREFIX . 'frontlogin') == TRUE) { ?>
                  <a class="btn-circle italic ext" href="<?php echo base_url('home/load_modalAccLogin/logout'); ?>" data-toggle="tooltip" data-placement="left" title="<?php echo $this->session->userdata(_PREFIX . 'frontemail'); ?>"><?php echo substr($this->session->userdata(_PREFIX . 'frontemail'), 0, 5); ?>... ,LOG OUT</a>
                <?php } else { ?>
                  <a class="btn-circle ext header-login" href="javascript:void(0);">Login / Register</a>
                <?php } ?>
              </div>
            </div>

            <div class="no-pad channel-contact-logo">
              <img src="<?php echo base_url('assets/img/logo/phone-icon.png'); ?>">
            </div>

            <div class="no-pad image-banner-fade channel-contact">
              <?php $getContact = $this->mhospital->getJoinByWhere("phone != ''")->result_array(); ?>
              <?php foreach ($getContact as $row) { ?>
                <div class="col-xs-12 contact-list">
                  <h3 class="purple" style="font-size:18px !important;"><?php echo $row['city']; ?></h3>
                  <p class="grey" style="font-size:12px !important;"><?php echo $row['phone']; ?></p>
                </div>
              <?php } ?>
              <div class="col-xs-12 contact-list">
                <div style="height: 100%; display: flex; align-items: flex; justify-content: flex-end; flex-direction: column;">
                  <h3 class="purple" style="font-size:18px !important;">Halo Brawijaya Hospital</h3>
                  <p class="grey" style="font-size:12px !important;">150160</p>
                </div>
              </div>
            </div>

            <div class="channel-button desktop-menu">
              <div class="container-btn">
                <a class="btn-circle ext slideTo" id="btn-toggle-find-header" todiv="search" href="<?php if ($this->uri->segment(1) == 'search' or $this->uri->segment(1) == '') {
                                                                                                      echo 'javascript:void(0)';
                                                                                                    } else {
                                                                                                      echo base_url('search');
                                                                                                    } ?>">Find What You Need</a>
              </div>
              <div class="container-btn">
                <?php if ($this->session->userdata(_PREFIX . 'frontlogin') == TRUE) { ?>
                  <a class="btn-circle italic ext" href="<?php echo base_url('home/load_modalAccLogin/logout'); ?>" data-toggle="tooltip" data-placement="left" title="<?php echo $this->session->userdata(_PREFIX . 'frontemail'); ?>"><?php echo substr($this->session->userdata(_PREFIX . 'frontemail'), 0, 5); ?>... ,LOG OUT</a>
                <?php } else { ?>
                  <a class="btn-circle ext header-login" href="javascript:void(0);">Login / Register</a>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>

    <div class="col-xs-12 header-menu desktop-menu">
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
          </div>

          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" align="center" style="margin-left:100px; margin-right:100px; ">
            <ul class="nav navbar-nav nav-style" style="display: flex; justify-content: space-around;">
              <li class="main"><a href="<?php echo base_url(); ?>">Home</a></li>
              <li class="main dropdown">
                <a href="javascript:void(0);" class="parent parent-1 ropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                  About Us
                </a>
                <ul class="dropdown-menu">
                  <li><a href="<?php echo base_url('about/vision-mission'); //('about/sub/about/1');
                                ?>">Vision & Mission</a></li>
                  <li><a href="<?php echo base_url('about/patient-family-rights'); //('about/sub/about/2');
                                ?>">Patient & Family Rights</a></li>
                  <li><a href="<?php echo base_url('about/patient-family-obligation'); //('about/sub/about/3');
                                ?>">Patient & Family Obligation</a></li>
                  <!-- <li><a href="<?php echo base_url('about/kepuasan-pasien-dan-keluarga'); //('about/sub/about/3');
                                    ?>">PATIENT & FAMILY SATISFACTION INDICATOR</a></li> -->
                  <!--<li><a href="<?php echo base_url('about/sevice-quality'); //('about/sub/about/3');
                                    ?>">Service Quality Indicator of Brawijaya Hospital Duren Tiga</a></li>-->
                </ul>
              </li>
              <li class="main dropdown">
                <a href="javascript:void(0)" class="parent parent-2" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                  Location
                </a>
                <ul class="dropdown-menu">
                  <?php $getHospital = $this->mhospital->getMenu('sort ASC')->result_array(); ?>
                  <?php foreach ($getHospital as $rowHospital) {
                    if ($rowHospital['idhospital'] != '7') { ?>
                      <li><a href="<?php echo base_url('location/' . $rowHospital['mapurl']); ?>"><?php echo $rowHospital['namehospital']; ?></a></li>
                  <?php }
                  } ?>
                  <li><a href="<?php echo base_url('microsite/brawijayasaharjo'); ?>">Brawijaya Hospital Saharjo</a></li>
                  <li><a href="<?php echo base_url('microsite/rspermataibu'); ?>">RS Permata Ibu - Managed By Brawijaya</a></li>
                </ul>
              </li>
              <li class="main dropdown new">
                <a href="javascript:void(0)" class="parent parent-5" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                  Services
                </a>
                <ul class="dropdown-menu">
                  <?php //$getService = $this->mpost->getJoinPublishedBy('3','idcategory',0,0,'ASC')->result_array();
                  ?>
                  <?php $getService = $this->mpost->getByMenuCategory(3)->result_array(); ?>
                  <?php foreach ($getService as $rowService) { ?>
                    <li><a href="<?php echo base_url('services/' . $rowService['slug']); ?>"><?php echo ucwords(strtolower($rowService['title'])); ?></a></li>
                  <?php } ?>
                </ul>
              </li>
              <li class="main dropdown new">
                <a href="javascript:void(0)" class="parent parent-6" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                  Facilities
                </a>
                <ul class="dropdown-menu">
                  <?php //$getFacilities = $this->mpost->getJoinPublishedBy('4','idcategory',0,0,'ASC')->result_array();
                  ?>
                  <?php $getFacilities = $this->mpost->getByMenuCategory(4)->result_array(); ?>
                  <?php foreach ($getFacilities as $rowFacilities) { ?>
                    <li><a href="<?php echo base_url('facilities/' . $rowFacilities['slug']); ?>"><?php echo ucwords(strtolower($rowFacilities['title'])); ?></a></li>
                  <?php } ?>
                </ul>
              </li>
              <li class="main dropdown">
                <a href="javascript:void(0);" class="parent parent-4" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                  Doctor's Schedule
                </a>
                <ul class="dropdown-menu">
                  <?php if(!empty($allS) && is_array($allS)): ?>
                   <?php foreach ($allS as $a) { ?>
                     <li><a href="<?php echo base_url('doctor-schedule/' . $a['tmgroupid']); ?>"><?php echo $a['tmgroupname'] ?></a></li>
                   <?php } ?>
                  <?php endif; ?>  
                </ul>
              </li>
              <li class="main">
                <a href="<?php echo base_url('sub/special_offer'); ?>">
                  Special Offer
                </a>
              </li>
              <li class="main hide">
                <a href="<?php echo base_url('sub/membership'); ?>">
                  Membership
                </a>
              </li>
              <li class="main">
                <a href="<?php echo base_url('sub/newsevent'); ?>">
                  News & Event
                </a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </div>
  </div>
  <div class="row"></div>
</section>

<div class="overlay">
  <img src="<?php echo base_url('assets/img/logo/Logo.png'); ?>">
  <div class="cssload-square">
    <div class="cssload-square-part cssload-square-green"></div>
    <div class="cssload-square-part cssload-square-pink"></div>
    <div class="cssload-square-blend"></div>
  </div>
</div>

<div class="header-revamp">
	<div class="container header-container">
		<a href="<?php echo base_url(''); ?>" title="Brawijaya Hospital">
			<img class="logo" src="<?php echo base_url('assets/img/logo/logo_bw_transparent.png'); ?>" width="400" alt="Brawijaya Hospital"
		</a>

		<div class="menu-wrapper">
      <div class="logo-mobile-wrapper">
        <a href="<?php echo base_url(''); ?>" >
          <img src="<?php echo base_url('assets/img/logo/logo_bw_transparent.png'); ?>" width="250">
        </a>
        
        <button class="menu-toggler">
          <span></span>
          <span></span>
          <span></span>
        </button>
      </div>
			<div class="menu-1">
				<div class="menu-items">
					<a href="<?= base_url(); ?>">Home</a>
					<a href="<?= base_url('about') ?>">About Us</a>
					<a href="<?= base_url('center-of-excellence'); ?>">Center Of Excellence</a>
					<a href="<?= base_url('facilities'); ?>">Facilities</a>
          <div class="additional-wrapper">
            <a href="tel:150160" class="button-call"></a>
            <div class="lang-btn-wrapper">
              <a href="#" class="lang-btn">
                <img src="<?= base_url('assets/img/icons/indonesia.png'); ?>" alt="" width="20">
              </a>
            </div>

          </div>
				</div>		
			</div>
			<div class="menu-2">
				<div class="menu-items">
					<a href="<?= base_url('find-doctor'); ?>">Find Doctor</a>
					<a href="<?= base_url('result/search'); ?>">Appointment</a>
					<a href="<?= base_url('location'); ?>">Location</a>
					<a href="<?= base_url('services'); ?>">Services</a>
					<div class="additional-wrapper">
            <div class="search-wrapper">
              <input type="text" name="search" id="search" class="search-form" placeholder="Search...">
              <i class="fa fa-search search-icon"></i>
            </div>
				</div>
			</div>

		</div>
    <div class="menu menu-mobile">
        <a href="<?= base_url(); ?>">Home</a>
        <a href="<?= base_url('about') ?>">About Us</a>
        <a href="<?= base_url('find-doctor'); ?>">Find Doctor</a>
        <a href="<?= base_url('result/search'); ?>">Appointment</a>
        <a href="<?= base_url('location'); ?>">Location</a>
        <a href="<?= base_url('center-of-excellence'); ?>">Center Of Excellence</a>
        <a href="<?= base_url('facilities'); ?>">Facilities</a>
        <a href="<?= base_url('services'); ?>">Services</a>
    </div>

	</div>
  <button class="menu-toggler">
    <span></span>
    <span></span>
    <span></span>
  </button>

</div>
</div>