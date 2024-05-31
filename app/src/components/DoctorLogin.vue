<template>
  <section id="doctor">
    <div class="wrapper">
      <div class="doctor-container">
        <div class="doctor-details">
          <h1>Hospital <span>Management</span> System</h1>
          <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Quas, velit
            hic deleniti voluptatum veniam ea.
          </p>
        </div>
        <form @submit.prevent="loginDoctor">
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
    async loginDoctor() {
      try {
        const response = await axios.post(this.$store.state.apiUrl + "/doctorLogin", {
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
            this.$router.push("/doctor/dashboard");
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
#doctor {
  height: 100vh;
  position: relative;
  margin: 0;
  padding: 0;
}

#doctor::before {
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

#doctor::after {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(0, 0, 0, 0.6);
  z-index: -1;
}

#doctor > * {
  position: relative;
  z-index: 1;
}

#doctor .wrapper {
  max-width: 1440px;
}

#doctor .doctor-container {
  display: flex;
  justify-content: center;
  gap: 100px;
  align-items: center;
}

#doctor .doctor-details {
  max-width: 500px;
  width: 100%;
}

#doctor .doctor-details h1,
#doctor .doctor-details p {
  color: var(--global-color-white);
}

#doctor .doctor-details h1 span {
  color: var(--global-color-primary);
}

#doctor .doctor-container form {
  max-width: 500px;
  width: 100%;
  padding: 20px;
  background: var(--global-color-white);
  box-shadow: var(--global-shadow);
}

@media screen and (max-width: 767px) {
  #doctor .doctor-container {
    padding: 100px 0;
    text-align: center;
    gap: 50px;
    flex-direction: column;
  }
}

@media screen and (min-width: 768px) {
  #doctor .doctor-container {
    padding: 100px 0;
    text-align: center;
    gap: 50px;
    flex-direction: column;
  }
}

@media screen and (min-width: 1024px) {
  #doctor .doctor-container {
    flex-direction: row;
    padding: 200px 0;
    text-align: left;
  }
}
</style>