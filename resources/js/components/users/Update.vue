<template>
  <Loading v-if="getIsLoading" />

  <div v-else class="col-md-8">
    <div class="card">
      <div class="card-header">Update</div>

      <div class="card-body">
        <form v-on:submit.prevent="updateUser">
          <div class="form-group">
            <label for="nama">Nama</label>
            <input
              v-model="currentUser.name"
              type="text"
              class="form-control"
              id="nama"
              placeholder="Enter your name"
            />

            <p v-if="errors" class="text-danger">
              {{
              errors["name"] ? errors["name"].join("\n") : ""
              }}
            </p>
          </div>

          <div class="form-group">
            <label for="email">Email</label>
            <input
              v-model="currentUser.email"
              type="email"
              class="form-control"
              id="email"
              placeholder="Enter your email address"
            />

            <p v-if="errors" class="text-danger">
              {{
              errors["email"]
              ? errors["email"].join("\n")
              : ""
              }}
            </p>
          </div>

          <div class="form-group">
            <label for="address">Address</label>
            <textarea
              v-model="currentUser.address"
              class="form-control"
              id="address"
              rows="3"
              placeholder="Enter your address"
            ></textarea>

            <p v-if="errors" class="text-danger">
              {{
              errors["address"]
              ? errors["address"].join("\n")
              : ""
              }}
            </p>
          </div>

          <div class="form-group">
            <label for="phone_number">Phone Number</label>
            <input
              v-model="currentUser.phone_number"
              type="number"
              class="form-control"
              id="phone_number"
              placeholder="Enter your phone number"
            />

            <p v-if="errors" class="text-danger">
              {{
              errors["phone_number"]
              ? errors["phone_number"].join("\n")
              : ""
              }}
            </p>
          </div>

          <router-link v-bind:to="`/profile/${currentUser.id}`" class="btn btn-primary">Back</router-link>

          <button type="submit" class="btn btn-warning float-right">Update</button>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import Loading from "../pages/Loading.vue";
import axios from "axios";

export default {
  data() {
    return {
      errors: null
    };
  },
  computed: {
    currentUser() {
      return this.$store.getters.getCurrentUser;
    },
    getIsLoading() {
      return this.$store.getters.getIsLoading;
    }
  },
  methods: {
    logout() {
      this.$store.commit("logout");
      this.$router.push("/login");
    },
    updateUser() {
      const { name, email, address, phone_number } = this.currentUser;
      const updatedUser = { name, email, address, phone_number };

      this.$store.commit("updateIsLoading", true);

      axios
        .patch(`/api/users/${this.currentUser.id}`, updatedUser)
        .then(response => {
          this.$store.commit("updateIsLoading", false);
          this.logout();

          Toast.fire({
            icon: "success",
            title: "Updated successfully. Please relogin to see the change!"
          });
        })
        .catch(error => {
          this.errors = error.data.errors;
          this.$store.commit("updateIsLoading", false);
        });
    }
  },
  components: {
    Loading
  }
};
</script>
