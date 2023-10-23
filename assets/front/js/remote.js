let remote_hospital,
  remote_specialist,
  remote_specialist_all_rs = (remote_doctor = remote_schedule = []);
const domHospital = "remote_hospital",
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
  domGlobalDoctor = $(document).find("#" + domDoctor);
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
  document.getElementById("clickNavbar").addEventListener("click", function () {
    document.getElementById("contentNavbar").classList.toggle("display-block");
    //console.log("hello");
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
    getGrouping.then((data) => {
      let dt = JSON.parse(data),
        set_html_dropdown = "";

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
        $.each(dt, function (key, value) {
          dt[key].specialist = _.sortBy(value.specialist, ["spesialis"]);
        });
        remote_specialist = dt;
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
          let dt = JSON.parse(data);
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

    //Append data
    remote_schedule.selected = {
      dsid: selected_dsid,
      weekday: selected_weekday,
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
      date: domAppointmentForm.find('select[name="date"]').val(),
      name: domAppointmentForm.find('input[name="name"]').val(),
      gender: domAppointmentForm.find('input[name="gender"]').val(),
      mobile_phone: domAppointmentForm.find('input[name="mobile_phone"]').val(),
      address: domAppointmentForm.find('input[name="address"]').val(),
      birthplace: domAppointmentForm.find('input[name="birthplace"]').val(),
      birthdate: domAppointmentForm.find('input[name="birthdate"]').val(),
      insurence: domAppointmentForm.find('input[name="insurence"]').val(),
      email: domAppointmentForm.find('input[name="email"]').val(),
    };

    console.log(obj_data);

    //Submit
    let submitAppointment = remoteSubmitAppointment(obj_data);
    submitAppointment.then((data) => {
      let dt = JSON.parse(data);

      //If peid is exist, means success
      if (dt.message == "OK") {
        remote_booking_condition(dt.data.kode_booking);
      } else {
        alert("Please complete the form");
      }

      //Re-enable CTA buttons
      domAppointmentCtaBtn.prop("disabled", false);
      domAppointmentCtaLoading.addClass("hide");
    });
  });

  // console.log(moment().day());

  // $('#trigger_search').each(function(){
  // 	$(this).trigger('change');
  // 	alert('each');
  // });

  // $('#trigger_search').change(function(){
  // 	const tmid = $(this).val();

  // 	alert('change');
  // 	let get = remoteGetDoctorsByRsspecialist(tmid);

  // 	get.then((data) => {
  // 		const dt 		= JSON.parse(data);
  // 		const data_rs 	= dt.data;
  // 		const sorted 	=  _.sortBy(data_rs, ['nama']);
  // 		const html 		= remote_result_tables(sorted);
  // 		$('#result_search').html(html);

  // 		// let options 	= '<option value="0"> - All Hospital - </option>';
  // 		// remote_hospital = dt;

  // 		// $.each(sorted, function(key, value){
  // 		// 	options += `<option value="${value.rsid}">${value.nama}</option>`;
  // 		// });
  // 		// $('#remote_hospital').html(options).removeAttr('disabled');
  // 	});
  // });
});

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
          set_html += `<div class="button-scroll-wrapper"><a href="#${this_rs}" class="button-scroll" onclick="hideButton()">${this_rs_name}</a></div>`;
        }

        set_html += `</div>`;
      }
    }
  }

  return set_html;
}

//rizal
function remoteGetGrouping() {
  return $.ajax({
    type: "get",
    url: `/remote/grouping`,
  });
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
            set_html += `<table class="w-100 table table-bordered table-striped"> <div class="group_doctor_wrapper">`;
            for (let i = 0; i < this_specialist_doctors.length; i++) {
              let this_doctor = this_specialist_doctors[i].pid,
                this_doctor_name = this_specialist_doctors[i].dokter;

              set_html += `<tr><td class="group_doctor_name" style="width: 50rem;">${this_doctor_name}</td><td class="text-center"><button type="submit" class="btn btn-default btn-circle" value="${this_doctor}" onclick="checkS(this.value,${this_rs},'${this_rs_name}')">View Schedule</button></td><tr>`;
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

// function remoteGetSchedule(pid){
// 	return $.ajax({
// 		type 	: 'get',
// 		url 	: `/remote/schedule?pid=${pid}`,
// 	});
// }

function remoteGetSchedule(pid, rsid) {
  return $.ajax({
    type: "get",
    url: `/remote/schedule?pid=${pid}&rsid=${rsid}`,
  });
}

function remoteSubmitAppointment(data) {
  return $.ajax({
    type: "post",
    url: `/remote/submitappointment`,
    data: data,
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

// function remoteGetDoctorsByRsspecialist(id){
// 	return $.ajax({
// 		type 	: 'get',
// 		url 	: `/remote/doctorsgroup?tmid=${id}`,
// 	});
// }

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

// function remote_fill_hospital(){

// 	let options = `<option value="0"> - All Hospital - </option>`;

// 	$.each(remote_hospital, function(key, value){
// 		options += `<option value="${value.rsid}">${value.nama}</option>`;
// 	});

// 	domGlobalHospital.html(options).removeAttr('disabled');
// }

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

    // $.each(datas, function(k, v){
    // 	options += '<option value="">'+v.spesialis+'</option>';
    // });
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

function checkS(val, rsid, rsname) {
  //Get schedule
  const pid = parseInt(val);
  const rs_id = parseInt(rsid);
  let getSchedule = remoteGetSchedule(pid, rs_id);
  Promise.all([getSchedule]).then((values) => {
    //Set data
    getSchedule.then((data) => {
      let dt = JSON.parse(data);
      console.log(dt);
      if (dt.jadwal) {
        dt.jadwal = _.sortBy(dt.jadwal, ["weekday"]);
        remote_schedule = dt;
        remote_schedule.rsid = rs_id;
        remote_schedule.rsname = rsname;
        remote_fill_schedule();
        appointmentModal.modal("show");
      } else {
        alert("This doctor does not have schedules");
      }
    });
  });
}

function remote_fill_schedule(has_schedule = true) {
  let options = "";
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
    console.log(group_schedule);
    $.each(group_schedule, function (key, values) {
      options += remote_fill_schedule_row(key, values);
    });
    remote_view_schedule_message("enable");
  } else {
    remote_view_schedule_message("disable", 1);
  }
  domGlobalScheduleTbody.html(options);
}

function remote_fill_schedule_row(day_index, data) {
  const dayname = weekdays[day_index] ?? "";
  let morning = "";
  let noon = "";
  let afternoon = "";

  if (data.length > 0) {
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

      let txt = `<a class="schedule_each" data-dsid="${v.dsid}" data-weekday="${v.weekday}" href="javascript:void(0);">${start_hour}:${tmp_start_minute} - ${end_hour}:${tmp_end_minute}</div>`;
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
    `
		<tr>
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
  const def_day = default_day + 1;
  const cur_day = moment().day();
  const set_day = cur_day > def_day ? def_day + 7 : def_day;
  console.log(def_day);
  console.log(cur_day);
  console.log(set_day);
  const nextFive = [...new Array(5)].map((i, idx) =>
    moment()
      .day(set_day)
      .add(idx * 7, "days")
  );
  let result = "";
  $.each(nextFive, function (k, v) {
    const value = v.format("YYYY-MM-DD");
    const text = v.format("DD MMM YYYY");
    console.log(value);
    result += `<option value="${value}">${text}</option>`;
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
    appointmentDetails.find('input[type="radio"]').prop("checked", false);
    appointmentDetails.find("select").val("0");
  }
}
