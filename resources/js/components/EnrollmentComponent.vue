<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">Listado de Matrículas
          <router-link
              to="/enrollments/create"
              class="btn btn-primary btn-sm float-right"
              >Generar Matrícular <i class="fas fa-plus"></i></router-link
            >
          </div>
          <div class="card-body">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">Estudiante</th>
                  <th scope="col">Estudiante DNI</th>
                  <th scope="col">Fecha</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="enrollment in enrollments.data" :key="enrollment.id">
                  <td>
                    {{
                      enrollment.student.name +
                      " " +
                      enrollment.student.lastname
                    }}
                  </td>
                  <td>{{ enrollment.student.dni }}</td>
                  <td>{{ enrollment.date_enrolled }}</td>
               
                </tr>
              </tbody>
              <tfoot>
                <tr>
                  <td colspan="7">
                    <pagination
                      :data="enrollments"
                      @pagination-change-page="getEnrollments"
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
  name: "EnrollmentComponent",
  data() {
    return {
      name: "",
      enrollments: {},
    };
  },
  mounted() {
    this.getEnrollments();
  },
  methods: {
    getEnrollments(page = 1) {
      axios
        .get("/enrollments?page=" + page)
        .then((response) => {
          this.enrollments = response.data.enrollments;
          console.log(this.enrollments);
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>
