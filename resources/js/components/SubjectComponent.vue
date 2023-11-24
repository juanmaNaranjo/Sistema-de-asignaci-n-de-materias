<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">Listado de Materias
            <router-link href="#" to="/subjects/create" class="btn btn-primary float-right">Nuevo <i class="fas fa-plus"></i></router-link>
          </div>
          <div class="card-body">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">Código</th>
                  <th scope="col">Nombre</th>
                  <th scope="col">Descripción</th>
                  <th scope="col">Créditos</th>
                  <th scope="col">Área de conocimiento</th>
                  <th scope="col">Tipo</th>
                  <th scope="col">Profesor</th>
                  <th scope="col">Acciones</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="subject in subjects.data" :key="subject.id">
                    <td>{{ subject.code }}</td>
                    <td>{{ subject.name }}</td>
                    <td>{{ subject.description }}</td>
                    <td>{{ subject.credits }}</td>
                    <td>{{ subject.knowledge_area }}</td>
                    <td>
                        <span v-if="subject.type == 'obligatory'" class="text-danger">Obligatoria</span>
                        <span v-else class="text-success">Electiva</span>
                    </td>
                    <td>{{ subject.teacher.name }}</td>
                    <td>
                        <a href="#" class="btn btn-danger m-1" @click="deleteSubject(subject.id)" title="Eliminar Materia">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
              </tbody>
              <tfoot>
                <tr>
                  <td colspan="8">
                    <pagination
                      :data="subjects"
                      @pagination-change-page="getSubjects"
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
import toastr from "toastr";

export default {
  name: "SubjectComponent",
  data() {
    return {
      name: "",
      subjects: {},
    };
  },
  mounted() {
    this.getSubjects();
  },
  methods: {
    getSubjects(page = 1) {
      axios
        .get("/subjects?page=" + page)
        .then((response) => {
          this.subjects = response.data.subjects;
          console.log(this.subjects);
        })
        .catch((error) => {
          console.log(error);
        });
    },
    deleteSubject(id) {
      axios
        .delete("/subjects/" + id)
        .then((response) => {
          this.getSubjects();
          toastr.info(response.data.message);
        })
        .catch((error) => {
          console.log(error);
          toastr.error(error.response.data.message);
        });
    },
  },
};
</script>