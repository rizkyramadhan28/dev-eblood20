<template>
    <Loading v-if="isLoading" />

    <div v-else class="col-md-8">
        <div class="card">
            <div class="card-header">Signup</div>
            <div class="card-body">
                <form v-on:submit.prevent="userSignup">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input
                            v-model="user.name"
                            type="name"
                            class="form-control"
                            id="name"
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
                            v-model="user.email"
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
                        <label for="password">Password</label>
                        <input
                            v-model="user.password"
                            type="password"
                            class="form-control"
                            id="password"
                            placeholder="Enter your password"
                        />

                        <p v-if="errors" class="text-danger">
                            {{
                                errors["password"]
                                    ? errors["password"].join("\n")
                                    : ""
                            }}
                        </p>
                    </div>

                    <div class="form-group">
                        <label for="bloodType">Blood Type</label>
                        <select
                            v-model="user.blood_type"
                            class="form-control"
                            id="bloodType"
                        >
                            <option
                                v-for="(gol_darah, index) in bloodTypes"
                                v-bind:key="index"
                                >{{ gol_darah }}</option
                            >
                        </select>

                        <p v-if="errors" class="text-danger">
                            {{
                                errors["blood_type"]
                                    ? errors["blood_type"].join("\n")
                                    : ""
                            }}
                        </p>
                    </div>

                    <div class="form-group">
                        <label for="address">Address</label>
                        <textarea
                            v-model="user.address"
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
                            v-model="user.phone_number"
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

                    <button type="submit" class="btn btn-primary float-right">
                        Submit
                    </button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import { signup } from "../../helpers/auth";
import validate from "validate.js";
import Loading from "../pages/Loading.vue";

export default {
    data() {
        return {
            bloodTypes: ["O−", "O+", "A-", "A+", "B-", "B+", "AB-", "AB+"],
            user: {
                name: "",
                email: "",
                password: "",
                blood_type: "O−",
                address: "",
                phone_number: ""
            },
            errors: null
        };
    },
    computed: {
        isLoading() {
            return this.$store.getters.getIsLoading;
        }
    },
    methods: {
        userSignup() {
            this.errors = null;

            const constraints = this.getConstraints();

            const errors = validate(this.user, constraints);

            if (errors) {
                this.errors = errors;
                return;
            }

            this.$store.commit("updateIsLoading", true);

            signup(this.user)
                .then(response => {
                    this.$store.commit("updateIsLoading", false);
                    this.$router.push("/login");

                    Toast.fire({
                        icon: "success",
                        title: "Signup success!"
                    });
                })
                .catch(error => {
                    this.$store.commit("updateIsLoading", false);
                });
        },
        getConstraints() {
            return {
                name: {
                    presence: true,
                    length: {
                        minimum: 5,
                        maximum: 255,
                        message:
                            "Must be at least 5 characters long and less than 255 characters!"
                    }
                },
                email: {
                    presence: true,
                    email: true
                },
                password: {
                    presence: true,
                    length: {
                        minimum: 6,
                        maximum: 255,
                        message:
                            "Must be at least 5 characters long and less than 255 characters!"
                    }
                },
                blood_type: {
                    presence: true
                },
                address: {
                    presence: true,
                    length: {
                        minimum: 1,
                        maximum: 255,
                        message: "Must be less than 255 characters!"
                    }
                },
                phone_number: {
                    presence: true,
                    length: {
                        minimum: 1,
                        maximum: 255,
                        message:
                            "Must be at least 12 characters long and less than 255 characters!"
                    }
                }
            };
        }
    },
    components: {
        Loading
    }
};
</script>
