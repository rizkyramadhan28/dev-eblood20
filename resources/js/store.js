import axios from "axios";
import { getLocalUser } from "./helpers/auth";

const user = getLocalUser();

export default {
    state: {
        currentUser: user,
        isUserLoggedIn: !!user,
        currentUserPoint: 0,
        isLoading: false
    },
    getters: {
        getCurrentUser(state) {
            return state.currentUser;
        },
        getIsUserLoggedIn(state) {
            return state.isUserLoggedIn;
        },
        getCurrentUserPoint(state) {
            return state.currentUserPoint;
        },
        getIsLoading(state) {
            return state.isLoading;
        }
    },
    mutations: {
        loginSuccess(state, payload) {
            state.isUserLoggedIn = true;
            state.currentUser = Object.assign({}, payload.user, {
                token: payload.access_token
            });
            localStorage.setItem("user", JSON.stringify(state.currentUser));
        },
        logout(state) {
            state.isUserLoggedIn = false;
            state.currentUser = null;
            localStorage.removeItem("user");
        },
        updateCurrentUserPoint(state, payload) {
            state.currentUserPoint = payload;
        },
        updateIsLoading(state, payload) {
            state.isLoading = payload;
        }
    },
    actions: {
        getCurrentUserPoint(context) {
            context.commit("updateIsLoading", true);

            axios
                .get(`/api/users/${context.state.currentUser.id}`)
                .then(response => {
                    context.commit(
                        "updateCurrentUserPoint",
                        response.data.point
                    );
                    context.commit("updateIsLoading", false);
                })
                .catch(error => {
                    context.commit("updateIsLoading", false);
                });
        }
    }
};
