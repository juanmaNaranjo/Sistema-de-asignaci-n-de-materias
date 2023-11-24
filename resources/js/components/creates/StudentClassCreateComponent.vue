<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8 col-sm-8">
        <div class="card">
          <div class="card-header">
            Unir Estudiante a Clase
            <router-link
              href="#"
              to="/students"
              class="btn btn-dark float-right"
              >Anterior <i class="fas fa-arrow-left-long"></i
            ></router-link>
          </div>
          <div class="card-body">
            <form
              class="forms-sample"
              role="form"
              @submit.prevent="createStudentClass()"
            >
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="studentId">Estudiante</label>
                    <select
                      class="form-control form-select"
                      v-model="studentId"
                    >
                      <option
                        v-for="student in students"
                        :value="student.id"
                        :key="student.id"
                      >
                        {{ student.name }} {{ student.lastname }}
                      </option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="stClass">Clase</label>
                    <select
                      class="form-control form-select"
                      v-model="stClassId"
                    >
                      <option
                        v-for="sClass in classes"
                        :value="sClass.id"
                        :key="sClass.id"
                      >
                        {{ sClass.subject.name }} -- {{ sClass.day }} --
                        {{ sClass.hour }} -- {{ sClass.teacher.name }}
                        {{ sClass.teacher.lastname }}
                      </option>
                    </select>
                  </div>
                </div>
                <div class="col-md-12">
                  <button class="btn btn-success float-right" type="submit">
                    Agregar
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
import axios from "axios";
import toastr from "toastr";
export default {
  name: "StudentClassCreateComponent",
  data() {
    return {
      studentId: "",
      stClassId: "",
      students: [],
      classes: [],
    };
  },
  mounted() {
    this.getAllStudents();
    this.getAllClasses();
  },
  methods: {
    createStudentClass() {
      console.log("create class");
    },

    getAllStudents() {
      axios.get("/students/all").then((response) => {
        this.students = response.data.students;
        console.log(this.students);
      });
    },
    getAllClasses() {
      axios.get("/sClasses/all").then((response) => {
        this.classes = response.data.sClasses;
        console.log(this.classes);
      });
    },
    createStudentClass() {
      axios
        .post("/student-classes", {
          student_id: this.studentId,
          s_class_id: this.stClassId,
        })
        .then((response) => {
          console.log(response);
          toastr.success(response.data.message);
          this.$router.push("/students");
        })
        .catch((error) => {
          console.log(error.response);
          if (error.response.status == 401) {
            toastr.error(error.response.data.message);
          }
          if (error.response.status == 500) {
            toastr.error(error.response.data.message);
          }
        });
    },
  },
};
</script>