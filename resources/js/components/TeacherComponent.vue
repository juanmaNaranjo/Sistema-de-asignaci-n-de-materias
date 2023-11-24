<template>
  <div class="container">
     <div
      class="modal fade"
      id="modalSubjects"
      tabindex="-1"
      aria-labelledby="modalSubjects"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalSubjects">Materias Impartidas</h5>
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
              <div class="col-md-6" v-for="subject in subjects" :key="subject.id">
            <div class="card">
              <div class="card-header">
                {{ subject.name }}
              </div>
              <div class="card-body">
                <p class="card-text">Área de conocimiento: {{ subject.knowledge_area}}</p>
                <p class="card-text">Créditos: {{ subject.credits }}</p>
                <p class="card-text">Tipo: 
                  <span v-if="subject.type == 'obligatory'" class="text-danger">Obligatoria</span>
                  <span v-else class="text-success">Electiva</span>
                </p>
                <p class="card-text">Código: {{ subject.code }}</p>
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
          <div class="card-header">Listado de Profesores
            <router-link href="#" to="/teachers/create" class="btn btn-primary float-right">Nuevo <i class="fas fa-plus"></i></router-link>
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
                <tr v-for="teacher in teachers.data" :key="teacher.id">
                    <td>{{ teacher.dni }}</td>
                    <td>{{ teacher.name }}</td>
                    <td>{{ teacher.email }}</td>
                    <td>{{ teacher.phone }}</td>
                    <td>{{ teacher.address }}</td>
                    <td>{{ teacher.city }}</td>
                    <td>
                        <a href="#" class="btn btn-secondary m-1" @click="showModalSubject(teacher.id)" title="Ver Materias">
                            <i class="fas fa-eye"> M</i>
                        </a>
                    </td>
                </tr>
              </tbody>
              <tfoot>
                <tr>
                  <td colspan="7">
                    <pagination
                      :data="teachers"
                      @pagination-change-page="getTeachers"
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
  name: "TeacherComponent",
  data() {
    return {
      name: "",
      teachers: {},
      subjects: [],
    };
  },
  mounted() {
    this.getTeachers();
  },
  methods: {
    getTeachers(page = 1) {
      axios
        .get("/teachers?page=" + page)
        .then((response) => {
          this.teachers = response.data.teachers;
          console.log(this.teachers);
        })
        .catch((error) => {
          console.log(error);
        });
    },

    showModalSubject(id) {
      axios
        .get("/teachers/subjects/" + id)
        .then((response) => {
          this.subjects = response.data.subjects;
          $("#modalSubjects").modal("show");
        })
        .catch((error) => {
          console.log(error);
        });
    },

    closeModalSubject() {
      $("#modalSubjects").modal("hide");
    },
  },
};
</script>