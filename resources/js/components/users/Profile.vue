<template>
  <Loading v-if="isLoading" />

  <div v-else class="col-md-8">
    <div class="card">
      <div class="card-header">Profile</div>

      <div class="card-body">
        <table id="profile-table">
          <thead>
            <tr>
              <th scope="col">Nama</th>
              <td>{{ currentUser.name }}</td>
            </tr>

            <tr>
              <th scope="col">Email</th>
              <td>{{ currentUser.email }}</td>
            </tr>

            <tr>
              <th scope="col">Blood Type</th>
              <td>{{ currentUser.blood_type }}</td>
            </tr>

            <tr>
              <th scope="col">Address</th>
              <td>{{ currentUser.address }}</td>
            </tr>

            <tr>
              <th scope="col">Phone Number</th>
              <td>{{ currentUser.phone_number }}</td>
            </tr>

            <tr>
              <th scope="col">Point</th>
              <td>{{ currentUserPoint.total_point }}</td>
            </tr>

            <tr>
              <th scope="col">Update Akun</th>
              <td>
                <router-link
                  v-bind:to="
                                        `/profile/update/${currentUser.id}`
                                    "
                  class="btn btn-warning"
                >Update</router-link>
              </td>
            </tr>

            <tr>
              <th scope="col">Hapus Akun</th>
              <td>
                <button v-on:click="deleteAccount" class="btn btn-danger">Delete</button>
              </td>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
import Loading from "../pages/Loading.vue";
import axios from "axios";

export default {
  data() {
    return {};
  },
  mounted() {
    this.$store.dispatch("getCurrentUserPoint");
  },
  methods: {
    logout() {
      this.$store.commit("logout");
      this.$router.push("/login");
    },
    deleteAccount() {
      this.$store.commit("updateIsLoading", true);

      axios
        .delete(`/api/users/${this.currentUser.id}`)
        .then(response => {
          this.$store.commit("updateIsLoading", false);
          this.logout();

          Toast.fire({
            icon: "success",
            title: "Account deleted successfully!"
          });
        })
        .catch(error => {
          this.$store.commit("updateIsLoading", false);
        });
    }
  },
  computed: {
    currentUser() {
      return this.$store.getters.getCurrentUser;
    },
    currentUserPoint() {
      return this.$store.getters.getCurrentUserPoint;
    },
    isLoading() {
      return this.$store.getters.getIsLoading;
    }
  },
  components: {
    Loading
  }
};
</script>

<style scoped>
#profile-table {
  width: 100%;
}

#profile-table td {
  padding: 0.5rem;
}
</style>
