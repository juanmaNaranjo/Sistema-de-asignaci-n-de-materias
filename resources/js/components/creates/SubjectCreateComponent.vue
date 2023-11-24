<template>
    <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8 col-sm-8">
        <div class="card">
          <div class="card-header">Nueva Materia
            <router-link href="#" to="/subjects" class="btn btn-dark float-right">Listado <i class="fas fa-arrow-left-long"></i></router-link>
          </div>
          <div class="card-body">
            <form
              class="forms-sample"
              role="form"
              @submit.prevent="createSubject()"
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
                    <label for="knowledge_area">Área de conocimiento</label>
                    <input
                      type="text"
                      class="form-control"
                      v-model="knowledge_area"
                    />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="code">Código</label>
                    <input type="number" class="form-control" v-model="code" />
                  </div>
                </div>
                <div class="col-md-6">
                 <div class="form-group">
                    <label for="teacher_id">Profesor</label>
                    <select class="form-control form-select" v-model="teacher_id">
                      <option v-for="teacher in teachers" :key="teacher" :value="teacher.id">{{teacher.name}} {{teacher.lastname}}</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="credits">Créditos</label>
                    <select class="form-control form-select" v-model="credits">
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="type">Tipo</label>
                    <select class="form-control form-select" v-model="type">
                      <option value="obligatory">Obligatoria</option>
                      <option value="elective">Electiva</option>
                    </select>
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="form-group">
                    <label for="description">Descripción</label>
                    <textarea v-model="description" cols="5" rows="5" class="form-control"></textarea>
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
    name: "SubjectCreateComponent",
    data() {
        return {
            name: "",
            knowledge_area: "",
            code: "",
            teacher_id: "",
            credits: "",
            type: "",
            description: "",
            errors: [],
            teachers: [],
        };
    },
    mounted() {
        axios.get("/teachers/all").then((response) => {
            this.teachers = response.data.teachers;
        });
    },
    methods: {
       
        createSubject() {
            const data = {
                name: this.name,
                knowledge_area: this.knowledge_area,
                code: this.code,
                teacher_id: this.teacher_id,
                credits: this.credits,
                type: this.type,
                description: this.description,
            };
            axios
                .post("/subjects", data)
                .then((response) => {
                    toastr.success(response.data.message);
                    this.cleanInputs();
                })
                .catch((error) => {
                    this.errors = error.response.data.errors;
                    toastr.error("Error al crear la materia");
                });
        },

        cleanInputs() {
            this.name = "";
            this.knowledge_area = "";
            this.code = "";
            this.teacher_id = "";
            this.credits = "";
            this.type = "";
            this.description = "";
        },
    },
};
</script>