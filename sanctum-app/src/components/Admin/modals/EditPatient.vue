<template>
  <div
    v-if="openClose"
    class="modal fade show"
    tabindex="-1"
    aria-hidden="true"
    id="editDoctor"
    style="display: block"
  >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">
          <div class="field-con">
            <input
              type="text"
              id="fullname"
              v-model="this.$store.state.patient.fullname"
              @input="updateFullName"
              placeholder="Enter Full Name"
              required
            />
          </div>
          <div class="field-con">
            <input
              type="text"
              id="address"
              v-model="this.$store.state.patient.address"
              @input="updateAddress"
              placeholder="Enter Adrress"
              required
            />
          </div>
          <div class="field-con">
            <input
              type="text"
              id="contact"
              v-model="this.$store.state.patient.contact"
              @input="updateContact"
              placeholder="Enter Contact"
              required
            />
          </div>
          <div class="field-con">
            <input
              type="email"
              id="email"
              v-model="this.$store.state.patient.email"
              @input="updateEmail"
              placeholder="Enter Email"
              required
            />
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn-secondary" @click="CloseModal()">Close</button>
          <button type="button" @click="EditPatient()" class="btn btn-primary">
            Edit
          </button>
        </div>
      </div>
    </div>
  </div>
</template>
  
<script>
import axios from "axios";
export default {
  name: "EditPatient",
  data() {
    return {
      openClose: this.visible,
      fullname: this.$store.state.patient.fullname,
      address: this.$store.state.patient.address,
      contact: this.$store.state.patient.contact,
      email: this.$store.state.patient.email,
      errors: null,
    };
  },
  props: {
    visible: Boolean,
  },
  methods: {
    updatePatientFullName() {
      this.$store.dispatch("updatePatientFullName", this.$store.state.patient.fullname);
    },
    updatePatientAddress() {
      this.$store.dispatch("updatePatientAddress", this.$store.state.patient.address);
    },
    updatePatientContact() {
      this.$store.dispatch("updatePatientContact", this.$store.state.patient.contact);
    },
    updatePatientEmail() {
      this.$store.dispatch("updatePatientEmail", this.$store.state.patient.email);
    },
    async EditPatient() {
      try {
        const response = await axios.put(
          this.$store.state.apiUrl +
            "/editPatient/" +
            this.$store.state.patient.id,
          {
            fullname: this.$store.state.patient.fullname,
            address: this.$store.state.patient.address,
            contact: this.$store.state.patient.contact,
            email: this.$store.state.patient.email,
          }
        );

        if (response.status === 200) {
          alert(response.data.message);
          this.openClose = !this.openClose;
          this.$emit("update:visible", false);
          this.$emit("modal-closed");
        }
      } catch (error) {
        alert(error.response.data.message);
      }
    },
    CloseModal() {
      this.openClose = !this.openClose;
      this.$emit("update:visible", false);
      this.$emit("modal-closed");
    },
  },
  watch: {
    visible: {
      handler(newVal) {
        this.openClose = newVal;
      },
    },
  },
};
</script>