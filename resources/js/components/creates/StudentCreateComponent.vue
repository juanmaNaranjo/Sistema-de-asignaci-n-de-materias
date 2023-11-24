<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8 col-sm-8">
        <div class="card">
          <div class="card-header">Nuevo Estudiante
            <router-link href="#" to="/students" class="btn btn-dark float-right">Listado <i class="fas fa-arrow-left-long"></i></router-link>
          </div>
          <div class="card-body">
            <form
              class="forms-sample"
              role="form"
              @submit.prevent="createStudent()"
            >
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="name">Nombre</label>
                    <input type="text" class="form-control" v-model="name" />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="lastname">Apellidos</label>
                    <input
                      type="text"
                      class="form-control"
                      v-model="lastname"
                    />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" v-model="email" />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="phone">Teléfono</label>
                    <input type="tel" class="form-control" v-model="phone" />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="semester">Semestre</label>
                    <select class="form-control form-select" v-model="semester">
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5">5</option>
                      <option value="6">6</option>
                      <option value="7">7</option>
                      <option value="8">8</option>
                      <option value="9">9</option>
                      <option value="10">10</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="address">Dirección</label>
                    <input type="text" class="form-control" v-model="address" />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="city">Ciudad</label>
                    <input type="text" class="form-control" v-model="city" />
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label for="dni">DNI</label>
                    <input type="text" class="form-control" v-model="dni" />
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
  name: "StudentCreateComponent",
  data() {
    return {
      name: "",
      lastname: "",
      email: "",
      phone: "",
      address: "",
      city: "",
      dni: "",
      semester: 1,
      errors: [],
    };
  },
  methods: {
    createStudent() {
      axios
        .post("/students", {
          name: this.name,
          lastname: this.lastname,
          email: this.email,
          phone: this.phone,
          address: this.address,
          city: this.city,
          dni: this.dni,
          semester: this.semester,
        })
        .then((response) => {
          this.cleanInputs();
          toastr.success(response.data.message);
        })
        .catch((error) => {
          this.errors = error.response.data.errors;
          toastr.error("Error al crear el estudiante");
        });
    },

    cleanInputs() {
      this.name = "";
      this.lastname = "";
      this.email = "";
      this.phone = "";
      this.address = "";
      this.city = "";
      this.dni = "";
      this.semester = 1;
    },
  },
};
</script>
