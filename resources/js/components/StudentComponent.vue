<template>
  <div class="container">
    <div
      class="modal fade"
      id="studentModal"
      tabindex="-1"
      aria-labelledby="studentModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="studentModalLabel">Materias</h5>
            <button
              type="button"
              class="close"
              @click="closeModalSubject()"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-6" v-for="sSubject in studentSubjects" :key="sSubject.id">
            <div class="card">
              <div class="card-header">
                {{ sSubject.name }}
              </div>
              <div class="card-body">
                <p class="card-text">Área de conocimiento: {{ sSubject.knowledge_area}}</p>
                <p class="card-text">Créditos: {{ sSubject.credits }}</p>
                <p class="card-text">Tipo: {{ sSubject.type }}</p>
                <p class="card-text">Código: {{ sSubject.code }}</p>
                <p class="card-text">Profesor: {{sSubject.teacherName}}</p>
              </div>
            </div>
            </div>
            </div>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              @click="closeModalSubject()"
              class="btn btn-secondary"
              data-dismiss="modal"
            >
              Close
            </button>
          </div>
        </div>
      </div>
    </div>
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            Listado de Estudiantes
            <router-link
              href="#"
              to="/students/create"
              class="btn btn-primary float-right mr-2"
              >Nuevo <i class="fas fa-plus"></i></router-link>
               <router-link
              href="#"
              to="/students-class/create"
              class="btn btn-info float-right text-white mr-2"
              >Unirme a una clase <i class="fas fa-plus"></i></router-link>
          </div>
          <div class="card-body">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">DNI</th>
                  <th scope="col">Nombre</th>
                  <th scope="col">Correo</th>
                  <th scope="col">Teléfono</th>
                  <th scope="col">Dirección</th>
                  <th scope="col">Ciudad</th>
                  <th scope="col">Acciones</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="student in students.data" :key="student.id">
                  <td>{{ student.dni }}</td>
                  <td>{{ student.name }}</td>
                  <td>{{ student.email }}</td>
                  <td>{{ student.phone }}</td>
                  <td>{{ student.address }}</td>
                  <td>{{ student.city }}</td>
                  <td>
                    <button
                      class="btn btn-secondary m-1"
                      @click="showModalSubject(student.id)"
                      title="Ver Materias"
                    >
                      <i class="fas fa-eye"> M</i>
                    </button>
                  </td>
                </tr>
              </tbody>
              <tfoot>
                <tr>
                  <td colspan="7">
                    <pagination
                      :data="students"
                      @pagination-change-page="getStudents"
                    ></pagination>
                  </td>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "StudentComponent",
  data() {
    return {
      name: "",
      students: {},
      studentSubjects: [],
    };
  },
  mounted() {
    this.getStudents();
  },
  methods: {
    getStudents(page = 1) {
      axios
        .get("/students?page=" + page)
        .then((response) => {
          this.students = response.data.students;
          console.log(this.students);
        })
        .catch((error) => {
          console.log(error);
        });
    },

    showModalSubject(id) {
      $("#studentModal").modal("show");
      axios
        .get("/students/subjects/" + id)
        .then((response) => {
          this.studentSubjects = response.data.subjects;
          console.log('Subjects',this.studentSubjects);
        })
        .catch((error) => {
          console.log(error);
        });
    },

    closeModalSubject() {
      $("#studentModal").modal("hide");
    },
  },
};
</script>
