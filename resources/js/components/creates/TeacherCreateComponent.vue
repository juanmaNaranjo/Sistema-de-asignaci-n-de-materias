<template>
     <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8 col-sm-8">
        <div class="card">
          <div class="card-header">Nuevo Profesor
            <router-link href="#" to="/teachers" class="btn btn-dark float-right">Listado
            <i class="fas fa-arrow-left-long"></i>
            </router-link>
          </div>
          <div class="card-body">
            <form
              class="forms-sample"
              role="form"
              @submit.prevent="createTeacher()"
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
import toastr from "toastr";
export default {
    name: "TeacherCreateComponent",
    data() {
        return {
            name: "",
            lastname: "",
            email: "",
            phone: "",
            address: "",
            city: "",
            dni: "",
            errors: [],
        };
    },
    methods: {
        createTeacher() {
            axios
                .post("/teachers", {
                    name: this.name,
                    lastname: this.lastname,
                    email: this.email,
                    phone: this.phone,
                    address: this.address,
                    city: this.city,
                    dni: this.dni,
                })
                .then((response) => {
                    this.cleanInputs();
                    toastr.success(response.data.message);
                })
                .catch((error) => {
                    this.errors = error.response.data.errors;
                    toastr.error("Error al crear el profesor");
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
        },
    },
};
</script>