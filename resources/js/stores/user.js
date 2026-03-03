import { defineStore } from "pinia";
import { userAPI } from "../shared/api/user";

export const useUserStore = defineStore("user", {
    state: () => {
        return {
            users: [],
            user: null,
            isLoading: false,
            error: null,
        };
    },

    actions: {
        async changePassword(data) {
            this.isLoading = false;
            this.error = null;

            try {
                this.isLoading = true;
                const response = await userAPI.changePassword(data);
                console.log("Success change password: ", response.data);
            } catch (err) {
                console.error("Error chsnge password: ", err);
                this.error =
                    err.response?.data?.message || "Error chsnge password";
            } finally {
                this.isLoading = false;
            }
        },

        async disableUser(data) {
            this.isLoading = false;
            this.error = null;

            try {
                this.isLoading = true;
                const response = await userAPI.disableUser(data);
                console.log("Success disable user");
            } catch (err) {
                console.error("Error disable user: ", response.data);
                this.error =
                    err.response?.data?.message || "Error disable userа";
            } finally {
                this.isLoading = false;
            }
        },

        async changeRole(data) {
            this.isLoading = false;
            this.error = null;

            try {
                this.isLoading = true;
                const response = await userAPI.changeRole(data);
                this.user = response.data;
                console.log("Success change role");
            } catch (err) {
                console.error("Error change role: ", response.data);
                this.error = err.response?.data?.message || "Error change role";
            } finally {
                this.isLoading = false;
            }
        },

        async allUser() {
            this.isLoading = false;
            this.error = null;

            try {
                this.isLoading = true;
                const response = await userAPI.allUser();
                this.users = response.data.data;
                this.user = null;
                console.log("Success in allUser");
                return response
            } catch (err) {
                console.error("Error in allUser: ", err);
                this.error = err.response?.data?.message || "Error in allUser";
                throw err;
            } finally {
                this.isLoading = false;
            }
        },

        async findUser(id) {
            this.isLoading = false;
            this.error = null;

            try {
                this.isLoading = true;
                const response = await userAPI.findUser(id);
                this.user = response.data.data;
                console.log("Success find user");
            } catch (err) {
                console.error("Error find user: ", err);
                this.error = err.response?.data?.message || "Error find user";
            } finally {
                this.isLoading = false;
            }
        },

        async byEmail(email) {
            this.isLoading = false;
            this.error = null;

            try {
                this.isLoading = true;
                const response = await userAPI.byEmail(email);
                this.user = response.data.data;
                this.users = [];
                console.log(response.data.data)
                console.log("Success find user by email");
            } catch (err) {
                console.error("Error find user by email: ", err);
                this.error =
                    err.response?.data?.message || "Error find user by email";
            } finally {
                this.isLoading = false;
            }
        },

        async createUser(data) {
            this.isLoading = false;
            this.error = null;

            try {
                this.isLoading = true;
                const response = await userAPI.createUser(data);
                console.log("Success create user");
            } catch (err) {
                console.error("Error create user: ", err);
                this.error = err.response?.data?.message || "Error create user";
            } finally {
                this.isLoading = false;
            }
        },

        async updateUser(id, data) {
            this.isLoading = false;
            this.error = null;

            try {
                this.isLoading = true;
                const response = await userAPI.updateUser(id, data);
                this.user = response.data.data;
                console.log(response.data.data)
                console.log("Success update user");
            } catch (err) {
                console.error("Error update user: ", err);
                this.error = err.response?.data?.message || "Error update user";
            } finally {
                this.isLoading = false;
            }
        },

        async deleteUser(id) {
            this.isLoading = false;
            this.error = null;

            try {
                this.isLoading = true;
                const response = await userAPI.deleteUser(id);
                console.log("Success delete user");
            } catch (err) {
                console.error("Error delete user: ", err);
                this.error = err.response?.data?.message || "Error delete user";
            } finally {
                this.isLoading = false;
            }
        },
    },
});
