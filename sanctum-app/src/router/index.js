import { createRouter, createWebHashHistory } from "vue-router";
import AdminLoginPage from "../components/AdminLogin.vue";
import DoctorLoginPage from "../components/DoctorLogin.vue";
import PatientLoginPage from "../components/PatientLogin.vue";
import AdminDashboard from "../components/Admin/Dashboard.vue";
import ManageDoctors from "../components/Admin/Doctors.vue";
import ManagePatients from "../components/Admin/Patients.vue";

const isAuthenticated = () => {
  return localStorage.getItem("token");
};

const isAdmin = () => {
  return localStorage.getItem("account_type") == 1;
};

// const isDoctor = () => {
//   return localStorage.getItem("account_type") == 2;
// };

// const isPatient = () => {
//   return localStorage.getItem("account_type") == 3;
// };

// const authGuard = (to, from, next) => {
//   if (isAuthenticated()) {
//     next();
//   } else {
//     next(from);
//   }
// };

const adminGuard = (to, from, next) => {
  if (isAuthenticated() && isAdmin()) {
    next();
  } else {
    next(from);
  }
};

// const doctorGuard = (to, from, next) => {
//   if (isAuthenticated() && isDoctor()) {
//     next();
//   } else {
//     next(from);
//   }
// };

// const patientGuard = (to, from, next) => {
//   if (isAuthenticated() && isPatient()) {
//     next();
//   } else {
//     next(from);
//   }
// };

const routes = [
  {
    path: "/",
    name: "index",
    component: AdminLoginPage,
  },
  {
    path: "/admin/login",
    name: "Adminlogin",
    component: AdminLoginPage,
  },
  {
    path: "/doctor/login",
    name: "Doctorlogin",
    component: DoctorLoginPage,
  },
  {
    path: "/patient/login",
    name: "Patientlogin",
    component: PatientLoginPage,
  },
  {
    path: "/admin/dashboard",
    name: "admin.dashboard",
    component: AdminDashboard,
    beforeEnter: adminGuard,
  },
  {
    path: "/admin/manageDoctors",
    name: "admin.manage.doctors",
    component: ManageDoctors,
    beforeEnter: adminGuard,
  },
  {
    path: "/admin/managePatients",
    name: "admin.manage.patients",
    component: ManagePatients,
    beforeEnter: adminGuard,
  },
];

const router = createRouter({
  history: createWebHashHistory(),
  routes,
});

export default router;
