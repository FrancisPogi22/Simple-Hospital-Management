<!-- eslint-disable vue/multi-word-component-names -->
<template>
  <HeaderPage />
  <Sidebar />
  <section id="doctors">
    <div class="wrapper">
      <div class="doctors-con">
        <div class="doctors-header-con">
          <button class="btn-primary" @click="toggleAddDoctor()">
            Add Doctor
          </button>
        </div>
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th>Full Name</th>
                <th>Email</th>
                <th>Contact</th>
                <th>Address</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="doctor in doctors" :key="doctor.id">
                <td>{{ doctor.fullname }}</td>
                <td>{{ doctor.email }}</td>
                <td>{{ doctor.contact }}</td>
                <td>{{ doctor.address }}</td>
                <td class="table-btn-con">
                  <select
                    name="selectAction"
                    v-model="selectedAction"
                    @change="handleSelectChange($event, doctor.id)"
                  >
                    <option value="" disabled hidden selected>
                      Select Action
                    </option>
                    <option value="Edit">Edit</option>
                    <option value="Delete">Delete</option>
                  </select>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <AddDoctor :visible="showDoctorModal" @update:visible="toggleAddDoctor" />
    <EditDoctor :visible="showEditModal" @update:visible="toggleEditDoctor" />
    <DeleteDoctor
      :visible="showDeleteDoctor"
      @update:visible="toggleDeleteDoctor"
    />
  </section>
</template>

<script>
import HeaderPage from "../../partials/HeaderPage.vue";
import Sidebar from "../../partials/Sidebar.vue";
import AddDoctor from "./modals/AddDoctor.vue";
import EditDoctor from "./modals/EditDoctor.vue";
import DeleteDoctor from "./modals/DeleteDoctor.vue";

export default {
  data() {
    return {
      selectedAction: "",
      showDoctorModal: false,
      showEditModal: false,
      showDeleteDoctor: false,
    };
  },
  components: {
    HeaderPage,
    Sidebar,
    AddDoctor,
    EditDoctor,
    DeleteDoctor,
  },
  mounted() {
    this.fetchDoctors();
  },
  methods: {
    async fetchDoctors() {
      await this.$store.dispatch("fetchDoctors");
    },
    handleSelectChange(event, id) {
      let selectedAction = event.target.value;

      if (selectedAction === "Delete") {
        this.toggleDeleteDoctor(id);
      } else if (selectedAction === "Edit") {
        this.toggleEditDoctor(id);
      }
    },
    toggleAddDoctor() {
      this.showDoctorModal = !this.showDoctorModal;

      if (this.showDoctorModal == false) {
        this.resetSelectAction();
        this.$store.dispatch("fetchDoctors");
      }
    },
    toggleEditDoctor(id) {
      this.$store.getters.getDoctor(id);
      this.showEditModal = !this.showEditModal;

      if (this.showEditModal == false) {
        this.resetSelectAction();
        this.$store.dispatch("fetchDoctors");
      }
    },
    toggleDeleteDoctor(id) {
      this.$store.getters.getDoctor(id);
      this.showDeleteDoctor = !this.showDeleteDoctor;

      if (this.showDeleteDoctor == false) {
        this.resetSelectAction();
        this.$store.dispatch("fetchDoctors");
      }
    },
    resetSelectAction() {
      this.selectedAction = "";
    },
  },
  computed: {
    doctors() {
      return this.$store.getters.getDoctors;
    },
  },
};
</script>

<style scoped>
#doctors .doctors-con {
  padding: 100px 20px 100px 100px;
}

#doctors .doctors-header-con {
  display: flex;
  justify-content: end;
  margin-bottom: 30px;
}
</style>