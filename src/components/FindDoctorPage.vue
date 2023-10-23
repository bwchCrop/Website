<template>
  <div>
    <div class="form-group" v-if="doctors.length > 0">
      <label for="doctor">Search doctor</label>
      <div class="search-input" :class="{ active: showSuggestion }">
        <input
          placeholder="Input doctor name"
          v-model="doctorFilter"
          class="form-control"
          type="text"
          @focus="showSuggestion = true"
        />
        <ul class="autocom-box" v-if="doctorFilter.trim().length > 0">
          <li
            v-for="doctor in filteredDoctor.slice(0, 5)"
            :key="doctor.pid"
            @mousedown="doctorFilter = doctor.name_real"
          >
            {{ doctor.name_real }}
          </li>
          <!-- here list are inserted from javascript -->
        </ul>
      </div>
    </div>

    <div class="form-group" v-if="hospitals.length > 0">
      <label for="hosputal">Select Hospital</label>
      <select class="form-control" v-model="selected.hospital">
        <option
          v-for="hos in hospitals"
          :key="`hostital-option${hos.rsid}`"
          :value="hos.rsid"
        >
          {{ hos.nama }}
        </option>
      </select>
    </div>
    <div>
      <div class="form-group" v-if="specialists.length > 0">
        <label for="hosputal">Select Specialist</label>
        <select class="form-control" v-model="selected.specialist">
          <option value="0">All Specialist</option>
          <option
            v-for="specialist in specialists"
            :key="`specialist-option${specialist.tmid}`"
            :value="specialist.tmid"
          >
            {{ specialist.spesialis }}
          </option>
        </select>
      </div>
    </div>

    <div>
      <div class="doctor-list" v-if="doctors.length > 0">
        <div class="row">
          <div
            class="col-md-6"
            v-for="doctor in filteredDoctor"
            :key="`doctor-card${doctor.pid}`"
          >
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">{{ doctor.name_real }}</h5>
                <div class="appereance">
                  <span class="label label-purple">{{ doctor.spesialis }}</span>
                </div>
                <a
                  href="#"
                  :value="doctor.pid"
                  :onclick="`fetchDoctor(${doctor.pid},${selected.hospital},'${hospitalName}')`"
                  class="btn btn-primary btn-find-doctor"
                  v-show="profile_display"
                  >View Profile</a
                > 
                <a
                  href="#"
                  :onclick="`checkS(${doctor.pid},${selected.hospital},'${hospitalName}','${doctor.group_name}')`"
                  class="btn btn-primary btn-find-doctor"
                  >Book</a
                >
                <!-- v-show="selected.hospital == 19" -->
              </div>
            </div>
          </div>
        </div>
      </div>
      <div v-if="doctors.length == 0">
        <span>Doctor Not Found</span>
      </div>
      <div
        class="doctor-loader"
        style="
          display: flex;
          align-items: center;
          justify-content: space-around;
        "
        v-if="doctors.loading == true"
      >
        <div v-for="n in skeletons.doctor.count" :key="`skeleton-wrapper-${n}`">
          <vue-skeleton-loader
            :width="skeletons.doctor.width"
            :height="skeletons.doctor.height"
            :animation="skeletons.doctor.animation"
          />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
function remoteLogin() {
  return $.ajax({
    type: "get",
    url: "/remote/login",
  });
}

const tokenGen = async () => {
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

export default {
  props: ["api_url", "profile_display"],
  data() {
    return {
      groups: [],
      showSuggestion: false,
      hospitals: [],
      specialists: [],
      doctors: [],
      doctorFilter: "",
      selected: {
        hospital: null,
        specialist: null,
      },
      skeletons: {
        doctor: {
          count: 3,
          type: "rect",
          width: 200,
          height: 200,
          animation: "fade",
        },
      },
    };
  },

  beforeMount() {},
  mounted() {
    this.getGroups();
  },

  computed: {
    filteredDoctor() {
      if (this.doctors.length > 0) {
        return this.doctors.filter((doctor) =>
          doctor.name_real
            .toLowerCase()
            .includes(this.doctorFilter.trim().toLowerCase())
        );
      }
      return this.doctors;
    },
    hospitalName() {
      if (this.selected.hospital == null) {
        return "";
      } else {
        return this.hospitals.find((hos) => hos.rsid == this.selected.hospital)
          .nama;
      }
    },
  },

  watch: {
    "selected.hospital": {
      handler: function (val) {
        this.specialists = [];
        this.doctors = {
          loading: true,
        };
        this.selected.specialist = null;
        this.getSpecialists(val);
      },
      deep: true,
    },
    "selected.specialist": {
      handler: function (val) {
        this.doctors = {
          loading: true,
        };
        this.getDoctors(val, this.selected.hospital);
      },
      deep: true,
    },
  },

  methods: {
    async getHospitals() {
      await axios.get("/remote/rs").then((response) => {
        this.hospitals = response.data;

        if (this.hospitals.length > 0) {
          this.selected.hospital = response.data.find(
            (element) => element.rsid == 19
          ).rsid;
        }
      });
    },
    async getGroups() {
      await axios.get("/remote/grouping").then((response) => {
        var data = response.data;
        var filtered = [];

        data.forEach((element, index) => {
          // this.
          let rsObject = element.rs;
          filtered[index] = {
            tmgroupid: element.tmgroupid,
            tmgroupname: element.tmgroupname,
            rs: [],
          };
          rsObject.forEach((rs, idx) => {
            if (rs.rsid == 19) {
              filtered[index].rs.push(rs);
            }
          });
        });

        //? gunakan filtered untuk data yang difilter, gunakan data untuk menggunakan data asli
        this.groups = data;
        this.getHospitals();
      });
    },
    getSpecialists(rsid) {
      let specialistList = [];
      if (rsid == null) {
        alert("Select Hospital First");
        return;
      }

      // let groups = await this.getGroups();

      this.groups.forEach((group) => {
        const rsgroup = group.rs;
        rsgroup.forEach((rs) => {
          if (rs.rsid == rsid) {
            rs.specialist.forEach((specialist) => {
              const spesialis = specialist.specialist.trimStart();
              let specialist_item = {
                tmid: specialist.tmid,
                spesialis: spesialis,
              };
              specialistList.push(specialist_item);
            });
          }
        });
      });

      this.selected.specialist = 0;

      //sort by spesialis
      const sortedSpecialist = _.orderBy(
        specialistList,
        ["spesialis"],
        ["asc"]
      );
      this.specialists = sortedSpecialist;
    },

    async getDoctors(tmid, rsid) {
      // const token = await tokenGen();
      if (tmid == null) {
        alert("Select Specialist First");
        return;
      }

      if (rsid == null) {
        alert("Select hospital First");
        return;
      }

      let doctorList = [];
      this.groups.forEach((group) => {
        const rsgroup = group.rs;
        rsgroup.forEach((rs) => {
          if (tmid == 0) {
            if (rs.rsid == rsid) {
              rs.specialist.forEach((specialist) => {
                specialist.doctors.forEach((doctor) => {
                  const name_real = doctor.dokter.trimStart();
                  let doctors = {
                    pid: doctor.pid,
                    name_real: name_real,
                    spesialis: specialist.specialist,
                    group_name: group.tmgroupname,
                  };
                  doctorList.push(doctors);
                });
              });
            }
          } else {
            if (rs.rsid == rsid) {
              rs.specialist.forEach((specialist) => {
                if (specialist.tmid == tmid) {
                  specialist.doctors.forEach((doctor) => {
                    let doctors = {
                      pid: doctor.pid,
                      name_real: doctor.dokter.trim(),
                      spesialis: specialist.specialist,
                      group_name: group.tmgroupname,
                    };
                    doctorList.push(doctors);
                  });
                }
              });
            }
          }
        });
      });
      //sort by name_real
      const sortedDoctors = _.orderBy(doctorList, ["name_real"], ["asc"]);
      this.doctors = sortedDoctors;
    },
  },
};
</script>

<style scoped>
  .btn.btn-primary.btn-find-doctor{
    font-size: 1em;
  }
  .btn.btn-primary.btn-find-doctor:active,
  .btn.btn-primary.btn-find-doctor:hover,
  .btn.btn-primary.btn-find-doctor:focus{
    color: #fff;
    background-color: #6c4081;
    border-color: #e1a1fe;
  }
</style>
