import axios from "axios";

export function login(credentials) {
    return new Promise((res, rej) => {
        axios
            .post("/api/auth/login", credentials)
            .then(response => res(response.data))
            .catch(error => rej("Wrong email or password!"));
    });
}

export function signup(credentials) {
    return new Promise((res, rej) => {
        axios
            .post("/api/auth/new", credentials)
            .then(response => res(response.data))
            .catch(error => rej(error.response));
    });
}

export function getLocalUser() {
    const user = localStorage.getItem("user");

    if (!user) {
        return null;
    }

    return JSON.parse(user);
}
