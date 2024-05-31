<template>
  <section id="patient">
    <div class="wrapper">
      <div class="patient-container">
        <div class="patient-details">
          <h1>Hospital <span>Management</span> System</h1>
          <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Quas, velit
            hic deleniti voluptatum veniam ea.
          </p>
        </div>
        <form @submit.prevent="loginPatient">
          <div class="field-con">
            <input
              type="email"
              class="form-control"
              name="email"
              id="email"
              v-model="email"
              placeholder="Email"
              @input="clearErrors"
              required
            />
            <small class="text-danger" v-if="errors">{{ errors }}</small>
          </div>
          <div class="field-con">
            <input
              type="password"
              class="form-control"
              name="password"
              placeholder="Password"
              v-model="password"
              @input="clearErrors"
              required
            />
          </div>
          <div class="btn-con">
            <button type="submit" class="btn-primary">LOGIN</button>
          </div>
        </form>
      </div>
    </div>
  </section>
</template>
    
  <script>
import axios from "axios";
export default {
  data() {
    return {
      email: "",
      password: "",
      errors: null,
    };
  },
  methods: {
    async loginPatient() {
      try {
        const response = await axios.post(this.$store.state.apiUrl + "/patientLogin", {
          email: this.email,
          password: this.password,
        });

        if (response.status === 200) {
          localStorage.setItem("user_id", response.data.user_id);
          localStorage.setItem("token", response.data.token);
          localStorage.setItem(
            "account_type",
            JSON.stringify(response.data.account_type)
          );
            this.$router.push("/patient/dashboard");
        }
      } catch (error) {
        this.errors = error.response.data.message;
      }
    },
    clearErrors() {
      this.errors = null;
    },
  },
};
</script>
  
<style scoped>
#patient {
  height: 100vh;
  position: relative;
  margin: 0;
  padding: 0;
}

#patient::before {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-image: url("../assets/Background.jpg");
  background-size: cover;
  background-position: center;
  z-index: -2;
}

#patient::after {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(0, 0, 0, 0.6);
  z-index: -1;
}

#patient > * {
  position: relative;
  z-index: 1;
}

#patient .wrapper {
  max-width: 1440px;
}

#patient .patient-container {
  display: flex;
  justify-content: center;
  gap: 100px;
  align-items: center;
}

#patient .patient-details {
  max-width: 500px;
  width: 100%;
}

#patient .patient-details h1,
#patient .patient-details p {
  color: var(--global-color-white);
}

#patient .patient-details h1 span {
  color: var(--global-color-primary);
}

#patient .patient-container form {
  max-width: 500px;
  width: 100%;
  padding: 20px;
  background: var(--global-color-white);
  box-shadow: var(--global-shadow);
}

@media screen and (max-width: 767px) {
  #patient .patient-container {
    padding: 100px 0;
    text-align: center;
    gap: 50px;
    flex-direction: column;
  }
}

@media screen and (min-width: 768px) {
  #patient .patient-container {
    padding: 100px 0;
    text-align: center;
    gap: 50px;
    flex-direction: column;
  }
}

@media screen and (min-width: 1024px) {
  #patient .patient-container {
    flex-direction: row;
    padding: 200px 0;
    text-align: left;
  }
}
</style>