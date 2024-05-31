import { createStore } from "vuex";
import axios from "axios";
export default createStore({
  state: {
    apiUrl: "http://127.0.0.1:8000/api",
    doctors: [],
    doctor: [],
    patients: [],
    patient: [],
  },
  getters: {
    getDoctors(state) {
      return state.doctors;
    },
    getPatients(state) {
      return state.patients;
    },
    getDoctor: (state) => (id) => {
      return axios
        .get(state.apiUrl + "/showDoctor/" + id)
        .then((response) => {
          state.doctor = response.data;
        })
        .catch((error) => {
          alert(error.message);
        });
    },
    getPatient: (state) => (id) => {
      return axios
        .get(state.apiUrl + "/showPatient/" + id)
        .then((response) => {
          state.patient = response.data;
        })
        .catch((error) => {
          alert(error.message);
        });
    },
  },
  mutations: {
    setDoctors(state, doctors) {
      state.doctors = doctors;
    },
    setPatients(state, patients) {
      state.patients = patients;
    },
    updateDoctorFullName(state, doctorFullName) {
      state.doctor.fullname = doctorFullName;
    },
    updateDoctorAddress(state, doctorAddress) {
      state.doctor.address = doctorAddress;
    },
    updateDoctorContact(state, doctorContact) {
      state.doctor.contact = doctorContact;
    },
    updateDoctorEmail(state, doctorEmail) {
      state.doctor.email = doctorEmail;
    },
    updatePatientFullName(state, patientFullName) {
      state.patient.fullname = patientFullName;
    },
    updatePatientAddress(state, patientAddress) {
      state.patient.address = patientAddress;
    },
    updatePatientContact(state, patientContact) {
      state.patient.contact = patientContact;
    },
    updatePatientEmail(state, patientEmail) {
      state.patient.email = patientEmail;
    },
  },
  actions: {
    async fetchDoctors({ state, commit }) {
      try {
        const response = await axios.get(state.apiUrl + "/doctors");
        commit("setDoctors", response.data);
      } catch (error) {
        alert("Error fetching doctors: " + error.message);
      }
    },
    async fetchPatients({ state, commit }) {
      try {
        const response = await axios.get(state.apiUrl + "/patients");
        commit("setPatients", response.data);
      } catch (error) {
        alert("Error fetching products: " + error.message);
      }
    },
    updateDoctorFullName({ commit }, doctorFullName) {
      commit("updateDoctorFullName", doctorFullName);
    },
    updateDoctorAddress({ commit }, doctorAddress) {
      commit("updateDoctorAddress", doctorAddress);
    },
    updateDoctorContact({ commit }, doctorContact) {
      commit("updateDoctorContact", doctorContact);
    },
    updateDoctorEmail({ commit }, doctorEmail) {
      commit("updateDoctorEmail", doctorEmail);
    },
    updatePatientFullName({ commit }, patientFullName) {
      commit("updatePatientFullName", patientFullName);
    },
    updatePatientAddress({ commit }, patientAddress) {
      commit("updatePatientAddress", patientAddress);
    },
    updatePatientContact({ commit }, patientContact) {
      commit("updatePatientContact", patientContact);
    },
    updatePatientEmail({ commit }, patientEmail) {
      commit("updatePatientEmail", patientEmail);
    },
  },
  modules: {},
});
