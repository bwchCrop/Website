<script src="https://call.razaki.technology/widget/ctb-webcall.js"></script>

<div class="revamp-floating-menu" id="float-menu-doctor">
    <div class="wrapper">
        <div class="item">
            <a href="<?= base_url('find-doctor'); ?>">
                <span class="icon-doctor icon"></span>
                <span>FIND DOCTOR</span>
            </a>
        </div>
        <div class="item">
            <a href="<?= base_url('result/search'); ?>">
                <span class="icon-appointment icon"></span>
                <span>APPOINTMENT</span>
            </a>
        </div>
        <div class="item">
            <a href="<?= base_url('location'); ?>">
                <span class="icon-location icon"></span>
                <span>LOCATION</span>
            </a>
        </div>
    </div>
</div>
<section class="footer container-fluid" id="footer" style="width: 100%;">
    <div class="col-xs-12 inner-footer">
        <div class="col-sm-3">
            <a href="<?php echo base_url(''); ?>" class="footer-link">
                <img class="w-100 logo-footer" src="<?php echo base_url('assets/img/logo/logo_bwch_2022.png'); ?>">
            </a>
            <div class="mt-2" style="margin-top: 1.5rem;">
                <a href="https://play.google.com/store/apps/details?id=com.terakorp.brawijaya_hospital" class="downloadapp" target="blank">
                    <img class="img-responsive" src="<?= base_url('assets\img\playstore.png'); ?>" alt="" style="margin: auto; width: 100%;">
                </a>
            </div>
            <div class="follow-us-wrapper" style="margin-top: 2rem;">
                <div class="icon-wrapper">
                    <div class="d-flex flex-row p-icon">
                        <a href="https://www.instagram.com/brawijaya.healthcare/" target="_blank">
                            <img class="icon-size" src="<?php echo base_url('assets/img/icons/purple/instagram.png'); ?>">
                        </a>
                        <a href="https://www.facebook.com/Brawijaya-Women-Children-Hospital-37356813420/" target="_blank">
                            <img class="icon-size" src="<?php echo base_url('assets/img/icons/purple/facebook.png'); ?>">
                        </a>
                        <a href="https://twitter.com/RS_BWCH" target="_blank">
                            <img class="icon-size" src="<?php echo base_url('assets/img/icons/purple/twitter.png'); ?>">
                        </a>
                        <a href="https://www.youtube.com/channel/UCHAXS8tJo0a9SpnSvow253Q" target="_blank">
                            <img class="icon-size" src="<?php echo base_url('assets/img/icons/purple/youtube.png'); ?>">
                        </a>
                        <a href="mailto:marketing@brawijayahealthcare.com">
                            <img class="icon-size" src="<?php echo base_url('assets/img/icons/purple/mail.png'); ?>">
                        </a>
                        <a href="<?= base_url('ugd'); ?>">
                            <img class="icon-size" src="<?php echo base_url('/assets/img/icons/purple/ugd.png'); ?>">
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="footer-row">
                <!-- <div class="col-sm-3 p-sm-0"> -->
                <!-- <div class="footer-menu-wrapper"> -->
                <div class="footer-menu">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <p class="list-title">Sitemap</p>
                        </li>
                        <li class="list-group-item"><a class="title" href="<?php echo base_url(); ?>">Home</a></li>
                        <li class="list-group-item"><a class="title" href="javascript:void(0);" onclick="redirectLink('<?php echo base_url('center-of-excellence'); ?>')">Center Of Excelence</a></li>
                        <li class="list-group-item"><a class="title" href="<?php echo base_url('sub/newsevent'); ?>">News & Promo</a></li>
                        <li class="list-group-item"><a class="title" href="<?php echo base_url('sub/special_offer'); ?>">Special Offer</a></li>
                        <li class="list-group-item"><a class="title" href="<?php echo base_url('career'); ?>">Career</a></li>
                    </ul>
                </div>
                <!-- </div> -->
                <!-- </div> -->
                <!-- <div class="col-sm-3 p-sm-0"> -->
                <!-- <div class="footer-menu-wrapper"> -->
                <div class="footer-menu">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <p class="list-title">About Us</p>
                        </li>
                        <!-- <li class="list-group-item"><a class="title" href="javascript:void(0);" onclick="redirectLink('<?php echo base_url('about'); ?>#visionmission')">Vision & Mission</a></li>
								<li class="list-group-item"><a class="title" href="javascript:void(0);" onclick="redirectLink('<?php echo base_url('about'); ?>#patientfamilyrights')">Patient & Family Rights</a></li>
								<li class="list-group-item"><a class="title" href="javascript:void(0);" onclick="redirectLink('<?php echo base_url('about'); ?>#patientfamilyobligation')">Patient & Family Obligation</a></li>
								<li class="list-group-item"><a class="title" href="javascript:void(0);" onclick="redirectLink('<?php echo base_url('about'); ?>#kepuasanpasienkeluarga')">Service Quality Indicator</a></li> -->
                        <li class="list-group-item"><a class="title" href="<?= base_url('about/vision-mission'); ?>">Vision & Mission</a></li>
                        <li class="list-group-item"><a class="title" href="<?= base_url('about/patient-family-rights'); ?>">Patient & Family Rights</a></li>
                        <li class="list-group-item"><a class="title" href="<?= base_url('about/patient-family-obligation'); ?>">Patient & Family Obligation</a></li>
                        <li class="list-group-item"><a class="title" href="<?= base_url('about/capaian-inm'); ?>">Service Quality Indicator</a></li>
                    </ul>
                </div>
                <!-- </div> -->
                <!-- </div> -->
                <!-- <div class="col-sm-6"> -->
                <!-- <div class="footer-menu-wrapper"> -->
                <div class="footer-menu">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <p class="list-title">Hospital & Clinic</p>
                        </li>
                        <?php $getHospital = $this->mhospital->getActived('sort ASC')->result_array(); ?>
                        <?php foreach ($getHospital as $rowHospital) : ?>
                            <li class="list-group-item"><a class="title" href="<?php echo base_url('location/' . $rowHospital['mapurl']); ?>"><?php echo $rowHospital['namehospital']; ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <!-- </div> -->
                <!-- </div> -->
            </div>
        </div>


        <div class="col-xs-12 copyright" align="center" style="display: none;">
            <div class="col-xs-12">
                <p class="white copyright">
                    Copyright &copy; 2020 Brawijaya Women & Children Hospital
                </p>
            </div>
        </div>
    </div>

    <div class="col-xs-12">

    </div>
</section>
<div class="free-call" id="free-call">
    <!-- <img src="<?php echo base_url('assets/icons/call.png'); ?>" alt=""> -->
    <img src="<?php echo base_url('assets/icons/call_long.png'); ?>" alt="">
</div>
