/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import { createApp } from 'vue';
import axios from 'axios';
import {router} from './routes/index';
import 'toastr/build/toastr.min.css';
/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */

const app = createApp({});

import StudentComponent from './components/StudentComponent.vue';
import StudentCreateComponent from './components/creates/StudentCreateComponent.vue';
import StudentClassCreateComponent from './components/creates/StudentClassCreateComponent.vue';
import TeacherComponent from './components/TeacherComponent.vue';
import TeacherCreateComponent from './components/creates/TeacherCreateComponent.vue';
import SubjectComponent from './components/SubjectComponent.vue';
import SubjectCreateComponent from './components/creates/SubjectCreateComponent.vue';
import ClassComponent from './components/ClassComponent.vue';
import EnrollmentComponent from './components/EnrollmentComponent.vue';
import EnrollmentCreateComponent from './components/creates/EnrollmentCreateComponent.vue';

app.component('student-component', StudentComponent);
app.component('student-create-component', StudentCreateComponent);
app.component('student-class-create-component', StudentClassCreateComponent);
app.component('teacher-component', TeacherComponent);
app.component('teacher-create-component', TeacherCreateComponent);
app.component('subject-component', SubjectComponent);
app.component('subject-create-component', SubjectCreateComponent);
app.component('class-component', ClassComponent);
app.component('enrollment-component', EnrollmentComponent);
app.component('enrollment-create-component', EnrollmentCreateComponent);

import { Bootstrap5Pagination } from 'laravel-vue-pagination';
app.component('pagination', Bootstrap5Pagination);
// API URL
axios.defaults.baseURL = 'http://localhost:8000/api';

app.use(router, axios);
app.mount('#app');
