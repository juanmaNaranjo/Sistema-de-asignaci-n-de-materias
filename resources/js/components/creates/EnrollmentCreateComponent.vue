<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8 col-sm-8">
        <div class="card">
          <div class="card-header">
            Nueva Matricula
            <router-link
              href="#"
              to="/enrollments"
              class="btn btn-dark float-right"
              >Listado <i class="fas fa-arrow-left-long"></i
            ></router-link>
          </div>
          <div class="card-body">
            <form
              class="forms-sample"
              role="form"
              @submit.prevent="createEnrollment()"
            >
              <div class="row">
                <div class="col-md-7">
                  <div class="form-group">
                    <label for="student">Estudiante </label>
                    <input
                      type="text"
                      class="form-control"
                      placeholder="Ingrese el DNI del estudiante"
                      v-model="dni"
                      @keyup="getStudentClasses()"
                    />
                  </div>
                </div>
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="date">Fecha</label>
                    <input type="date" class="form-control" v-model="eDate" />
                  </div>
                </div>
                <div class="col-md-6" v-if="allClass.length > 0">
                  <div class="form-group">
                    <label for="teacher_id"
                      >Listado de clases a matricular</label
                    ><br />
                    <select class="form-control" multiple>
                      <option
                        v-for="classs in allClass"
                        :value="classs.id"
                        :key="classs.id"
                      >
                        {{ classs.day }} : {{ classs.hour }} ,
                        {{ classs.subject.name }}
                      </option>
                    </select>
                  </div>
                </div>

                <div class="col-md-12">
                  <button class="btn btn-success float-right" type="submit">
                    Matricular
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import toastr from "toastr";

export default {
  name: "EnrollmentCreateComponent",
  data() {
    return {
      student_id: "",
      studentId: "",
      allClass: [],
      dni: "",
      eDate: "",
    };
  },
  mounted() {
    console.log("Component mounted.");
  },

  methods: {
    getStudentClasses() {
      axios
        .get("students/classes/" + this.dni)
        .then((response) => {
          this.allClass = response.data.classes;
          this.studentId = response.data.classes[0].studentId;
          if (this.allClass.length > 0) {
            toastr.success("Se encontraron clases para el estudiante");
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },

    createEnrollment() {
      axios
        .post("/enrollments", {
          student_id: this.studentId,
          date_enrolled: this.eDate,
        })
        .then((response) => {
          toastr.success(response.data.message);
          this.$router.push("/enrollments");
        })
        .catch((error) => {
          console.log(error);
          if (error.response.status == 400) {
            toastr.info(error.response.data.message);
          }
          if (error.response.status == 401 && this.allClass.length > 0) {
            toastr.info(error.response.data.message);
          }
          if (error.response.status == 500) {
            toastr.info(error.response.data.message);
          }
        });
    },
  },
};
</script>