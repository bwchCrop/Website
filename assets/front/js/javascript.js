let remote_hospital,
  remote_specialist,
  selected_rsid = 0,
  selected_group = null,
  last_data = null,
  remote_specialist_all_rs = (remote_doctor = remote_schedule = []);
const profile_enabled = PROFILE_ENABLED,
  //APPOINTMENT_ALL = ENABLE_APPOINTMENT_ALL, //var for user can do appointment in all hospital
  APPOINTMENT_ALL = false, //var for user can do appointment in all hospital
// const profile_enabled = false,
  domHospital = "remote_hospital",
  domPoliWrawpper = "poli_wrapper",
  domErrorMrid = "error-mrid",
  domSpecialist = "remote_specialist",
  domDoctor = "remote_doctor",
  domDoctorMessage = "remote_doctor_message",
  domScheduleMessage = "remote_schedule_message",
  domScheduleDoctorName = "appointment_schedule_doctor_name",
  domScheduleSpecialistName = "appointment_schedule_specialist_name",
  domScheduleHospitalName = "appointment_schedule_hospital_name",
  domScheduleTbody = "appointment_schedule_tbody",
  domScheduleDate = "appointment_schedule_date",
  domScheduleDetails = "appointment_form_details",
  domGlobalHospital = $(document).find("#" + domHospital),
  domGlobalSpecialist = $(document).find("#" + domSpecialist),
  domTestGetSchedule = $(document).find("a.getSchedule-test");
domGlobalDoctor = $(document).find("#" + domDoctor);
(domGlobalPoliWrawpper = $(document).find("." + domPoliWrawpper)),
  (domGlobalDoctorMessage = $(document).find("#" + domDoctorMessage)),
  (domGlobalScheduleMessage = $(document).find("#" + domScheduleMessage)),
  (domGlobalScheduleDoctorName = $(document).find("#" + domScheduleDoctorName)),
  (domGlobalScheduleSpecialistName = $(document).find(
    "#" + domScheduleSpecialistName
  )),
  (domGlobalScheduleHospitalName = $(document).find(
    "#" + domScheduleHospitalName
  )),
  (domGlobalScheduleTbody = $(document).find("#" + domScheduleTbody)),
  (domGlobalScheduleDate = $(document).find("#" + domScheduleDate)),
  (domGlobalScheduleDetails = $(document).find("#" + domScheduleDetails)),
  (domGlobalScheduleEach = $(document).find(
    "#appointment_schedule_tbody .schedule_each"
  )),
  (domAppointmentCtaBtn = $(document).find(".appointment_form_cta_button")),
  (domSubmitAppointment = $(document).find("#appointment_form_cta_submit")),
  (domAppointmentCtaLoading = $(document).find(
    ".appointment_form_cta_loading"
  )),
  (appointmentModal = $("#appointment_modal")),
  (doctorModal = $("#profileDoctorModal")),
  (appointmentBookingCode = $("#appointment_booking_code")),
  (appointmentSuccess = $("#appointment_success")),
  (appointmentDetails = $("#appointment_details")),
  (viewScheduleBtn = $("#view_schedule")),
  (weekdays = {
    1: "Monday",
    2: "Tuesday",
    3: "Wednesday",
    4: "Thursday",
    5: "Friday",
    6: "Saturday",
    0: "Sunday",
  }),
  (default_doctor_options = '<option value="0"> - Select Doctor - </option>');

$(document).ready(function () {
  appointmentModal.find(".loading").hide();
  appointmentModal.find(".appointmentResult").hide();
  document.getElementById("clickNavbar").addEventListener("click", function () {
    document.getElementById("contentNavbar").classList.toggle("display-block");
    //console.log("hello");
  });
  toggleMrid();
  document.querySelectorAll("[name=patient_lt]").forEach((el) => {
    el.addEventListener("change", function () {
      toggleMrid();
    });
  });
  const tmGroupId = $(document).find("#tmGroupId").val();

  //rizal
  let getGrouping = remoteGetGrouping(),
    grouping_result_obj = null,
    rs_predefined_id = $("#rs_predefined_id").val(),
    grouping_predefined_id = $("#grouping_predefined_id").val(),
    grouping_select_dropdown = $("#grouping_select_dropdown"),
    grouping_list = $("#grouping_list");
  rsFinder = $("#rsButton");
  homeSpec = $("#homeSpeciality");
  homeHospital = $("#remote_hospital");
  homeButton = $("#buttonGetS");

  Promise.all([getGrouping]).then((values) => {
    //Set data
    if (window.location.pathname != '/result/search') {
      return false;
    }
    getGrouping.then((data) => {
      let dt = JSON.parse(data),
        set_html_dropdown = "";

      //? data filtering start
      var filtered = [];

      dt.forEach((element, index) => {
        let rsObject = element.rs;
        filtered[index] = {
          tmgroupid: element.tmgroupid,
          tmgroupname: element.tmgroupname,
          rs: [],
        };
        rsObject.forEach((rs, idx) => {
          if (rs.rsid == 19 || rs.rsid == 31 || rs.rsid == 7) {
            filtered[index].rs.push(rs);
          }
        });
      });

      //   dt = filtered;

      //? data filtering finish

      if (dt) {
        let find_group = 0;

        for (let i = 0; i < dt.length; i++) {
          let dropdown_selected = "";

          //Find group by predefined id
          if (dt[i].tmgroupid == grouping_predefined_id) {
            find_group = dt[i];

            dropdown_selected = 'selected="selected"';
          }

          //Fill select group
          set_html_dropdown += `<option ${dropdown_selected} value="${dt[i].tmgroupid}">${dt[i].tmgroupname}</option>`;
        }

        //home selected gandung
        homeSpec.html(set_html_dropdown);
        homeButton.click(function () {
          // window.location.href = "http://localhost/doctor-schedule/"+homeSpec.val()+"/"+homeHospital.val();
          window.location.href =
            "/schedule/" + homeSpec.val() + "/" + homeHospital.val();
        });

        //Set grouping object to be used for dropdown
        grouping_result_obj = dt;

        //Fill dropdown
        if (set_html_dropdown != "") {
          grouping_select_dropdown.html(set_html_dropdown);
        }

        //Fill data
        remote_fill_group_setup(grouping_list, find_group, rs_predefined_id);

        //rsfinder gandung
        rsFinder.html(rsButton(find_group, rs_predefined_id));

        //scroll smooth gandung
        $('a[href*="#"]')
          // Remove links that don't actually link to anything
          .not('[href="#"]')
          .not('[href="#0"]')
          .not('[href="#pills-doctor-profile"]')
          .not('[href="#pills-doctor-schedule"]')
          .click(function (event) {
            // On-page links
            if (
              location.pathname.replace(/^\//, "") ==
                this.pathname.replace(/^\//, "") &&
              location.hostname == this.hostname
            ) {
              // Figure out element to scroll to
              var target = $(this.hash);
              target = target.length
                ? target
                : $("[name=" + this.hash.slice(1) + "]");
              // Does a scroll target exist?
              if (target.length) {
                // Only prevent default if animation is actually gonna happen
                event.preventDefault();
                $("html, body").animate(
                  {
                    scrollTop: target.offset().top - 200,
                  },
                  1000,
                  function () {
                    // Callback after animation
                    // Must change focus!
                    var $target = $(target);
                    $target.focus();
                    if ($target.is(":focus")) {
                      // Checking if the target was focused
                      return false;
                    } else {
                      $target.attr("tabindex", "-1"); // Adding tabindex for elements not focusable
                      $target.focus(); // Set focus again
                    }
                  }
                );
              }
            }
          });

        //end gandung
      } else {
        grouping_list.html("Failed to get data, please refresh this page.");
      }
    });
  });
  grouping_select_dropdown.change(function () {
    var cekButton = document.querySelector("#listRs");

    if (cekButton) {
      cekButton.style.display = "flex";
    }

    let this_value = $(this).val();
    let find_group = 0,
      dt = grouping_result_obj;

    for (let i = 0; i < dt.length; i++) {
      //Find group by selected id
      if (dt[i].tmgroupid == this_value) {
        find_group = dt[i];
      }
    }

    rsFinder.html(rsButton(find_group, rs_predefined_id));

    $('a[href*="#"]')
      // Remove links that don't actually link to anything
      .not('[href="#"]')
      .not('[href="#0"]')
      .click(function (event) {
        // On-page links
        if (
          location.pathname.replace(/^\//, "") ==
            this.pathname.replace(/^\//, "") &&
          location.hostname == this.hostname
        ) {
          // Figure out element to scroll to
          var target = $(this.hash);
          target = target.length
            ? target
            : $("[name=" + this.hash.slice(1) + "]");
          // Does a scroll target exist?
          if (target.length) {
            // Only prevent default if animation is actually gonna happen
            event.preventDefault();
            $("html, body").animate(
              {
                scrollTop: target.offset().top - 200,
              },
              1000,
              function () {
                // Callback after animation
                // Must change focus!
                var $target = $(target);
                $target.focus();
                if ($target.is(":focus")) {
                  // Checking if the target was focused
                  return false;
                } else {
                  $target.attr("tabindex", "-1"); // Adding tabindex for elements not focusable
                  $target.focus(); // Set focus again
                }
              }
            );
          }
        }
      });

    remote_fill_group_setup(grouping_list, find_group, rs_predefined_id);
  });

  //end rizal
  $("#form_search_schedule").each(function () {
    //Get RS & specialist
    let getRs = remoteGetRs();
    let getSpecialist = remoteGetSpecialist();
    let getSpecialistAllRs = remoteGetSpecialistAllRs();

    Promise.all([getRs, getSpecialist, getSpecialistAllRs]).then((values) => {
      //Vars
      const rsid_default = $("#rsid_default");
      const tmid_default = $("#tmid_default");

      //RS

      getRs.then((data) => {
        const dt = JSON.parse(data);
        const sorted = _.sortBy(dt, ["nama"]);
        remote_hospital = sorted;
        remote_fill_hospital(tmGroupId);
      });

      //Specialist
      getSpecialist.then((data) => {
        let dt = JSON.parse(data);
        if (dt) {
          $.each(dt, function (key, value) {
            dt[key].specialist = _.sortBy(value.specialist, ["spesialis"]);
          });
          remote_specialist = dt;
        }
      });

      //Specialist all rs
      getSpecialistAllRs.then((data) => {
        const dt = JSON.parse(data);
        const sorted = _.sortBy(dt, ["spesialis"]);
        remote_specialist_all_rs = sorted;
        remote_fill_specialist(0);
      });

      if (rsid_default.length > 0 && tmid_default.length > 0) {
        $(document)
          .find('#remote_hospital option[value="' + rsid_default.val() + '"]')
          .prop("selected", true)
          .trigger("change");
        setTimeout(function () {
          $(document)
            .find(
              '#remote_specialist option[value="' +
                tmid_default.val() +
                '"][rsid="' +
                rsid_default.val() +
                '"]'
            )
            .prop("selected", true);
        }, 250);
      }
    });
  });

  domGlobalHospital.change(function () {
    const rsid = $(this).val();
    remote_fill_specialist(rsid, tmGroupId);
  });

  domGlobalSpecialist.change(function () {
    const rsid = parseInt(domGlobalHospital.val());
    const tmid = parseInt($(this).val());

    //Wait
    if (tmid > 0) {
      //Disable and display loading
      remote_disable_doctors(0);
      remote_view_schedule_message("disable", null);

      // let getDoctors 	= remoteGetDoctors(rsid, tmid);
      let getDoctors = remoteGetDoctorsByRsSpecialist(tmid);
      Promise.all([getDoctors]).then((values) => {
        //Set data
        getDoctors.then((data) => {
          let dt = JSON.parse(data);
          let sorted = [];
          $.each(dt["data"], function (k, v) {
            let tmp = v;
            tmp.dokter = _.sortBy(v.dokter, ["name"]);
            sorted.push(tmp);
          });
          remote_doctor = sorted;
          remote_fill_doctor(rsid, tmid);
        });
      });
    } else {
      remote_fill_doctor(rsid, tmid);
    }
  });

  domGlobalDoctor.change(function () {
    const rsid = parseInt(domGlobalHospital.val());
    const pid = parseInt($(this).val());

    if (pid <= 0) {
      viewScheduleBtn.prop("disabled", true);
    } else {
      viewScheduleBtn.prop("disabled", false);

      //Display loading
      remote_view_schedule_message("disable", 0);

      //Get schedule
      const pid = parseInt(domGlobalDoctor.val());
      let getSchedule = remoteGetSchedule(pid, rsid);
      Promise.all([getSchedule]).then((values) => {
        //Set data
        getSchedule.then((data) => {
          let dt = data;
          if (dt.jadwal) {
            dt.jadwal = _.sortBy(dt.jadwal, ["weekday"]);
            remote_schedule = dt;
            remote_fill_schedule();
          } else {
            remote_fill_schedule(false);
          }
        });
      });
    }
  });

  viewScheduleBtn.click(function () {
    appointmentModal.modal("show");
  });

  $("#form_search_schedule").submit(function () {
    return false;
  });

  $(document).on("click", ".schedule_each", function () {
    let _dis = $(this);
    const selected_dsid = _dis.data("dsid");
    const selected_weekday = _dis.data("weekday");
    const selected_start = _dis.data("start");

    //Append data
    remote_schedule.selected = {
      dsid: selected_dsid,
      weekday: selected_weekday,
      start: selected_start,
    };

    $(document).find(".schedule_each").removeClass("active");
    _dis.addClass("active");
    domGlobalScheduleDetails.removeClass("hide");
    domGlobalScheduleDate
      .html(remote_generate_available_date(selected_weekday))
      .prop("disabled", false);
    appointmentModal.find("modal-footer").removeClass("hide");
  });

  appointmentModal.on("hidden.bs.modal", function (e) {
    $(document).find(".schedule_each").removeClass("active");
    appointmentModal.find("modal-footer").addClass("hide");
    domGlobalScheduleDetails.addClass("hide");
    domGlobalScheduleDate.html(remote_default_available_date());
    remote_booking_condition();
  });

  domSubmitAppointment.click(function () {
    const _dis = $(this);
    if (_dis.prop("disabled")) {
      return false;
    }

    //Disable CTA buttons
    domAppointmentCtaBtn.prop("disabled", true);
    domAppointmentCtaLoading.removeClass("hide");

    //Prepare object data
    let domAppointmentForm = $("#appointment_form");
    let obj_data = {
      pid: remote_schedule.pid,
      rsid: remote_schedule.rsid,
      rsname: remote_schedule.rsname,
      dsid: remote_schedule.selected.dsid,
      start_hour: remote_schedule.selected.start,
      mrid: domAppointmentForm.find('input[name="mrid"]').val(),
      date: domAppointmentForm.find('select[name="date"]').val(),
      name: domAppointmentForm.find('input[name="name"]').val(),
      gender: domAppointmentForm.find('input[name="gender"]:checked').val(),
      mobile_phone: domAppointmentForm.find('input[name="mobile_phone"]').val(),
      address: domAppointmentForm.find('input[name="address"]').val(),
      birthplace: domAppointmentForm.find('input[name="birthplace"]').val(),
      birthdate: domAppointmentForm.find('input[name="birthdate"]').val(),
      insurence: domAppointmentForm.find('input[name="insurence"]').val(),
      email: domAppointmentForm.find('input[name="email"]').val(),
      patient_type: domAppointmentForm
        .find('input[name="patient_lt"]:checked')
        .val(),
    };

    // console.log(obj_data);

    // TASK: Add OTP confiramtion
    // if (
    //   obj_data.mobile_phone == undefined ||
    //   obj_data.mobile_phone == null ||
    //   obj_data.mobile_phone == "" ||
    //   obj_data.name == undefined ||
    //   obj_data.name == null ||
    //   obj_data.name == "" ||
    //   obj_data.address == undefined ||
    //   obj_data.address == null ||
    //   obj_data.address == "" ||
    //   obj_data.email == undefined ||
    //   obj_data.email == null ||
    //   obj_data.email == ""
    // ) {
    //   alert("Harap lengkapi from pendaftaran!");
    //   return;
    // }

    let getSchedule = fetchSchedule(obj_data.pid, obj_data.rsid)

    Promise.all([getSchedule]).then((value)=>{
      getSchedule.then((data) => {
        let dt = data;
        const ranges_date = [];
        if (dt.cuti && dt.cuti.length > 0) {
            dt.cuti.forEach(element => {
              const start = moment(element.start_date, 'YYYY-MM-DD');
              const end = moment(element.end_date, 'YYYY-MM-DD');
              const current = start.clone();

              while (current.isBefore(end)) {
                ranges_date.push(current.format("YYYY-MM-DD"));
                current.add(1, "day");
              }
              ranges_date.push(end.format("YYYY-MM-DD"));
            });

            const selected_date_is_invalid = ranges_date.includes(obj_data.date);

            if (selected_date_is_invalid) {
              setTimeout(function () {
                appointmentModal.modal("hide");
                Swal.fire(
                  "Dokter Cuti!",
                  "Mohon maaf jadwal dokter saat ini sudah penuh/dokter sedang cuti, silahkan pilih jadwal dokter hari lainnya. Terima Kasih.",
                  "error"
                );
              }, 1000);
              domAppointmentCtaBtn.prop("disabled", false);
              domAppointmentCtaLoading.addClass("hide");
              return selected_date_is_invalid;
            }
        }
        let phone = obj_data.mobile_phone;
        phone = phone.slice(0, 2) + phone.slice(2).replace(/.(?=...)/g, "*");
        last_data = { ...obj_data };
        $.ajax({
          type: "POST",
          url: "/remote/send_otp",
          data: last_data,
          success: function (result) {
            const response = JSON.parse(result);
            console.log(response);
            if (response.status == "success") {
              $("#appointment_modal").modal("hide");
              $("#otp_modal").find("#phone-otp").text(phone);
              $("#otp_modal").modal("show");
              last_data = response.patient_data;
              last_data.patient_type = obj_data.patient_type;
              last_data.gender = response.patient_data.sex;
            } else {
              console.log(response);
              Swal.fire(
                "Something wrong on the server!",
                xhr.responseJSON.errors,
                "error"
              );
            }
          },
          error: function (xhr, status, error) {
            if (error == "patient_not_found") {
              Swal.fire(
                "MRID and your data could not be found!",
                "You can register as a new patient if you are not sure about your MRID!",
                "error"
              );
            } else if (error == "validation_error") {
              console.log(xhr, status, error);
              Swal.fire(
                "Please complete your data!",
                xhr.responseJSON.errors,
                "error"
              );
            }
            domAppointmentCtaBtn.prop("disabled", false);
            domAppointmentCtaLoading.addClass("hide");
          },
        });
      });
    })
  });
});

var can_resend_otp = true;

// NOTE: resend otp function
function resendOtp(e) {
  $.ajax({
    type: "POST",
    url: "/remote/send_otp",
    data: last_data,
    beforeSend: function () {
      $(e.target).prop("disabled", true);
    },
    success: function (result) {
      const response = JSON.parse(result);

      if (response.status == "limited") {
        Swal.fire(
          `You can't send code at this time! please wait in ${response.time_diff} seconds!`
        );
      }
      $(e.target).prop("disabled", false);
    },
  });
}

function validateOTP(e) {
  e.preventDefault();
  let otpString =
    $("#first").val() +
    $("#second").val() +
    $("#third").val() +
    $("#fourth").val();

  $.ajax({
    url: "/remote/match_otp",
    type: "POST",
    data: {
      otp_input: otpString,
    },
    beforeSend: function (xhr) {
      $(e.target).prop("disabled", true);
    },
    error: function (xhr, status, error) {
      console.log(error);
    },
    success: function (result, status, xhr) {
      const response = JSON.parse(result);
      if (response.status == "success") {
        sendAppointment(last_data);
      } else {
        alert(response.causer);
        $(e.target).prop("disabled", false);
      }
    },
  });
}

function sendAppointment(data) {
  console.log(data);

  let submitAppointment = remoteSubmitAppointment(data);
  submitAppointment.then(
    (data) => {
      let dt = JSON.parse(data);
      //If peid is exist, means success
      if (dt.message == "OK") {
        $("#otp_modal").modal("hide");
        $("#appointment_modal").modal("show");
        appointmentBookingCode.html(dt.data.kode_booking);
        appointmentSuccess.removeClass("hide");
        appointmentDetails.addClass("hide");
        domAppointmentCtaBtn.prop("disabled", false);
        domAppointmentCtaLoading.addClass("hide");
        // remote_booking_condition(dt.data.kode_booking);
      } else {
        // console.log(dt);
        // FIXME: Ini mungkin akan di hapus
        if (dt.message == "mrid-not-found") {
          $(document)
            .find("#" + domErrorMrid)
            .show();
          alert("Your MRID is not valid, make sure your MRID are valid!");
        } else if (dt.message == "Duplicate Appointment") {
          alert("Duplicate Appointment with this schedule");
        } else if ( dt.message == "Jumlah Pasien sudah melebihi kuota maksimal") {
          alert("Mohon maaf jadwal dokter saat ini sudah penuh. Terima Kasih.");
        }else if( dt.message == "Dokter Sedang Cuti"){
          alert("Dokter sedang cuti, silahkan pilih jadwal dokter hari lainnya. Terima Kasih");
        } else {
          alert(dt.message);
          console.log(dt);
        }
        $("#otp_modal").modal("hide");
      }

      //Re-enable CTA buttons
      domAppointmentCtaBtn.prop("disabled", false);
      domAppointmentCtaLoading.addClass("hide");
      $(".otp-validation").prop("disabled", false);
      const inputs = document.querySelectorAll("#otp > *[id]");
      for (let i = 0; i < inputs.length; i++) {
        $(inputs[i]).val("");
      }
    },
    (err) => alert(err)
  );
}

function rsButton(selected_group, cekRS) {
  let rs = selected_group.rs;
  let set_html = "";

  //console.log(cekRS);

  if (rs) {
    if (cekRS == "0") {
      if (rs.length > 0) {
        set_html += `<div class="button-scroll-wrapper" id="listRs">`;

        for (let i = 0; i < rs.length; i++) {
          let this_rs = rs[i].rsid,
            this_rs_name = rs[i].hospital;
          this_rs_specialist = rs[i].specialist;
          set_html += `<div class="button-scroll-wrapper"><a href="#${this_rs}" class="button-scroll">${this_rs_name}</a></div>`;
        }

        set_html += `</div>`;
      }
    }
  }

  return set_html;
}

//rizal
function remoteGetGrouping() {
  let path = window.location.pathname;

  if (path == '/result/search') {
    return $.ajax({
      type: "get",
      // url: `/remote/grouping_new`,
      url: `/remote/grouping`,
    });
  }

  return null;
}

function remote_fill_group_setup(
  grouping_list,
  find_group,
  rs_predefined_id = 0
) {
  if (find_group) {
    // document.querySelector('#listRs').style.display="block";
    $("#messageSchedule").html("");
    let set_grouping_html = remote_fill_group(find_group, rs_predefined_id);
    grouping_list.html(set_grouping_html);
  } else {
    grouping_list.html("Invalid specialist group ID.");
  }
}

function remote_fill_group(selected_group, rs_predefined_id = 0) {
  let group_id = selected_group.tmgroupid,
    group_name = selected_group.tmgroupname,
    rs = selected_group.rs;

  let set_html = "";

  var countData = 0;

  if (rs.length > 0) {
    set_html += `<div class="group_rs_wrapper">`;

    for (let i = 0; i < rs.length; i++) {
      let this_rs = rs[i].rsid,
        this_rs_name = rs[i].hospital;
      this_rs_specialist = rs[i].specialist;

      //If rs_predefined_id is filled, only display that RS
      if (rs_predefined_id != 0 && rs_predefined_id != this_rs) {
        // 	$('#messageSchedule').html("Schedule not found");
        continue;
      }

      if (this_rs_name) {
        countData++;
      }
      set_html += `<div id="${this_rs}" class="group_rs_name">${this_rs_name}</div>`;

      if (this_rs_specialist.length > 0) {
        set_html += `<div class="group_specialist_wrapper">`;

        for (let i = 0; i < this_rs_specialist.length; i++) {
          let this_specialist = this_rs_specialist[i].tmid,
            this_specialist_name = this_rs_specialist[i].specialist;
          this_specialist_doctors = this_rs_specialist[i].doctors;

          set_html += `<div class="group_specialist_name">${this_specialist_name}</div>`;

          if (this_specialist_doctors.length > 0) {
            let tmpDoctor = this_specialist_doctors;
            tmpDoctor = _.sortBy(tmpDoctor, (o) => o.dokter);
            // console.log(tmpDoctor);
            set_html += `<table class="w-100 table table-bordered table-striped"> <div class="group_doctor_wrapper">`;
            for (let i = 0; i < tmpDoctor.length; i++) {
              let this_doctor = tmpDoctor[i].pid,
                this_doctor_name = tmpDoctor[i].dokter;

              let hidden_style = null;

              //   if (this_rs != 19) {
              //     hidden_style = "display: none;";
              //   }
              if (profile_enabled) {
                set_html += `<tr><td class="group_doctor_name" style="width: 40rem;">${this_doctor_name}</td><td class="text-center"><div class="text-center row"><div class="col-12 col-md-5"><button type="button" class="btn btn-default btn-circle " style="margin-right: 2px;" value="${this_doctor}" onclick="fetchDoctor(this.value,${this_rs},'${this_rs_name}', '${group_name}')">View Profile</button></div><div class="col-12 col-md-7"><button type="button" class="btn btn-default btn-circle" value="${this_doctor}" onclick="checkS(this.value, ${this_rs},'${this_rs_name}', '${group_name}','${this_specialist}')">Get Appointment</button></div></td><tr>`;
              } else {
                set_html += `<tr><td class="group_doctor_name" style="width: 50rem;">${this_doctor_name}</td><td class="text-center"><div class="text-center row"><div class="col-12"><button type="button" class="btn btn-default btn-circle" value="${this_doctor}" onclick="checkS(this.value, ${this_rs},'${this_rs_name}', '${group_name}', '${this_specialist}')" style="${hidden_style}">Get Appointment</button></div></td><tr>`;
              }
            }
            set_html += `</div> </table>`;
          } else {
            set_html += `<div class="group_specialist_name">No doctors found for this specialist.</div>`;
          }
        }

        set_html += `</div>`;
      } else {
        set_html += `<div class="group_rs_specialist">No specialist found for this hospital.</div>`;
      }
    }

    set_html += `</div>`;

    if (countData == 0) {
      $("#messageSchedule").html("Schedule not found");
    }
  } else {
    set_html += "No hospital found for this specialist.";
  }

  return set_html;
}
//end rizal

// function remoteLogin() {
//   return $.ajax({
//     type: "get",
//     url: "/remote/login"
//   });
// }

function remoteGetRs() {
  return $.ajax({
    type: "get",
    url: "/remote/rs",
  });
}

function remoteGetSpecialist() {
  return $.ajax({
    type: "get",
    url: "/remote/specialist",
  });
}

function specialistid(rsid) {
  return $.ajax({
    type: "get",
    url: `/remote/specialistbyrsid?rsid=${rsid}`,
    dataType: "json",
  });
}

function remoteGetSpecialistAllRs() {
  return $.ajax({
    type: "get",
    url: "/remote/specialistallrs",
  });
}

function remoteGetDoctors(rsid, tmid) {
  return $.ajax({
    type: "get",
    url: `/remote/doctors?rsid=${rsid}&tmid=${tmid}`,
  });
}

function remoteGetDoctorsByRsSpecialist(tmid) {
  return $.ajax({
    type: "get",
    url: `/remote/doctorsbyrsspecialist?tmid=${tmid}`,
  });
}

const remoteGetSchedule = async (pid, rsid) => {
  const token = await tokenGen();

  return $.ajax({
    type: "get",
    url: `/remote/schedule?pid=${pid}&rsid=${rsid}&token=${token}`,
  });
};

// function remoteGetSchedule(pid, rsid) {
//   return $.ajax({
//     type: "get",
//     url: `/remote/schedule?pid=${pid}&rsid=${rsid}`,
//   });
// }

function remoteGetApiDoctor(pid) {
  return $.ajax({
    type: "get",
    url: `/remote/api_doctor?pid=${pid}`,
  });
}

function remoteSubmitAppointment(data) {
  return $.ajax({
    type: "post",
    url: "/remote/submitappointment",
    data: { data: data },
    error: function (jqXHR, exception) {
      var msg = "";
      if (jqXHR.status === 0) {
        msg = "Not connect.\n Verify Network.";
      } else if (jqXHR.status == 404) {
        msg = "Requested page not found. [404]";
      } else if (jqXHR.status == 500) {
        msg = "Internal Server Error [500].";
      } else if (jqXHR.status == 504) {
        msg = "Internal Server Error [504].";
      } else if (exception === "parsererror") {
        msg = "Requested JSON parse failed.";
      } else if (exception === "timeout") {
        msg = "Time out error.";
      } else if (exception === "abort") {
        msg = "Ajax request aborted.";
      } else {
        msg = "Uncaught Error.\n" + jqXHR.responseText;
      }
      Swal.fire("Server Error!", msg, "error");
      console.log(msg, exception);
      $("#otp_modal").modal("hide");
    },
  });
}

function remoteDoctorTmGroupId(gid) {
  return $.ajax({
    type: "get",
    url: `/remote/rsByTmId?gid=${gid}`,
  });
}

function remoteSpTmGroupId(rsid, gid) {
  return $.ajax({
    type: "get",
    url: `/remote/spByTmId?rsid=${rsid}&gid=${gid}`,
  });
}

function remote_result_tables(rs) {
  let tmp = "";
  $.each(rs, function (key, value) {
    tmp += remote_result_template(value);
  });
  return tmp;
}

function remote_result_template(data) {
  const html = remote_rows_doctors(data.dokter);
  return `
		<div>
			<h3 class="liteblack">${data.name}</h3>
			<table class="table table-bordered table-striped" width="100%">
				<tr class="head"><td colspan="2">DOCTORS</td></tr>
				${html}
			</table>
		</div>
	`;
}

function remote_rows_doctors(dokter) {
  let tmp = "";
  const sorted = _.sortBy(dokter, ["name"]);
  $.each(sorted, function (key, value) {
    tmp += remote_row_doctor(value);
  });
  return tmp;
}

function remote_row_doctor(dokter) {
  return `
		<tr class="cell">
			<td>${dokter.name}</td>
			<td width="250" class="text-center">
				<a href="#" pid="${dokter.pid}" tmid="${dokter.tmid}">Get Appointment</a>
			</td>
		</tr>
	`;
}

function remote_fill_hospital(tmGroupId) {
  let options = `<option value="0"> - All Hospital - </option>`;

  if (tmGroupId == "") {
    $.each(remote_hospital, function (key, value) {
      options += `<option value="${value.rsid}">${value.nama}</option>`;
    });

    domGlobalHospital.html(options).removeAttr("disabled");
  } else {
    let rsGroup = remoteDoctorTmGroupId(tmGroupId);

    rsGroup.then((data) => {
      const dt = JSON.parse(data);
      $.each(dt, function (key, value) {
        options += `<option value="${value.rsid}">${value.hospital}</option>`;
      });

      domGlobalHospital.html(options).removeAttr("disabled");
    });
  }
}

function remote_fill_specialist(rsid, tmGroupId = "") {
  let options = '<option value="0"> - Select Specialist - </option>';
  rsid = parseInt(rsid);

  //Set message for doctors dropdown
  remote_disable_doctors(1);

  //If all RS, get all data from all RS
  //Else, find from filled RS only
  if (rsid === 0) {
    $.each(remote_specialist_all_rs, function (k, v) {
      options += `<option value="${v.tmid}" rsid="${v.rsid}">${v.spesialis}</option>`;
    });
  } else {
    if (tmGroupId == "") {
      // console.log(remote_specialist_all_rs);
      const source = _.find(remote_specialist, { rsid: rsid });
      $.each(source.specialist, function (k, v) {
        options += `<option value="${v.tmid}">${v.spesialis}</option>`;
      });
    } else {
      let spGroup = remoteSpTmGroupId(rsid, tmGroupId);

      spGroup.then((data) => {
        const dt = JSON.parse(data);
        $.each(dt, function (k, v) {
          options += `<option value="${v.tmid}">${v.specialist}</option>`;
        });
        domGlobalSpecialist.html(options).removeAttr("disabled");
      });
    }
  }

  domGlobalSpecialist.html(options).removeAttr("disabled");
}

function remote_fill_doctor(rsid, tmid) {
  if (tmid <= 0) {
    remote_disable_doctors(1);
  } else {
    let doctors = [];

    if (rsid > 0) {
      const get = _.find(remote_doctor, { rsid: rsid });
      if (get.dokter) {
        doctors = get.dokter;
      }
    } else {
      const get = _.sortBy(_.flatten(_.map(remote_doctor, "dokter")), "name");
      if (get) {
        doctors = get;
      }
    }

    if (doctors.length > 0) {
      let options = default_doctor_options;
      $("#remote_doctor_list").empty();
      $.each(doctors, function (key, value) {
        options += `<option value="${value.pid}">${value.name}</option>`;
        $("#remote_doctor_list").append(
          `<tr><td class="padding-4 cell align-middle">${value.name}<div id="m_${value.pid}"></div></td><td class="text-center"><button type="submit" class="btn btn-default btn-circle" value="${value.pid}" onclick="checkS(this.value)">View Schedule</button></td></tr>`
        );
      });
      remote_enable_doctors(options, parseInt(doctors.length));
    } else {
      remote_disable_doctors(2);
    }
  }
}

function checkS(val, rsid, rsname, group = null, specialist = null) {
  // console.log("🚀 ~ file: javascript.js:1035 ~ checkS ~ rsid:", (rsid != 19 || rsid != '19'))
  
  // console.log(rsid == 7 && group == "Dental", group, rsid);
  // NOTE: kode block untuk hide appointment form selain dari antasari.
  if (APPOINTMENT_ALL == false) {
    if (rsid == 19 || rsid == 31 || rsid == 7 || rsid == 9) {
      $("#appointment_form").show();
    }else{
      $("#appointment_form").hide();
    }
  }else{
    $("#appointment_form").show();
  }

  selected_rsid = rsid;
  selected_group = group;
  appointmentModal.modal("show");
  appointmentModal.find(".loading").show();
  appointmentModal.find(".appointmentResult").hide();
  // disable button get schedule
  document.querySelectorAll("#grouping_list button").forEach((element) => {
    element.setAttribute("disabled", true);
  });

  //Get schedule
  const pid = parseInt(val);
  const rs_id = parseInt(rsid);
  // let getSchedule = remoteGetSchedule(pid, rs_id);
  let getSchedule = fetchSchedule(pid, rs_id);

  Promise.all([getSchedule]).then(
    (values) => {
      document.querySelectorAll("#grouping_list button").forEach((element) => {
        element.removeAttribute("disabled");
      });
      //Set data
      getSchedule.then((data) => {
        let dt = data;
        // console.log(dt);

        if (dt.jadwal) {
          dt.jadwal = _.sortBy(dt.jadwal, ["weekday"]);
          dt.jadwal_group = _.chain(dt.jadwal)
            .groupBy("poli")
            .map(function (v, i) {
              return {
                poli: i,
                jadwal: v,
              };
            })
            .value();
          remote_schedule = dt;
          remote_schedule.rsid = rs_id;
          remote_schedule.rsname = rsname;
          remote_fill_schedule();
          setTimeout(function () {
            appointmentModal.find(".loading").hide();
            appointmentModal.find(".appointmentResult").show();
          }, 1000);
        } else {
          setTimeout(function () {
            alert("This doctor does not have schedules");
            appointmentModal.modal("hide");
          }, 1000);
        }
      });
    },
    (err) => {
      appointmentModal.modal("hide");
      alert(err.statusText);
      document.querySelectorAll("#grouping_list button").forEach((element) => {
        element.removeAttribute("disabled");
      });
    }
  );
}

function fetchDoctor(id, rsid) {
  // disable button get schedule
  document.querySelectorAll("#grouping_list button").forEach((element) => {
    element.setAttribute("disabled", true);
  });
  doctorModal.find(".schedule-wrapper").html(" ");

  // $(doctorModal).modal("show");
  const pid = parseInt(id);
  let getApiDoctor = remoteGetApiDoctor(pid);
  // console.log("🚀 ~ file: javascript.js ~ line 890 ~ fetchDoctor ~ getApiDoctor", getApiDoctor)
  let getSchedule = remoteGetSchedule(pid, rsid);
  // console.log("🚀 ~ file: javascript.js ~ line 892 ~ fetchDoctor ~ getSchedule", getSchedule)

  Promise.all([getApiDoctor, getSchedule]).then((value) => {
    document.querySelectorAll("#grouping_list button").forEach((element) => {
      element.removeAttribute("disabled");
    });

    getSchedule.then((data) => {
      let dt = data;
      // console.log(dt);
      const poliData = _.groupBy(dt.jadwal, "poli");

      let html = "",
        tmpJdwl = "",
        title = "";
      $.each(poliData, (poliname, poli) => {
        // console.log(poliname);
        let tmpSchedules = _.groupBy(poli, "weekday");
        title = `<h5>${poliname}</h5>`;
        tmpJdwl += title;
        $.each(tmpSchedules, (index, jdwl) => {
          let rows = "";
          let column = "";
          column += `
              <h6 class="header">${weekdays[index]}</h6>
            `;
          $.each(jdwl, function (tmpJdwl2) {
            const start_minute = sudo__minute(jdwl[tmpJdwl2].start_minute),
              end_minute = sudo__minute(jdwl[tmpJdwl2].end_minute),
              start_hour = parseInt(jdwl[tmpJdwl2].start_hour),
              end_hour = parseInt(jdwl[tmpJdwl2].end_hour);
            column += `<p>${start_hour} - ${end_hour}</p>`;
            rows = column;
          });

          // rows += column;

          // console.log(rows);

          tmpJdwl += `<div>${rows}</div>`;
        });

        html = tmpJdwl;
      });

      $(".poli-wrap").html(tmpJdwl);

      const schedules = _.groupBy(dt.jadwal, "weekday");

      $.each(schedules, function (index, jadwal) {
        let doc_jadwal = weekdays[index];
        let txt = "";
        let poli_name;
        $.each(jadwal, function (idx, j) {
          // console.log(j);
          poli_name = j.poli;
          const start_minute = sudo__minute(j.start_minute),
            end_minute = sudo__minute(j.end_minute),
            start_hour = parseInt(j.start_hour),
            end_hour = parseInt(j.end_hour);
          txt += `<div>${start_hour}:${start_minute} - ${end_hour}:${end_minute}</div>`;
        });

        let poli = `<div class="poli-text">${poli_name}</div>`;
        let title = `<div>${doc_jadwal}</div>`;
        let newD = `<div>${poli + title + txt}</div>`;

        doctorModal.find(".schedule-wrapper").append(
          $("<div>", {
            class: "schedule-col",
            html: $(newD) || "",
          })
        );
      });
    });

    getApiDoctor.then((data) => {
      let dt = JSON.parse(data);
      if (dt) {

        window.location = `/doctor/detail/${dt.slug}`;
        return;
        doctorModal.modal("show");
        let img = doctorModal.find(".doctor-img");
        let tab = doctorModal.find("#pills-doctor-profile-tab");
        $(img).attr("src", dt.image || "/assets/img/doctor-image.png");
        $(tab).tab("show");
        doctorModal.find(".doctor-name").text(dt.name);
        doctorModal.find(".location").text(dt.hospital);
        doctorModal.find(".specialist").text(dt.specialist);
        doctorModal
          .find(".description")
          .text(
            dt.description ||
              "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Tempora consequatur consequunturrem10"
          );
      }
    });
  });
}

function remote_fill_schedule(has_schedule = true) {
  let options = "",
    poliGroup = "";
  if (has_schedule) {
    //Find RS and specialist name
    let find_rs = {
      rsid: "",
      rs_name: "",
      tmid: "",
      specialist_name: "",
    };

    for (var i = 0; i < remote_doctor.length; i++) {
      const find = _.find(remote_doctor[i].dokter, {
        pid: remote_schedule.pid,
      });
      if (find) {
        find_rs.rsid = remote_doctor[i].rsid;
        find_rs.rs_name = remote_doctor[i].name;
        find_rs.tmid = remote_doctor[i].tmid;
        find_rs.specialist_name = remote_doctor[i].spesialis;
        break;
      }
    }
    remote_schedule.rsinfo = find_rs;

    //Fill doctor and specialist name
    domGlobalScheduleDoctorName.html(remote_schedule.dokter);
    domGlobalScheduleSpecialistName.html(
      remote_schedule.rsinfo.specialist_name
    );
    domGlobalScheduleHospitalName.html(remote_schedule.rsinfo.rs_name);

    //Fill schedule
    let group_schedule = _.groupBy(remote_schedule.jadwal, "weekday");
    let _group_schedule = remote_schedule.jadwal_group;
    // console.log(_group_schedule);
    $.each(_group_schedule, function (key, values) {
      poliGroup += create_table(key, values);
    });
    $.each(group_schedule, function (key, values) {
      // console.log(values);
      options += remote_fill_schedule_row(key, values);
    });
    remote_view_schedule_message("enable");
  } else {
    remote_view_schedule_message("disable", 1);
  }
  domGlobalPoliWrawpper.html(poliGroup);
  // domGlobalScheduleTbody.html(options);
}

function create_table(a, data) {
  let options = "";
  options += `<thead>
								<tr><th>Day &amp; Time</th>
								<th width="120">Morning</th>
								<th width="120">Noon</th>
								<th width="120">Afternoon</th>
							</tr></thead>`;
  let group_schedule = _.groupBy(data.jadwal, "weekday");
  $.each(group_schedule, function (key, values) {
    // console.log(values);
    options += remote_fill_schedule_row(key, values);
  });
  let wrapper = document.createElement("div");
  let table = document.createElement("table");
  table.classList.add("table", "schedule_table");
  table.innerHTML = options;
  let titleHtml = document.createElement("h4");
  titleHtml.classList.add("poli_title");
  titleHtml.innerHTML = data.poli;
  wrapper.append(titleHtml);
  wrapper.append(table);
  return wrapper.innerHTML;
}

function remote_fill_schedule_row(day_index, data) {
  const dayname = weekdays[day_index] ?? "";
  let morning = "";
  let noon = "";
  let afternoon = "";

  if (data.length > 0) {
    data = _.sortBy(data, (o) => o.start_hour);
    $.each(data, function (k, v) {
      let start_hour = parseInt(v.start_hour),
        start_minute = parseInt(v.start_minute),
        end_hour = parseInt(v.end_hour),
        end_minute = parseInt(v.end_minute);

      var tmp_start_minute;
      if (start_minute == 0) {
        tmp_start_minute = "00";
      } else if (start_minute == 1) {
        tmp_start_minute = "01";
      } else if (start_minute == 2) {
        tmp_start_minute = "02";
      } else if (start_minute == 3) {
        tmp_start_minute = "03";
      } else if (start_minute == 4) {
        tmp_start_minute = "04";
      } else if (start_minute == 5) {
        tmp_start_minute = "05";
      } else if (start_minute == 6) {
        tmp_start_minute = "06";
      } else if (start_minute == 7) {
        tmp_start_minute = "07";
      } else if (start_minute == 8) {
        tmp_start_minute = "08";
      } else if (start_minute == 9) {
        tmp_start_minute = "09";
      } else {
        tmp_start_minute = start_minute;
      }

      var tmp_end_minute;
      if (end_minute == 0) {
        tmp_end_minute = "00";
      } else if (end_minute == 1) {
        tmp_end_minute = "01";
      } else if (end_minute == 2) {
        tmp_end_minute = "02";
      } else if (end_minute == 3) {
        tmp_end_minute = "03";
      } else if (end_minute == 4) {
        tmp_end_minute = "04";
      } else if (end_minute == 5) {
        tmp_end_minute = "05";
      } else if (end_minute == 6) {
        tmp_end_minute = "06";
      } else if (end_minute == 7) {
        tmp_end_minute = "07";
      } else if (end_minute == 8) {
        tmp_end_minute = "08";
      } else if (end_minute == 9) {
        tmp_end_minute = "09";
      } else {
        tmp_end_minute = end_minute;
      }

      // const 	tmp_start_minute = start_minute == 0 ? '00' : start_minute,
      // 			tmp_end_minute = end_minute == 0 ? '00' : end_minute;

      let txt = `<a class="schedule_each" data-start="${start_hour}:${tmp_start_minute}" data-dsid="${v.dsid}" data-weekday="${v.weekday}" href="javascript:void(0);">${start_hour}:${tmp_start_minute} - ${end_hour}:${tmp_end_minute}</a>`;
      if (start_hour >= 0 && start_hour < 12) {
        morning += txt;
      } else if (start_hour >= 12 && start_hour < 17) {
        noon += txt;
      } else if (start_hour >= 17 && start_hour <= 24) {
        afternoon += txt;
      }
    });
  }

  return (
    `<tr>
		<td>${dayname}</td>
		<td>` +
    morning +
    `</td>
		<td>` +
    noon +
    `</td>
		<td>` +
    afternoon +
    `</td>
	</tr>
	`
  );
}

function remote_enable_doctors(html_options, count_doctors) {
  domGlobalDoctor.html(html_options).removeAttr("disabled");
  domGlobalDoctorMessage.html(count_doctors + " doctor(s) found");
}

function remote_disable_doctors(code = 1) {
  let message = "Please select specialist"; //default 1

  if (code == 0) {
    message = "Please wait, loading doctors data";
  } else if (code == 2) {
    message = "No doctors found";
  }

  domGlobalDoctor.html(default_doctor_options).prop("disabled", true);
  domGlobalDoctorMessage.html(message);
  viewScheduleBtn.prop("disabled", true);
}

function remote_view_schedule_message(type = "disable", code = null) {
  if (type == "disable") {
    let message = ""; //default 1

    if (code === 0) {
      message = "Please wait, loading doctor schedule";
    } else if (code === 1) {
      message =
        '<span style="color:red;">This doctor does not have schedules</span>';
    }

    domGlobalScheduleMessage.html(message);
    viewScheduleBtn.prop("disabled", true);
  } else {
    domGlobalScheduleMessage.html("");
    viewScheduleBtn.prop("disabled", false);
  }
}

function remote_default_available_date() {
  domGlobalScheduleDate
    .html('<option value="0">Please choose schedule</option>')
    .prop("disabled", true);
}

function remote_generate_available_date(default_day) {
  // console.log(data);
  const def_day = default_day;
  // console.log("🚀 ~ file: javascript.js:1487 ~ remote_generate_available_date ~ def_day:", def_day)
  const cur_day = moment().day();
  // console.log("🚀 ~ file: javascript.js:1489 ~ remote_generate_available_date ~ cur_day:", cur_day)
  let set_day = cur_day > def_day ? def_day + 7 : def_day;
  // console.log("🚀 ~ file: javascript.js:1491 ~ remote_generate_available_date ~ set_day:", set_day)
  
  const nextFive = [...new Array(5)].map((i, idx) =>
    moment()
      .day(set_day)
      .add(idx * 7, "days")
  );

  const now = moment();

  let endDate = nextFive[nextFive.length - 1];

  if (selected_rsid == 31 && selected_group == "Psycholog") {
    if (now.startOf('day').isSame(nextFive[0].startOf("day"))) {
      // remove H-3
      nextFive.splice(0, 3);
    
      for (let index = 1; index <= 3; index++) {
        const newWeek = moment(endDate).add(index * 7, "days");
        nextFive.push(newWeek);
      }
      
    }else{
      nextFive.splice(0, 2);
      for (let index = 1; index <= 2; index++) {
        const newWeek = moment(endDate).add(index * 7, "days");
        nextFive.push(newWeek);
      }
    }
  }else if(selected_rsid == 7 && selected_group == "Dental"){
    //
    nextFive.forEach((nextday, index) => {
      if (nextday.isSame('2023-10-03', 'day') || nextday.isSame('2023-10-04', 'day')) {
         nextFive.splice(index, 1);
      }
    })
  }else{
    if (now.startOf('day').isSame(nextFive[0].startOf("day"))) {
      // remove first array
      nextFive.splice(0, 1);

      // create new date in next last of the week
      const newWeek = moment(endDate).add(7, "days");
      // add more 1 day on next week
      nextFive.push(newWeek);
    }
    // remove H-1
  }

  // console.log(nextFive);

  let result = "";
  $.each(nextFive, function (k, v) {
    // if not today return result 5 date
    // if today, dont render today date in option
    const value = v.format("YYYY-MM-DD");
    const text = v.format("DD MMM YYYY");
    if (moment().diff(v, "day") != 0) {
      // console.log(value);
    }
    result += `<option value="${value}">${text}</option>`;
    // result += `<option value="${value}">${text}</option>`;
  });
  return result;
}

function remote_booking_condition(booking_code = null) {
  if (booking_code) {
    appointmentBookingCode.html(booking_code);
    appointmentSuccess.removeClass("hide");
    appointmentDetails.addClass("hide");
  } else {
    appointmentBookingCode.html("");
    appointmentSuccess.addClass("hide");
    appointmentDetails.removeClass("hide");

    //Reset input
    appointmentDetails
      .find(
        'input[type="text"], input[type="date"], input[type="email"], textarea'
      )
      .val("");
    // appointmentDetails.find('input[type="radio"]').prop("checked", false);
    appointmentDetails.find("select").val("0");
  }
  domAppointmentCtaBtn.prop("disabled", false);
  domAppointmentCtaLoading.addClass("hide");
}

function toggleMrid() {
  let value = $("[name=patient_lt]:checked").val();
  $("#" + domErrorMrid).hide();
  if (value == "new") {
    $("[name=mrid]").val("");
    $(".mrid-new-wrapper input").prop("disabled", false).prop("required", true);
    $(".mrid-new-wrapper").show();
    $(".mrid-old-wrapper input").prop("disabled", true).prop("required", false);
    $(".mrid-old-wrapper").hide();

    // input name
    // $("#appointment_form_details > div:nth-child(3) > input").prop(
    //   "disabled",
    //   false
    // );
    // input gender
    // $("#appointment_form_details > input[name=gender]").prop("disabled", false);
    // input birth date
    // $("#appointment_form_details > div:nth-child(5) > input").prop(
    //   "disabled",
    //   false
    // );
    // input birth place
    // $("#appointment_form_details > div:nth-child(6) > input").prop(
    //   "disabled",
    //   false
    // );
  } else {
    // $("#appointment_form_details > div:nth-child(3) > input").prop(
    //   "disabled",
    //   true
    // );
    // $("#appointment_form_details > input[name=gender]").prop("disabled", true);
    // $("#appointment_form_details > div:nth-child(5) > input").prop(
    //   "disabled",
    //   true
    // );
    // $("#appointment_form_details > div:nth-child(6) > input").prop(
    //   "disabled",
    //   true
    // );
    $(".mrid-new-wrapper input").prop("disabled", true).prop("required", false);
    $(".mrid-new-wrapper").hide();
    $(".mrid-old-wrapper input").prop("disabled", false).prop("required", true);
    $(".mrid-old-wrapper").show();
  }
}

$("#appointment_form_details > div.form-group.mrid-wrapper > input").keyup(
  delay((e) => {
    mridInput(e.target.value);
  }, 1200)
);

function mridInput(val = undefined) {
  if (val) {
    $("#appointment_form_details > div:nth-child(5) > input").prop(
      "disabled",
      false
    );
  } else {
    $("#appointment_form_details > div:nth-child(5) > input").prop(
      "disabled",
      true
    );
  }
}

function remoteLogin() {
  return $.ajax({
    type: "get",
    url: "/remote/login",
  });
}

const fetchSchedule = async (pid, rsid, rsname) => {
  const token = await tokenGen(); //comment for new api

  let data = {
    group: true,
    rsid: rsid,
  };
  var settings = {
    url: `${API_URL}/schedulebyPid/${pid}`,
    // url: `/remote/schedule_data/${pid}/${rsid}`,
    method: "GET",
    headers: {
       "Content-Type": "application/json",
       Authorization: `Bearer ${token}`,
    },
    data: data,
  };

  return $.ajax(settings);
};

const tokenGen = async () => {
  let token = null;
  await remoteLogin().then((data) => {
    let dt = JSON.parse(data);
    token =  dt.token;
  });
  
  if (token == 'null' || token == null || !token) {
    $tokengen = await tokenGen();
    return $tokengen;
  }

  return token;
  let tokenInStorage = localStorage.getItem("tera_token");
  let tokenTimeStamp = localStorage.getItem("tera_token_time");
  if (tokenInStorage == null) {
    await remoteLogin().then((data) => {
      let dt = JSON.parse(data);
      localStorage.setItem("tera_token", dt.token);
      localStorage.setItem("tera_token_time", Date.now());
    });
  } else {
    let timeExp = Date.now() - tokenTimeStamp;
    if (timeExp > 90000) {
      await remoteLogin().then((data) => {
        let dt = JSON.parse(data);
        localStorage.setItem("tera_token", dt.token);
        localStorage.setItem("tera_token_time", Date.now());
      });
    }
  }

  return localStorage.getItem("tera_token");
};

$(domTestGetSchedule).click(function () {
  fetchSchedule(7, 1190);
});

function sudo__minute(start) {
  let tmp_start_minute;
  if (start == 0) {
    tmp_start_minute = "00";
  } else if (start == 1) {
    tmp_start_minute = "01";
  } else if (start == 2) {
    tmp_start_minute = "02";
  } else if (start == 3) {
    tmp_start_minute = "03";
  } else if (start == 4) {
    tmp_start_minute = "04";
  } else if (start == 5) {
    tmp_start_minute = "05";
  } else if (start == 6) {
    tmp_start_minute = "06";
  } else if (start == 7) {
    tmp_start_minute = "07";
  } else if (start == 8) {
    tmp_start_minute = "08";
  } else if (start == 9) {
    tmp_start_minute = "09";
  } else {
    tmp_start_minute = start;
  }

  return tmp_start_minute;
}

function delay(fn, ms) {
  let timer = 0;
  return function (...args) {
    clearTimeout(timer);
    timer = setTimeout(fn.bind(this, ...args), ms || 0);
  };
}
