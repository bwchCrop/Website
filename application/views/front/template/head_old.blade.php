<section class="header container-fluid smaller" id="header">
  <div class="row">
      <div class="col-xs-12 header-content">
          <div class="header-margin">
          <div class="col-xs-12 col-lg-4 logo no-pad-sm" align="left">
              <a href="<?php echo base_url('');?>">
                <img src="<?php echo base_url('assets/img/logo/logo_bw_transparent.png');?>" >
              </a>
              <div class="icon-wrapper">
                <div class="d-flex flex-row p-icon">
                  <a href="https://www.instagram.com/brawijaya.healthcare/" target="_blank">
                    <img class="icon-size" src="<?php echo base_url('assets/img/logo/icon_socmed_instagram.png');?>">
                  </a>
                  <a href="https://www.facebook.com/Brawijaya-Women-Children-Hospital-37356813420/" target="_blank">
                    <img class="icon-size" src="<?php echo base_url('assets/img/logo/icon_socmed_fb.png');?>">
                  </a>
                  <a href="https://twitter.com/RS_BWCH" target="_blank">
                    <img class="icon-size" src="<?php echo base_url('assets/img/logo/icon_socmed_twitter.png');?>">
                  </a>
                  <a href="https://www.youtube.com/channel/UCHAXS8tJo0a9SpnSvow253Q" target="_blank">
                    <img class="icon-size" src="<?php echo base_url('assets/img/logo/icon_socmed_youtube.png');?>">
                  </a>
                  <a href="mailto:marketing@brawijayahealthcare.com">
                    <img class="icon-size" src="<?php echo base_url('assets/img/logo/icon_socmed_email.png');?>">
                  </a>
                </div>
              </div>
          </div>
          <div class="col-xs-12 col-lg-4 call no-pad" align="left">
            <div class="no-pad channel-contact-logo">
              <img src="<?php echo base_url('assets/img/logo/phone-icon.png');?>">
            </div>
            <div class="no-pad image-banner-fade channel-contact">
              <?php $getContact = $this->mhospital->getJoinByWhere("phone != ''")->result_array(); ?>
              <?php foreach($getContact as $row){ ?>
                <div class="col-xs-12 contact-list">
                    <h3 class="purple"  style="font-size:24px !important;"><?php echo $row['city'];?></h3>
                    <p class="grey" style="font-size:14px !important;"><?php echo $row['phone'];?></p>
                </div>
              <?php } ?>
            </div>
            <div class="channel-button">
              <div class="container-btn">
                <a class="btn-circle ext slideTo" id="btn-toggle-find-header" todiv="search" href="<?php if($this->uri->segment(1) == 'search' OR $this->uri->segment(1) == ''){echo 'javascript:void(0)';}else{echo base_url('search');}?>">Find What You Need</a>
              </div>
              <div class="container-btn">
                <?php if($this->session->userdata(_PREFIX.'frontlogin') == TRUE){ ?>
                  <a class="btn-circle italic ext" href="<?php echo base_url('home/load_modalAccLogin/logout');?>" data-toggle="tooltip" data-placement="left" title="<?php echo $this->session->userdata(_PREFIX.'frontemail');?>"><?php echo substr($this->session->userdata(_PREFIX.'frontemail'),0,5);?>... ,LOG OUT</a>                
                <?php }else{ ?>
                  <a class="btn-circle ext header-login" href="javascript:void(0);">Login / Register</a>                
                <?php } ?>              
              </div>
            </div>
          </div>
                </div>
      </div>

      <div class="col-xs-12 header-menu">
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
                <ul class="nav navbar-nav nav-style">
                  <li class="main"><a href="<?php echo base_url();?>">Home</a></li>
                  <li class="main dropdown">
                    <a href="javascript:void(0);" class="parent parent-1 ropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                      About Us
                    </a>
                    <ul class="dropdown-menu">
                      <li><a href="<?php echo base_url('about/vision-mission');//('about/sub/about/1');?>">Vision & Mission</a></li>
                      <li><a href="<?php echo base_url('about/patient-family-rights');//('about/sub/about/2');?>">Patient & Family Rights</a></li>
                      <li><a href="<?php echo base_url('about/patient-family-obligation');//('about/sub/about/3');?>">Patient & Family Obligation</a></li>
                      <!-- <li><a href="<?php echo base_url('about/kepuasan-pasien-dan-keluarga');//('about/sub/about/3');?>">PATIENT & FAMILY SATISFACTION INDICATOR</a></li> -->
                      <!--<li><a href="<?php echo base_url('about/sevice-quality');//('about/sub/about/3');?>">Service Quality Indicator of Brawijaya Hospital Duren Tiga</a></li>-->
                    </ul>
                  </li>
                  <li class="main dropdown">
                    <a href="javascript:void(0)" class="parent parent-2" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                      Location
                    </a>
                    <ul class="dropdown-menu">
                      <?php $getHospital = $this->mhospital->getActived('sort ASC')->result_array();?>
                      <?php foreach($getHospital as $rowHospital){ if($rowHospital['idhospital'] != '7'){ ?>
                      <li><a href="<?php echo base_url('location/'.$rowHospital['mapurl']);?>"><?php echo $rowHospital['namehospital'];?></a></li>
                      <?php } } ?>
                      <li><a href="<?php echo base_url('microsite/brawijayasaharjo');?>">Brawijaya Hospital Saharjo</a></li>
                    </ul>
                  </li>
                  <li class="main dropdown">
                    <a href="javascript:void(0)" class="parent parent-3" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                      Services & Facilities
                    </a>
                    <ul class="dropdown-menu serv-facil">
                      <li class="col-xs-12 no-pad outer-flex-sm">
                        <ul class="col-xs-12 col-sm-6 no-pad service">
                          <li class="title"><a href="<?php echo base_url('services');?>">Services</a></li>
                          <?php $getService = $this->mpost->getJoinPublishedBy('3','idcategory',0,0,'ASC')->result_array();?>
                          <?php foreach($getService as $rowService){ ?>
                          <li><a href="<?php echo base_url('services/'.$rowService['slug'])/*base_url('sub/services/1/'.$rowService['post_id'])*/;?>"><?php echo strtoupper($rowService['post_title']);?></a></li>
                          <?php } ?>
                        </ul>
                        <ul class="col-xs-12 col-sm-6 no-pad facilities">
                          <li class="title"><a href="<?php echo base_url('facilities');?>">Facilities</a></li>
                          <?php $getFacilities = $this->mpost->getJoinPublishedBy('4','idcategory',0,0,'ASC')->result_array();?>
                          <?php foreach($getFacilities as $rowFacilities){ ?>
                          <li><a href="<?php echo base_url('facilities/'.$rowFacilities['slug'])/*base_url('sub/services/2/'.$rowFacilities['post_id'])*/;?>"><?php echo strtoupper($rowFacilities['post_title']);?></a></li>
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
                      <?php $getSpecialist = $this->mhighlight->getAll()->result_array();?>
                      <?php foreach($getSpecialist as $rowSpecialist){ ?>
                        <li><a href="<?php echo base_url('doctor-schedule/'.$rowSpecialist['highlight_slug']);?>"><?php echo strtoupper($rowSpecialist['highlight_title']);?></a></li>
                      <?php } ?>
                    </ul>
                  </li>  
                  <li class="main">
                    <a href="<?php echo base_url('sub/special_offer');?>">
                      Special Offer
                    </a>
                  </li>  
                  <li class="main">
                    <a href="<?php echo base_url('sub/membership');?>">
                      Membership
                    </a>
                  </li>  
                  <li class="main">
                    <a href="<?php echo base_url('sub/newsevent');?>">
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
<!-- 
<section class="dock">
  <div class="container-dock">
    <div class="col-xs-12">
      <a href="https://www.instagram.com/brawijaya.healthcare/" target="_blank">
        <img src="<?php echo base_url('assets/img/logo/icon_socmed_instagram.png');?>">
      </a>
    </div>
    <div class="col-xs-12">
      <a href="https://www.facebook.com/Brawijaya-Women-Children-Hospital-37356813420/" target="_blank">
        <img src="<?php echo base_url('assets/img/logo/icon_socmed_fb.png');?>">
      </a>
    </div>
    <div class="col-xs-12">
      <a href="https://twitter.com/RS_BWCH" target="_blank">
        <img src="<?php echo base_url('assets/img/logo/icon_socmed_twitter.png');?>">
      </a>
    </div>
    <div class="col-xs-12">
      <a href="https://www.youtube.com/channel/UCHAXS8tJo0a9SpnSvow253Q" target="_blank">
        <img src="<?php echo base_url('assets/img/logo/icon_socmed_youtube.png');?>">
      </a>
    </div>
    <div class="col-xs-12">
      <a href="mailto:marketing@brawijayahealthcare.com">
        <img src="<?php echo base_url('assets/img/logo/icon_socmed_email.png');?>">
      </a>
    </div>
  </div>
</section> -->

<div class="overlay">
  <img src="<?php echo base_url('assets/img/logo/Logo.png');?>">
  <div class="cssload-square">
    <div class="cssload-square-part cssload-square-green"></div>
    <div class="cssload-square-part cssload-square-pink"></div>
    <div class="cssload-square-blend"></div>
  </div>
</div>