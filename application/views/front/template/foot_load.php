<style type="text/css">
    .btn-offer {
        position: absolute;
        bottom: 45px;
        margin-left: -15%;
        left: 50%;
        box-shadow: 0px 0px 20px 0px black;
    }
</style>

<div class="modal fade form" id="accountInformationModal" tabindex="-1" role="dialog" aria-labelledby="accountInformationModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content form">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title italic purple" id="accountInformationModalLabel">ACCOUNT INFORMATION</h3>
            </div>
            <div class="modal-body accountInformationModalBody">
                <form class="form-control-wrapper frmAccountInformationModal">
                    <div class="form-group">
                        <input type="text" class="form-control" id="mdl-txtemail" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="mdl-txtpassword" placeholder="Password">
                    </div>
                </form>
            </div>
            <div class="modal-footer" style="padding-top: 0px !important;">
                <!-- <a href="javascript:void(0);" class="pull-left" style="padding-top: 15px;">Forgot Password?</a> -->
                <button type="button" class="btn btn-login hov-white">LOGIN</button>
            </div>
            <div class="modal-footer" align="center" style="border-top: 1px solid #e7e7e7; text-align: center !important;">
                Haven't had an account?&nbsp;
                <button type="button" class="btn btn-register hov-white">REGISTER</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade form" id="accountLoginModal" tabindex="-1" role="dialog" aria-labelledby="accountLoginModalLabel" style="overflow: overlay;">
    <div class="modal-dialog" role="document">
        <div class="modal-content form">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title italic purple" id="accountLoginModalLabel">GET APPOINTMENT</h3>
            </div>
            <div class="modal-body accountLoginModalBody">
                <form class="form-control-wrapper frmAccountLoginModal">
                    <div class="form-group">
                        <input type="text" class="form-control" id="mdllogin-txtspeciality" placeholder=" - Speciality - ">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="mdllogin-txtdoctor" placeholder=" - Doctor - ">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="mdllogin-txthospital" placeholder=" - Hospital - ">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="mdllogin-txtdate" placeholder=" - Date - ">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="mdllogin-txthour" placeholder=" - Hour - ">
                    </div>
                </form>
            </div>
            <div class="modal-body AccountPatientModalBody">
                <h3 class="modal-title italic purple" id="AccountPatientModalLabel">PATIENT INFORMATION</h3><br>
                <input type="hidden" name="patientLoginCounter" id="patientLoginCounter" value="1">
                <form class="form-control-wrapper frmAccountPatientModal">
                    <div class="row field">
                        <div class="col-md-12" style="padding-top: 15px;">
                            <div class="form-group inputPatientName">
                                <!-- <input type="text" class="form-control" id="mdllogin-txtpatientname" placeholder=" Nama Pasien "> -->
                                <div class="input-group">
                                    <input type="hidden" id="mdllogin-txtpatientid" name="mdllogin-txtpatientid[]" value="">
                                    <input type="text" class="form-control mdllogin-txtpatientname" name="mdllogin-txtpatientname[]" placeholder=" Nama Pasien " aria-describedby="basic-addon2">
                                    <span class="input-group-btn btn-group" id="basic-addon2">
                                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="caret"></span></button>
                                        <ul class="dropdown-menu" id="dropdown-patient"></ul>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" class="form-control" id="mdllogin-txtpatientphone" name="mdllogin-txtpatientphone[]" placeholder=" Telpon ">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" class="form-control" id="mdllogin-txtpatientemail" name="mdllogin-txtpatientemail[]" placeholder=" Email ">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="radio" class="sex mdllogin-txtpatientsex" name="mdllogin-txtpatientsex" value="1" />&nbsp;Male&nbsp;&nbsp;&nbsp;
                                <input type="radio" class="sex mdllogin-txtpatientsex" name="mdllogin-txtpatientsex" value="0" />&nbsp;Female
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-12" style="padding: 0px;">
                                <label class="form-control-label">Tanggal Lahir</label>
                            </div>
                            <div class="col-md-3" style="padding: 0px;">
                                <div class="form-group">
                                    <select class="form-control col-md-4 mdllogin-txtbirthday" name="mdllogin-txtbirthday[]">
                                        <option value="00" valmonth="" disabled selected> - Day - </option>
                                        <?php for ($i = 1; $i < 32; $i++) {
                                            echo '<option value="' . $i . '">' . $i . '</option>';
                                        } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <select class="form-control col-md-4 mdllogin-txtbirthmonth" name="mdllogin-txtbirthmonth[]">
                                        <option value="00" valmonth="" disabled selected> - Month - </option>
                                        <option value="01" valmonth="January">January</option>
                                        <option value="02" valmonth="February">February</option>
                                        <option value="03" valmonth="March">March</option>
                                        <option value="04" valmonth="April">April</option>
                                        <option value="05" valmonth="May">May</option>
                                        <option value="06" valmonth="June">June</option>
                                        <option value="07" valmonth="July">July</option>
                                        <option value="08" valmonth="August">August</option>
                                        <option value="09" valmonth="September">September</option>
                                        <option value="10" valmonth="October">October</option>
                                        <option value="11" valmonth="November">November</option>
                                        <option value="12" valmonth="December">December</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4" style="padding: 0px;">
                                <div class="form-group">
                                    <select class="form-control col-md-4 mdllogin-txtbirthyear" name="mdllogin-txtbirthyear[]">
                                        <option value="0000" valmonth="" disabled selected> - Year - </option>
                                        <?php for ($i = 1970; $i <= date('Y'); $i++) {
                                            echo '<option value="' . $i . '">' . $i . '</option>';
                                        } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default hov-white btn-addpatient">+ ADD NEW PATIENT</button>
                <button type="button" class="btn btn-default hov-white btn-sbmappointment">SUBMIT</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade form" id="accountRegistrationModal" tabindex="-1" role="dialog" aria-labelledby="accountRegistrationModalLabel" style="overflow: overlay;">
    <div class="modal-dialog" role="document">
        <div class="modal-content form">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title italic purple" id="accountRegistrationModalLabel">ACCOUNT REGISTRATION</h3>
            </div>
            <div class="modal-body accountRegistrationModalBody">
                <form class="form-control-wrapper frmAccountRegistrationModal">
                    <div class="form-group">
                        <input type="text" class="form-control" id="mdl-txtregname" placeholder="Name">
                    </div>
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="mdl-txtregschedule">
                        <input type="hidden" class="form-control" id="mdl-txtregspeciality">
                        <input type="hidden" class="form-control" id="mdl-txtregbookdate">
                        <input type="text" class="form-control" id="mdl-txtregemail" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <input type="password" onkeyup="passConfirmation()" class="form-control" id="mdl-txtregpass" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <input type="password" onkeyup="passConfirmation()" class="form-control" id="mdl-txtregpassconfirm" placeholder="Confirm Password">
                        <div id="passalert" class="italic purple" style="display: none;">Password Doesnt Match...</div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="mdl-txtregphone" placeholder="Phone">
                    </div>
                </form>
            </div>
            <div>
                <div class="modal-body AccountPatientRegModalBody">
                    <h3 class="modal-title italic purple" id="AccountPatientRegModalLabel">PATIENT DATA</h3>
                    <input type="hidden" name="patientCounter" id="patientCounter">
                    <form class="form-control-wrapper frmAccountPatientModal">
                        <div class="row field">
                            <!-- <button type="button" class="close field" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
                            <div class="col-md-12" style="padding: 15px 0px 0px;">
                                <div class="col-md-12">
                                    <div class="form-group inputPatientName">
                                        <input type="text" class="form-control mdllogin-txtpatientname" name="mdllogin-txtpatientname[]" placeholder=" Nama Pasien ">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="radio" class="sex mdllogin-txtpatientsex" name="mdllogin-txtpatientsex-1[]" value="1" />&nbsp;Male&nbsp;&nbsp;&nbsp;
                                        <input type="radio" class="sex mdllogin-txtpatientsex" name="mdllogin-txtpatientsex-1[]" value="0" />&nbsp;Female
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12" style="padding: 0px;">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-control-label">Tanggal Lahir</label>
                                        <select class="form-control col-md-4 mdllogin-txtbirthday" name="mdllogin-txtbirthday[]">
                                            <option value="0" valmonth="" disabled selected> - Day - </option>
                                            <?php for ($i = 1; $i < 32; $i++) {
                                                echo '<option value="' . $i . '">' . $i . '</option>';
                                            } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-control-label">&nbsp;</label>
                                        <select class="form-control col-md-4 mdllogin-txtbirthmonth" name="mdllogin-txtbirthmonth[]">
                                            <option value="00" valmonth="" disabled selected> - Month - </option>
                                            <option value="01" valmonth="January">January</option>
                                            <option value="02" valmonth="February">February</option>
                                            <option value="03" valmonth="March">March</option>
                                            <option value="04" valmonth="April">April</option>
                                            <option value="05" valmonth="May">May</option>
                                            <option value="06" valmonth="June">June</option>
                                            <option value="07" valmonth="July">July</option>
                                            <option value="08" valmonth="August">August</option>
                                            <option value="09" valmonth="September">September</option>
                                            <option value="10" valmonth="October">October</option>
                                            <option value="11" valmonth="November">November</option>
                                            <option value="12" valmonth="December">December</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-control-label">&nbsp;</label>
                                        <select class="form-control col-md-4 mdllogin-txtbirthyear" name="mdllogin-txtbirthyear[]">
                                            <option value="0" valmonth="" disabled selected> - Year - </option>
                                            <?php for ($i = 1970; $i <= date('Y'); $i++) {
                                                echo '<option value="' . $i . '">' . $i . '</option>';
                                            } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-addpatient hov-white">+ ADD NEW PATIENT</button>
                <button type="button" class="btn btn-sbmregister hov-white" disabled="disabled">SUBMIT</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="invstorViewer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document" style="margin-top: 5%">
        <div class="modal-content">
            <script type='text/javascript' src='<?php //echo base_url("assets/front/js/viz_v1.js");
                                                ?>'></script>
            <div class='tableauPlaceholder' style='width: 100%; height: 100%;'>
                <object class='tableauViz' width='100%' height='450px' style='display:none;'>
                    <!--<param name='host_url' value='http%3A%2F%2F139.255.96.150%3A81%2F' /> -->
                    <param name='embed_code_version' value='3' />
                    <param name='site_root' value='' />
                    <param name='name' value='BrawijayaDashboard&#47;Dashboard1' />
                    <param name='tabs' value='no' />
                    <param name='toolbar' value='yes' />
                    <param name='showAppBanner' value='false' />
                    <param name='filter' value='iframeSizedToWindow=true' />
                </object>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="imageViewer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document" style="margin-top: 5%">
        <div class="modal-content">
            <img class="contentimageViewer" src="<?php echo base_url('assets/img/logo/background.png'); ?>" width="100%">
        </div>
    </div>
</div>

<div class="modal fade" id="postViewer" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <p>One fine body&hellip;</p>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<div class="modal fade form" id="profileDoctorModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="profileDoctorModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content form" style="min-height: 75vh;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body profileDoctorModalBody">
                <div class="row">
                    <div class="col-md-6">
                        <img src="" alt="" class="doctor-img">
                    </div>
                    <div class="col-md-6">
                        <div>
                            <!-- Nav tabs -->
                            <ul class="nav nav-pills nav-fill" id="view-doctor-tab" role="tablist" style="margin-bottom: 1rem;">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-doctor-profile-tab" data-toggle="pill" href="#pills-doctor-profile" role="tab" aria-controls="pills-doctor-profile" aria-selected="true">Profile</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-doctor-schedule-tab" data-toggle="pill" href="#pills-doctor-schedule" role="tab" aria-controls="pills-doctor-schedule" aria-selected="false">Schedule</a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane" id="pills-doctor-profile">
                                    <div class="profile-container">
                                        <div class="profile-box">
                                            <h6 class="label">Doctor Name</h6>
                                            <p class="doctor-name text-value"></p>
                                        </div>
                                        <div class="profile-box">
                                            <h6 class="label">Practice Location</h6>
                                            <p class="location text-value"></p>
                                        </div>
                                        <div class="profile-box">
                                            <h6 class="label">Specialist</h6>
                                            <p class="specialist text-value"></p>
                                        </div>
                                        <div class="profile-box">
                                            <h6 class="label">Description</h6>
                                            <div class="description"></div>
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="pills-doctor-schedule">
                                    <div class="schedule-wrapper hide">

                                    </div>

                                    <div class="poli-wrap">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade form" id="otp_modal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content form">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title italic purple">Konfirmasi OTP</h3>
            </div>
            <div class="modal-body">
                <div class="position-relative">
                    <div class="text-center">
                        <h4>Mohon masukkan kode OTP untuk melanjutkan proses pendaftaran</h4>
                        <h4> <span>4 Digit Kode telah dikirim ke whatsapp</span> <small id="phone-otp"></small> </h4>
                        <div id="otp" class="inputs d-flex flex-row justify-content-center mt-2">
                            <input class="text-center form-control rounded" type="text" id="first" maxlength="1" />
                            <input class="text-center form-control rounded" type="text" id="second" maxlength="1" />
                            <input class="text-center form-control rounded" type="text" id="third" maxlength="1" />
                            <input class="text-center form-control rounded" type="text" id="fourth" maxlength="1" />
                        </div>
                        <div class="mt-4" style="margin-top: 20px; margin-bottom: 20px;">
                            <button class="btn px-4 otp-validation" onclick="validateOTP(event)">Kirim & Lanjutkan!</button>
                        </div>
                        <div>
                            <p>Belum menerima kode? <span style="cursor: pointer;" onclick="resendOtp(event)">Kirim ulang kode!</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade form" id="appointment_modal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content form">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title italic purple">APPOINTMENT</h3>
            </div>
            <div class="modal-body setAppointmentModalBody">
                <div class="loading" style="display: flex; justify-content: center; align-items: center; padding-bottom: 20px;">
                    <h4><i class="fa fa-spinner fa-spin" style="margin-right: 10px;"></i>Please Wait...</h4>
                </div>
                <div class="appointmentResult">
                    <form class="form-control-wrapper frmSetAppointmentModal">
                        <div id="appointment_doctor_info">
                            <div id="appointment_schedule_doctor_name"></div>
                            <div id="appointment_schedule_specialist_name"></div>
                        </div>
                        <div id="appointment_success" class="hide">
                            <div>Congratulations, your appointment is successfully requested.<br>Please check your email for details.<br>Your booking Code:</div>
                            <h1 id="appointment_booking_code"></h1>
                            <div class="appointment_success_cta">
                                <button type="button" class="btn btn-default hov-white" data-dismiss="modal">Ok, Close Popup</button>
                            </div>
                        </div>
                        <div id="appointment_details">
                            <div id="appointment_schedule_hospital_area">
                                <div id="appointment_schedule_hospital_name"></div>
                                <div>Please select suitable schedule time.</div>
                            </div>
                            <div class="poli_wrapper">

                            </div>
                            <table class="table schedule_table" style="display: none;">
                                <thead>
                                    <th>Day & Time</th>
                                    <th width="120">Morning</th>
                                    <th width="120">Noon</th>
                                    <th width="120">Afternoon</th>
                                </thead>
                                <tbody id="appointment_schedule_tbody"></tbody>
                            </table>
                            <?php if (_ENABLE_APPOINTMENT) : ?>
                                <div id="appointment_form">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="required">Date</label>
                                                <select id="appointment_schedule_date" class="form-control" disabled="disabled" name="date">
                                                    <option class="hide" value="0">Please choose schedule</option>
                                                </select>
                                            </div>
                                            <div id="appointment_form_details" class="hide">
                                                <div class="form-group">
                                                    <div>
                                                        <label>
                                                            <input type="radio" name="patient_lt" checked value="new"><span style="margin-left:5px;">Pasien Baru</span>
                                                        </label>
                                                        <label style="margin-left:20px;">
                                                            <input type="radio" name="patient_lt" value="old"><span style="margin-left:5px;">Pasien Lama</span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="form-group mrid-old-wrapper">
                                                    <label class="required">MRID</label>
                                                    <input type="text" class="form-control" name="mrid" placeholder="Your Medical Record Number if Any" />
                                                    <small class="text-danger" id="error-mrid">Your MRID is not valid, make sure your MRID are valid!</small>
                                                </div>
                                                <div class="form-group mrid-new-wrapper">
                                                    <label class="required">Name</label>
                                                    <input type="text" class="form-control" name="name" placeholder="Your Full Name" />
                                                </div>
                                                <div class="form-group mrid-new-wrapper">
                                                    <label class="required">Gender</label>
                                                    <div>
                                                        <label>
                                                            <input type="radio" name="gender" value="M"><span style="margin-left:5px;">Male</span>
                                                        </label>
                                                        <label style="margin-left:20px;">
                                                            <input type="radio" name="gender" value="F"><span style="margin-left:5px;">Female</span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="required">Birth Date</label>
                                                    <input type="date" class="form-control" name="birthdate" placeholder="Your Birth Date" />
                                                </div>
                                                <div class="form-group mrid-new-wrapper">
                                                    <label class="required">Birth Place</label>
                                                    <input type="text" class="form-control" name="birthplace" placeholder="Your Birth Place" />
                                                </div>
                                                <div class="form-group">
                                                    <label style="margin-bottom: 0px !important;" class="required">Mobile Phone</label>
                                                    <small style="display: block; font-size: 14px; font-weight: 200;">Pastikan nomor yang anda masukkan terhubung dengan Whatsapp</small>
                                                    <input type="text" class="form-control" name="mobile_phone" placeholder="Mobile Phone" />
                                                </div>
                                                <div class="form-group">
                                                    <label class="required">Address</label>
                                                    <input type="text" class="form-control" name="address" placeholder="Full Address" />
                                                </div>
                                                <div class="form-group">
                                                    <label class="required">Asuransi</label>
                                                    <div>
                                                        <label>
                                                            <input type="radio" name="insurence" value="1"><span style="margin-left:5px;">Yes</span>
                                                        </label>
                                                        <label style="margin-left:20px;">
                                                            <input type="radio" name="insurence" value="0"><span style="margin-left:5px;">No</span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Email Address</label>
                                                    <input type="email" class="form-control" name="email" placeholder="Email Address" />
                                                </div>
                                                <div class="appointment_form_cta form-group">
                                                    <div class="row">
                                                        <div class="col-sm-6 appointment_form_cta_cancel_wrapper">
                                                            <button type="button" class="btn btn-default hov-white appointment_form_cta_button" data-dismiss="modal">CLOSE</button>
                                                        </div>
                                                        <div class="col-sm-6 appointment_form_cta_submit_wrapper">
                                                            <button id="appointment_form_cta_submit" type="button" class="btn btn-default hov-white appointment_form_cta_button">SUBMIT</button>
                                                        </div>
                                                        <div class="col-sm-12 appointment_form_cta_loading hide">Submitting data, please wait...</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade form" id="appointmentModal" tabindex="-1" role="dialog" aria-labelledby="setAppointmentModalLabel">
    <div class="modal-dialog" role="document">
        <link href='https://fonts.googleapis.com/css?family=Roboto:400,500' rel='stylesheet' type='text/css'>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <div class="modal-content form">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title italic purple" id="setAppointmentModalLabel">GET APPOINTMENT</h3>
            </div>
            <div class="modal-body setAppointmentModalBody">
                <form class="form-control-wrapper frmSetAppointmentModal">
                    <div class="form-group">
                        <label class="form-control-label">Speciality</label>
                        <input type="text" class="form-control" id="mdl-txtspeciality" placeholder=" - Speciality - ">
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Doctor</label>
                        <input type="text" class="form-control" id="mdl-txtdoctor" placeholder=" - Doctor - ">
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Location</label>
                        <input type="text" class="form-control" id="mdl-txthospital" placeholder=" - Hospital - ">
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Date</label>
                        <input type="text" class="form-control" id="mdl-txtdate" placeholder=" - Date - ">
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Time</label>
                        <input type="text" class="form-control" id="mdl-txthour" placeholder=" - Hour - ">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default hov-white" data-dismiss="modal">CLOSE</button>
                <button type="button" class="btn btn-default btn-submit hov-white">SUBMIT</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade form" id="offerRegistrationModal" tabindex="-1" role="dialog" aria-labelledby="offerRegistrationModalLabel" style="overflow: overlay;">
    <div class="modal-dialog" role="document">
        <div class="modal-content form">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title italic purple" id="offerRegistrationModalLabel">SPECIAL OFFER FORM</h3>
            </div>
            <div class="modal-body offerRegistrationModalBody">
                <form class="form-control-wrapper frmOfferRegistrationModal">
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="mdl-txtoffid">
                        <input type="text" class="form-control" id="mdl-txtofftitle" readonly="readonly">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="mdl-txtoffname" placeholder="Name">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="mdl-txtoffemail" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="mdl-txtoffphone" placeholder="Phone">
                    </div>
                    <div class="form-group">
                        <select class="form-control" id="mdl-txtoffunit">
                            <option value="0" disabled="disabled">- Pilih Unit -</option>

                            <?php
                            $getUnit = $this->mhospital->getActived()->result_array();
                            ?>

                            <?php foreach ($getUnit as $row) { ?>
                                <option value="<?php echo $row['idhospital']; ?>"><?php echo $row['namehospital']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="mdl-txtoffmessage" placeholder="Message">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn hov-white" id="btn-back-brochure">VIEW BROCHURE</button>
                <button type="button" class="btn btn-sbmofferregister hov-white">SUBMIT</button>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url('assets/front/js/jquery.min.js'); ?>"></script>
<!-- <script src="<?php echo base_url('assets/dist/js/jquery.validate.min.js'); ?>"></script> -->
<!-- <script src="<?php echo base_url('assets/dist/js/additional-methods.min.js'); ?>"></script> -->
<script src="<?php echo base_url('assets/front/js/tether.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/front/js/bootstrap.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/front/slick/slick.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/front/js/jquery-migrate-1.2.1.min.js'); ?>"></script>
<!-- Timepicker -->
<script src="<?php echo base_url('assets/admin/js/ripples.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/admin/js/material.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/admin/js/moment-with-locales.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/admin/js/bootstrap-material-datetimepicker.js'); ?>"></script>
<script src="<?php echo base_url('assets/front/js/classie.js'); ?>"></script>
<script src="<?php echo base_url('assets/front/js/lodash-4.17.21.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/front/js/moment-2.29.1.min.js') ?>"></script>

<!-- sweetalert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.16/dist/sweetalert2.all.min.js"></script>

<script src="<?php echo base_url('assets/front/js/customjs.js?' . date('Ymdhis')); ?>"></script>
<script src="<?php echo base_url('assets/front/js/javascript.js?' . date('Ymdhis')); ?>"></script>

<script src="<?= base_url('assets/bundle/app.js?' . date('Ymdhis')); ?>"></script>
<script type="text/javascript">
    function hideButton() {
        document.querySelector('#listRs').style.display = "none";
    }
</script>
<script type="text/javascript">
    //var headerHeight = $("section#header").height();
    $('a[href*="#"]')
        // Remove links that don't actually link to anything
        .not('[href="#"]')
        .not('[href="#0"]')
        .not('.nav-link[href="#pills-doctor-profile"]')
        .not('.nav-link[href="#pills-doctor-schedule"]')
        .click(function(event) {
            // On-page links
            if (
                location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') &&
                location.hostname == this.hostname
            ) {
                // Figure out element to scroll to
                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                // Does a scroll target exist?
                if (target.length) {
                    // Only prevent default if animation is actually gonna happen
                    event.preventDefault();
                    console.log(target);
                    $('html, body').animate({
                        scrollTop: target.offset().top - 200
                    }, 1000, function() {
                        // Callback after animation
                        // Must change focus!
                        var $target = $(target);
                        $target.focus();
                        if ($target.is(":focus")) { // Checking if the target was focused
                            return false;
                        } else {
                            $target.attr('tabindex', '-1'); // Adding tabindex for elements not focusable
                            $target.focus(); // Set focus again
                        };
                    });
                }
            }
        });

    $('#view-doctor-tab a').click(function(e) {
        e.preventDefault();
        $(this).tab('show');
    })
</script>
<script>
    function loadMaps($lat, $lng, $rs = '', $desc = '') {
        var url = '<?php echo $this->uri->segment(1); ?>';

        if ($lat === undefined) {
            var id = $("#dd_location").val();
            var ex = id.split("|");

            $lat = parseFloat(ex[0]);
            $lng = parseFloat(ex[1]);

            var myLatLng = {
                lat: $lat,
                lng: $lng
            }

            var map = new google.maps.Map(document.getElementById('gmap_canvas'), {
                zoom: 15,
                center: myLatLng
            })

            var marker = new google.maps.Marker({
                position: myLatLng,
                map: map
            })

            $.post(
                '<?php echo base_url("location/loaddeschospital/") ?>' + $lat + '/' + $lng, {
                    lat: $lat,
                    lng: $lng
                },
                function(data) {
                    $('.title-maps').html(data).fadeIn(1000);
                }
            );
        } else {
            if (url == 'location') {
                $(document).ready(function() {
                    $.getScript('https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyAE2rsUNHLPo71yoQ5TLCLy9R8qCQ3Zl0w', function() {
                        var myLatLng = {
                            lat: $lat,
                            lng: $lng
                        }

                        var map = new google.maps.Map(document.getElementById('gmap_canvas'), {
                            zoom: 15,
                            center: myLatLng
                        })

                        var contentString = '<div id="content">' +
                            '<div id="bodyContent">' +
                            '<p class="no-pad" style="line-height:25px;"><b>' + $rs + '</b><br>' + $desc + '<br><a target="_blank" href="https://www.google.com/maps/search/' + $lat + ',' + $lng + '">' +
                            'View on google maps</a> ' +
                            '</p>' +
                            '</div>' +
                            '</div>';

                        var infowindow = new google.maps.InfoWindow({
                            content: contentString
                        });

                        var marker = new google.maps.Marker({
                            position: myLatLng,
                            map: map
                        })

                        marker.addListener('click', function() {
                            infowindow.open(map, marker);
                        });
                    })
                })
            }
        }
    }

    function loadSlick() {
        const responsive = [{
                breakpoint: 425,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: false,
                    autoplay: true,
                },
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                },
            },
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 4
                },
            }
        ];
        $('.image-banner').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 4000,
            arrows: true,
            dots: false,
            // prevArrow: '<img class="bannerArrow prevArrow" src="<?php echo base_url('assets/img/logo/banner-arrow-left.png') ?>">',
            // nextArrow: '<img class="bannerArrow nextArrow" src="<?php echo base_url('assets/img/logo/banner-arrow-right.png') ?>">',
            responsive: [{
                    breakpoint: 2000,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 515,
                    settings: {
                        dots: false,
                        arrows: false,
                    }
                }
            ]
        });

        $('.image-banner-fade').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 4000,
            arrows: true,
            dots: false,
            // prevArrow: '<img class="bannerArrow prevArrow" src="<?php echo base_url('assets/img/logo/banner-arrow-left.png') ?>">',
            // nextArrow: '<img class="bannerArrow nextArrow" src="<?php echo base_url('assets/img/logo/banner-arrow-right.png') ?>">',
            responsive: [{
                    breakpoint: 2000,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 515,
                    settings: {
                        dots: false,
                        arrows: false,
                        infinite: true,
                        speed: 500,
                        fade: true,
                        cssEase: 'linear',
                    }
                }
            ]
        });

        $('.image-banner-dots').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 4000,
            arrows: false,
            dots: true,
            responsive: [{
                    breakpoint: 2000,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 515,
                    settings: {
                        dots: false,
                    }
                }
            ]
        });

        $('.slider-for').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: true,
            fade: true,
            asNavFor: '.slider-nav',
            prevArrow: '<a href="#"><img class="bannerArrow prevArrow" src="<?php echo base_url('assets/img/logo/banner-arrow-left.png') ?>"></a>',
            nextArrow: '<a href="#"><img class="bannerArrow nextArrow" src="<?php echo base_url('assets/img/logo/banner-arrow-right.png') ?>"></a>',
        });

        $('.slider-nav').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            asNavFor: '.slider-for',
            dots: false,
            centerMode: false,
            focusOnSelect: true,
        });

        $('.poster-slide').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            autoplay: false,
            autoplaySpeed: 4000,
            arrows: true,
            dots: false,
            prevArrow: '<a href="#"><img class="bannerArrow prevArrow" src="<?php echo base_url('assets/img/logo/banner-arrow-left.png') ?>"></a>',
            nextArrow: '<a href="#"><img class="bannerArrow nextArrow" src="<?php echo base_url('assets/img/logo/banner-arrow-right.png') ?>"></a>',
            responsive: [{
                    breakpoint: 991,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 515,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        dots: false,
                    }
                }
            ]
        });

        $('.revamp-coe-wrapper').slick({
            slidesToShow: 4,
            slidesToScroll: 4,
            arrows: true,
            dots: true,
            adaptiveHeight: true,
            dotsClass: "slick-dots coe-slick-dots",
            responsive: responsive
            // prevArrow: '<img class="bannerArrow prevArrow" src="<?php echo base_url('assets/img/logo/banner-arrow-left.png') ?>">',
            // nextArrow: '<img class="bannerArrow nextArrow" src="<?php echo base_url('assets/img/logo/banner-arrow-right.png') ?>">',
        })

        $('.revamp-testimoni-wrapper').slick({
            slidesToShow: 4,
            slidesToScroll: 4,
            arrows: true,
            dots: true,
            dotsClass: "slick-dots testimoni-slick-dots",
            adaptiveHeight: true,
            responsive: responsive
            // prevArrow: '<img class="bannerArrow prevArrow" src="<?php echo base_url('assets/img/logo/banner-arrow-left.png') ?>">',
            // nextArrow: '<img class="bannerArrow nextArrow" src="<?php echo base_url('assets/img/logo/banner-arrow-right.png') ?>">',
        })
    }

    function loadHeaderInit() {
        window.addEventListener('scroll', function(e) {
            var distanceY = window.pageYOffset || document.documentElement.scrollTop,
                shrinkOn = 300,
                header = document.getElementById("header");
            if (distanceY > shrinkOn) {
                if (classie.has(header, "smaller")) {

                } else {
                    $(".image-banner").slick('slickNext');
                }

                classie.add(header, "smaller");
            } else {
                if (classie.has(header, "smaller")) {
                    classie.remove(header, "smaller");
                    $(".image-banner").slick('slickNext');
                }
            }

        });
    }

    function loadLinkTab(id) {
        $(".overlay").fadeIn(600);
        window.location.href = '<?php echo base_url('about/sub/about_vision_mission'); ?>';
        $(id).tab('show');
        $(".overlay").fadeOut(1200);
    }

    function loadDivPage(param1, param2, param3) {
        /* banner */
        $(".overlay").fadeIn(600);

        /* load div */
        if (param3 === undefined) {
            var id = '';
        } else {
            var id = param3;
        }

        if (id == '53') {
            $("#postViewer .modal-body").html('<h3 class="purple" align="center">Information</h3><p style="text-align:center !important;">We Are Having an Update</p>');
            $("#postViewer").modal({
                backdrop: "static",
                keyboard: false
            });
            $(".overlay").fadeOut(1200);
        } else {
            $.post(
                "<?php echo base_url('loadsub/'); ?>" + param2 + "/" + id, {
                    id: 0
                },
                function(data) {
                    $('#' + param1).tab('show')
                    $('.tab-pane.active').html(data).fadeIn(1000);
                    $(".overlay").fadeOut(1200);
                    window.scrollTo(0, 0)

                    $('.slider-for').slick({
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        arrows: true,
                        fade: true,
                        asNavFor: '.slider-nav',
                        prevArrow: '<a href="#"><img class="bannerArrow prevArrow" src="<?php echo base_url('assets/img/logo/banner-arrow-left.png') ?>"></a>',
                        nextArrow: '<a href="#"><img class="bannerArrow nextArrow" src="<?php echo base_url('assets/img/logo/banner-arrow-right.png') ?>"></a>',
                    });

                    $('.slider-nav').slick({
                        slidesToShow: 3,
                        slidesToScroll: 1,
                        asNavFor: '.slider-for',
                        dots: false,
                        centerMode: false,
                        focusOnSelect: true,
                    });
                }
            );
        }
    }

    function loadMore(limit) {
        //$(".overlay").fadeIn(600);

        if (limit === undefined) {
            var limit = $('.loadmore').attr('limit');
        }

        var app = 3;
        var nextlimit = parseInt(limit) + parseInt(app);

        $.post(
            '<?php echo base_url('about/load_more'); ?>', {
                limit: limit
            },
            function(data) {
                var exdata = data.split('+_+');
                var content = exdata[0];
                var status = exdata[1];
                $('.outer-newsevent-list').hide();
                $('.outer-newsevent-list').html(content);
                $('.outer-newsevent-list').fadeIn(1000);

                if (status == 'true') {
                    $('.loadmore').hide();
                    $('.loadless').show();
                } else {
                    $('.loadmore').attr('limit', nextlimit);
                    $('.loadmore').show();
                    $('.loadless').hide();
                }

                $(".overlay").fadeOut(1200);
            }
        )
    }

    function viewPicture(url) {
        $('.contentimageViewer').attr('src', url);
        $('#imageViewer').modal('show');
    }

    function viewPictureBtn(url, id, promo, attach) {
        $('.contentimageViewer').attr('src', url);

        if (attach !== undefined && attach == '1') {
            // var html = '<a href="javascript:void(0);" onclick="viewCSForm(\'' + url + '\',' + id + ',\'' + promo + '\')" class="btn btn-primary btn-offer">Registrasi</a>';
        } else {
            $(".btn-offer").remove();
            var html = '';
        }

        $('#imageViewer .modal-content').append(html);

        $('.modal').modal('hide');
        $('#imageViewer').modal('show');
    }

    function viewCSForm(url, id, promo, attach) {
        if (attach !== undefined && attach == '1') {
            $('#btn-back-brochure').attr('onclick', 'viewPictureBtn(\'' + url + '\',' + id + ',\'' + promo + '\',\'' + attach + '\')');
        } else {
            $('#btn-back-brochure').attr('onclick', 'viewPictureBtn(\'' + url + '\',' + id + ',\'' + promo + '\')');

        }

        $('#mdl-txtofftitle').val(promo);
        $('#mdl-txtoffid').val(id);
        $('.modal').modal('hide');
        $('#offerRegistrationModal').modal('show');
    }

    function viewPost(id) {
        $(".overlay").fadeIn(600);

        var url = "<?php echo base_url('load_post'); ?>";

        $.post(
            url, {
                id: id
            },
            function(data) {
                $("#postViewer .modal-body").html(data);

                $(".overlay").fadeOut(1200);

                $('#postViewer').modal('show');
            }
        );
    }

    function redirectLink(url) {

        window.location.href = url;
    }

    /* --- BOOKING FUNCTION --- */
    function elementFunction(status, param) {
        if (status == 'disabled') {
            if (param == 'mdllogin') {
                $("#accountLoginModal #mdllogin-txtpatientid").attr('disabled', 'disabled');
                $("#accountLoginModal .mdllogin-txtpatientname").attr('disabled', 'disabled');
                $("#accountLoginModal #mdllogin-txtpatientemail").attr('disabled', 'disabled');
                $("#accountLoginModal #mdllogin-txtpatientphone").attr('disabled', 'disabled');
                $("#accountLoginModal .mdllogin-txtbirthday").attr('disabled', 'disabled');
                $("#accountLoginModal .mdllogin-txtbirthmonth").attr('disabled', 'disabled');
                $("#accountLoginModal .mdllogin-txtbirthyear").attr('disabled', 'disabled');
                $("#accountLoginModal .mdllogin-txtpatientsex").attr('disabled', 'disabled');
            }
        } else {
            if (param == 'mdllogin') {
                $("#accountLoginModal #mdllogin-txtpatientid").removeAttr('disabled');
                $("#accountLoginModal .mdllogin-txtpatientname").removeAttr('disabled');
                $("#accountLoginModal #mdllogin-txtpatientemail").removeAttr('disabled');
                $("#accountLoginModal #mdllogin-txtpatientphone").removeAttr('disabled');
                $("#accountLoginModal .mdllogin-txtbirthday").removeAttr('disabled');
                $("#accountLoginModal .mdllogin-txtbirthmonth").removeAttr('disabled');
                $("#accountLoginModal .mdllogin-txtbirthyear").removeAttr('disabled');
                $("#accountLoginModal .mdllogin-txtpatientsex").removeAttr('disabled');
            }
        }
    }

    function passConfirmation() {
        var regpass = $("#mdl-txtregpass").val();
        var regpassconfirm = $("#mdl-txtregpassconfirm").val();

        if (regpass != regpassconfirm) {
            $("#passalert").show()
            $(".btn-sbmregister").attr('disabled', 'disabled');
        } else {
            $("#passalert").hide()
            $(".btn-sbmregister").removeAttr('disabled');
        }
    }

    function setPatient(id, name, email, phone, birthday, sex, row) {
        var date = birthday.split('-');
        var day = date[2];
        var month = date[1];
        var year = date[0];

        if (row == undefined) {
            var element1 = $('.mdllogin-txtbirthday');
            var element2 = $('.mdllogin-txtbirthmonth');
            var element3 = $('.mdllogin-txtbirthyear');
            var checkbox = 'input[name=mdllogin-txtpatientsex]';

            $("#accountLoginModal #mdllogin-txtpatientid").val(id);
            $("#accountLoginModal .mdllogin-txtpatientname").val(name);
            $("#accountLoginModal #mdllogin-txtpatientemail").val(email);
            $("#accountLoginModal #mdllogin-txtpatientphone").val(phone);
            element1.val(day);
            element2.val(month);
            element3.val(year);
        } else {
            var element1 = $('.mdllogin-txtbirthday-' + row);
            var element2 = $('.mdllogin-txtbirthmonth-' + row);
            var element3 = $('.mdllogin-txtbirthyear-' + row);
            var checkbox = 'input[name=mdllogin-txtpatientsex-' + row + ']';

            $("#accountLoginModal #mdllogin-txtpatientid-" + row).val(id);
            $("#accountLoginModal .mdllogin-txtpatientname-" + row).val(name);
            $("#accountLoginModal #mdllogin-txtpatientemail-" + row).val(email);
            $("#accountLoginModal #mdllogin-txtpatientphone-" + row).val(phone);
            element1.val(day);
            element2.val(month);
            element3.val(year);
        }

        if (sex == '1' || sex == '0') {
            elementFunction('disabled', 'mdllogin');
            $(checkbox + '[value=' + sex + ']').attr('checked', 'checked');
        } else {
            elementFunction('enabled', 'mdllogin');
            $(checkbox).removeAttr('checked');
        }
    }

    function doLogin(email, password, idschedule, idspeciality) {
        if (idspeciality == undefined) {
            idspeciality = '';
        }

        if (idschedule == undefined || idschedule == '') {
            access = 'login';
        } else {
            access = '';
        }

        $.post(
            "<?php echo base_url('home/load_modalAccLogin/'); ?>" + access, {
                email: email,
                password: password,
                idschedule: idschedule,
                idspeciality: idspeciality
            },
            function(data) {
                if (data == 'Failed') {
                    location.href = '<?php echo base_url('failed/login'); ?>';
                } else if (data == 'Logged On') {
                    location.href = '<?php echo base_url(''); ?>';
                } else {
                    var splitdata = data.split('--delimiter--');

                    $("#accountInformationModal").modal('hide');

                    $(".frmAccountLoginModal").html(splitdata[0]);
                    $("#dropdown-patient").html(splitdata[1]);

                    $("#accountLoginModal").modal('show');
                }
            }
        );
    }

    function delPatient(row) {

        $(".field-" + row).remove();
    }

    $(document).ready(function() {

        $('.modal').on('hidden.bs.modal', function(e) {
            if ($('.modal').hasClass('in')) {
                $('body').addClass('modal-open');
            }
        });

        /* --- GENERAL --- */
        $(".overlay").fadeOut(1200);
        $('[data-toggle="tooltip"]').tooltip();

        <?php
        $url1 = $this->uri->segment(1);
        $url2 = $this->uri->segment(2);
        $url3 = $this->uri->segment(3);
        $url4 = $this->uri->segment(4);

        if ($url1 == 'location') {
            if ($url2 != '') {
                if ($url2 == 'detail') {
                    $getLatLng = $this->mhospital->getJoinByWhere("idhospital = '" . $this->uri->segment(3) . "'")->row_array();
                    // echo 'loadMaps(' . $getLatLng['latitude'] . ', ' . $getLatLng['longitude'] . ', "' . $getLatLng['namehospital'] . '", "' . trim(preg_replace('/\s+/', ' ', $getLatLng['addresshospital'])) . '");';
                    //echo 'loadMaps(-6.257503, 106.807413);';
                } else {
                    switch ($url2) {
                        case 'brawijayaclinickemang':
                            $uriid = '1';
                            break;
                        case 'brawijayaclinicuob':
                            $uriid = '2';
                            break;
                        case 'brawijayahospitalantasari':
                            $uriid = '3';
                            break;
                        case 'brawijayarsiadurentiga':
                            $uriid = '4';
                            break;
                        case 'brawijayaclinicbuahbatu':
                            $uriid = '5';

                            // echo '$("#postViewer .modal-body").html(\'<h3 class="purple" align="center">Brawijaya Clinic Buah Batu Bandung</h3><p style="text-align:center !important;">Untuk informasi Schedule & Appointment Dokter, hubungi:<br><a href="tel:0227308104"><img src="'.base_url('assets/img/logo/bwch_phone_icon.png').'" width="24px"> (022) 730 8104</a><br><a href="https://api.whatsapp.com/send?phone=6281222234943"><img src="'.base_url('assets/img/logo/bwch_wa_icon.png').'" width="24px"> 0812-2223-4943</a></p>\');';
                            // echo '$("#postViewer").modal("show");';
                            break;
                        case 'brawijayasaharjo':
                            $uriid = '7';
                            break;
                        case 'brawijayahospitaltangerang':
                            $uriid = '8';
                            break;
                        case 'brawijayahospitalbojongsari':
                            $uriid = '6';
                            break;
                        case 'brawijayahospitaldepok':
                            $uriid = '6';
                            break;
                        default:
                            $uriid = $this->uri->segment(2);
                            break;
                    }

                    $getLatLng = $this->mhospital->getJoinByWhere("idhospital = '" . $uriid . "'")->row_array();
                    // echo 'loadMaps(' . $getLatLng['latitude'] . ', ' . $getLatLng['longitude'] . ', "' . $getLatLng['namehospital'] . '", "' . trim(preg_replace('/\s+/', ' ', $getLatLng['addresshospital'])) . '");';
                }
            } else {
                // echo 'loadMaps(-6.257503, 106.807413);';
            }
        } elseif ($url1 == 'success') {
            $getPhone = $this->mhospital->getById($url2)->row_array();

            // echo '$("#postViewer .modal-body").html(\'<h3 class="purple" align="center">THANK YOU FOR YOUR BOOKING</h3><p style="text-align:center !important;">Our Team Representation Will Contact You For Further Confirmation<br>To confirm your appointment, please contact our clinic at '.$getPhone['phone'].'</p>\');';
            echo '$("#postViewer .modal-body").html(\'<h3 class="purple" align="center">THANK YOU FOR YOUR ONLINE BOOKING</h3><p style="text-align:center !important;">Please wait for our admission team to contact you and verify your booking appointment.</p>\');';
            echo '$("#postViewer").modal("show");';
        } elseif ($url1 == 'failed') {
            if ($url2 == 'login') {
                echo '$("#postViewer .modal-body").html(\'<h3 class="purple" align="center">LOGIN FAILED!</h3><p style="text-align:center !important;">Check your User ID or Password...</p>\');';
                echo '$("#postViewer").modal("show");';
            } else {
                echo '$("#postViewer .modal-body").html(\'<h3 class="purple" align="center">FAILED!</h3><p style="text-align:center !important;"></p>\');';
                echo '$("#postViewer").modal("show");';
            }
        } elseif ($url1 == 'reg-success') {
            echo '$("#postViewer .modal-body").html(\'<h3 class="purple" align="center">THANK YOU FOR REGISTRATION</h3><p style="text-align:center !important;">Go to Doctors Schedule and Submit Your Booking</p>\');';
            echo '$("#postViewer").modal("show");';
        } elseif ($url1 == 'sub') {
            if (isset($url3)) {

                $getPost = $this->mpost->getJoinByWhere("post.slug = '" . $url3 . "'")->row_array();

                if (is_array($getPost) && count($getPost) > 0) {
        ?>

                    $('html,body').animate({
                        scrollTop: $("#special-offer").offset().top - 135
                    }, 'slow');

                <?php

                    if (!isset($url4)) {
                        echo "viewPictureBtn('" . $getPost['thumbnail'] . "','" . $getPost['post_id'] . "', '" . addslashes($getPost['post_title']) . "','1')";
                    } else {
                        echo "viewCSForm('" . $getPost['thumbnail'] . "','" . $getPost['post_id'] . "', '" . addslashes($getPost['post_title']) . "', '" . $getPost['attach'] . "')";
                    }
                }
            }
        } elseif ($url1 == 'result') {

            if ($url2 == 'search' || strpos($url2, 'location=bandung') == TRUE) {
                // echo '$("#postViewer .modal-body").html(\'<h3 class="purple" align="center">Brawijaya Clinic Buah Batu Bandung</h3><p style="text-align:center !important;">Untuk informasi Schedule & Appointment Dokter, hubungi:<br><a href="tel:0227308104"><img src="'.base_url('assets/img/logo/bwch_phone_icon.png').'" width="24px"> (022) 730 8104</a><br><a href="https://api.whatsapp.com/send?phone=6281222234943"><img src="'.base_url('assets/img/logo/bwch_wa_icon.png').'" width="24px"> 0812-2223-4943</a></p>\');';
                // echo '$("#postViewer").modal("show");';
            }
        } elseif ($url1 == 'bandung') {
            // echo '$("#postViewer .modal-body").html(\'<h3 class="purple" align="center">Brawijaya Clinic Buah Batu Bandung</h3><p style="text-align:center !important;">Untuk informasi Schedule & Appointment Dokter, hubungi:<br><a href="tel:0227308104"><img src="'.base_url('assets/img/logo/bwch_phone_icon.png').'" width="24px"> (022) 730 8104</a><br><a href="https://api.whatsapp.com/send?phone=6281222234943"><img src="'.base_url('assets/img/logo/bwch_wa_icon.png').'" width="24px"> 0812-2223-4943</a></p>\');';
            // echo '$("#postViewer").modal("show");';
        } elseif ($url1 == 'facilities') {
            if ($url2 == 'inpatient-rooms') {
                ?>
                $('#facilitiestab .content').hide();
            <?php

                echo '$("#postViewer .modal-body").html(\'<h3 class="purple" align="center">Information</h3><p style="text-align:center !important;">We Are Having an Update</p>\');';
                echo '$("#postViewer").modal({backdrop: "static", keyboard: false});';
                echo '$(".modal button.close").click(function(){ window.history.go(-1); return false; })';
            } else {
            ?>
                $('#facilitiestab .content').show();
        <?php
            }
        }
        ?>

        loadSlick();
        //loadHeaderInit();

        var uri = '<?php echo $this->uri->segment(1); ?>';

        if (uri == 'search') {
            $('html,body').animate({
                scrollTop: $("#search").offset().top - 135
            }, 'slow');
        }

        $(".slideTo").click(function() {
            var padding;
            var div = $(this).attr('todiv');
            var distanceY = window.pageYOffset || document.documentElement.scrollTop,
                shrinkOn = 300,
                header = document.getElementById("header");

            if (div == 'top') {
                padding = 135; //225;
            } else {
                if (distanceY > shrinkOn) {
                    padding = 125;
                } else {
                    padding = 135; //225;
                }
            }

            $('html,body').animate({
                scrollTop: $("#" + div).offset().top - padding
            }, 'slow');
        })

        $(".btn-sbmofferregister").click(function() {
            $(".overlay").fadeIn(600);

            var offer_id = $("#mdl-txtoffid").val();
            var offer_title = $("#mdl-txtofftitle").val();
            var offer_name = $("#mdl-txtoffname").val();
            var offer_email = $("#mdl-txtoffemail").val();
            var offer_phone = $("#mdl-txtoffphone").val();
            var offer_message = $("#mdl-txtoffmessage").val();
            var offer_unit = $("#mdl-txtoffunit").val();

            $.post(
                "<?php echo base_url('home/addOffer'); ?>", {
                    offerid: offer_id,
                    offertitle: offer_title,
                    offername: offer_name,
                    offeremail: offer_email,
                    offerphone: offer_phone,
                    offerunit: offer_unit,
                    offermessage: offer_message,
                },
                function(data) {
                    $('.modal').modal('hide');

                    $("#mdl-txtoffname").val('');
                    $("#mdl-txtoffemail").val('');
                    $("#mdl-txtoffphone").val('');
                    $("#mdl-txtoffmessage").val('');
                    $("#mdl-txtoffunit").val(0);

                    console.log(data);

                    if (data == 'success') {
                        $(".overlay").fadeOut(600);
                        $("#postViewer .modal-body").html('<h3 class="purple" align="center">THANK YOU FOR REGISTRATION</h3><p style="text-align:center !important;">Our Team Representation Will Contact You For Further Confirmation</p>');
                        $("#postViewer").modal("show");
                    } else {
                        $(".overlay").fadeOut(600);
                        $("#postViewer .modal-body").html('<h3 class="purple" align="center">FAILED!</h3><p style="text-align:center !important;">To confirm your appointment, please contact our clinic.</p>');
                        $("#postViewer").modal("show");
                    }
                }
            );
        });

        $(".header-login").click(function() {
            $("#accountInformationModal").modal('show');
        })

        $(".nav-tabs li a#performance").click(function() {
            $(".slider-newsevent").resize();
        });

        if (matchMedia) {
            const mq = window.matchMedia("(min-width: 768px)");

            if (mq.matches) {
                $(".header-menu li.dropdown").hover(
                    function() {
                        $(this).addClass('open');
                    },
                    function() {
                        $(this).removeClass('open');
                    }
                );

                $(".main.dropdown a.parent.parent-1").attr("onclick", "redirectLink('<?php echo base_url('about'); ?>')");
                $(".main.dropdown a.parent.parent-2").attr("onclick", "redirectLink('<?php echo base_url('location'); ?>')");
                $(".main.dropdown a.parent.parent-3").attr("onclick", "redirectLink('<?php echo base_url('sub/services'); ?>')");
                $(".main.dropdown a.parent.parent-4").attr("onclick", "redirectLink('<?php echo base_url('doctor-schedule'); ?>')");
                $(".main.dropdown a.parent.parent-5").attr("onclick", "redirectLink('<?php echo base_url('services'); ?>')");
                $(".main.dropdown a.parent.parent-6").attr("onclick", "redirectLink('<?php echo base_url('facilities'); ?>')");

            }
        }
        /* --- GENERAL --- */

        /* --- FILTER --- */
        $("#filter-speciality").change(function() {
            var id = $(this).val();

            window.location.href = "<?php echo base_url('doctor-schedule-'); ?>" + id;
        });
        /* --- FILTER --- */

        /* --- APPOINTMENT --- */
        $(".btn-appointment").click(function() {
            $(".overlay").fadeIn(600);

            var mindays = "<?php echo date('Y-m-d'); ?>";
            var idschedule = $(this).attr('idschedule');
            var disableddays = $(this).attr('disableddays');
            var idspeciality = $(this).attr('idspeciality');
            var idhospital = $(this).attr('idhospital');

            $.post(
                "<?php echo base_url('home/load_modalSet'); ?>", {
                    idschedule: idschedule,
                    idspeciality: idspeciality
                },
                function(data) {
                    $(".frmSetAppointmentModal").html(data);

                    if (idspeciality == '9' && idhospital == '5') {
                        mindays = "<?php echo date('Y-m-d', strtotime(date('Y-m-d') . ' +6 day')); ?>";
                    }

                    time_picker(disableddays, mindays);

                    $("#setAppointmentModal").modal('show');
                    $(".overlay").fadeOut(600);
                }
            );
        });

        $(".btn-submit").click(function() {
            $(".overlay").fadeIn(600);

            var idschedule = $("#mdl-txtidschedule").val();
            var idspeciality = $("#mdl-txtidspeciality").val();
            var iddoctor = $("#mdl-txtiddoctor").val();
            var idhospital = $("#mdl-txthospital").val();
            var date = $("#mdl-txtdate").val();
            var hour = $("#mdl-txthour").val();

            if (date == '' || date == null) {
                $("#mdl-txtdate").attr('style', 'border: 1px solid red');
                $(".overlay").fadeOut(600);
            } else {
                $.post(
                    "<?php echo base_url('home/setAppointment') ?>", {
                        idschedule: idschedule,
                        idspeciality: idspeciality,
                        iddoctor: iddoctor,
                        idhospital: idhospital,
                        date: date,
                        hour: hour
                    },
                    function(data) {
                        $("#setAppointmentModal").modal('hide');

                        if (data == 'logon') {
                            var email = '<?php //echo $this->session->userdata(_PREFIX . 'frontemail');
                                            ?>';
                            var password = '';

                            doLogin(email, password, idschedule, idspeciality);
                            $(".overlay").fadeOut(600);
                        } else {
                            $("#accountInformationModal .btn-login").attr('idspeciality', idspeciality);
                            $("#accountInformationModal .btn-login").attr('idschedule', idschedule);
                            $("#accountInformationModal .btn-login").attr('bookdate', date);

                            $("#accountInformationModal .btn-register").attr('idspeciality', idspeciality);
                            $("#accountInformationModal .btn-register").attr('idschedule', idschedule);
                            $("#accountInformationModal .btn-register").attr('bookdate', date);

                            $("#accountInformationModal").modal('show');
                            $(".overlay").fadeOut(600);
                        }
                        //console.log(idschedule+' - '+idspeciality+' - '+iddoctor+' - '+idhospital+' - '+date+' - '+hour);
                    }
                );
            }
        });
        /* --- APPOINTMENT --- */

        /* --- ACCOUNT >< LOGIN --- */
        delete window.patientLoginCounter;
        var patientLoginCounter = $("input[name=patientLoginCounter]").val();
        var containerLogin = $(".frmAccountPatientModal").closest('form');

        $(".btn-login").click(function() {
            $(".overlay").fadeIn(600);

            var idschedule = $(this).attr('idschedule');
            var idspeciality = $(this).attr('idspeciality');
            var email = $("#mdl-txtemail").val();
            var password = $("#mdl-txtpassword").val();

            doLogin(email, password, idschedule, idspeciality);
            $(".overlay").fadeOut(600);
        });

        $("#accountLoginModal .btn-addpatient").click(function() {
            $(".overlay").fadeIn(600);

            patientLoginCounter++;
            if (patientLoginCounter > 5) {
                alert("Max. 5 Patient . . .");
                patientLoginCounter--;
                $("input[name=patientLoginCounter]").val(patientLoginCounter);
                return false;
            } else {
                $.post(
                    "<?php echo base_url('home/addPatientField/onLogin'); ?>", {
                        counterpatient: patientLoginCounter
                    },
                    function(data) {
                        containerLogin.append(data);
                        $("input[name=patientLoginCounter]").val(patientLoginCounter);

                        $(".overlay").fadeOut(600);
                    }
                );
            }
        });

        $(".btn-sbmappointment").click(function() {
            $(".overlay").fadeIn(600);

            var accschedule = $('#accountLoginModal #mdl-txtidschedule').val();
            var accspeciality = $('#accountLoginModal #mdl-txtidspeciality').val();
            var accbookdate = $('#accountLoginModal #mdl-txtdate').val();
            var accemail = '';
            var accphone = '';

            var patientid = $('#accountLoginModal input[name="mdllogin-txtpatientid[]"]').map(function() {
                return $(this).val();
            }).get();

            var patientname = $('#accountLoginModal input[name="mdllogin-txtpatientname[]"]').map(function() {
                return $(this).val();
            }).get();

            var patientphone = $('#accountLoginModal input[name="mdllogin-txtpatientphone[]"]').map(function() {
                return $(this).val();
            }).get();

            var patientemail = $('#accountLoginModal input[name="mdllogin-txtpatientemail[]"]').map(function() {
                return $(this).val();
            }).get();

            var patientsex = $('#accountLoginModal .sex:checked').map(function() {
                return $(this).val();
            }).get();

            var patientbday = $('#accountLoginModal select[name="mdllogin-txtbirthday[]"]').map(function() {
                return $(this).val();
            }).get();

            var patientbmonth = $('#accountLoginModal select[name="mdllogin-txtbirthmonth[]"]').map(function() {
                return $(this).val();
            }).get();

            var patientbyear = $('#accountLoginModal select[name="mdllogin-txtbirthyear[]"]').map(function() {
                return $(this).val();
            }).get();

            $.post(
                "<?php echo base_url('home/accountRegistration/onLogin'); ?>", {
                    accschedule: accschedule,
                    accspeciality: accspeciality,
                    accbookdate: accbookdate,
                    accemail: accemail,
                    accphone: accphone,
                    patientname: patientname,
                    patientsex: patientsex,
                    patientphone: patientphone,
                    patientemail: patientemail,
                    patientbday: patientbday,
                    patientbmonth: patientbmonth,
                    patientbyear: patientbyear,
                    patientcounter: patientLoginCounter,
                    patientid: patientid
                },
                function(data) {
                    strdata = data.split('-');

                    if (strdata[0] == 'Success') {
                        window.location.href = "<?php echo base_url('success/'); ?>" + strdata[1];
                    } else {
                        window.location.href = "<?php echo base_url('failed/'); ?>" + data;
                    }
                }
            );
        });
        /* --- ACCOUNT >< LOGIN --- */

        /* --- ACCOUNT >< REGISTER --- */
        delete window.counterPatient;
        var counterPatient = 1;
        var container = $("#accountRegistrationModal .frmAccountPatientModal").closest('form');

        $(".btn-register").click(function() {
            $(".overlay").fadeIn(600);

            var idschedule = $(this).attr('idschedule');
            var idspeciality = $(this).attr('idspeciality');
            var bookdate = $(this).attr('bookdate');

            $("#accountRegistrationModal #mdl-txtregschedule").val(idschedule);
            $("#accountRegistrationModal #mdl-txtregspeciality").val(idspeciality);
            $("#accountRegistrationModal #mdl-txtregbookdate").val(bookdate);

            $("#accountInformationModal").modal('hide');
            $("#accountRegistrationModal").modal('show');

            $(".overlay").fadeOut(600);
        });

        $("#accountRegistrationModal .btn-addpatient").click(function() {
            $(".overlay").fadeIn(600);

            counterPatient++;
            if (counterPatient > 5) {
                alert("Max. 5 Patient . . .");
                counterPatient--;
                $("input[name=patientCounter]").val(counterPatient);
                return false;
            } else {
                $.post(
                    "<?php echo base_url('home/addPatientField'); ?>", {
                        counterpatient: counterPatient
                    },
                    function(data) {
                        container.append(data);
                        $("input[name=patientCounter]").val(counterPatient);

                        $(".overlay").fadeOut(600);
                    }
                );
            }
        });

        $(".btn-sbmregister").click(function() {
            $(".overlay").fadeIn(600);

            var accschedule = $('#accountRegistrationModal #mdl-txtregschedule').val();
            var accspeciality = $('#accountRegistrationModal #mdl-txtregspeciality').val();
            var accbookdate = $('#accountRegistrationModal #mdl-txtregbookdate').val();
            var accemail = $('#accountRegistrationModal #mdl-txtregemail').val();
            var accpass = $('#accountRegistrationModal #mdl-txtregpassconfirm').val();
            var accname = $('#accountRegistrationModal #mdl-txtregname').val();
            var accphone = $('#accountRegistrationModal #mdl-txtregphone').val();

            var patientname = $('#accountRegistrationModal input[name="mdllogin-txtpatientname[]"]').map(function() {
                return $(this).val();
            }).get();

            var patientsex = $('#accountRegistrationModal .sex:checked').map(function() {
                return $(this).val();
            }).get();

            var patientbday = $('#accountRegistrationModal select[name="mdllogin-txtbirthday[]"]').map(function() {
                return $(this).val();
            }).get();

            var patientbmonth = $('#accountRegistrationModal select[name="mdllogin-txtbirthmonth[]"]').map(function() {
                return $(this).val();
            }).get();

            var patientbyear = $('#accountRegistrationModal select[name="mdllogin-txtbirthyear[]"]').map(function() {
                return $(this).val();
            }).get();

            $.post(
                "<?php echo base_url('home/accountRegistration'); ?>", {
                    accschedule: accschedule,
                    accspeciality: accspeciality,
                    accbookdate: accbookdate,
                    accemail: accemail,
                    accname: accname,
                    accpass: accpass,
                    accphone: accphone,
                    patientname: patientname,
                    patientsex: patientsex,
                    patientbday: patientbday,
                    patientbmonth: patientbmonth,
                    patientbyear: patientbyear,
                    patientcounter: counterPatient
                },
                function(data) {
                    strdata = data.split('-');

                    if (strdata[0] == 'Success') {
                        window.location.href = "<?php echo base_url('success/'); ?>" + strdata[1];
                    } else if (strdata[0] == 'RegSuccess') {
                        window.location.href = "<?php echo base_url('reg-success'); ?>";
                    } else {
                        window.location.href = "<?php echo base_url('failed/'); ?>" + data;
                    }
                }
            );

            /* --------
            	console.log(patientname);
            	console.log(patientsex);
            	console.log(patientbday);
            	console.log(patientbmonth);
            	console.log(patientbyear);
            /* -------- */
        });
        /* --- ACCOUNT >< REGISTER --- */
    });

    $('.menu-toggler').on('click', function() {
        $('.menu-wrapper').toggleClass('open');
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function(event) {

        function OTPInput() {
            const inputs = document.querySelectorAll('#otp > *[id]');
            for (let i = 0; i < inputs.length; i++) {
                inputs[i].addEventListener('keydown', function(event) {
                    if (event.key === "Backspace") {
                        inputs[i].value = '';
                        if (i !== 0) inputs[i - 1].focus();
                    } else {
                        if (i === inputs.length - 1 && inputs[i].value !== '') {
                            return true;
                        } else if (event.keyCode > 47 && event.keyCode < 58) {
                            inputs[i].value = event.key;
                            if (i !== inputs.length - 1) inputs[i + 1].focus();
                            event.preventDefault();
                        } else if (event.keyCode > 64 && event.keyCode < 91) {
                            inputs[i].value = String.fromCharCode(event.keyCode);
                            if (i !== inputs.length - 1) inputs[i + 1].focus();
                            event.preventDefault();
                        }
                    }
                });
            }
        }
        OTPInput();
    });
</script>
