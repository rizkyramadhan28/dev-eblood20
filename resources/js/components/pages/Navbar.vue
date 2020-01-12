<template>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <router-link to="/" class="navbar-brand" exact-active-class="active"
                >Dev Eblood</router-link
            >

            <button
                class="navbar-toggler"
                type="button"
                data-toggle="collapse"
                data-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown"
                aria-expanded="false"
                aria-label="Toggle navigation"
            >
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <router-link
                        v-if="currentUser"
                        to="/hospital"
                        class="nav-link"
                        exact-active-class="active"
                        >Hospital</router-link
                    >

                    <li class="nav-item dropdown">
                        <a
                            class="nav-link dropdown-toggle"
                            href="#"
                            id="navbarDropdownMenuLink"
                            role="button"
                            data-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false"
                            >Action</a
                        >
                        <div
                            class="dropdown-menu"
                            aria-labelledby="navbarDropdownMenuLink"
                        >
                            <template v-if="!currentUser">
                                <router-link
                                    to="/login"
                                    class="dropdown-item"
                                    exact-active-class="active"
                                    >Login</router-link
                                >
                                <router-link
                                    to="/signup"
                                    class="dropdown-item"
                                    exact-active-class="active"
                                    >Signup</router-link
                                >
                            </template>

                            <template v-else>
                                <router-link
                                    v-bind:to="`/profile/${currentUser.id}`"
                                    class="dropdown-item"
                                    exact-active-class="active"
                                    >Profile</router-link
                                >
                                <a
                                    class="dropdown-item"
                                    href="#"
                                    v-on:click="logout"
                                    >Logout</a
                                >
                            </template>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script>
export default {
    computed: {
        currentUser() {
            return this.$store.getters.getCurrentUser;
        }
    },
    methods: {
        logout() {
            this.$store.commit("logout");
            this.$router.push("/login");
        }
    }
};
</script>
