function time_picker(disabledDays, mindays) {
  if (typeof disabledDays === "undefined") disabledDays = [];
  if (typeof mindays === "undefined") mindays = new Date();

  $(".date-picker").bootstrapMaterialDatePicker({
    time: false,
    clearButton: true,
    disabledDays: disabledDays,
    minDate: mindays,
  });

  $(".time-picker").bootstrapMaterialDatePicker({
    date: false,
    shortTime: false,
    format: "HH:mm",
  });

  $(".date-format-picker").bootstrapMaterialDatePicker({
    format: "dddd DD MMMM YYYY - HH:mm",
  });

  $(".date-fr-picker").bootstrapMaterialDatePicker({
    format: "DD/MM/YYYY HH:mm",
    lang: "fr",
    weekStart: 1,
    cancelText: "ANNULER",
    nowButton: true,
    switchOnClick: true,
  });

  $(".date-end-picker").bootstrapMaterialDatePicker({
    weekStart: 0,
    format: "DD/MM/YYYY HH:mm",
  });
  $(".date-start-picker")
    .bootstrapMaterialDatePicker({
      weekStart: 0,
      format: "DD/MM/YYYY HH:mm",
      shortTime: true,
    })
    .on("change", function (e, date) {
      $("#date-end").bootstrapMaterialDatePicker("setMinDate", date);
    });

  $(".min-date-picker").bootstrapMaterialDatePicker({
    format: "DD/MM/YYYY HH:mm",
    minDate: new Date(),
  });

  $.material.init();
}

let floating_dector = $("#float-menu-doctor");
const floating_call = document.querySelector("#free-call");

$(window).scroll(function () {
  if ($(window).scrollTop() + $(window).height() > $(document).height() - 100) {
    floating_dector.addClass("bottom-scroll");
    floating_call.classList.add("bottom-scroll");
  } else {
    floating_dector.removeClass("bottom-scroll");
    floating_call.classList.remove("bottom-scroll");
  }
});

floating_call.addEventListener("click", () => {
  window.open(
    "https://call.razaki.technology/webcall/?client=BRAWIJAYA",
    "popup",
    "width=400,height=600"
  );

  //   window.ctbWebCall.init({
  //     clientId: "BRAWIJAYA",
  //     mode: "POPUP" /* POPUP|IFRAME */,
  //     // mode: 'IFRAME' /* POPUP|IFRAME */
  //   });
});
