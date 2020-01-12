<template>
    <Loading v-if="isLoading" />

    <div v-else class="col-md-8">
        <div class="card">
            <div class="card-header">Login</div>
            <div class="card-body">
                <p v-if="loginError" id="loginError" class="text-danger mb-2">
                    {{ loginError }}
                </p>

                <div class="form-group">
                    <form v-on:submit.prevent="userLogin">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input
                                v-model="user.email"
                                type="email"
                                class="form-control"
                                id="email"
                                placeholder="Enter your email address"
                            />
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input
                                v-model="user.password"
                                type="password"
                                class="form-control"
                                id="password"
                                placeholder="Enter your password"
                            />
                        </div>

                        <button
                            type="submit"
                            class="btn btn-primary float-right"
                        >
                            Submit
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { login } from "../../helpers/auth";
import Loading from "../pages/Loading.vue";

export default {
    data() {
        return {
            user: {
                email: "",
                password: ""
            },
            loginError: ""
        };
    },
    computed: {
        isLoading() {
            return this.$store.getters.getIsLoading;
        }
    },
    methods: {
        userLogin() {
            this.$store.commit("updateIsLoading", true);

            login(this.user)
                .then(res => {
                    this.$store.commit("loginSuccess", res);
                    this.$store.commit("updateIsLoading", false);
                    this.$router.push("/");

                    Toast.fire({
                        icon: "success",
                        title: "Login success!"
                    });
                })
                .catch(err => {
                    this.loginError = err;
                    this.$store.commit("updateIsLoading", false);
                });
        }
    },
    components: {
        Loading
    }
};
</script>
