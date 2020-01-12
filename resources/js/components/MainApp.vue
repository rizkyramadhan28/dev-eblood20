<template>
  <div>
    <Navbar />
    <div class="container mt-5 mb-5">
      <div class="row justify-content-center">
        <router-view></router-view>
      </div>
    </div>
  </div>
</template>

<script>
import Navbar from "./pages/Navbar.vue";

export default {
  components: {
    Navbar
  }
};
</script>
