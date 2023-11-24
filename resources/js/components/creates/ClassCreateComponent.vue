<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8 col-sm-8">
        <div class="card">
          <div class="card-header">
            Nueva Clase
            <router-link href="#" to="/classes" class="btn btn-dark float-right"
              >Listado <i class="fas fa-arrow-left-long"></i
            ></router-link>
          </div>
          <div class="card-body">
            <form
              class="forms-sample"
              role="form"
              @submit.prevent="createClass()"
            >
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="day">Day</label>
                    <select class="form-control form-select" v-model="day">
                      <option
                        v-for="day in days"
                        :value="day.name"
                        :key="day.id"
                      >
                        {{ day.name }}
                      </option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="cHour">Hora</label>
                    <input type="time" class="form-control" v-model="cHour" />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="teacher_id">Profesor</label>
                    <select
                      class="form-control form-select"
                      v-model="teacherId"
                      @click="teacherSubjects()"
                    >
                      <option
                        v-for="teacher in teachers"
                        :value="teacher.id"
                        :key="teacher.id"
                      >
                        {{ teacher.name }} {{ teacher.lastname }}
                      </option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="subject_id">Materia</label>
                    <select
                      class="form-control form-select"
                      v-model="subjectId"
                      name="subjectId"
                      id="subjectId"
                    >
                      <option
                        v-for="subject in subjects"
                        :value="subject.id"
                        :key="subject.id"
                      >
                        {{ subject.name }}
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
import toastr from "toastr";
import axios from "axios";
export default {
  name: "ClassCreateComponent",
  data() {
    return {
      day: "",
      cHour: "",
      teacherId: "",
      subjectId: "",
      teachers: [],
      subjects: [],
      days: [
        { id: 1, name: "Lunes" },
        { id: 2, name: "Martes" },
        { id: 3, name: "Miercoles" },
        { id: 4, name: "Jueves" },
        { id: 5, name: "Viernes" },
        { id: 6, name: "Sabado" },
      ],
    };
  },
  mounted() {
    console.log("Component mounted.");
    this.getTeachers();
  },
  methods: {
    getTeachers() {
      axios.get("/teachers/all").then((response) => {
        this.teachers = response.data.teachers;
        console.log(this.teachers);
      });
    },
    teacherSubjects() {
      axios
        .get("/teachers/subjects/" + this.teacherId)
        .then((response) => {
          this.subjects = response.data.subjects;
          console.log(this.subjects);
        })
        .catch((error) => {
          console.log(error);
        });
    },

    createClass() {
      axios
        .post("/sClasses", {
            day: this.day,
            hour: this.cHour,
            teacher_id: this.teacherId,
            subject_id: this.subjectId,
        })
        .then((response) => {
            toastr.success(response.data.message);
            this.cleanInput();
        })
        .catch((error) => {
            if(error.response.status == 405){
                toastr.error(error.response.data.message);
            }
             if(error.response.status == 500){
                toastr.error(error.response.data.message);
            }
            if(error.response.status == 400){
                toastr.error(error.response.data.message);
            }
          console.log(error);
        });
    },
    cleanInput(){
      this.day = "",
      this.cHour = "",
      this.teacherId = "",
      this.subjectId = ""
    }
  },
};
</script>