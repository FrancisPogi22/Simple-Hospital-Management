<!-- eslint-disable vue/multi-word-component-names -->
<template>
  <section id="sidebar">
    <div class="sidebar-con">
      <div class="sidebar-header">
        <p>HMS</p>
      </div>
      <div class="sidebar-nav-con">
        <ul class="sidebar-nav">
          <router-link to="/admin/dashboard">
            <i class="fa-solid fa-tv"></i>
            <span>Dashboard</span>
          </router-link>
          <router-link to="/admin/manageDoctors" v-if="isAuthenticate && account_type == 1">
            <i class="fa-solid fa-user-doctor"></i>
            <span>Manage Doctors</span>
          </router-link>
          <router-link
            to="/admin/managePatients"
            v-if="isAuthenticate && account_type == 1"
          >
            <i class="fa-solid fa-hospital-user"></i>
            <span>Manage Patients</span>
          </router-link>
          <router-link
            to="/doctor/patientRecords"
            v-if="isAuthenticate && account_type == 2"
          >
            <i class="fa-solid fa-book"></i>
            <span>Patient Record</span>
          </router-link>
          <router-link
            to="/doctor/manageAppointments"
            v-if="isAuthenticate && account_type == 2"
          >
            <i class="fa-solid fa-calendar-check"></i>
            <span>Appointments</span>
          </router-link>
          <router-link
            to="/patient/appointments"
            v-if="isAuthenticate && account_type == 3"
          >
            <i class="fa-solid fa-calendar-check"></i>
            <span>Appointments</span>
          </router-link>
          <router-link
            to="/patient/viewMedicalRecords"
            v-if="isAuthenticate && account_type == 3"
          >
            <i class="fa-solid fa-calendar-check"></i>
            <span>Medical Records</span>
          </router-link>
          <a href="" v-if="isAuthenticate">
            <i class="fa-solid fa-arrow-right-from-bracket"></i>
            <span>Logout</span>
          </a>
        </ul>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  data() {
    return {
      account_type: 0,
      isAuthenticate: false,
    };
  },
  mounted() {
    this.account_type = localStorage.getItem("account_type");
    this.isAuthenticate = !!localStorage.getItem("token");
  },
};
</script>

<style scoped>
#sidebar {
  position: fixed;
  left: 0;
  height: 100%;
  width: 80px;
  z-index: 9;
  transition: 0.3s;
  background: var(--global-color-primary);
  box-shadow: var(--global-shadow);
}

#sidebar:hover {
  width: 250px;
}

#sidebar:hover .sidebar-nav a span {
  opacity: 1;
  visibility: visible;
}

#sidebar:hover .sidebar-header {
  opacity: 1;
}

#sidebar .sidebar-header {
  opacity: 0;
  transition: 0.3s;
  display: flex;
  align-items: center;
  height: 64px;
  padding: 10px;
}

#sidebar .sidebar-header p {
  color: var(--global-color-white);
  font-weight: 600;
}

#sidebar .sidebar-nav {
  padding: 0;
  margin: 0;
}

#sidebar .sidebar-nav a {
  padding: 15px 10px 15px 35px;
  display: flex;
  align-items: center;
  gap: 20px;
}

#sidebar .sidebar-nav a:hover {
  background: var(--global-color-white);
}

#sidebar .sidebar-nav a:hover span,
#sidebar .sidebar-nav a:hover i {
  color: var(--global-color-primary);
}

#sidebar .sidebar-nav a span {
  opacity: 0;
  visibility: hidden;
  color: var(--global-color-white);
  font-weight: 600;
  transition: opacity 0.3s, visibility 0.3s;
  font-size: 16px;
  white-space: nowrap;
  overflow: hidden;
}

#sidebar .sidebar-nav a i {
  color: var(--global-color-white);
  font-size: 15px;
}
</style>