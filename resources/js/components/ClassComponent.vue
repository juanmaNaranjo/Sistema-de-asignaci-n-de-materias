<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">Listado de Clases
            <router-link href="#" to="/classes/create" class="btn btn-primary float-right mr-2">Nueva
            <i class="fas fa-plus"></i>
            </router-link>
          </div>
          <div class="card-body">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">Día</th>
                  <th scope="col">Nombre</th>
                  <th scope="col">Hora</th>
                  <th scope="col">Profesor</th>
                  <th scope="col">N° Estudiantes</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="classe in classes.data" :key="classe.id">
                    <td>{{ classe.day }}</td>
                    <td>{{ classe.subject.name }}</td>
                    <td>{{ classe.hour }}</td>
                    <td>{{ classe.teacher.name }}</td>
                    <td>{{ classe.student.length }}</td>
                </tr>
              </tbody>
              <tfoot>
                <tr>
                  <td colspan="7">
                    <pagination
                      :data="classes"
                      @pagination-change-page="getClasses"
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
  name: "ClassComponent",
  data() {
    return {
      name: "",
      classes: {},
    };
  },
  mounted() {
    this.getClasses();
  },
  methods: {
    getClasses(page = 1) {
      axios
        .get("/sClasses?page=" + page)
        .then((response) => {
          this.classes = response.data.sClasses;
          console.log(this.classes);
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>
